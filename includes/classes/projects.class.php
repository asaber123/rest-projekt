<?php
class Project{
    private $db;
    private $name;
    private $description;
    private $link;

    //constructorsom körs direkt i klassen
    function __construct()
    {
        $this->db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE); if ($this->db->connect_errno > 0) {
            die("No database connection:" . $this->db->connect_error);
        }
    } 
    //Returnerar alla poster ifrån tabbellen "courses"
    function getProject($id){
        $sql = "SELECT * FROM projects_portfolio WHERE id = '$id';";
        $result = $this->db->query($sql);

        //return result as an array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Returnerar alla poster ifrån tabbellen "courses"
    function getProjects(){
        $sql = "SELECT * FROM projects_portfolio;";
        $result = $this->db->query($sql);

        //returnerar som en array
        if (!empty($result)){
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else{
            return "No projects found";
        }
    }
    //Lägger till ny kurs. Returnerar true om det blir en lyckad lagring, annars returneras false
    function addProject($name, $description, $link): bool{
        if (strlen($name) > 0 || strlen($description) > 0 || strlen($link)> 0 ){
            //Making sure that the inputs are safe and won't create any html, css tags or script code. 
            $safeName = htmlspecialchars($name);
            $safeDescription= htmlspecialchars($description);
            $safeLink= htmlspecialchars($link);


            //Setting variables and using real escape function to be sure that the database see the input as text and not as sql code. 
            $this->name = mysqli_real_escape_string($this->db, $safeName);
            $this->description = mysqli_real_escape_string($this->db, $safeDescription);
            $this->link = mysqli_real_escape_string($this->db, $safeLink);
            $sql = "INSERT INTO projects_portfolio(name, description, link)VALUES('$this->name','$this->description', '$this->link');";
            return mysqli_query($this->db, $sql);
        } else {
            return false;
        }
    }    
    
    //Uppdaterar värdet från en kurs med id
    function updateProject($id, $name, $description, $link){
        if (strlen($name) > 0 || strlen($description) > 0 || strlen($link)> 0 ){
        //Setting variables and using real escape function to be sure that the database see the input as text and not as sql code. 
        $this->name = mysqli_real_escape_string($this->db, $name);
        $this->description = mysqli_real_escape_string($this->db, $description);
        $this->link = mysqli_real_escape_string($this->db, $link);
        $id = intval($id);
        $sql = "UPDATE projects_portfolio SET name= '$name', description= '$description', link= '$link'  WHERE id= $id;";
        return mysqli_query($this->db, $sql);
    }else{
        return false;
    }
    }

    //Tar bort kurs med id
    function deleteProject($id):bool{
        $sql = "DELETE FROM projects_portfolio WHERE id=$id;";

        $result= $this->db->query($sql);
        return $result;
    }
    function close(){
        $this->db = null; 
    }

}