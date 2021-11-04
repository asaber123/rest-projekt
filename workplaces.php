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
include 'classes/workplaces.class.php';


// If a parameter is an id, the variable is set as the id. 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}



//Creates an instance of the class. 
$workplace = new Workplace();

//Making switch depending on what method is used. 
switch($method) {
    //In case of get method
    case 'GET':
        //If an id is sent, it will go to the function "getProject" in the class
        if(isset($id)){
            $result = $workplace->getWorkplace($id);
            if(count($result)== 0){
                $result = "Det finns inga arbetsplatser med id= $id att hämta";
            }
        //If an id is not sent in, the data will be sent to the function "getWorkplaces" in the class. 
        } else{
            $result = $workplace->getWorkplaces();
            if(count($result)== 0){
                $result = "Det finns inga arbetsplatser att hämta";
            }
        }
        break;

    case 'POST':
        //Reads the JSON data and transform it into an object. 
        $data = json_decode(file_get_contents("php://input"));
        //If all data has been sent in, the data is sent to the function "addProject" in the class. 
        if($workplace->addWorkplace($data->name, $data->description, $data->date, $data->text)){
            $result = "Arbets-erfarenhet tillagd";
            http_response_code(201); 
        //If the data was not sent or something else went wrong, error message will be displayed. 
        } else {
            $result = "Arbetserfarenheten är inte tillagd, alla värden måste vara ifyllda";
            http_response_code(503);
        }


        break;
    case 'PUT':
        //If no id is sent an error message will be shown. 
        if(!isset($id)) {
            http_response_code(510); 
            $response = "Id saknas";
        //If id is sent it will transform the JSON input and make it into an object.   
        } else {
            $data = json_decode(file_get_contents("php://input"));
            //setting variables
            $name = $data->name;
            $description = $data->description;
            $date = $data->date;
            $text = $data->text;
            
            //If data has been sent in, the data is sent to the function "updateProject" in the class
        if($workplace-> updateWorkplace($id, $name, $description, $date, $text))
            http_response_code(200);
            $result = "Arbetserfarenhet med id=$id är uppdaterat";
            }
        break;
        //If the method is delete:
    case 'DELETE':
        //If no id is sent with the request, an error message is shown. 
        if(!isset($id)) {
            $result = "Id saknas";  
        } //If an id is sent, data will be sent to "deleteProject" in the class function. 
        elseif($workplace->deleteWorkplace($id)) {
            $result = "Arbetserfarenhet med id=$id är borttaget";
        }
        //If none of above, a different error message will be shown. 
        else {
            $result = "Varning, något gick fel";
        }
        break;
        
}

//Transform the result data into JSON format and sent it to the user. 
echo json_encode($result);