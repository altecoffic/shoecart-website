<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
       
       
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
 
<!-- container for the form  -->
    <div class="container">
        <div class="myCard">
            <div class="signup">
                
                <!-- form starts here -->
                <form class="myForm text-center needs-validation"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <header>REGISTER</header>

                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input class="myInput" type="text" name="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>" placeholder="Username" id="username" required>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <input class="myInput" type="password" name="password"
                            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $password; ?>" placeholder="Password" id="password" required>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input class="myInput" type="password" name="confirm_password"
                            class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $confirm_password; ?>" placeholder="Confirm Password"
                            id="confirm_password" required>
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="butt" value="SUBMIT">
                        <p>Already have an account? <a class="butt" href="login.php">Login here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of the container -->
</body>

<!-- register css starts here -->
<style>
/* for body */
body {
    background-image: url('https://cdn.dribbble.com/users/5135576/screenshots/12347765/media/88e3f4968d3b3a75ff67a227c1c429c5.gif');
    background-repeat:no-repeat;
    background-size:cover;
}

/* for sign up */
.signup {
    position: relative;
    background: #FFF2B3;
    border-radius: 25px;
    height: 100%;
    padding: 25px;
}

.signup header {
    color: black;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
}

.row {
    height: 100%;
}

/* for the card */
.myCard {
    background: linear-gradient(45deg, #f046ff, #9b00e8);
    background: #fff;
    margin-left: 270px;
    margin-top: 70px;
    height: 100%;
    width: 50%;
    border-radius: 25px;
    -webkit-box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
}

.signup .myInput {
    width: 300px;
    border-radius: 25px;
    padding: 10px;
    padding-left: 50px;
    border: none;
    -webkit-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    -moz-box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
}

.signup .myInput:focus {
    outline: none;
}


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

.signup .butt:hover {
    background: linear-gradient(45deg, #FFF883, #FFF54E);
}

.signup .butt:focus {
    outline: none;
}


/* button css */

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
</style>

</html>