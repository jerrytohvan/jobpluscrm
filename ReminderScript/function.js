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
    return year + "-" + month + "-" + day;
}



async function dailyReminderQuery() {
    const current = formattedDate() + " 08:00:00";
    const iniNextDay = new Date(formattedDate() + " 08:00:00");
    const nextDay = new Date(parseInt(iniNextDay.setDate(iniNextDay.getDate() + 1))).toISOString().replace('T', ' ').substr(0, 19);
   
    let result;

    const results = await Search.datesearch(current, nextDay);

    if (results !== null) {
        const map = sortData(results);
        result = map;
    }
    console.log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
    console.log(result);
    console.log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
    return result;

}

// async function display(){
//    const result =  await test(current, nextDay);
//   // console.log(res);
//    return result;
// }


async function updateTwoHours() {
    const currentDate = new Date().setSeconds(0, 0) + 7200000;
    //console.log(currentDate);
    const dateString = new Date(currentDate).toISOString().replace('T', ' ').substr(0, 19);
    let finalResult;
    const results = await Search.twoHourSearch(dateString);
    if (results !== null) {
        const map = sortData(results);
        finalResult = map;
    }
    console.log("====================");
    console.log(finalResult);
    console.log("====================");
    return finalResult;
}










// function sortIds(tasks) {
//     const ids = [];
//     const uniqueIds = [];
//     for (let task of tasks) {
//         ids.push(task.user_id, task.assigned_id);
//     }
//     for (let i in ids) {
//         if (uniqueIds.indexOf(ids[i]) === -1) {
//             uniqueIds.push(ids[i]);
//         }
//     }
//     return uniqueIds;
// }

function sortData(tasks) {
    let tIds = [];
    let idTaskMap = new Map();
    let arrayMap = [];
    for (let task of tasks) {
        if (task.user_id != 0 || task.assigned_id != 0) {
            if (idTaskMap.has(task.user_id) || idTaskMap.has(task.assigned_id)) {
                tIds = idTaskMap.get(task.user_id);
                tIds.push(task.title + "," + task.description);
                idTaskMap.set(task.user_id, tIds);
                tIds = [];
            } else {
                tIds.push(task.title + "," + task.description);
                idTaskMap.set(task.user_id, tIds);
                tIds = [];
            }
        }
        if (task.assigned_id != 0) {
            if (idTaskMap.has(task.assigned_id)) {
                tIds = idTaskMap.get(task.assigned_id);
                tIds.push(task.title + "," + task.description);
                idTaskMap.set(task.assigned_id, tIds);
                tIds = [];
            } else {
                tIds.push(task.title + "," + task.description);
                idTaskMap.set(task.assigned_id, tIds);
                tIds = [];
            }
        }

    }
    return idTaskMap;
}

module.exports = {
    dailyReminderQuery,
    updateTwoHours
}