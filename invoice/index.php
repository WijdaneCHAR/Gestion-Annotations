



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<page size="A4">


<div class="row">
<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 brandSection">
<div class="row">
<div class="col-md-12 col-sm-12 header">
<div class="col-md-3 col-sm-3 headerLeft">
<h1><img src="logo.png" height="60"></h1>
</div>
<div class="col-md-9 col-sm-9 headerRight">
<p style=" font-size: 20px;"><b>LARSA</b></p>
<p style="font-size: 20px;"><b>email</b></p>
</div>
</div>
<div class="col-md-12 col-sm-12 content">
<h1>Facture<strong>  1</strong></h1>
<h5>
   <?php echo "Le"   . date("d/m/Y") ; ?>

</h5>

</div>
<div class="col-md-12 col-sm-12 panelPart">
<div class="row">
<div class="col-md-6 col-sm-6 panelPart">
<div class="panel panel-default">
<div class="panel-body">
TO
</div>
<div class="panel-footer">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-6">
<h1>Nom du Projet:

<b> <?php 

    require_once("db.php");
if ( isset($_GET["id"]) ) 
    {
       $con->query("SELECT FROM groupe WHERE id_group = " . $_GET['id']); 
    
       header("Location: index.php");
    }
    
 $result = $con->query("SELECT * FROM groupe");
 $row = $result->fetch_assoc() ;
 echo $row['nom'];


 ?>
</b>

</h1>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 tableSection">

<table class="table text-center">
<thead>
   
<tr class="tableHead">
<th style="width:30px;">Quantité</th>
<th>Tache</th>
<th style="width:100px;">Montant</th>
</tr>
</thead>
<tbody>
<tr>
<td>
   
<?php 

    require_once("db.php");

    
       $result = $con->query("SELECT COUNT( id_annot) as re from annotation a where a.id_group= 1");

    
    
 // $result = $con->query("SELECT * FROM groupe");
 $row = $result->fetch_assoc() ; 
        $quant = $row['re'];
         echo $row['re']; 
 


 ?>



</td>
<td>annotation</td>
<td>
<?php 

   
      
 $result = $con->query("SELECT prix_par_annot FROM groupe WHERE id_group = 1"); 
 $row = $result->fetch_assoc() ;
    $prix = $row['prix_par_annot'];
 echo $row['prix_par_annot'];


 ?>


</td>

</tr>


</tbody>
</table>
</div>
<div class="col-md-12 col-sm-12 lastSectionleft ">
<div class="row">
<div class="col-md-8 col-sm-6 Sectionleft">


</div>
<div class="col-md-4 col-sm-6">
<div class="panel panel-default">
<div class="panel-body lastPanel">
TOTAL
</div>
<div class="panel-footer lastFooter">
<div class="row">
<div class="col-md-5 col-sm-6 col-xs-6 panelLastLeft">

</div>

<p align="center"><strong><?php echo $prix * $quant; ?> </strong></p>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</page>
</body>
</html>