const pg = require('pg');
const Promise = require('bluebird');
const conString = "postgres:postgres:yiyao@localhost:5432/jobplus";
//const client = new pg.Client(conString);
//client.connect();
let client;

function connect() {
    client = new pg.Client(conString);
    Promise.promisifyAll(client);
    client.on('error', error => {
        connect();
    });
    return client.connect();
}




async function datesearch(current, date) {
    connect();
    const upperBound = "'" + current + "' ,'YYYY-MM-DD HH24:MI:SS'";
    const lowerBound = "'" + date + "', 'YYYY-MM-DD HH24:MI:SS'";
    //actual query
    //const query = 'Select * from tasks where date_reminder > (SELECT TO_TIMESTAMP(' + upperBound + ')) AND date_reminder < (SELECT TO_TIMESTAMP(' + lowerBound + '))';
   //testing query
    const query = 'SELECT * from tasks';
    return new Promise((resolve, reject) => {
        client.query(query)
            .then(res => {
                resolve(res.rows);
                client.end();
            })
            .catch(e => console.error(e.stack))
    })

}


async function twoHourSearch(date) {
    connect();
    const queryDate = "'" + date + "' ,'YYYY-MM-DD HH24:MI:SS'";
    //actual query
    //const query = 'Select * from tasks where date_reminder <= (SELECT TO_TIMESTAMP(' + queryDate + '))';
   //testing query 
    const query = 'Select * from tasks'
    return new Promise((resolve, reject) => {
        client.query(query)
            .then(res => {
                resolve(res.rows);
            })
            .catch(e => console.error(e.stack))
    })
}




module.exports = {
    datesearch,
    twoHourSearch
}
