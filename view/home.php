<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="free todo list application">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home - Todo List</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }

        section {
          position: relative;
          min-height: 100vh;
          background-color: #0094FF;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 20px;
        }

        section .my_container {
          position: relative;
          width: 800px;
          height: 500px;
          background: #fff;
          box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
          overflow: hidden;
        }

        section .my_container .user {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          display: flex;
        }

        section .my_container .user .imgBx {
          position: relative;
          width: 50%;
          height: 100%;
          background: #ff0;
          transition: 0.5s;
        }

        section .my_container .user .imgBx img {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
        }

        section .my_container .user .formBx {
          position: relative;
          width: 50%;
          height: 100%;
          background: #fff;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 40px;
          transition: 0.5s;
        }

        section .my_container .user .formBx form h2 {
          font-size: 18px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 2px;
          text-align: center;
          width: 100%;
          margin-bottom: 10px;
          color: #555;
        }

        section .my_container .user .formBx form input {
          position: relative;
          width: 100%;
          padding: 10px;
          background: #f5f5f5;
          color: #333;
          border: none;
          outline: none;
          box-shadow: none;
          margin: 8px 0;
          font-size: 14px;
          letter-spacing: 1px;
          font-weight: 300;
        }

        section .my_container .user .formBx form input[type='submit'] {
          max-width: 100px;
          background: #677eff;
          color: #fff;
          cursor: pointer;
          font-size: 14px;
          font-weight: 500;
          letter-spacing: 1px;
          transition: 0.5s;
        }

        section .my_container .user .formBx form .signup {
          position: relative;
          margin-top: 20px;
          font-size: 12px;
          letter-spacing: 1px;
          color: #555;
          text-transform: uppercase;
          font-weight: 300;
        }

        section .my_container .user .formBx form .signup a {
          font-weight: 600;
          text-decoration: none;
          color: #677eff;
        }

        section .my_container .signupBx {
          pointer-events: none;
        }

        section .my_container.active .signupBx {
          pointer-events: initial;
        }

        section .my_container .signupBx .formBx {
          left: 100%;
        }

        section .my_container.active .signupBx .formBx {
          left: 0;
        }

        section .my_container .signupBx .imgBx {
          left: -100%;
        }

        section .my_container.active .signupBx .imgBx {
          left: 0%;
        }

        section .my_container .signinBx .formBx {
          left: 0%;
        }

        section .my_container.active .signinBx .formBx {
          left: 100%;
        }

        section .my_container .signinBx .imgBx {
          left: 0%;
        }

        section .my_container.active .signinBx .imgBx {
          left: -100%;
        }

        @media (max-width: 991px) {
          section .my_container {
            max-width: 400px;
          }

          section .my_container .imgBx {
            display: none;
          }

          section .my_container .user .formBx {
            width: 100%;
          }
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- For responsive datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
  </head>
  <body>
    
    <div class="container my-5">
        
        <?php
            if (isset($_SESSION["loggedin"]) && isset($_SESSION["user_id"])) {
                ?>
                <h1>Todo List Application - <?php echo $_SESSION["user_name"]." | ".$_SESSION["user_email"]; ?></h1>
                <div class="d-flex justify-content-between mt-3 align-items-center">
                  <a href="index.php?action=add-todo" class="btn btn-primary">+ New Todo</a>
                  <a href="index.php?action=logout" class="btn btn-secondary">Logout -></a>
                </div>
                <hr>
                <br><br><br>
                
                      <?php
                        if (isset($todolist) && count($todolist)>0) {
                          ?>
                          <div class="table-responsive">
                          <table class="table" id="todoTable">
                            <thead>
                                <tr>
                                <th scope="col">Sno</th>
                                <th scope="col">Todo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                          <?php
                          $sno=1;
                          foreach ($todolist as $key=> $todo) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $sno; ?></th>
                                <td><?php echo $todo["title"]; ?></td>
                                <td><?php echo $todo["status"]==1?"<span class='text-danger'>Pending</span>":"<span class='text-success'>Completed</span>"; ?></td>
                                <td><?php echo $todo["created_at"]; ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                    <a href="index.php?action=edit-todo&todo_id=<?php echo $todo["id"]; ?>">Edit</a>
                                    <a  href="index.php?action=delete-todo&todo_id=<?php echo $todo["id"]; ?>">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $sno++;
                          }
                          ?>
                            
                            
                              </tbody>
                        </table>
                        </div>
                          <?php
                        }
                        else{
                          ?>
                          <p class="text-center ">
                              No Todo To Show...
                          </p>
                          <?php
                         
                        }
                      ?>
                      
                
                <?php
            }
            else{
                ?>
                <h1>Todo List Application</h1>

                <br><br><br>
                <section>
                    <div class="my_container">
                    <div class="user signinBx">
                    <div class="imgBx"><img src="https://cdni.iconscout.com/illustration/premium/thumb/login-3305943-2757111.png" alt="" /></div>

                       <div class="formBx">
                        <form action="" method="POST" onsubmit="return loginFrom();">
                            <h2>Sign In</h2>
                            <input type="text" name="email" placeholder="Email Id" required />
                            <input type="password" name="password" placeholder="Password" required />
                            <input type="submit" name="login_btn" value="Login" />
                            <p class="signup">
                            Don't have an account ?
                            <a href="#" onclick="toggleForm();">Sign Up.</a>
                            </p>
                        </form>
                        </div>
                    </div>
                    <div class="user signupBx">
                        <div class="formBx">
                        <form action="" onsubmit="return signupFrom();" method="POST">
                            <h2>Create an account</h2>
                            <input type="text" name="name" placeholder="Name"  required/>
                            <input type="email" name="email" placeholder="Email Address" required />
                            <input type="password" name="password" id="signup_password" placeholder="Create Password" required />
                            <input type="password" name="confirm_password" id="signup_confirm_password" placeholder="Confirm Password" required />
                            <input type="submit" name="signup_btn" value="Sign Up" />
                            <p class="signup">
                            Already have an account ?
                                <a href="#" onclick="toggleForm();">Sign in.</a>
                            </p>
                        </form>
                        </div>
                        <div class="imgBx"><img src="https://cdni.iconscout.com/illustration/premium/thumb/sign-up-page-1886582-1598253.png" alt="" /></div>

                    </div>
                    </div>
                </section>
                <?php
            }
        ?>

        
    </div>

   
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- For responsive datatable -->
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
      let table = new DataTable('#todoTable',{
        responsive: true
    });

    </script>
  </body>
</html>