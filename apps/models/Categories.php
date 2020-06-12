<?php
    class apps_models_Categories extends apps_libs_dbConn{
        protected $tablename = "categories";
        protected $queryParameter = [];
        public $idedit;
        public $name;
        public $create_date;
        public $email;

        public function buildQueryParameter($param)
        {
            # code...
            $defaule = [
                "select" => "",
                "from" => "",
                "where"=> "",
                "other" => "",
                "params" => "",
                "field" => []    
            ];
            $this->queryParameter = array_merge($defaule,$param); 
            return $this;
            // gộp 2 mảng default và param theo key rồi ghi đèn lên mảng queryParameter
        }
        public function checkValue($value)
        {
            # code...
            if(trim($value)){
                return "where ".$value;
            }else{
                return "";
            }
        }
        public function select()
        {

            # code...
            // cau sql
            $sql = "SELECT DISTINCT ".$this->queryParameter['select']
            ." FROM ".$this->tablename." "
            .$this->checkValue($this->queryParameter['where'])
            ." ".$this->queryParameter['other'];
            // echo $sql;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result!=null ? $result : null;
            $this->conn = null;
    
        }
        public function insert()
        {
            # code...
            $sql = "INSERT INTO ".$this->tablename." (id,name,create_date,email) VALUE (".$this->id.",'".$this->name."','".$this->create_date."','".$this->email."')";
            // var_dump($sql);
            // die();
            $this->conn->exec($sql);
            $this->conn = null;
        }
        public function delete()
        {
            # code...
            $sql = "DELETE FROM ".$this->tablename." WHERE id =".(int)$this->id;
            $this->conn->exec($sql);
            $this->conn = null;
        }
        public function update()
        {
            # code...
            $sql = "UPDATE ".$this->tablename." SET id = ".(int)$this->idedit." , name = '".$this->name
            ."' , create_date = '".$this->create_date."' , email = '".$this->email."' WHERE id = ".(int)$this->idedit;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $this->conn = null;
        }
    }