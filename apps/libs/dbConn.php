<?php
    class apps_libs_dbConn{
        protected $servername = "localhost"; 
        protected $dbname ="web_news";
        protected $username = "root";
        protected $password = "";
        protected $tablename;

        // protected $queryParameter = [];
        protected $conn;

        public function __construct()
        {   
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,$this->username, $this->password);
            $this->connDB();
            // tự động kết nối database khi gọi đến class này.
        }

        // kết nối database bằng PDO
        public function connDB(){
            try {
               
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
              } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }
        }
    }
?>