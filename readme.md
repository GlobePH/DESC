# DESC (Disaster and Emergency Service Center)

Server Requirements

* Laravel
* Node.js 
* MySQL v5.5 
* Redis
    
### Installation

Install the composer vendors:
```sh
$ composer install
```

Install node modules:
```sh
$ npm install
```

You need forever installed globally:

```sh
$ npm i -g forever
```

## Starting the gateway
```sh
    $ forever start gateways/bulkgateway.js <querylimit>
    $ forever start gateways/rtgateway.js <querylimit>
    $ forever start gateways/prioritygateway.js <querylimit>
```    

## Starting the Websocket Server

```sh
    $ forever start server.js
```    