<?php
 class Courses{
    private $db;
    private $id;
    private $code;
    private $name;
    private $description;
    private $link;

    //constructorsom körs direkt i klassen
    function __construct()
    {
        $this->db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE); if ($this->db->connect_errno > 0) {
            die("Fel vid anlutning:" . $this->db->connect_error);
        }
    } 
    //Returnerar alla poster ifrån tabbellen "courses"
    function getCourse($id){
        $sql = "SELECT * FROM courses_portfolio WHERE id = '$id';";
        $result = $this->db->query($sql);

        //return result as an array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Returnerar alla poster ifrån tabbellen "courses"
    function getCourses(){
        $sql = "SELECT * FROM courses_portfolio;";
        $result = $this->db->query($sql);

        //returnerar som en array
        if (!empty($result)){
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else{
            return "inga kurser hittades";
        }
    }
    //Lägger till ny kurs. Returnerar true om det blir en lyckad lagring, annars returneras false
    function addCourse($name, $link, $description): bool{
        if (strlen($name) > 1 || strlen($link) > 1 || strlen($description) > 1){
            $this->name = $name;
            $this->link = $link;
            $this->description = $description;
            $sql = "INSERT INTO courses_portfolio(name, link, description)VALUES('$this->name','$this->link', '$this->description');";
            return mysqli_query($this->db, $sql);
        } else {
            return false;
        }
    }    
    
    //Uppdaterar värdet från en kurs med id
    function updateCourse($id, $name, $link, $description){
        if (strlen($name) > 1 || strlen($link) > 1 || strlen($description) > 1){

        $this->name = $name;
        $this->link = $link;
        $this->description = $description;
        $id = intval($id);
        $sql = "UPDATE courses_portfolio SET name= '$name', link= '$link', description= '$description'  WHERE id= $id;";
        return mysqli_query($this->db, $sql);
    }else{
        return false;
    }
    }

    //Tar bort kurs med id
    function deleteCourse($id):bool{
        $sql = "DELETE FROM courses_portfolio WHERE id=$id;";

        $result= $this->db->query($sql);
        return $result;
    }
    function close(){
        $this->db = null; 
    }

 }