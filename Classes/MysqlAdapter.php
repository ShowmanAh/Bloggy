<?php
class MysqlAdapter{
    protected $config = [];// DB configuration
    protected $link;// DB connection
    protected $result; // query result
    public function __construct(array $config)
    {
        // check configuration
        if(count($config) !== 4){
            throw new InvalidArgumentException("invalid number of connecting");
        }
        $this->config = $config;
    }
    // check connection
    public function connect(){
        // SingleTone pattern connect only once
        if($this->link === null){
            list($host, $username, $password, $database) = $this->config;
            if(!$this->link = mysqli_connect ($host, $username, $password, $database)){
                throw new RuntimeException(" Error connecting with server : ". mysqli_connect_error ());
            }
            unset($host, $username, $password, $database);// destroy config

        }
        return $this->link;
    }
    // check query
    public function query($query){
        // check if query empty or not contain string
        if(!is_string ($query) || empty($query)){
            throw new InvalidArgumentException('invalid specified query');
        }
        $this->connect (); // calling connection for open connection
        if(!$this->result = mysqli_query ($this->link, $query)){
            throw new RuntimeException('ERROR in the specified query' . $query . mysqli_error ($this->link));
        }
        return $this->result;
    }
    // function fetch on a  single row  from current result set as (associative array)
    public function fetch(){
        if($this->result !== null){
            if($row = mysqli_fetch_array ($this->result, MYSQLI_ASSOC)){
               $this->freeResult ();
            }
            return $row;

        }
        return false;
    }
    // function fetch all row  from current result set as (associative array)
    public function fetchAll(){
        if($this->result !== null){
            if($all = mysqli_fetch_all ($this->result, MYSQLI_ASSOC)){
                $this->freeResult();
            }
            return $all;

        }
        return false;
    }
    // make free result
    public function freeResult(){
        if($this->result === null){
            return false;
        }
        mysqli_free_result ($this->result);
        return true;
    }
    // get inserted id
    public function getInsertedId(){
        $this->link !== null ? mysqli_insert_id ($this->link) : null;
    }
    // function get count rows
    public function countRow(){
        $this->result !== null ? mysqli_num_rows ($this->result) : 0;
    }
    // get rows has occure affected
    public function affectedRow(){
        $this->link !== null ? mysqli_affected_rows ($this->link) : 0;
    }
    // close db connection
    public function disconnect(){
        if($this->link === null){
            return false;
        }
        mysqli_close ($this->link);
        $this->link = null;
        return true;
    }
    // close db connection automatically when instance of class destroyed
    public function __destruct()
    {
       $this->disconnect ();
    }


}
