<?php

    include 'connect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
		//Checking if email and password have been entered
        if(!isset($_POST['email']) || !isset($_POST['password']))
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Please enter credentials!'));
            die($output);
        }    
        $email = $_POST['email'];
        $password = $_POST['password'];
        
		//Checking if valid email id is entered
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { 
            //email validation
            $output = json_encode(array('type' => 'error', 'text' => 'Please enter a valid email!'));
            die($output);
        }
		
		//Establishing a Connection to the database
        if($conn->connect_error)
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Error connecting'.$conn->connect_error));
            die($output);
        }  
		
        //Checking if the user exists 
		$sqlE = "select * from orgcred where email = '$email';";
		$sqlS = "select * from seekercred where email = '$email';";
		
        $resultE_CH = $conn->query($sqlE);
		$resultS_CH = $conn->query($sqlS); 
		if($resultE_CH->num_rows == 0 && $resultS_CH->num_rows == 0)
		{
			$output = json_encode(array('type' => 'error', 'text' => 'User Does not Exist, Please Register.'));
            die($output);
		}
		
		//If the user exists log-in takes place 
		$sqlE = "select * from orgcred where email = '$email' and password = '$password';";
        $sqlS = "select * from seekercred where email = '$email' and password = '$password';";
		
		$resultE = $conn->query($sqlE);
        if ($resultE->num_rows > 0) 
        {
            // output data of each row
            if($rowE = $resultE->fetch_assoc()) 
            { 
                session_start();
				$oc_id=$rowE["oc_id"];
                $_SESSION["o_id"]= $oc_id;
					$nsql="select name from organisation where o_id='$oc_id';";
					$nres=$conn->query($nsql);
					$nname=$nres ->fetch_assoc();
					$name= $nname["name"];
                $_SESSION["login_employer"]= $name; 
                $output = json_encode(array('type' => 'success', 'text' => 'Login successfull'.$_SESSION["login_employer"]));
                die($output);

            }
            
        }
        $resultS = $conn->query($sqlS);   
        if ($resultS->num_rows > 0) 
        {
            // output data of each row
            if($rowS = $resultS->fetch_assoc()) 
            { 
                session_start();
				$sc_id = $rowS["sc_id"];
                $_SESSION["s_id"]= $sc_id;
					$nsql="select name from seeker where s_id='$sc_id';";
					$nres=$conn->query($nsql);
					$nname=$nres ->fetch_assoc();
					$name= $nname["name"];
                $_SESSION["login_user"]= $name;
                $output = json_encode(array('type' => 'success', 'text' => 'Login successfull'.$_SESSION["login_user"]));
                die($output);
            }
        }
        else
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Invalid credentials!'));
            die($output);
        }

    }