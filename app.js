const express = require('express');
const data = require('./function.js');
const http = require('http');
const cron = require("cron").CronJob;
const req = require('request');
const app = express();

// some http shet
const httpAgent = new http.Agent({
  keepAlive: true
});

//php end point
const options = {
  host: 'localhost',
  port: '8000',
  path: '/tasks/data',
  method: 'GET',
  //method: 'POST',
  json: true,
  headers: {
    accept: 'application/json',
  },
}


options.agent = httpAgent;
let connector;

// connection function for hhtp reuqest it is ketpt alive all the time
function connection() {
  try {
  connector = http.request(options,function (response) {
    console.log(response.statusCode);
    console.log(response.statusMessage);
    
  });
  console.log("here")
   connector.end();
  }
  catch (err) {
    console.log(err);
  }
  
}



// //This is for email n tele reminder
// async function dailyReminder() {
//   let keys;
//   let values = [];
//   let results = [];
//   connection();
//   app.get('/mailData', async function (req, res) {
//     const queryResult = await data.dailyReminderQuery();
//     console.log("&&&&&&&&&&&&&&&&&&&");
//     console.log(queryResult);
//     console.log("&&&&&&&&&&&&&&&&&&&");
//     if (queryResult == null) {
//       const error = "Failed";
//       res.status(400).json(error);
//     }
//     keys = Array.from(queryResult.keys());
//     for (let key of keys) {
//       if (queryResult.has(key)) {
//         values.push(queryResult.get(key));
//       }
//     }
//     results.push(keys, values);
//     console.log("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$");
//     console.log(results);
//     console.log("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$");
//       res.status(200).json(results);
//       //res.end();
//       keys = [];
//       values = [];
//       results = [];
 
//   })
// }
// const job = new cron("0 0 */12 * * *", function () {
//   dailyReminder();
// }, null, true, 'Asia/Singapore');
// job.start();


//This for tele reminder every 2 hours
async function update() {
  connection();
  app.get('/mailData', async function (req, res) {
    
    let keys;
    let values = [];
    let results = [];
    const queryResult = await data.updateTwoHours();
    console.log("*****************");
    console.log(queryResult);
    console.log("******************");
  
    if (queryResult == null) {
      const error = "Failed";
      res.status(400).json(error);
    }
    keys = Array.from(queryResult.keys());
    for (let key of keys) {
      if (queryResult.has(key)) {
        values.push(queryResult.get(key));
      }
    }
    results.push(keys, values);
      res.status(200).json(results);
      //res.end();
      keys = [];
      values = [];
      results = [];
  })
}



// this one run per min to test
const updateByTwo = new cron("0 */1 * * * *",
  function () {
     update();
  }, null, true, 'Asia/Singapore');

updateByTwo.start();
app.listen(3000)