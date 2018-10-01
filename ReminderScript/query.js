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



// const date = new Date().toISOString().replace('T', '').substr(0, 19);
async function datesearch(current, date) {
    connect();
    //const query = 'SELECT * from tasks  where(user_id,assigned_id) IN ( SELECT DISTINCT user_id, assigned_id from tasks where date_reminder  < to_timestamp(' +current+') or date_reminder > to_timestamp('+date+'))';
    //const query = 'Select distinct user_id,assigned_id from tasks where(date_reminder  < to_timestamp(' + current + ') or date_reminder > to_timestamp(' + date + '))';
    //const query = 'Select * from tasks where(date_reminder  < to_timestamp(' + current + ') and date_reminder > to_timestamp(' + date + '))';
    // const s = 'YYYY-MM-DD hh:mi:ss';
    // let cs = current + 3600000;
    // let cst = new Date(cs);
    // console.log(cst);
    //console.log(current);
    const dstr = "'"+current+"' ,'YYYY-MM-DD HH24:MI:SS'";
    const outer = "'" + date +"', 'YYYY-MM-DD HH24:MI:SS'";
 //const query = 'Select date_reminder from tasks where date_reminder > (SELECT TO_TIMESTAMP('+outer+'))';
   const query = 'Select * from tasks where date_reminder > (SELECT TO_TIMESTAMP('+dstr+')) AND date_reminder < (SELECT TO_TIMESTAMP('+outer+'))';
    //const query = 'SELECT * from tasks';
   return new Promise((resolve, reject) => {
        client.query(query)
            .then(res => {
                resolve(res.rows);
                //console.log(res.rows);
                //client.end();
                client.end();
                

            })
            .catch(e => console.error(e.stack))
    })

}

// async function teleIdSearch(ids){
//     const params = [];
//     for (id of ids) {
//         if (id != null) {
//             params.push(id);
//         }
//     }
    

//     const query = 'SELECT teleId from users where id in (' + params.join(',') + ')';
//     return new Promise((resolve, reject) => {
//         client.query(query)
//             .then(res => {
//                 resolve(res.rows);
              
//             })
//             .catch(e => console.error(e.stack))

//     })
// }

async function usersearch(ids) {

    const params = [];
    for (id of ids) {
        if (id != null) {
            params.push(id);
        }
    }
    //console.log(params);

    const query = 'SELECT email from users where id in (' + params.join(',') + ')';
    return new Promise((resolve, reject) => {
        client.query(query)
            .then(res => {
                resolve(res.rows);
                // console.log(res.rows);
                client.end();
                //const client = new pg.Client(conString);
                //client.connect();
                //connect();
            })
            .catch(e => console.error(e.stack))

    })


}
// client.query('SELECT * from users')
//     .then(res => {
//         console.log(res.rows)
//         client.end();
//     })
//     .catch(e => console.error(e.stack))


module.exports = {
    datesearch,
    usersearch
}
// pool.connect()
//   .then(client => {
//     return client.query('SELECT * FROM users', [1])
//       .then(res => {
//         client.release()
//         console.log(res.rows)
//       })
//       .catch(e => {
//         client.release()
//         console.log(err.stack)
//       })
//   })