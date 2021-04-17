<!-- Used to authorize a Candidate-->

<?php

    $s_id="";
    if (session_status() == PHP_SESSION_NONE) 
    {
		session_start();
    }
    if(isset($_SESSION["s_id"]))
    {
		$s_id=$_SESSION["s_id"];
    }
    else
    {
		header('Location:index.php');
    }
