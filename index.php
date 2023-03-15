<?php
require_once('./model/db_con.php');
require_once('./model/todo_model.php');
require_once('./model/user_model.php');
session_start();
$action="";

if (isset($_GET["action"])) {
    $action=$_GET["action"];
}

switch ($action) {
    case '':
        
        if (isset($_POST["login_btn"])) {
            $email=trim($_POST["email"]);
            $password=trim($_POST["password"]);
            if ($email && $password) {
                $user_db=new UserModel();
                $data=$user_db->loginUser($email,$password);
               
                if ($data['success']) {
                    $_SESSION["loggedin"]=true;
                    $_SESSION["user_id"]=$data["row_id"];
                    $_SESSION["user_name"]=$data["name"];
                    $_SESSION["user_email"]=$data["email"];
                    echo "<script>
                    window.location.href='index.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('".$data['message']."');
                    history.back();
                    </script>";
                    exit; 
                }
                
            }
            else{
                echo "<script>
                alert('Please fill all the details !');
                history.back();
                </script>";
                exit;
            }
        }
        elseif (isset($_POST["signup_btn"])) {
            $name=trim($_POST["name"]);
            $email=trim($_POST["email"]);
            $password=trim($_POST["password"]);
            if ($name && $email && $password) {
                $user_db=new UserModel();
                $data=$user_db->addUser($name,$email,$password);
               
                if ($data['success']) {
                    $_SESSION["loggedin"]=true;
                    $_SESSION["user_id"]=$data["row_id"];
                    $_SESSION["user_name"]=$name;
                    $_SESSION["user_email"]=$email;
                    echo "<script>
                    window.location.href='index.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('".$data['message']."');
                    history.back();
                    </script>";
                    exit; 
                }
                
            }
            else{
                echo "<script>
                alert('Please fill all the details !');
                history.back();
                </script>";
                exit;
            }
        } 
        elseif (isset($_POST["addtodo_btn"])) {
            if ($_POST["todo_title"]) {
                $todo_title=trim($_POST["todo_title"]);
                $todo_db=new TodoModel();
                $data=$todo_db->addTodo($todo_title,$_SESSION["user_id"]);
                if ($data['success']) {
                    echo "<script>
                    window.location.href='index.php';
                    </script>";
                    exit;
                } else {
                   
                    echo "<script>
                    alert('Technical Issue !');
                    history.back();
                    </script>";
                    exit; 
                }
            } else {
                echo "<script>
                    alert('Please fill all the required details !');
                    history.back();
                    </script>";
                    exit;
            }
            
            
        }
        elseif (isset($_POST["updatetodo_btn"])) {
            if ($_POST["todo_title"] && $_POST["todo_status"] && $_POST["todo_id"]) {
                $todo_title=trim($_POST["todo_title"]);
                $todo_status=trim($_POST["todo_status"]);
                $todo_id=trim($_POST["todo_id"]);
                $todo_db=new TodoModel();
                $data=$todo_db->editTodo($todo_title,$todo_status,$todo_id,$_SESSION["user_id"]);
                if ($data['success']) {
                    echo "<script>
                    window.location.href='index.php';
                    </script>";
                    exit;
                } else {
                   
                    echo "<script>
                    alert('Technical Issue !');
                    history.back();
                    </script>";
                    exit; 
                }
            } else {
                echo "<script>
                    alert('Please fill all the required details !');
                    history.back();
                    </script>";
                    exit;
            }
            
            
        }
        else {

            if (isset($_SESSION["user_id"])) {
                $user_db=new TodoModel();
                $data=$user_db->getAllTodo($_SESSION["user_id"]);
                if ($data['success']) {
                    $todolist=$data["data"];
                   
                    include("./view/home.php");

                } else {
                    echo "<script>
                    alert('".$data["message"]."');
                    history.back();
                    </script>";
                    exit;
                }
            } else {
                # code...
                include("./view/home.php");
            }
            
            
        }
        
        break;

    case 'add-todo':
        include("./view/add.php");
        break;
    
    case 'edit-todo':
        $todo_id=$_GET["todo_id"];
        if($todo_id){
            $todo_db=new TodoModel();
            $data=$todo_db->getTodo($todo_id,$_SESSION["user_id"]);
           

            if ($data['success']) {
                $todo_data=$data["data"][0];
                include("./view/edit.php");
                exit;
            } else {
               
                echo "<script>
                alert('Technical Issue !');
                history.back();
                </script>";
                exit; 
            }

        }
        break;
    case 'delete-todo':
            $todo_id=$_GET["todo_id"];
            if($todo_id){
                $todo_db=new TodoModel();
                $data=$todo_db->deleteTodo($todo_id,$_SESSION["user_id"]);
               
    
                if ($data['success']) {
                    echo "<script>
                    window.location.href='./index.php';
                    </script>";
                    exit; 
                } else {
                   
                    echo "<script>
                    alert('Technical Issue !');
                    history.back();
                    </script>";
                    exit; 
                }
    
            }
        break;

    case 'logout':
        session_unset();
        session_destroy();
        echo "<script>
        window.location.href='./index.php';
        </script>";
        break;
        
    default:
        # code...
        break;
}
?>