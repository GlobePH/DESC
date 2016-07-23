var app = require('express')();
var fs = require('fs');

var server = require('http').Server(app);

var io = require('socket.io')(server);

var redis = require('redis');

server.listen(8890);

io.on('connection', function (socket) {
    //console.log(socket);
    var user_id = socket.handshake.query.user_id;
    //var user_id = 1;
    console.log("new client connected " + user_id);
    //comment out when in laptop
    var redisClient = redis.createClient();
    redisClient.subscribe("notification." + user_id);

    redisClient.on("message", function (channel, message) {
        console.log("new message in queue " + message + " channel" + channel);
        socket.emit(channel, message);
    });

    socket.on('disconnect', function () {
        redisClient.quit();
    });
  });
