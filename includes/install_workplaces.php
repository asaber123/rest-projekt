<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}


$sql ="DROP TABLE IF EXISTS workplaces_portfolio;";
$sql .= "CREATE TABLE workplaces_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(150) NOT NULL,
    date VARCHAR(32) NOT NULL UNIQUE,
    text VARCHAR(150) NOT NULL
);";
//lite test data
$sql .="INSERT INTO workplaces_portfolio(id, name,description, date, text) VALUES (1, 'Aptiv', 'Summer student internship', '2021/04/01 - 2021/09/20', 'Texttext');";

/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Table workplaces_portfolio is installed!";
} else {
    echo "Something happend, table workplaces_portfolio are not installed!";
}