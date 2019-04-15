<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "<span style='color:red'>Errore: e-mail non valida.</span>";
	}
	else {
		$sql ="SELECT EmailId FROM lms_tblstudents WHERE EmailId=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'>Errore: l'e-mail corrisponde ad uno studente già registrato.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'>OK: l'e-mail è utilizzabile ai fini della registrazione.</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}


?>
