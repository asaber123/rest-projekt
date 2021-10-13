<?php
class Workplace{
    private $db;
    private $id;
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
        if (strlen($name) > 1 || strlen($description) > 1 || strlen($date) > 0 || strlen($text) > 1){
            $this->name = $name;
            $this->description = $description;
            $this->date = $date;
            $this->text = $text;
            $sql = "INSERT INTO workplaces_portfolio(name, description, date, text)VALUES('$this->name','$this->description', '$this->date', '$this->text');";
            return mysqli_query($this->db, $sql);
        } else {
            return false;
        }
    }    
    
    //Uppdaterar värdet från en kurs med id
    function updateWorkplace($id, $name, $description, $date, $text){
        if (strlen($name) > 1 || strlen($description) > 1 || strlen($date) > 0 || strlen($text) > 1){

        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->text = $text;
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