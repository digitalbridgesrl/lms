<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 

    if(isset($_POST['update']))
    {
        $id=$_GET['id'];
        $sid=$_POST['sid'];
        $fname=$_POST['fullname'];
        $mobileno=$_POST['mobileno'];
        $email=$_POST['email']; 
        $status=$_POST['status']; 
        $sql="UPDATE lms_tblstudents set StudentId=:sid,FullName=:fname,MobileNumber=:mobileno,EmailId=:email,Status=:status where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg']="Lo studente è stato modificato correttamente.";
        header('location:manage-students.php');
    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Modifica Studente</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "../check_availability.php",
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
                <h4 class="header-line">Modifica Studente</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Informazioni Studente
                    </div>
                    <div class="panel-body">
                        <form name="signup" method="post" onSubmit="return valid();">
                            <?php 
                            $id=intval($_GET['id']);
                            $sql="SELECT * from lms_tblstudents where id=:id";
                            $query=$dbh->prepare($sql);
                            $query-> bindParam(':id',$id, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {               
                                  ?> 
                                  <div class="form-group">
                                    <label>Matricola</label>
                                    <input class="form-control" type="text" name="sid" value="<?php echo htmlentities($result->StudentId);?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Nome e Cognome</label>
                                    <input class="form-control" type="text" name="fullname" value="<?php echo htmlentities($result->FullName);?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Cellulare</label>
                                    <input class="form-control" type="text" name="mobileno" value="<?php echo htmlentities($result->MobileNumber);?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" id="emailid" onchange="checkAvailability()" value="<?php echo htmlentities($result->EmailId);?>" autocomplete="off" required  />
                                    <span id="user-availability-status" style="font-size:12px;"></span> 
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <?php if($result->Status==1) {?>
                                       <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="1" checked="checked">Attivato
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="0">Disattivato
                                        </label>
                                    </div>
                                <?php } else { ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="0" checked="checked">Disattivato
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="1">Attivato
                                        </label>
                                        </div
                                    <?php } ?>
                                </div>
                            <?php }} ?>
                            <button type="submit" name="update" class="btn btn-info">AGGIORNA</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY  -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS  -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
