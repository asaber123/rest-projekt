<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}
$sql ="DROP TABLE IF EXISTS projects_portfolio;";
$sql .= "CREATE TABLE projects_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(32) NOT NULL,
    link VARCHAR(32) NOT NULL
);";
//lite test data
$sql .="INSERT INTO projects_portfolio(id, name, description, link) VALUES (1, 'Make an impact', 'Bloggportal med php', 'http://asaberglund.se/impact/');";


/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Table projects_portfolio installed!";
} else {
    echo "Something happend, table projects_portfolio are not installed!";
}