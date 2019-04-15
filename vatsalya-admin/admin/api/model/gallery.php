<?php
class Gallery{
 
    // database connection and table name
    private $conn;
    private $table_name = "gallery";
 
    // object properties
    public $id;
    public $image_name;
    public $image_url;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

//-------------------------------------------------------------------------------------
        // read news
    function read(){
    
        // select all records 
        $query = "SELECT * FROM " . $this->table_name;
            
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();         
        return $stmt;
    }
//-------------------------------------------------------------------------------------------
    // create gallery
    function create(){
    
        // query to insert record
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    image_name=:image_name, image_url=:image_url";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->image_name=$this->image_name;
        $this->image_url=$this->image_url;
        

    
        // bind values
        $stmt->bindParam(":image_name", $this->image_name);
        $stmt->bindParam(":image_url", $this->image_url);   


    
        // execute query
        if($stmt->execute()){
            return true;
        }    
        return false;
        
    }
//------------------------------------------------------------------------
    //------------------------------------------------------------------------------
    // delete the record
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            $affected_rows = $stmt->rowCount();
            if($affected_rows>0) return 1; // deleted rows
            return 0; // stmt was executed but no rows were deleted
        }
    
        return -1; // stmt was not executed because of db problem
        
    }
}


?>