const Search = require('./query');

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
    return result;

}



async function updateTwoHours() {
    console.log("funtion called");
    const currentDate = new Date().setSeconds(0, 0) + 7200000;
    const dateString = new Date(currentDate).toISOString().replace('T', ' ').substr(0, 19);
    let finalResult;
    const results = await Search.twoHourSearch(dateString);
    if (results !== null) {
        const map = sortData(results);
        finalResult = map;
    }
    return finalResult;
}


function sortData(tasks) {
    let tIds = [];
    let idTaskMap = new Map();
    let arrayMap = [];
    console.log(tasks.length);
    for (let task of tasks) {
        if (task.user_id != 0 || task.assigned_id != 0) {
            if (idTaskMap.has(task.user_id) || idTaskMap.has(task.assigned_id)) {
                tIds = idTaskMap.get(task.user_id) == undefined ? [] : idTaskMap.get(task.user_id);
                tIds.push(task.company_id + "," + task.title);
                idTaskMap.set(task.user_id, tIds);
                tIds = [];
            } else {
                tIds.push(task.company_id + "," + task.title);
                idTaskMap.set(task.user_id, tIds);
                tIds = [];
            }
        }
        if (task.assigned_id != 0) {
            if (idTaskMap.has(task.assigned_id)) {
                tIds = idTaskMap.get(task.assigned_id);
                tIds.push(task.company_id + "," + task.title);
                idTaskMap.set(task.assigned_id, tIds);
                tIds = [];
            } else {
                tIds.push(task.company_id + "," + task.title);
                idTaskMap.set(task.assigned_id, tIds);
                tIds = [];
            }
        }
        if(task.collaborator != null){
            for(let collab of task.collaborator){
                if (idTaskMap.has(collab)) {
                    tIds = idTaskMap.get(collab);
                    tIds.push(task.company_id + "," + task.title);
                    idTaskMap.set(collab, tIds);
                    tIds = [];
                } else {
                    tIds.push(task.company_id + "," + task.title);
                    idTaskMap.set(collab, tIds);
                    tIds = [];
                }
            }
        }

    }
    console.log(idTaskMap);
    return idTaskMap;
}

module.exports = {
    dailyReminderQuery,
    updateTwoHours
}