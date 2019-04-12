<?php
class News{
 
    // database connection and table name
    private $conn;
    private $table_name = "news";
 
    // object properties
    public $id;
    public $title;
    public $date;
    public $header;
    public $url;
    public $story;
    public $author;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read news
    function read(){
    
        // select all news and sort them based on date descending so that the latest news comes first
        $query = "SELECT * FROM " . $this->table_name . " n ORDER BY n.date DESC";
        
        //debugging
        //echo "<br/>$query <br />";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        //debugging
        //echo "<br/>$query <br />";
        return $stmt;
    }

    // create news
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title=:title, date=:date, header=:header, url=:url, story=:story, author=:author";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->header=htmlspecialchars(strip_tags($this->header));
        $this->url=htmlspecialchars(strip_tags($this->url));
        $this->story=htmlspecialchars($this->story);
        $this->author=htmlspecialchars(strip_tags($this->author));
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":header", $this->header);
        $stmt->bindParam(":url", $this->url);
        $stmt->bindParam(":story", $this->story);
        $stmt->bindParam(":author", $this->author);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update news
    function update(){
 
        // update query
        $query = "UPDATE " . $this->table_name . "
                
                SET
                title=:title, date=:date, header=:header, url=:url, story=:story, author=:author 
                WHERE    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->header=htmlspecialchars(strip_tags($this->header));
        $this->url=htmlspecialchars(strip_tags($this->url));
        $this->story=htmlspecialchars($this->story);
        $this->author=htmlspecialchars(strip_tags($this->author));
    
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":header", $this->header);
        $stmt->bindParam(":url", $this->url);
        $stmt->bindParam(":story", $this->story);
        $stmt->bindParam(":author", $this->author);
     
        // execute the query
        if($stmt->execute()){
            $affected_rows = $stmt->rowCount();
            if($affected_rows>=1)
            return true;
        }
     
        return false;
    }


}

?>