var request = require('request');
var sleep = require('sleep');
var mysql = require('mysql');
var moment = require('moment');
var log4js = require('log4js');
log4js.loadAppender('file');
log4js.addAppender(log4js.appenders.file('../logs/bulk_gateway_'+moment().format('YYYYMMDD')+'.log'), 'DESC');

var logger = log4js.getLogger('DESC');
logger.setLevel('trace');

var connection = mysql.createConnection({
  host     : 'db4free.net',
  user     : 'desc_admin',
  password : 'desc_admin123',
  database : 'descteamoverdue'
});

var sendUrl = 'https://post.chikka.com/smsapi/request';
var statusUrl = 'https://descdev-dyleenwilard.c9users.io/desc/public/api/sms/status/manual';

while(process.pid != -1){
    logger.trace('Opening Database Connection');
    
    connection.connect();
    
    var test = connection.query('SELECT * FROM queue WHERE delivery = 0 AND sms_type = 1 LIMIT ' + process.argv[2], function(err, rows, fields) {
        if (!err)
        {
            if(rows.length > 0){
                logger.trace('Getting '+row.length+' Transactions');
                for(var row in rows)
                {
                    logger.trace('Cluster ID: ' + rows[row].cluster_id);
                    logger.trace('Reference ID: ' + rows[row].reference_id);
                    logger.trace('Mobile Number: ' + rows[row].number);
                    logger.trace('Message: ' + rows[row].message);
                    var postData = {
                        message_type: 'SEND',
                        mobile_number: rows[row].number,
                        shortcode: '292908435',
                        message_id: rows[row].reference_id,
                        message: rows[row].message,
                        client_id: 'd5a4869a3a862984ea79f62c28edb75e655ed7977555760404b30b111a21f77b',
                        // secret_key: 'bca2d3600032075d32af6ce3a3a54a8c0157a010bdf15008ed5ec7369ee1e010'
                    };
                    logger.trace('Sending transaction to ' + url);
                    request.post({url: sendUrl, form: postData}, function(err,httpResponse,body)
                    {
                        if(!err){
                            var parsedBody = JSON.parse(body);
                            if(parsedBody.status != 200)
                            {
                                logger.trace('ERROR: '+parsedBody.status+':'+parsedBody.message);
                                var outboundStatusData = {
                                  cluster_id: rows[row].cluster_id,
                                  reference_id: rows[row].reference_id,
                                  status_code: parsedBody.status,
                                  status_message: parsedBody.message,
                                  status_description: (parsedBody.description) ? parsedBody.description : ''
                                };
                                logger.trace('Manually Saving response');
                                request.post({url: statusUrl, form: outboundStatusData}, function(err,httpResponse,body){});
                            }
                            logger.trace('SUCCESS: '+parsedBody.status+':'+parsedBody.message);
                        } else {
                            console.log(err);
                        } 
                    });
                    var outboundData = {
                        cluster_id: rows[row].cluster_id,
                        sms_type: rows[row].sms_type,
                        reference_id: rows[row].reference_id,
                        number: rows[row].number,
                        message: rows[row].message,
                        time_prepared: rows[row].time_prepared,
                        request_id: "",
                        time_delivered: moment().format('YYYY-MM-DD H:m:s')
                    };
                    connection.query('INSERT INTO outbound SET ?', outboundData, function(err, result) {});
                    connection.query("DELETE FROM queue WHERE reference_id = '" + rows[row].reference_id + "'", function(err, result) {});
                }
            } else {
                logger.trace('...');
            }
            logger.trace('Closing Database Connection');
            connection.end();
        } else {
            console.log('Error while performing Query.');
        }    
    });
}