<?php
 class Course{
    private $db;
    private $name;
    private $description;
    private $link;
    private $university;

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
    function addCourse($name, $link, $description, $university): bool{
        if (strlen($name) > 0 || strlen($link) > 0 || strlen($description) > 0 || strlen($university) > 0 ){
            $this->name = mysqli_real_escape_string($this->db, $name);
            //Making sure that the inputs are safe and won't create any html, css tags or script code. 
            $safeName = htmlspecialchars($name);
            $safeLink= htmlspecialchars($link);
            $safeDescription= htmlspecialchars($description);
            $safeUniversity= htmlspecialchars($university);

            //Using real escape function to be sure that the database see the input as text and not as sql code. 
            $this->name = mysqli_real_escape_string($this->db, $safeName);
            $this->link = mysqli_real_escape_string($this->db, $safeLink);
            $this->description = mysqli_real_escape_string($this->db, $safeDescription);
            $this->university = mysqli_real_escape_string($this->db, $safeUniversity);
            $sql = "INSERT INTO courses_portfolio(name, link, description, university)VALUES('$this->name','$this->link', '$this->description', '$this->university');";
            return mysqli_query($this->db, $sql);
        } else {
            return false;
        }
    }    
    
    //Uppdaterar värdet från en kurs med id
    function updateCourse($id, $name, $link, $description, $university){
        if (strlen($name) > 0 || strlen($link) > 0 || strlen($description) > 0|| strlen($university) > 0 ){
        //Making sure that the inputs are safe and won't create any html, css tags or script code. 
        $safeName = htmlspecialchars($name);
        $safeLink= htmlspecialchars($link);
        $safeDescription= htmlspecialchars($description);
        $safeUniversity= htmlspecialchars($university);

        //Setting variables and using real escape function to be sure that the database see the input as text and not as sql code. 
        $this->name = mysqli_real_escape_string($this->db, $safeName);
        $this->link = mysqli_real_escape_string($this->db, $safeLink);
        $this->description = mysqli_real_escape_string($this->db, $safeDescription);
        $this->university = mysqli_real_escape_string($this->db, $safeUniversity);
        $id = intval($id);
        $sql = "UPDATE courses_portfolio SET name= '$name', link= '$link', description= '$description', university= '$university'  WHERE id= $id;";
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