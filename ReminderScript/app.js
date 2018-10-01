const express = require('express');
const data = require('./function.js');
const bodyParser = require('body-parser');
const http = require('http');
const cron = require("cron").CronJob;
const req = require('request');
const app = express();

// app.use(bodyParser.urlencoded({ extended: false }));
// app.use(bodyParser.json());

// app.get('localhost:8000/mailData', function (req, res) {
//     res.send(data.starter());
//   })
// app.get('/mailout', function (incoming_req, res) {
//     res.send('mail data invoke world');
//     const options = {
//         hostname: 'localhost',
//         port: 8000,
//         path: '/mailData',
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         }
//       };
//       const req = http.request(options, function(res) {
//         console.log('Status: ' + res.statusCode);
//         console.log('Headers: ' + JSON.stringify(res.headers));
//         res.setEncoding('utf8');
//         res.on('data', function (body) {
//           //console.log('Body: ' + body);
//         });
//       });
//       req.on('error', function(e) {
//         console.log('problem with request: ' + e.message);
//       });
//       // write data to request body

//       req.write("hellow");
//       req.end();
//   });
//console.log(data.display());


// async function d(){
//   const d = await data.display();
//   app.get('/display',function(req,res){

//     //console.log(r);
//     res.send(d);
//   })
// }
// d();


// async function d(){
//   const d = await data.display();
//   app.get('/mailData', function (req, res) {
//     var options = {
//       host: 'localhost',
//       port: '8000',
//       path: '/tasks/data',
//       method: 'GET',
//       //method: 'POST',
//       json: true,
//       headers: {
//         accept: 'application/json',
//         'data': '123'
//       }
//     };


//     new cron("* * * * * *", function () {
//       //res = test(now, d);
//       //const p = "printed";
//       console.log('started');



//       var x = http.request(options, function (res) {
//         console.log("Connected");
//         res.on('data', function (data) {
//           //res.send('123');
//           res.status(200).json({ foo : 'bar' });
//         });
//       });

//       x.end();
//       //return res.then();
//       //starter();
//     }, null, true, 'Asia/Singapore');

//     res.status(200).json(d);

//   })
// }
// d();



async function mapData() {
  const queryResult = await data.display();
  let keys;
  let values = [];
  let results = [];
  app.get('/mailData', function (req, res) {
    const options = {
      host: 'localhost',
      port: '8000',
      path: '/tasks/data',
      method: 'GET',
      //method: 'POST',
      json: true,
      headers: {
        accept: 'application/json',
      }
    }
    if (queryResult == null) {
      const error = "Failed";
      res.status(400).json(error);
    }
    let connector = http.request(options, function (res) {
    });

    connector.end();
    keys = Array.from(queryResult.keys());
    for (let key of keys) {
      if (queryResult.has(key)) {
        values.push(queryResult.get(key));
      }
    }
    results.push(keys, values);
    res.status(200).json(results);
  })
}

const job = new cron("* * * * * *", function () {
  mapData();
}, null, true, 'Asia/Singapore');

job.start();



app.listen(3000)