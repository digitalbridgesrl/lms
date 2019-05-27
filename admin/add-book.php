<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$bookname=$_POST['bookname'];
$booksubtitle=$_POST['booksubtitle'];
$volume=$_POST['volume'];
$totvolume=$_POST['totvolume'];
$category=$_POST['category'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];
$isbn=$_POST['isbn'];
$inventory=$_POST['inventory'];
$sql="INSERT INTO  lms_tblbooks(BookName,BookSubtitle,Volume,TotVolume,CatId,AuthorId,PublisherId,ISBNNumber,InventoryNumber) VALUES(:bookname,:booksubtitle,:volume,:totvolume,:category,:author,:publisher,:isbn,:inventory)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':booksubtitle',$booksubtitle,PDO::PARAM_STR);
$query->bindParam(':volume',$volume,PDO::PARAM_STR);
$query->bindParam(':totvolume',$totvolume,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':publisher',$publisher,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':inventory',$inventory,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Il libro è stato inserito correttamente.";
header('location:manage-books.php');
}
else 
{
$_SESSION['error']="Errore durante l'inserimento del libro. Si prega di verificare i dati inseriti.";
header('location:manage-books.php');
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
    <title>Online Library Management System | Aggiungi Libro</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

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
                <h4 class="header-line">Aggiungi Libro</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Informazioni sul Libro
</div>



<div class="panel-body">
<form role="form" method="post">

<table>
    <tr>
        <td>

<div class="form-group">
<label>Titolo: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off"  required />
</div>

</td>
<td>

<div class="form-group">
<label>Sottotitolo: </label>
<input class="form-control" type="text" name="booksubtitle" autocomplete="off" />
</div>

</td>
</tr>

<tr>
    <td>

<div class="form-group">
<label>Volume: </label>
<input class="form-control" type="text" name="volume" autocomplete="off" />
</div>

</td>
<td>

<div class="form-group">
<label>Volumi: </label>
<input class="form-control" type="text" name="totvolume" autocomplete="off" />
</div>

</td>
</tr>

<tr>
    <td colspan="2">

<div class="form-group">
<label>Categoria: <span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="">Seleziona Categoria</option>
<?php 
$status=1;
$sql = "SELECT * from  lms_tblcategory where Status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
 <?php }} ?> 
</select>
</div>

</td>

<tr>
    <td>

<div class="form-group">
<label>Autore: <span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="">Seleziona Autore</option>
<?php 
$sql = "SELECT * from lms_tblauthors";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
<?php }} ?> 
</select>
</div>

</td>
<td>

<div class="form-group">
<label>Editore: <span style="color:red;">*</span></label>
<select class="form-control" name="publisher" required="required">
<option value="">Seleziona Editore</option>
<?php 
$sql = "SELECT * from lms_tblpublishers";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->PublisherName);?></option>
<?php }} ?> 
</select>
</div>

</td>
</tr>

<tr valign="top">
    <td>

<div class="form-group">
<label>Inventario: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="inventory" required="required" autocomplete="off"  />
</div>

</td>
<td>

<div class="form-group">
<label>ISBN: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" required="required" autocomplete="off"  />
</div>

</td>
</tr>
</table>

<div align="center">
<button type="submit" name="add" class="btn btn-info">AGGIUNGI</button>
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
