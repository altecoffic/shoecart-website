<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     // header("location: welcome.php");
//     exit;
// }
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<!-- body starts here -->

<body>

    <!--for login page ----------- -->
    <div class="container">
        <div class="myCard">
            <div class="login">
                <!-- alert if the login is error -->
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
            ?>
            <!-- login form starts here -->
                <form class="myForm text-center needs-validation"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <header>
                        LOG IN
                    </header>

                    <!-- for the username -->
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <input class="myInput" type="text" name="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>" placeholder="Username" id="username" required>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                <!-- for the password -->
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input class="myInput" type="password" name="password"
                            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                            placeholder="Password" id="password" required>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                <!-- either you will sign in or create an acc -->
                    <div class="form-group">
                        <input type="submit" class="butt" value="Login">
                        <p>Don't have an account? <a class="butt" href="register.php">Sign up now</a>.</p>
                    </div>
                </form>
                <!-- End of form -->
            </div>
        </div>
    </div>
    </div>
</body>

<!-- login css starts here -->
<style>
body {
    background-image: url('https://cdn.dribbble.com/users/5135576/screenshots/12347765/media/88e3f4968d3b3a75ff67a227c1c429c5.gif');
    background-repeat: no-repeat;
    background-size: cover;
}

/* for login */
.login {
    position: relative;
    background: #FFF2B3;
    border-radius: 40px;
    height: 100%;
    padding: 25px;
}


.row {
    height: 100%;
}

/* for the card cont */
.myCard {

    margin-left: 270px;
    margin-top: 70px;
    height: 100%;
    width: 50%;
    border-radius: 25px;
    -webkit-box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
}

/* login css */
.login header {
    color: black;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
}

.login .myInput {
    width: 300px;
    border-radius: 25px;
    padding: 10px;
    padding-left: 50px;
    border: none;
    -webkit-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
}

.login .myInput:focus {
    outline: none;
}

/* for the form */
.myForm {
    margin-top: 50px;
}

.butt {
    background: linear-gradient(45deg, #FEE04F, #FED303);
    color: #fff;
    width: 230px;
    border: none;
    margin-bottom: 30px;
    border-radius: 25px;
    padding: 10px;
    -webkit-box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
}

.login.butt:hover {
    background: linear-gradient(45deg, #c85bff, #b726ff);
}

.login.butt:focus {
    outline: none;
}

.login .fas {
    position: relative;
    color: #bb36fd;
    left: 36px;
}

.butt_out {
    background: transparent;
    color: #fff;
    width: 120px;
    border: 2px solid#fff;
    border-radius: 25px;
    padding: 10px;
    -webkit-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
}

.butt_out:hover {
    border: 2px solid#eecbff;
}

.butt_out:focus {
    outline: none;
}

.button {
    background: linear-gradient(45deg, #bb36fd, #c24ffc);
    -webkit-box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
}

.row {
    display: flex;

    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
</style>
<!-- end of login css -->

</html>