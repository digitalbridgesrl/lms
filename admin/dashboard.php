<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{?>
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
      <title>Online Library Management System | Cruscotto Amministratore</title>
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
      <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">CRUSCOTTO AMMINISTRATORE</h4>
          </div>
        </div>

        <div class="row">
          <a href="manage-books.php">
            <div class="col-md-4 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-book fa-5x"></i>
                <?php 
                $sql ="SELECT count(*) as tot from lms_tblbooks ";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetch(PDO::FETCH_OBJ);
                $listdbooks=$results->tot;
                ?>
                <h3><?php echo htmlentities($listdbooks);?></h3>
                Libri
              </div>
            </div>
          </a>
          <a href="manage-issued-books.php">
            <div class="col-md-4 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-sort-amount-asc fa-5x"></i>
                <?php 
                $status=1;
                $sql2 ="SELECT count(*) as tot from lms_tblissuedbookdetails";
                $query2 = $dbh -> prepare($sql2);
                $query2->execute();
                $results2=$query2->fetch(PDO::FETCH_OBJ);
                $returnedbooks=$results2->tot;
                ?>
                <h3><?php echo htmlentities($returnedbooks);?></h3>
                Prestiti totali
              </div>
            </div>
          </a>
          <a href="manage-students.php">
            <div class="col-md-4 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-users fa-5x"></i>
                <?php 
                $sql3 ="SELECT count(*) as tot from lms_tblstudents";
                $query3 = $dbh -> prepare($sql3);
                $query3->execute();
                $results3=$query3->fetch(PDO::FETCH_OBJ);
                $regstds=$results3->tot;
                ?>
                <h3><?php echo htmlentities($regstds);?></h3>
                Studenti
              </div>
            </div>
          </a>

        </div>



        <div class="row">
          <a href="manage-authors.php">
           <div class="col-md-4 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-group fa-5x"></i>
              <?php 
              $sql4 ="SELECT count(*) as tot from lms_tblauthors";
              $query4 = $dbh -> prepare($sql4);
              $query4->execute();
              $results4=$query4->fetch(PDO::FETCH_OBJ);
              $listdathrs=$results4->tot;
              ?>
              <h3><?php echo htmlentities($listdathrs);?></h3>
              Autori
            </div>
          </div>
        </a>
        <a href="manage-categories.php">
          <div class="col-md-4 col-sm-3 rscol-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-th-large fa-5x"></i>
              <?php 
              $sql5 ="SELECT count(*) as tot from lms_tblcategory";
              $query5 = $dbh -> prepare($sql5);
              $query5->execute();
              $results5=$query5->fetch(PDO::FETCH_OBJ);
              $listdcats=$results5->tot;
              ?>
              <h3><?php echo htmlentities($listdcats);?> </h3>
              Categorie
            </div>
          </div>
        </a>
        <a href="manage-publishers.php">
        <div class="col-md-4 col-sm-3 rscol-xs-6">
          <div class="alert alert-info back-widget-set text-center">
            <i class="fa fa-home fa-5x"></i>
            <?php 
            $sql6 ="SELECT count(*) as tot from lms_tblpublishers";
            $query6 = $dbh -> prepare($sql6);
            $query6->execute();
            $results6=$query6->fetch(PDO::FETCH_OBJ);
            $listdpubs=$results6->tot;
            ?>
            <h3><?php echo htmlentities($listdpubs);?> </h3>
            Editori
          </div>
        </div>
      </a>
      </div>


    </div>















<!-- slider
             <div class="row">

              <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                   
                    <div class="carousel-inner">
                        <div class="item active">

                            <img src="assets/img/1.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img src="assets/img/2.jpg" alt="" />
                          
                        </div>
                        <div class="item">
                            <img src="assets/img/3.jpg" alt="" />
                           
                        </div>
                    </div>
                    
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol>
                    
                     <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
                </div>
              </div>
                 
               
             
               
            
             </div>
           -->          
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
