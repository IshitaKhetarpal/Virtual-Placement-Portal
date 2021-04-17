<!--To authorize Employers-->

<?php

    $o_id="";
    if (session_status() == PHP_SESSION_NONE) 
    {
		session_start();
    }
    if(isset($_SESSION["o_id"]))
    {
		$o_id=$_SESSION["o_id"];    
    }
    else
    {
		header('Location:index.php');
    }
