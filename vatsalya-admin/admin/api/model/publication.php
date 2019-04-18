<?php
class Publication{
 
    // database connection and table name
    private $conn;
    private $table_name = "publication";
 
    // object properties
    public $id;
    public $publication_name;
    public $publication_url;
   
 
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
    // create publication
    function create(){
    
        // query to insert record
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    publication_name=:publication_name, publication_url=:publication_url";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->publication_name=$this->publication_name;
        $this->publication_url=$this->publication_url;
        

    
        // bind values
        $stmt->bindParam(":publication_name", $this->publication_name);
        $stmt->bindParam(":publication_url", $this->publication_url);   


    
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

    //-----------------------------------------------------------------------
    // update publication
    function update(){
 
        // update query
        $query = "UPDATE " . $this->table_name . "
                
                SET
                publication_name=:publication_name, publication_url=:publication_url
                WHERE    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        
    
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":publication_name", $this->publication_name);
        $stmt->bindParam(":publication_url", $this->publication_url);
        
        
        // execute the query
        if($stmt->execute()){
            $affected_rows = $stmt->rowCount();
            if($affected_rows>0) return 1; // updated successfully
            return 0; // executed but not updated
        }
     
        return -1; // didn't execute
    }

//------------------------------------------------------------------------------
}


?>