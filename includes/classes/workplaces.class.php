<?php
class Workplace{
    private $db;
    private $name;
    private $description;
    private $date;
    private $text;

    function __construct()
    {
        $this->db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE); if ($this->db->connect_errno > 0) {
            die("No database connction:" . $this->db->connect_error);
        }
    } 
    function getWorkplace($id){
        $sql = "SELECT * FROM workplaces_portfolio WHERE id = '$id';";
        $result = $this->db->query($sql);

        //return result as an array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function getWorkplaces(){
        $sql = "SELECT * FROM workplaces_portfolio;";
        $result = $this->db->query($sql);

        //returnerar som en array
        if (!empty($result)){
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else{
            return "no data found";
        }
    }
    //Lägger till ny kurs. Returnerar true om det blir en lyckad lagring, annars returneras false
    function addWorkplace($name, $description, $date, $text): bool{
        if (strlen($name) > 0 || strlen($description) > 0 || strlen($date) > 0 || strlen($text) > 0){
            //Making sure that the inputs are safe and won't create any html, css tags or script code. 
            $safeName = htmlspecialchars($name);
            $safeDescription= htmlspecialchars($description);
            $safeDate= htmlspecialchars($date);
            $safeText = htmlspecialchars($text);

            //Setting variables and using real escape function to be sure that the database see the input as text and not as sql code. 
            $this->name = mysqli_real_escape_string($this->db, $safeName);
            $this->description = mysqli_real_escape_string($this->db, $safeDescription);
            $this->date = mysqli_real_escape_string($this->db, $safeDate);
            $this->text = mysqli_real_escape_string($this->db, $safeText);
            $sql = "INSERT INTO workplaces_portfolio(name, description, date, text)VALUES('$this->name','$this->description', '$this->date', '$this->text');";
            return mysqli_query($this->db, $sql);
        } else {
            return false;
        }
    }    
    
    //Uppdaterar värdet från en kurs med id
    function updateWorkplace($id, $name, $description, $date, $text){
        if (strlen($name) > 0 || strlen($description) > 0 || strlen($date) > 0 || strlen($text) > 0){
        //Making sure that the inputs are safe and won't create any html, css tags or script code. 
        $safeName = htmlentities($name, ENT_QUOTES, "UTF-8");
        $safeDescription= htmlentities($description, ENT_QUOTES, "UTF-8");
        $safeDate= htmlentities($date, ENT_QUOTES, "UTF-8");
        $safeText = htmlentities($text, ENT_QUOTES, "UTF-8");

        //Setting variables and using real escape function to be sure that the database see the input as text and not as sql code. 
        $this->name = mysqli_real_escape_string($this->db, $safeName);
        $this->description = mysqli_real_escape_string($this->db, $safeDescription);
        $this->date = mysqli_real_escape_string($this->db, $safeDate);
        $this->text = mysqli_real_escape_string($this->db, $safeText);
        $id = intval($id);
        $sql = "UPDATE workplaces_portfolio SET name= '$name', description= '$description', date= '$date', text ='$text'  WHERE id= $id;";
        return mysqli_query($this->db, $sql);
    }else{
        return false;
    }
    }

    //Tar bort kurs med id
    function deleteWorkplace($id):bool{
        $sql = "DELETE FROM workplaces_portfolio WHERE id=$id;";

        $result= $this->db->query($sql);
        return $result;
    }
    function close(){
        $this->db = null; 
    }

}