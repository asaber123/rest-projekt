<?php
// class Courses{
//     private $db;
//     private $id;
//     private $code;
//     private $name;
//     private $progression;
//     private $link;

//     //constructorsom körs direkt i klassen
//     function __construct()
//     {
//         $this->db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE); if ($this->db->connect_errno > 0) {
//             die("Fel vid anlutning:" . $this->db->connect_error);
//         }
//     } 
//     //Returnerar alla poster ifrån tabbellen "courses"
//     function getCourse($id){
//         $sql = "SELECT * FROM courses WHERE id = '$id';";
//         $result = $this->db->query($sql);

//         //return result as an array
//         return mysqli_fetch_all($result, MYSQLI_ASSOC);
//     }

//     //Returnerar alla poster ifrån tabbellen "courses"
//     function getCourses(){
//         $sql = "SELECT * FROM courses;";
//         $result = $this->db->query($sql);

//         //returnerar som en array
//         if (!empty($result)){
//         return mysqli_fetch_all($result, MYSQLI_ASSOC);
//         } else{
//             return "inga kurser hittades";
//         }
//     }
//     //Lägger till ny kurs. Returnerar true om det blir en lyckad lagring, annars returneras false
//     function addCourse($code, $name, $progression, $link): bool{
//         if (strlen($code) > 1 || strlen($name) > 1 || strlen($progression) > 0 || strlen($link) > 1){
//             $this->code = $code;
//             $this->name = $name;
//             $this->progression = $progression;
//             $this->link = $link;
//             $sql = "INSERT INTO courses(code, name, progression, link)VALUES('$this->code','$this->name', '$this->progression', '$this->link');";
//             return mysqli_query($this->db, $sql);
//         } else {
//             return false;
//         }
//     }    
    
//     //Uppdaterar värdet från en kurs med id
//     function updateCourse($id, $code, $name, $progression, $link){
//         if (strlen($code) > 1 || strlen($name) > 1 || strlen($progression) > 0 || strlen($link) > 1){

//         $this->code = $code;
//         $this->name = $name;
//         $this->progression = $progression;
//         $this->link = $link;
//         $id = intval($id);
//         $sql = "UPDATE courses SET code= '$code', name= '$name', progression= '$progression', link ='$link'  WHERE id= $id;";
//         return mysqli_query($this->db, $sql);
//     }else{
//         return false;
//     }
//     }

//     //Tar bort kurs med id
//     function deleteCourse($id):bool{
//         $sql = "DELETE FROM courses WHERE id=$id;";

//         $result= $this->db->query($sql);
//         return $result;
//     }
//     function close(){
//         $this->db = null; 
//     }

// }