<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="free todo list application">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Todo - Todo List</title>

  </head>
  <body>
    
    <div class="container my-5">
        
        <?php
            if (isset($_SESSION["loggedin"]) && isset($_SESSION["user_id"]) && ($todo_data["user_id"]==$_SESSION["user_id"])) {
                
                ?>
                <h1>Update Todo</h1>
                <div class="d-flex gap-2 mt-3">
                  <a href="index.php" class="btn btn-primary">Home</a>
                </div>
                <hr>

                <br><br><br>
                <form action="./index.php" method="POST" onsubmit="return confirm('Are You Sure !')">
                    <div class="mb-3">
                        <label for="todo_tile" class="form-label"><b>Update Your Todo Here *</b></label>
                        <textarea class="form-control" name="todo_title" rows="5" id="todo_tile" placeholder="Write Your Todo" required><?php echo $todo_data["title"]; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="todo_status"><b>Todo Status *</b></label>
                        <select class="form-select" aria-label="Todo Status" id="todo_status" name="todo_status">
                            <option <?php echo $todo_data["status"]==1?"selected":""; ?> value="1">Pending</option>
                            <option <?php echo $todo_data["status"]==2?"selected":""; ?> value="2">Completed</option>
                        </select>
                        <input type="hidden" name="todo_id" value="<?php echo $todo_data["id"]; ?>" hidden>
                    </div>
                    <button type="submit" name="updatetodo_btn" class="btn btn-dark">Update Todo</button>
                </form>
                
                <?php
            }
            else{
                echo "<script>
                    history.back();
                    </script>";
                    exit;
            }
        ?>

        
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        const toggleForm = () => {
            const container = document.querySelector('.my_container');
            container.classList.toggle('active');
        };

        function signupFrom(){
            let password=document.getElementById("signup_password").value;
            let c_password=document.getElementById("signup_confirm_password").value;

            if(password===c_password){
                return true;
            }
            alert("Password and Confirm Password must be same !");
            return false;
        }
        function loginFrom(){
           
            return true;
        }
    </script>
  </body>
</html>