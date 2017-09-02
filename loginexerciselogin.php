<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login exercise</title>
    <link rel="stylesheet" href="loginexerciselogin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<body class="bg" background="background.png">

   
    <?php 
    
    session_start();
    
    if(isset($_POST['register'])){
        header("Location:register.php");
    }
    
    if(isset($_POST['login']))
    {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {   //after log in database starts working 
            require_once('db_connection.php'); 


            $username = $_POST['username'];
            $password = $_POST['password'];

            $pwd_hash = hash('sha256', $password);

            $sql = "SELECT * FROM logging WHERE username ='" . $username.  "' AND password = '" . $pwd_hash . "'";

            $result = mysqli_query($conn, $sql); //mysqli_query  must know where (what database and what username) and what content must be send to db

            $count = mysqli_num_rows($result); //ansear from db - num_rows conts how many fitting things in db to un and pw
         
            
            if($count == 1) // check if count equals 1 - that means that there is an unique username and he can register
            {
                $_SESSION['username'] = $username; //creation of session of name un with value is $ysername
                $_SESSION['auth'] = "Y"; //creating session auth for autheniticate (i just named it this way) and gave it a value Y
                    if(isset($_SESSION["auth"])) {  //check if its set on isset -> is set / unset
                        header("Location: loggedun.php");
                    }

                
            }
            else
            {
                echo 'Invalid username or password';
                
            }
        }
    }
?>
<fieldset>
	<div class="forma">
    
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<input class="un" name="username" type="text" placeholder="user name" required> 
	<input class="ps" name="password" type="password" placeholder="password">
        <br>
        <br>
	<input class="button" name="login" type="submit" value="Log in">
    <input class="button" name="register" type="submit" value="Register">
        
</form>
        </fieldset>
        </div>
</body>
</html>