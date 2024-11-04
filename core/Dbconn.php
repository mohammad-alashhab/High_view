<?php 

 class conn{

   private $pass='';
private $host='localhost';
private $dbname='e_commerce';
private $dbuser='root';
public function connect(){
    try{
        $pdo = new PDO ("mysql:host=" .$this->host . ";dbname=". $this->dbname , $this->dbuser , $this->pass);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo ;

    }catch(PDOException $e){
   die("Connection failed" . $e->getMessage());
    }
}


     public function query($sql, $data = [])
     {
         try {
             $conn = $this->connect();
             $stmt = $conn->prepare($sql);

             $check = $stmt->execute($data);
             if ($check) {
                 $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                 return (is_array($result) && count($result) > 0) ? $result : [];
             } else {
                 return false;
             }
         } catch (PDOException $e) {
             // Optional: log the error or display a user-friendly message
             error_log("Query failed: " . $e->getMessage());
             return false;
         } finally {
             // Close the statement and connection
             $stmt = null;
             $conn = null;
         }
     }




 }