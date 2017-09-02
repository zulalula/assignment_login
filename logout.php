

<?php
    
    session_start(); // making sure there is the same session
    if(isset($_SESSION['auth']))
    {
        unset($_SESSION['username']); //process of unsetting the session
        session_unset();
        session_destroy();
        mysqli_close();
        header("location:loginexerciselogin.php");
        exit;
    }
    
?>
