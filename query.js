//const pg = require('pg');
const {Client} = require('pg');
const Promise = require('bluebird');
//const conString = "postgres:postgres:yiyao@localhost:5432/jobplus";
const conString = "postgres://kxryyrrgwnqvgc:7aedc3797a2a6a9c58be8059e514f14d792c08181344b9dfab0751a50c1b0ebd@ec2-50-16-196-138.compute-1.amazonaws.com:5432/d7g4e6fdifqadb";

function connect() {
    //client = new pg.Client(conString);
     client = new Client({
        connectionString: conString,
        ssl: true,
      });
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
                resolve(JSON.stringify(res.rows));
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
                client.end();
            })
            .catch(e => console.error(e.stack))
    })
}




module.exports = {
    datesearch,
    twoHourSearch
}
