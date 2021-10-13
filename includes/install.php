<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}

//Creating table for courses
$sql ="DROP TABLE IF EXISTS courses_portfolio;";
$sql .= "CREATE TABLE courses_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    link VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);";
//creating tables for workplaces
$sql ="DROP TABLE IF EXISTS workplaces_portfolio;";
$sql .= "CREATE TABLE workplaces_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(150) NOT NULL,
    date VARCHAR(32) NOT NULL UNIQUE,
    text VARCHAR(150) NOT NULL
);";
//Creating tables for projects
$sql ="DROP TABLE IF EXISTS projects_portfolio;";
$sql .= "CREATE TABLE projects_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(32) NOT NULL,
    link VARCHAR(32) NOT NULL
);";
//Adding some test data
$sql .="INSERT INTO workplaces_portfolio(id, name,description, date, text) VALUES (1, 'Aptiv', 'Summer student internship', '2021/04/01 - 2021/09/20', 'Texttext');";
$sql .="INSERT INTO courses_portfolio(id, name, link, description) VALUES (1, 'Webbutveckling III', 'https://www.miun.se/utbildning/kurser/Sok-kursplan/kursplan/?kursplanid=21873', 'Grunderna i JavaScript, HTML & CSS');";
$sql .="INSERT INTO projects_portfolio(id, name, description, link) VALUES (1, 'Make an impact', 'Bloggportal med php', 'http://asaberglund.se/impact/');";


/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Tables are installed!";
} else {
    echo "Something happend, tables are not installed!";
}
