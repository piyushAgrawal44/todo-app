<?php
date_default_timezone_set('Asia/Kolkata');
class MyDatabase{
    private $conn;
    private $host;
    private $user;
    private $pass;
    private $databasename;
   
    public function __construct() {
      $this->conn=$this->db_connect();
      return $this->conn;
    }
  
    private function db_connect(){
      $this->host = 'localhost';
      $this->user = 'root';
      $this->pass = '';
      $this->databasename = 'todolist';
  
      $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->databasename);
      return $conn;
    }
  
    public function db_query($sql){
          $result = $this->conn->query($sql);
          $query_data=$result->fetch_array();
          return $query_data;
    }

    function bindQueryParams($sql,$paramType,$paramValue){

      $param_value_ref[]= & $paramType;
      for ($i=0; $i <count($paramValue) ; $i++) { 
        $param_value_ref[]= & $paramValue[$i];
      }
     
      call_user_func_array(array($sql,"bind_param"),$param_value_ref);
    }

    public function insert($query,$paramType,$paramValue){
      $sql=$this->conn->prepare($query);

      $this->bindQueryParams($sql,$paramType,$paramValue);
      $data;
      try {
        $sql->execute();
        if($sql->insert_id){
          $data["success"]=true;
          $data["row_id"]=$sql->insert_id;
          $data["message"]="Successfully Account Created !";
          return $data;
        }
        else{
          $data["success"]=false;
          $data["message"]="Some technical issue !";
          return $data;

        }
      } catch (\Throwable $th) {
          $data["success"]=false;
          $data["message"]="Either email already exit or some technical issue !";
          return $data;

      }
    }

    public function select($query,$paramType,$paramValue){
      $sql=$this->conn->prepare($query);

      $this->bindQueryParams($sql,$paramType,$paramValue);
      $data;
      try {
        $sql->execute();
        $query_data=$sql->get_result();
        if($query_data->num_rows>0){
          while ($row=$query_data->fetch_array()) {
            $data["success"]=true;
            $data["row_id"]=$row["id"];
            $data["name"]=$row["name"];
            $data["email"]=$row["email"];
            $data["password"]=$row["password"];
            $data["message"]="Successfully Loggedin !";
          }
         
        }
        else{
          $data["success"]=false;
          $data["message"]="Some technical issue !";
        }
      } catch (\Throwable $th) {
          $data["success"]=false;
          $data["message"]="Either Invalid Credential or some technical issue !";
      }
    
      return $data;
    }

    public function selectTodoList($query,$paramType,$paramValue){

      
      $sql=$this->conn->prepare($query);

      $this->bindQueryParams($sql,$paramType,$paramValue);
      
      $data;
      try {
        $sql->execute();
        $query_data=$sql->get_result();

        if($query_data->num_rows>0){
          $data["success"]=true;

          $tempArr=[];
          $i=0;
          while($row=$query_data->fetch_array()) {
            $tempArr[$i]=$row;
            $i++;
          }
          $data['data']=$tempArr;
        }
        else{
          $data["success"]=true;
          $data["data"]=[];
          $data["message"]="No Todo to show";
        }
      } catch (\Throwable $th) {
          $data["success"]=false;
          $data["message"]="Some technical issue !";
      }
    
      return $data;
    }


    public function updateTodo($query,$paramType,$paramValue){

      
      $sql=$this->conn->prepare($query);

      $this->bindQueryParams($sql,$paramType,$paramValue);
      
      $data;
      try {
        
        $query_result=$sql->execute();
        if($query_result){
          $data["success"]=true;
        }
        else{
          $data["success"]=true;
          $data["data"]=[];
          $data["message"]="Failed to update";
        }
      } catch (\Throwable $th) {
          $data["success"]=false;
          $data["message"]="Some technical issue !";
      }
    
      return $data;
    }

    public function deleteTodo($query,$paramType,$paramValue){

      
      $sql=$this->conn->prepare($query);

      $this->bindQueryParams($sql,$paramType,$paramValue);
      
      $data;
      try {
        
        $query_result=$sql->execute();
        if($query_result){
          $data["success"]=true;
        }
        else{
          $data["success"]=true;
          $data["message"]="Failed to delete";
        }
      } catch (\Throwable $th) {
          $data["success"]=false;
          $data["message"]="Some technical issue !";
      }
    
      return $data;
    }
}
  