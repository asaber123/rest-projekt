<?php
/*Headers*/

//Allows the webbservice to be reached from all domains.
header('Access-Control-Allow-Origin: *');

//Inform that the webbservice is sending data in JSON format. 
header('Content-Type: application/json');

//Setting methods that the webbservice should be able to accept. 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

//Setts what headers that are allowed from client 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Reads what method that are sent. 
$method = $_SERVER['REQUEST_METHOD'];

require 'includes/config.php';


// If a parameter is an id, the variable is set as the id. 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}



//Creates an instance of the class. 
$course = new Course();

//Making switch depending on what method is used. 
switch($method) {
    //In case of get method
    case 'GET':
        //If an id is sent, it will go to the function "getCourse" in the class
        if(isset($id)){
            $result = $course->getCourse($id);
            if(count($result)== 0){
                $result = "There are no courses with id= $id to get";
            }
        //If an id is not sent in, the data will be sent to the function "getCourses" in the class. 
        } else{
            $result = $course->getCourses();
            if(count($result)== 0){
                $result = "There are no courses to get";
            }
        }
        break;

    case 'POST':
        //Reads the JSON data and transform it into an object. 
        $data = json_decode(file_get_contents("php://input"));
    
        //If all data has been sent in, the data is sent to the function "addCourse" in the class. 
        if($course->addCourse($data->name, $data->link, $data->description)){
            $result = "Course added";
            http_response_code(201); 
        //If the data was not sent or something else went wrong, error message will be displayed. 
        } else {
            $result = "course is not created, all values must be set";
            http_response_code(503);
        }


        break;
    case 'PUT':
        //If no id is sent an error message will be shown. 
        if(!isset($id)) {
            http_response_code(510); 
            $response = "Id is missing";
        //If id is sent it will transform the JSON input and make it into an object.   
        } else {
            $data = json_decode(file_get_contents("php://input"));
            //setting variables
            $name = $data->name;
            $link = $data->link;
            $description = $data->description;
            //If data has been sent in, the data is sent to the function "updateCourse" in the class
        if($course->updateCourse($id, $name, $link, $description))
            http_response_code(200);
            $result = "Course with=$id is updated";
            }
        break;
        //If the method is delete:
    case 'DELETE':
        //If no id is sent with the request, an error message is shown. 
        if(!isset($id)) {
            $result = "An id is missing";  
        } //If an id is sent, data will be sent to "deleteCourse" in the class function. 
        elseif($course->deleteCourse($id)) {
            $result = "Course with id=$id is deleted";
        }
        //If none of above, a different error message will be shown. 
        else {
            $result = "Error, something went wrong";
        }
        break;
        
}

//Transform the result data into JSON format and sent it to the user. 
echo json_encode($result);