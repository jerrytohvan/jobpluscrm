<?php

require('..\vendor\laravel\framework\src\illuminate\Database\Connectors\PostgresConnector.php');

require('.\Models\Clients\Candidate.php');
use App\Models\Clients\Candidate;
$dbconn = pg_connect("host=127.0.0.1 port=5432 dbname=pgsql user=postgres password=yiyao");
$sql="CREATE TABLE testinf (id varchar(5),name varchar(20),PRIMARY KEY(id))";
pg_exec($dbconn, $sql) or die(pg_errormessage());
// use Illuminate\Database\Eloquent\Model\Clients\Candidate;
//use Illuminate\Database\Eloquent\Model;
$test = Candidate::orderBy('id', 'asc')->get();
print($test);
print('hi');