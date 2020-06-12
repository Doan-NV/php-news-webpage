<?php
class apps_models_Post extends apps_libs_dbConn
{
    protected $tablename = "posts";
    protected $queryParameter = [];
    public $id="";
    public $cateid="";
    public $name="";
    public $summary="";
    public $content="";

    public function buildQueryParameter($param)
    {
        # code...
        $defaule = [
            "select" => "",
            "from" => "",
            "where" => "",
            "other" => "",
            "params" => "",
            "field" => []
        ];
        $this->queryParameter = array_merge($defaule, $param);
        return $this;
        // gộp 2 mảng default và param theo key rồi ghi đèn lên mảng queryParameter
    }
    public function checkValue($value)
    {
        # code...
        if (trim($value)) {
            return "where " . $value;
        } else {
            return "";
        }
    }
    public function select()
    {

        # code...
        $sql = "SELECT " . $this->queryParameter['select']
            . " FROM " . $this->tablename . " "
            . $this->checkValue($this->queryParameter['where'])
            . " " . $this->queryParameter['other'];
        // echo $sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);

        return $result != null ? $result : null;
        $conn = null;
    }
    public function selectEnd()
    {
        # code...
        $sql = "SELECT " . $this->queryParameter['select']
            . " FROM " . $this->tablename . " "
            . " " . $this->queryParameter['other'];
        // echo $sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);

        return $result != null ? $result : null;
        $conn = null;

    }
    public function selectCount()
    {

        # code...
        $sql = "SELECT COUNT(" . $this->queryParameter['select']
            . ") FROM " . $this->tablename . " "
            . $this->checkValue($this->queryParameter['where'])
            . " " . $this->queryParameter['other'];

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result != null ? $result : null;
        $conn = null;
    }
    public function selectMany()
    {
        # code...
        // SELECT * FROM posts WHERE cate_id =2 LIMIT 1,5;
        $sql = "SELECT " . $this->queryParameter['select']
            . " FROM " . $this->tablename . " "
            . $this->checkValue($this->queryParameter['where'])
            . " LIMIT " . $this->queryParameter['other'];
        // echo $sql;
        // die();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result != null ? $result : null;
        $conn = null;
    }
    public function insert()
    {
        # code...
        $sql = "INSERT INTO ".$this->tablename." (id,cate_id,name,summary,content) VALUE (".$this->id.",".$this->cateid.",'".$this->name."','".$this->summary."','".$this->content."')";
        // echo $sql;
        // die();
        $this->conn->exec($sql);
        $this->conn = null;
    }
    public function delete()
    {
        # code...
        $sql = "DELETE FROM " . $this->tablename . " WHERE id =" . (int) $this->id;
        $this->conn->exec($sql);
        $this->conn = null;
    }
    public function update()
    {
        # code...
        $sql = "UPDATE " .$this->tablename . " SET id = " .(int)$this->id . " , cate_id = ".(int) $this->cateid ." , name = '".$this->name
            ."' , summary = '".$this->summary."' , content = '".$this->content."' WHERE id = " .(int)$this->id;
        // echo ($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $this->conn = null;
    }

}
