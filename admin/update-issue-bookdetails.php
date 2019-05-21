<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$rdate=$_POST['rdate'];

$rstatus=1;
$sql="update lms_tblissuedbookdetails set ReturnStatus=:rstatus, ReturnDate=:rdate where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->bindParam(':rdate',$rdate,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Libro restituito correttamente.";
header('location:manage-issued-books.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Dettaglio Libro in Prestito</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/datetimepicker.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- DATETIME PICKER -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>

    <script type="text/javascript">
    $(document).ready( function () {
        $('#picker').dateTimePicker({
          selectData: "now",
          showTime: true,
          locale: "it",
          dateFormat: "YYYY-MM-DD HH:mm",
          dateStart: "2019/01/01",
          positionShift: { top: -300, left: 150},
          title: "Seleziona la data di restituzione",
          buttonTitle: "OK"
        });    });
    </script>

<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Dettaglio Libro in Prestito</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Dettaglio Libro in Prestito
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT lms_tblstudents.FullName,lms_tblbooks.BookName,lms_tblbooks.ISBNNumber,lms_tblissuedbookdetails.IssuesDate,lms_tblissuedbookdetails.ReturnDate,lms_tblissuedbookdetails.id as rid,lms_tblissuedbookdetails.ReturnStatus from  lms_tblissuedbookdetails join lms_tblstudents on lms_tblstudents.StudentId=lms_tblissuedbookdetails.StudentId join lms_tblbooks on lms_tblbooks.id=lms_tblissuedbookdetails.BookId where lms_tblissuedbookdetails.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   



<div class="form-group">
<label>Studente: </label>
<?php echo htmlentities($result->FullName);?>
</div>

<div class="form-group">
<label>Libro: </label>
<?php echo htmlentities($result->BookName);?>
</div>


<div class="form-group">
<label>ISBN: </label>
<?php echo htmlentities($result->ISBNNumber);?>
</div>

<div class="form-group">
<label>Data Prestito: </label>
<?php echo htmlentities($result->IssuesDate);?>
</div>


<div class="form-group">
<label>Data Restituzione: </label>
<?php if($result->ReturnDate==""){ ?>
            <span style="color:red"><?php   echo htmlentities("Non Ancora Restituito"); ?></span>
<?php
        } else {
            echo htmlentities($result->ReturnDate);
        }
?>
</div>

<div class="form-group">
<label>Nuova Data Restituzione: </label> <div style="display: inline-block;" id="picker"> </div>
    <input type="hidden" name="rdate" id="rdate" value="" />
    <script>
        var now = moment().format('YYYY/MM/DD hh:mm');
        document.getElementById("rdate").value = now;
    </script>
</div>


<div class="form-group">
<?php if($result->ReturnStatus==0){ ?>
    <button type="submit" name="return" id="submit" class="btn btn-info">RESTITUZIONE</button>
<?php } else { ?>
    <button type="submit" name="return" id="submit" class="btn btn-warning">AGGIORNA</button>
    <a href="manage-issued-books.php" class="btn btn-info">NON AGGIORNARE</a>
<?php   }  ?>
</div>

<?php }} ?>

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
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <!-- MOMENT SCRIPTS  -->
    <script src="assets/js/moment.js"></script>
    <!-- DATETIMEPICKER SCRIPTS  -->
    <script src="assets/js/datetimepicker.js"></script>


</body>
</html>
<?php } ?>
