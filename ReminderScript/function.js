const Search = require('./query');
const cron = require("cron").CronJob;
const http = require('http');
const req = require('request');
// const current = new Date();
//     const nextDayInit = new Date();
//     const twoDaysLtrInit = new Date();
//     const nextDay = new Date(parseInt(nextDayInit.setDate(nextDayInit.getDate()+1)));
//     const twoDays = new Date(parseInt(twoDaysLtrInit.setDate(twoDaysLtrInit.getDate()+2)));
//     console.log(current);
//const date = new Date().toISOString().replace('T', ' ').substr(0, 19);
//new Date().toISOString().replace('T', ' ').substr(0, 19);
//console.log(date);
// console.log(nextDay);
// console.log(twoDays);

// get date n query

//conversion of date for actual code
function formattedDate() {
    const date = new Date();
    let month = String(date.getMonth() + 1);
    let day = String(date.getDate());
    const year = String(date.getFullYear());
  
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return year +"-"+month+"-"+day;
}  

const current = formattedDate() + " 08:00:00";
const iniNextDay = new Date(formattedDate() + " 08:00:00");
const nextDay = new Date(parseInt(iniNextDay.setDate(iniNextDay.getDate()+1))).toISOString().replace('T', ' ').substr(0, 19);

// console.log(nextDay);
// console.log(typeof nextDay);
//console.log(formattedDate());
//console.log(nextDay);
//console.log(new Date());



// const now = new Date('2018-08-30 12:10:26').getTime();

// var d = new Date().getTime();

// actual dynamic code with converted date of 0 and +1

async function test(current, nextDay) {
    let result;
   
    const results = await Search.datesearch(current, nextDay);

    if (results !== null){
        const map = sortData(results);
        result = map;
    }
   // console.log(map);
    //const emails = await Search.usersearch(ids);
    //console.log(emails);
    //result = emails;
    // for(let email of emails){
    //     //console.log(email);
    //     result.push(email);
        
    // }
    //let fmap = map;
   //console.log(result);
   //console.log(fmap);
    return result;

}

async function display(){
   const result =  await test(current, nextDay);
  // console.log(res);
   return result;
}

display();


// async function test(now, d) {

//     const results = await Search.datesearch(now, d);
//     const ids = sortIds(results);
//     const emails = await Search.usersearch(ids);
    //console.log(emails);
    //trail(emails);
    // const m = sortData(results);
    // console.log(m);
//     return emails;
// }
//console.log(test(now,d));
//test(now, d);
//console.log('ini');
//let res;

// var options = {
//     host:'localhost',
//     port:'8000',
//     path:'/tasks/data',
//     method:'GET',
//     //method: 'POST',
//     json: true,
//     headers:{
//         accept:'application/json',
//         'data' : '123'
//     }
//   };
// function trial(){

//   new cron("* * * * * *", function () {
    //res = test(now, d);
    //const p = "printed";
    // console.log('started');

   
      
    // var x = http.request(options,function(res){
    //     console.log("Connected");
    //     res.on('data',function(data){
    //         console.log(data);
    //     });
    // });
    
    // x.end();
    //return res.then();
    //starter();
// },null,true,'Asia/Singapore');
// }
//console.log('fin ini');




 //function starter(){
    //  console.log('starter started');
    // const options = {
    //     hostname: 'localhost',
    //     port: 3000,
    //     path: '/mailout',
    //     method: 'Get',
    //     headers: {
    //         'Content-Type': 'application/json',
    //     }
    //   };
    //   console.log("stage 1");
      //response.send(job.start());
    //   const req = http.request(options, function(res) {
    //       console.log("stage 2");
    //     res.statusCode
        //console.log('Status: ' + res.statusCode);
        // JSON.stringify(res.headers);
        //console.log('Headers: ' + JSON.stringify(res.headers));
        // res.setEncoding('utf8');
        // res.on('data', function (body) {
          //console.log('Body: recieve');
          //return job.start();
    //       console.log("u reached");
    //         console.log(res.send(emails));
    //       res.send(emails);
    //     });
    //   });
    //   req.on('error', function(e) {
    //     console.log('problem with request: ' + e.message);
    //   });
      
    //  return job.start();

 //}



//const user = Search.usersearch(1);
// result.then(console.log);

// result
// .then(function(value){
//     console.log(value);
//     user.then(function(userData){
//         console.log(userData);
//     })
// })

function sortIds(tasks) {
    const ids = [];
    const uniqueIds = [];
    for (let task of tasks) {
        ids.push(task.user_id, task.assigned_id);
    }
    for (let i in ids) {
        if (uniqueIds.indexOf(ids[i]) === -1) {
            uniqueIds.push(ids[i]);
        }
    }
    return uniqueIds;
}

function sortData(tasks){
    let tIds = [];
    let idTaskMap = new Map();
    let arrayMap = [];
    for(let task of tasks){
        if(task.user_id != 0 || task.assigned_id != 0){
            if(idTaskMap.has(task.user_id) || idTaskMap.has(task.assigned_id)){
                tIds = idTaskMap.get(task.user_id);
                tIds.push(task.id);
                idTaskMap.set(task.user_id,tIds);
                tIds = [];
            }else{
                tIds.push(task.id);
                idTaskMap.set(task.user_id,tIds);
                tIds = [];
            }
         }if(task.assigned_id != 0){
            if(idTaskMap.has(task.assigned_id)){
                tIds = idTaskMap.get(task.assigned_id);
                tIds.push(task.id);
                idTaskMap.set(task.assigned_id,tIds);
                tIds = [];
            }else{
                tIds.push(task.id);
                idTaskMap.set(task.assigned_id,tIds);
                tIds = [];
            }
        }
        
    }
    //console.log(idTaskMap);
    return idTaskMap;
}

module.exports = {
    //trial
    display
}