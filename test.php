<?php
include("includes/config.php");
$c = new Courses;
$p = new Projects;


//var_dump($c->addCourse("test", "test", "test"));
//var_dump($c->getCourse(6));

//$s->deleteCourse(2);

//var_dump($c->updateCourse(2, "222", "222", "222", "22"));

// echo "<pre>";
// var_dump($c->getCourses());
// echo "</pre>";


//var_dump($c->addProject("test", "test", "test"));
//var_dump($c->getProject(6));

//$c->deleteProject(2);

//var_dump($c->updateProject(2, "222", "222", "222", "22"));

echo "<pre>";
var_dump($p->getProjects());
echo "</pre>";