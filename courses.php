<?php
/*Headers med inställningar för din REST webbtjänst*/

//Gör att webbtjänsten går att komma åt från alla domäner (asterisk * betyder alla)
header('Access-Control-Allow-Origin: *');

//Talar om att webbtjänsten skickar data i JSON-format
header('Content-Type: application/json');

//Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Läser in vilken metod som skickats och lagrar i en variabel
$method = $_SERVER['REQUEST_METHOD'];

require 'includes/config.php';


//Om en parameter av id finns i urlen lagras det i en variabel
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}



//Skapar en instans av klassen för att skicka data till databasen, med databasen som parameter
$course = new Course();

switch($method) {
    case 'GET':
        if(isset($id)){
            $result = $course->getCourse($id);
            if(count($result)== 0){
                $result = "There are no courses with id= $id to get";
            }
        } else{
            $result = $course->getCourses();
            if(count($result)== 0){
                $result = "There are no courses to get";
            }
        }
        break;

    case 'POST':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));
    

        if($course->addCourse($data->name, $data->link, $data->description)){
            $result = "Course added";
            http_response_code(201); 

        } else {
            $result = "course is not created, all values must be set";
            http_response_code(503);
        }


        break;
    case 'PUT':
        //Om inget id är med skickat, skickas felmeddelande
        if(!isset($id)) {
            http_response_code(510); 
            $response = "Id is missing";
        //Om id är skickad   
        } else {
            $data = json_decode(file_get_contents("php://input"));
            //deklarerar in värde till klassens properties
            $name = $data->name;
            $link = $data->link;
            $description = $data->description;

        if($course->updateCourse($id, $name, $link, $description))
            http_response_code(200);
            $result = "Course with=$id is updated";
            }
        break;
        //Delete funktion som tar bort objekten med ett visst id.
    case 'DELETE':
        //Om inget id skickas, returneras textsträngen
        if(!isset($id)) {
            $result = "An id is missing";  
        } 
        elseif($course->deleteCourse($id)) {
            $result = "Course with id=$id is deleted";
        }
        else {
            $result = "Error, something went wrong";
        }
        break;
        
}

//Gör om svaret ill Json och skickar tillbaka till avsändaren
echo json_encode($result);
