
<html>
    <head>
      <link rel="stylesheet" href="loginexerciselogin.css"></head>
    <body class="bg" background="background.png">
    </body>
</html>

<?php
    session_start();
    if(isset($_POST['back']))
    {
        require_once('logout.php');
    }

    if(isset($_POST['register']))
    {
	if (!empty($_POST['username']) && !empty($_POST['password'])) {   //after log in database starts working 
        require_once('db_connection.php'); 
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $pwd_hash = hash('sha256', $password);
        
        $sql = "SELECT * FROM logging WHERE username ='" . $username.  "' AND password = '" . $pwd_hash . "'";
        $result = mysqli_query($conn, $sql); //mysqli_query must know where to send and what to send to the db
        
        $count = mysqli_num_rows($result); //answ from db - num_rows counts how many fitting values is in the bd for username and password
        
        if($count == 0) // if its 0 that means no username like this   
        {
            $sql_2 = "INSERT INTO logging(username,password) VALUES('$username','$pwd_hash')";
            $result_2 = mysqli_query($conn, $sql_2);
            if($result_2)
            {
                echo 'User registered';

            }
            else
            {
                echo 'Error';
            }
        }
        else
        {
            echo 'User already exists.';
            mysqli_close($conn);
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
       
         <input class="button" name="register" type="submit" value="Register" >
       <div> <br></div>
                
         <input class="button" name="back" type="submit" value="Back to homepage" >
        
        
</form>
        </fieldset>