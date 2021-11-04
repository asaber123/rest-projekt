<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}
//creating tables for workplaces
$sql .="DROP TABLE IF EXISTS workplaces_portfolio;";
$sql .= "CREATE TABLE workplaces_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(150) NOT NULL,
    date VARCHAR(32) NOT NULL UNIQUE,
    text VARCHAR(350) NOT NULL
    );";

//Adding data to the webpage for workplaces
$sql .="INSERT INTO workplaces_portfolio( name,description, date, text) VALUES ('Aptiv', 'Sommar-praktik', '2021/04/01 - 2021/09/20', 'Praktiserade på APTIV Advanced Safety under sommaren 2021. Jobbade i agila projektteam och hjälpte till att automatisera olika arbetsprocesser. Hjälpte även till att designa ett visa kort för APRIV student-praktik');";
$sql .="INSERT INTO workplaces_portfolio( name,description, date, text) VALUES ('Örebro Kommun', 'Projektanställning', '2018/04/01 - 2018/10/15', 'Gjorde en förstudie för Örebro kommun som undersökte hur försäljningskanalerna för lokala producenter fungerar i dagsläget samt om det finns några åtgärder kommunenn skulle kunna göra för att förbättra dessa.');";
$sql .="INSERT INTO workplaces_portfolio( name,description, date, text) VALUES ('Harahon hotell', 'Fast anställning', '2019/12/01 - 2020/08/01', 'Jobbade som kock och som hållbarhetsansvarig för restaurangen på Harahon i Hemsedal, Norge');";
$sql .="INSERT INTO workplaces_portfolio( name,description, date, text) VALUES ('Mandelmanns trädgårdar', 'Tidsbegränsad anställning', '2016/04/01 - 2016/08/01', 'Jobbade som kock på den ekologiska gården Mandelmanns trädgårdar där allt som serverades ifrån köket kom från gården. ');";

/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Tabellerna är installerade!";
} else {
    echo "Något hände, det gick inte att installera tabellerna!";
}
