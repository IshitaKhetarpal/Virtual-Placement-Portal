<html>
<body>
<select class="form-control full-width has-padding has-border" name="institute" required>
<option value="">Please Choose your Institute</option>
<?php 
	include 'connect.php';
	$sql = "select name from organisation;";
	$result= $conn->query($sql);
	while($row = $result->fetch_assoc())
	{	
?>	
		<option value="<?= $row['name']; ?>"> <?= $row['name']; ?></option>
<?php 
	
	} 
?>
</select>
</body></html>