<?php
    class apps_models_Admin extends apps_libs_dbConn{
        protected $tablename = "admin";
        protected $queryParameter = [];

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
            $sql = "SELECT DISTINCT ".$this->queryParameter['select']
            ." FROM ".$this->tablename." "
            .$this->checkValue($this->queryParameter['where'])
            ." ".$this->queryParameter['other'];
            // echo $sql;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result!=null ? $result[0] : null;
            $conn = null;
    
        }
    }