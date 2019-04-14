<?php
class Testimonial{
 
    // database connection and table name
    private $conn;
    private $table_name = "testimonial";
 
    // object properties
    public $id;
    public $provider_name;
    public $testimonials;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read testimonial
    function read(){
    
        // select all testimonial and sort them based on date descending so that the latest testimonial comes first
        $query = "SELECT * FROM " . $this->table_name;
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
//-------------------------------------------------------------------
    // create testimonial
    function create(){
    
        // query to insert record
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    provider_name=:provider_name, testimonials=:testimonials";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->provider_name=htmlspecialchars(strip_tags($this->provider_name));
        $this->testimonials=strip_tags($this->testimonials);
        

    
        // bind values
        $stmt->bindParam(":provider_name", $this->provider_name);
        $stmt->bindParam(":testimonials", $this->testimonials);
            
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
//---------------------------------------------------------------------------
// delete the testimonial
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
//---------------------------------------------------------------------
//-----------------------------------------------------------------------
    // update news
    function update(){
 
        // update query
        $query = "UPDATE " . $this->table_name . "
                
                SET
                provider_name=:provider_name, testimonials=:testimonials
                WHERE    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        
    
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":provider_name", $this->provider_name);
        $stmt->bindParam(":testimonials", $this->testimonials);
        
        
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