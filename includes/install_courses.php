<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}
$sql ="DROP TABLE IF EXISTS courses_portfolio;";
$sql .= "CREATE TABLE courses_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    link VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);";
//lite test data
$sql .="INSERT INTO courses_portfolio(id, name, link, description) VALUES (1, 'Webbutveckling III', 'https://www.miun.se/utbildning/kurser/Sok-kursplan/kursplan/?kursplanid=21873', 'Grunderna i JavaScript, HTML & CSS');";

/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Table courses_portfolio is installed!";
} else {
    echo "Something happend, Table courses_portfolio are not installed!";
}
