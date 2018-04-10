<?php
include 'Log.php';

Log::add('Vamo testear isso');


//insert
Log::add('REGISTRO DE LOG DO SISTEMA '. date("G:i"), 'ADMIN', 1);
echo '<hr>';

//find id
$results = Log::find(1);
var_dump($results);
echo '<hr>';

//delete id
$delete = Log::delete(15);
var_dump($delete);
echo '<hr>';

//find all
$results2 = Log::findAll();
var_dump($results2);

//Where
$results2 = Log::findAll("cat='SYSTEM'");
var_dump($results2);