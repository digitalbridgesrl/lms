<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
//code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Codice di verifica errato!');</script>" ;
    } 
    else {    
        $StudentId=$_POST['sid'];
        $fname=$_POST['fullname'];
        $mobileno=$_POST['mobileno'];
        $email=$_POST['email']; 
        $password=md5($_POST['password']); 
        $status=1;
        $sql="INSERT INTO lms_tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
            $_SESSION['msg']="Lo studente è stato registrato correttamente.";
            header('location:manage-students.php');
        }
        else 
        {
            $_SESSION['error']="Errore nella fase di registrazione. Si prega di verificare i dati inseriti.";
            header('location:manage-students.php');
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Online Library Management System | Registrazione Studente</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid()
        {
            if(document.signup.password.value!= document.signup.confirmpassword.value)
            {
                alert("Errore: le password non corrispondono!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data:'emailid='+$("#emailid").val(),
                type: "POST",
                success:function(data){
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>    

</head>
<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Registrazione Studente</h4>
                
            </div>

        </div>
        <div class="row">

            <div class="col-md-9 col-md-offset-1">
             <div class="panel panel-info">
                <div class="panel-heading">
                 Inserire i dati dello studente
             </div>
             <div class="panel-body">
                <form name="signup" method="post" onSubmit="return valid();">
                    <div class="form-group">
                        <label>Matricola</label>
                        <input class="form-control" type="text" name="sid" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                        <label>Cognome e Nome</label>
                        <input class="form-control" type="text" name="fullname" autocomplete="off" required />
                    </div>


                    <div class="form-group">
                        <label>Cellulare</label>
                        <input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()" autocomplete="off" required  />
                        <span id="user-availability-status" style="font-size:12px;"></span> 
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" autocomplete="new-password" required  />
                    </div>

                    <div class="form-group">
                        <label>Conferma Password</label>
                        <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                    </div>
                    <div class="form-group">
                        <label>Codice di Verifica</label>
                        <input class="form-control" type="text"  name="vercode" maxlength="5" autocomplete="off" required />&nbsp;<img src="../captcha.php">
                    </div>                                

                    <div align="center">
                        <button type="submit" name="signup" class="btn btn-info" id="submit">CONFERMA</button>
                        <a href="dashboard.php" class="btn btn-warning">ANNULLA</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS  -->
<script src="assets/js/custom.js"></script>
</body>
</html>
