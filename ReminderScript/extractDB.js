const pg = require('pg');
const Promise = require('bluebird');
const conString = "postgres:postgres:yiyao@localhost:5432/jobplus";
let client;
const fs = require('fs');
function connect() {
  client = new pg.Client(conString);
  Promise.promisifyAll(client);
  client.on('error', error => {
      connect();
  });
  return client.connect();
}



connect();
 
 return new Promise((resolve, reject) => {
  const query = "select table_name from information_schema.tables where table_schema='public' and table_type='BASE TABLE'";
  client.query(query)
            .then(res => {
                let tables = res.rows;
                for (let table of tables) {
                  const queryInner = "select * from " + table.table_name;
                  const createStream = fs.createWriteStream("./Data/"+table.table_name+".json");
                  createStream.end();
                  client.query(queryInner)
                  .then(res =>{
                    fs.writeFileSync('./Data/'+table.table_name+'.json',JSON.stringify(res.rows,null,4));
                  })
                  
                }
                
                
                
            })
            .catch(e => console.error(e.stack));


            
 })

 

