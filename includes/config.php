<?php
// Made by Åsa Berglund 2021
$devmode= false;

include 'classes/courses.class.php';
include 'classes/workplaces.class.php';
include 'classes/projects.class.php';


if($devmode){
    //Database connection for localhost
    define("DBHOST", "localhost");
    define("DBUSER", "rest_api_projekt");
    define("DBPASS", "password");
    define("DBDATABASE", "rest_api_projekt");
}
    else {
        //Database connection for mysql simply.com
        define("DBHOST", "mysql112.unoeuro.com");
        define("DBUSER", "asaberglund_se");
        define("DBPASS", "livetpaenpinne2021");
        define("DBDATABASE", "asaberglund_se_db");
    }
