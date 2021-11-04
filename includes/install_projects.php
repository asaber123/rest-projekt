<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}
// //Creating tables for projects
$sql .="DROP TABLE IF EXISTS projects_portfolio;";
$sql .= "CREATE TABLE projects_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(65) NOT NULL,
    description VARCHAR(350) NOT NULL,
    link VARCHAR(350) NOT NULL
    );";

//Adding data to the webpage for projects
$sql .="INSERT INTO projects_portfolio(name, description, link) VALUES ('Svea Gård', 'Företagshemsida med Wordpress som CMS system', 'http://asaberglund.se/wordpress_simply/');";
$sql .="INSERT INTO projects_portfolio(name, description, link) VALUES ('Make an impact', 'Bloggportal med php', 'http://asaberglund.se/impact/');";
$sql .="INSERT INTO projects_portfolio(name, description, link) VALUES ('Hemsedal Skate', 'Mallsida med fokus på typografi', 'http://minafiler.miun.se/~asbe2001/GD008G/Hemsedal-diy/');";
$sql .="INSERT INTO projects_portfolio(name, description, link) VALUES ('Sveriges Radio - Rest-API', 'Hemsida med fokus på att läsa in data ifrån rest-api', 'http://minafiler.miun.se/~asbe2001/dt084g/ProjektJS/');";
$sql .="INSERT INTO projects_portfolio(name, description, link) VALUES ('Umami - Nordiska soya', 'Mallsida med fokus på bildbehandling och grafik', 'http://minafiler.miun.se/~asbe2001/DT163G/Umami/');";

/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Tabellerna är installerade!";
} else {
    echo "Något hände, det gick inte att installera tabellerna!";
}
