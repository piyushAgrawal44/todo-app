<?php
Class TodoModel
{

    private $db_con;
    public function __construct(){
        $this->db_con=new MyDatabase();
    }
    public function addTodo($title,$user_id){

        $paramType="sii";
        $paramValue=array(
            $title,
            1,
            $user_id
        );

        $sql="INSERT INTO all_todos (title,status,user_id) VALUES (?,?,?)";

        $data=$this->db_con->insert($sql,$paramType,$paramValue);
        return $data;
    }

    public function getTodo($id,$user_id){
        $paramType="ii";
        $paramValue=array(
            $id,
            $user_id
        );

        $sql="SELECT id,title,status,user_id FROM all_todos WHERE id=? AND user_id=? AND deleted_at IS NULL";

        $data=$this->db_con->selectTodoList($sql,$paramType,$paramValue);
        return $data;
    }

    public function getAllTodo($user_id){
        $paramType="i";
        $paramValue=array(
            $user_id
        );

        $sql="SELECT id,title,status,user_id,created_at FROM all_todos WHERE user_id=? AND deleted_at IS NULL";

        $data=$this->db_con->selectTodoList($sql,$paramType,$paramValue);
        return $data;
    }

    public function editTodo($title,$status,$todoId,$user_id){

        $status=($status>=2)? 2 :1;
        $paramType="siii";
        $paramValue=array(
            $title,
            $status,
            $todoId,
            $user_id
        );

        $sql="UPDATE all_todos SET title=?,status=? WHERE id=? AND user_id=?";

        $data=$this->db_con->updateTodo($sql,$paramType,$paramValue);
        return $data;
    }

    public function deleteTodo($todoId,$user_id){

        $paramType="ii";
        $paramValue=array(
            $todoId,
            $user_id
        );

        $sql="DELETE FROM all_todos WHERE id=? AND user_id=?";

        $data=$this->db_con->updateTodo($sql,$paramType,$paramValue);
        return $data;
    }


}