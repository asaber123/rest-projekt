<?php
//Made by Åsa Berglund2021
//Create DB using PHP, to install tables go to install.php

include('config.php');

//Connect to DB
$db=new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Fel vid anlutning:" . $this->db->connect_error);
}

// // //Creating table for courses
$sql ="DROP TABLE IF EXISTS courses_portfolio;";
$sql .= "CREATE TABLE courses_portfolio(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    university VARCHAR(62) NOT NULL,
    name VARCHAR(62) NOT NULL,
    link VARCHAR(255) NOT NULL,
    description VARCHAR(350) NOT NULL
);";
// // // // //Adding data to the webpage for courses
$sql .="INSERT INTO courses_portfolio( university, name, link, description) VALUES ('Mittuniversitetet',  'Webbutveckling III', 'https://www.miun.se/utbildning/kurser/Sok-kursplan/kursplan/?kursplanid=21873', 'Fördjupning i JavaScript och Php för att kunna skapa interaktiva webbplatser, baserade på en automatiserad utvecklingsmiljö');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ( 'Projektledning', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27003', 'Syftet med kursen är att ge grundkunskap om projektarbete och ledning av projekt. Kursen fokuseras slutligen mot praktiska studier av reella projekt och tillämpningar av projektmetodik.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Typografi och form för webb', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24399', 'Kursen syftar till att skapa en medvetenhet om grundläggande typografi och läslighet för skärm samt introducera praktiskt designarbete.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Webbanvändbarhet', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30563', 'Kursen syftade till att ge kunskap att implementera/realisera en webbplats som uppfyller användbarhetsmål samt krav för en tillgänglig webbplats.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Webbdesign för CMS', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22324', 'Kursen handlade om att skapa temamallar med HTML, CSS och JavaScript för att sedan överföra dessa till ett CMS. Det CMS system kursen fokuserade på var Wordpress.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Webbutveckling II', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27133', 'Skapandet av interaktiva webbplatser, arbetar med dynamisk HTML, utför databasanslutningar och utvecklar en webbmiljö med hjälp av olika utvecklingsverktyg och scriptspråk såsom Php.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Databaser', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=21595', 'Grundläggande kunskaper om relationsdatabaser, datamodellering och frågespråket SQL. Kursen innehöll lärande av konstruktion av databaser utifrån datamodellering.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Digital bildbehandling för webb', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24403', 'Kursens syfte var att lära sig grunderna i bildbehandling och skapande av grafik for webb. Kursen går även igenom grundläggande begrepp inom webbutveckling så som sitemaps och designskisser.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Webbutveckling I', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=18908', 'Grunder i HTML och CSS. Kursens övergripande mål är att ge god förståelse för vikten av genomtänkt design på en webbplats. Att kunna analysera de tänkta användarna, men även rent praktiskt realisera denna design i en användbar webbplats.', 'Mittuniversitetet');";
$sql .="INSERT INTO courses_portfolio(name, link, description, university) VALUES ('Introduktion till programmering i JavaScript', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30811', 'Grunderna för programering i JavaScript');";



/* If success, print print pre tag else warning */
if($db->multi_query($sql)) {
    echo "Tabellerna är installerade!";
} else {
    echo "Något hände, det gick inte att installera tabellerna!";
}
