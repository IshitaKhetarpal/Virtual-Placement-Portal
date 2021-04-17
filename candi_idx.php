<?php
if(isset($_SESSION['s_id']))
	{
		$s_id=$_SESSION['s_id'];
		include 'connect.php';
		$result = $conn->query("select o_id from seeker where s_id=". $s_id .";");
		$temp=$result->fetch_assoc();
		$o_id=$temp['o_id'];
		
		$res=$conn->query("select name from organisation where o_id=". $o_id .";");
		$temp=$res->fetch_assoc();
		$o_name=$temp['name'];
?>
		<html>
		<body>
		<div style="width: 100%" class="row" >
		<div class="col-md-9"  >
		<div style=" margin-top: 30px;">
		<h1>Find Company at <?php echo $o_name ?></h1>
		<form class="example" action="index.php">
		<input style="color:#000" type="text" placeholder="Search.." name="q">
		<button type="submit"><i class="fa fa-search"></i></button>
		</form>
		</div>   
		<div class="container row">
<?php  
		$c_name=$category=$cgpa=$ctc=$reqs=$role=$eType=$status=$msg="";
		
		$sql = "select * from post where o_id=".$o_id ." order by date;";    
		if(isset($_GET['q']))
		{
			$sql = "select * from post where c_name LIKE '%".$_GET['q']."%' and o_id= ".$o_id." and status='1' order by date;";
		}
		
		if(isset($_GET['category']))
		{
			$sql = "select * from post where category='".$_GET['category']."' and o_id=".$o_id." and status='1' order by date";
		}
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			while( $row=$result->fetch_assoc())
			{
				$pid= $row['id'];
				$c_name= $row['c_name'];
				$category=$row['category'];
				$cgpa=$row['cgpa'];
				$ctc=$row['ctc'];
				$industry=$row['industry'];
				$reqs=$row['reqs'];
				$role=$row['role'];
				$eType=$row['employmentType'];
				$branch=$row['branch'];
				$jd=$row['jd'];
?>
				<div class="col-md-4" style="margin: 20px; background: rgba(0,0,0,0.5);padding: 5px;box-shadow: 0px 0px 5px #003333">                       
				<h3 style="color: #2196F3"><?php echo $role;?></h3>
				<h4><b>By <?php echo $c_name;?></b></h4><br>
				<h4><b>Job Requirements: </b><br><h5><?php echo $reqs;?></h5></h4>
				<h5><b>CGPA Cut-off: </b><?php echo $cgpa;?>  </h5>
				<h5><b>Salary: </b><?php echo $ctc;?> </h5> 
				<h5><b>Employment Type: </b><?= $eType;?></h5>
				<h5><b>Branches Eligible: </b><?= $branch;?></h5>
				<h5><b>Job Description: </b><a href="getting.php?jd=<?php echo $jd;?>" target="_blank" style="color:white"> Click here to View</a></h5>
				<a href="applyJob.php?id=<?php echo $pid;?>" class="pull-right"><h3>Apply</h3></a>
				</div>                   
<?php 
    
			}
		}
		else
		{
			echo "Search returned no results";
		}
?>
		</div>
		</div>
		
		<div style=" height: 100vh; padding:10px; margin-bottom:40 " class="col-md-3">
		<h3>Jobs by Category</h3>
		<form>
		<div> 
		<select class="form-control" name='category'>
		<?php include "categoryOptions.php";?>
		</select><br>
		<input class="btn btn-success pull-right" type="submit" value="Search"/>
		</div> </form> 
		</div> 
		
		</div></body></html>
<?php 
	} 
?>