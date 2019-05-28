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
$bookname=$_POST['bookname'];
$booksubtitle=$_POST['booksubtitle'];
$volume=$_POST['volume'];
$totvolume=$_POST['totvolume'];
$shelf=$_POST['shelf'];
$category=$_POST['category'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];
$isbn=$_POST['isbn'];
$inventory=$_POST['inventory'];
$bookid=intval($_GET['bookid']);
$sql="update  lms_tblbooks set BookName=:bookname,BookSubtitle=:booksubtitle,Volume=:volume,TotVolume=:totvolume,ShelfId=:shelf,CatId=:category,AuthorId=:author,PublisherId=:publisher,ISBNNumber=:isbn,InventoryNumber=:inventory where id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':booksubtitle',$booksubtitle,PDO::PARAM_STR);
$query->bindParam(':volume',$volume,PDO::PARAM_STR);
$query->bindParam(':totvolume',$totvolume,PDO::PARAM_STR);
$query->bindParam(':shelf',$shelf,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':publisher',$publisher,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':inventory',$inventory,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Il libro è stato modificato correttamente.";
header('location:manage-books.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Modifica Libro</title>
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
                <h4 class="header-line">Modifica Libro</h4>
                
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
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT lms_tblbooks.BookName,lms_tblbooks.BookSubtitle,lms_tblbooks.Volume,lms_tblbooks.TotVolume,lms_tblshelf.ShelfName as sid,lms_tblcategory.CategoryName,lms_tblcategory.id as cid,lms_tblauthors.AuthorName,lms_tblauthors.id as athrid, lms_tblpublishers.PublisherName,lms_tblpublishers.id as pubid, lms_tblbooks.ISBNNumber,lms_tblbooks.InventoryNumber,lms_tblbooks.id as bookid from  lms_tblbooks left join lms_tblshelf on lms_tblshelf.id=lms_tblbooks.ShelfId left join lms_tblcategory on lms_tblcategory.id=lms_tblbooks.CatId left join lms_tblauthors on lms_tblauthors.id=lms_tblbooks.AuthorId left join lms_tblpublishers on lms_tblpublishers.id=lms_tblbooks.PublisherId where lms_tblbooks.id=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<table>
    <tr>
        <td>

<div class="form-group">
<label>Titolo: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required />
</div>

</td>
<td>

<div class="form-group">
<label>Sottotitolo: </label>
<input class="form-control" type="text" name="booksubtitle" value="<?php echo htmlentities($result->BookSubtitle);?>" />
</div>

</td>
</tr>

<tr>
    <td>

<div class="form-group">
<label>Volume: </label>
<input class="form-control" type="text" name="volume" value="<?php echo htmlentities($result->Volume);?>" />
</div>

</td>
<td>

<div class="form-group">
<label>Volumi: </label>
<input class="form-control" type="text" name="totvolume" value="<?php echo htmlentities($result->TotVolume);?>" />
</div>

</td>
</tr>

<tr>
<td colspan="2">
<div class="form-group">
<label>Scaffale: <span style="color:red;">*</span></label>
<select class="form-control" name="shelf" required="required">
<option value="<?php echo htmlentities($result->sid);?>"> <?php echo htmlentities($shelfname=$result->ShelfName);?></option>
<?php 
$sql1 = "SELECT * from  lms_tblshelf";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($shelfname==$row->ShelfName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->ShelfName);?></option>
 <?php }}} ?> 
</select>
</div>
</td>
</tr>



<tr>
<td colspan="2">
<div class="form-group">
<label>Categoria: <span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  lms_tblcategory where Status=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->CategoryName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php }}} ?> 
</select>
</div>
</td>
</tr>

<tr>
    <td>

<div class="form-group">
<label>Autore: <span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
<?php 
$sql2 = "SELECT * from lms_tblauthors";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->AuthorName)
{
continue;
} else{
?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
<?php }}} ?> 
</select>
</div>

</td>
<td>

<div class="form-group">
<label>Editore: <span style="color:red;">*</span></label>
<select class="form-control" name="publisher" required="required">
<option value="<?php echo htmlentities($result->pubid);?>"> <?php echo htmlentities($pubname=$result->PublisherName);?></option>
<?php 
$sql2 = "SELECT * from lms_tblpublishers";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($pubname==$ret->PublisherName)
{
continue;
} else{
?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->PublisherName);?></option>
<?php }}} ?> 
</select>
</div>


</td>
</tr>
<tr valign="top">
    <td>

<div class="form-group">
<label>Inventario: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="inventory" value="<?php echo htmlentities($result->InventoryNumber);?>"  required="required" />
</div>

</td>
<td>

<div class="form-group">
<label>ISBN: <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>"  required="required" />
</div>

</td>
</tr>
</table>

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
