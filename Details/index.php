<?php
//lecture
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
$con = new mysqli('localhost','root','','annot');
if (file_exists('test.xml')) {
    $xml = simplexml_load_file('test.xml');
} else {
    exit('Failed to open test.xml');
}
foreach ($xml->item as $i) {
    $con->query("INSERT INTO passage(text_passage) VALUES ('$i->passage')");
}

// ecriture
$sql="SELECT p.text_passage ss, a.question cc , a.reponse dd FROM annotation a , passage p WHERE a.id_passage = p.id_passage ";
$data=$con->query($sql);
$xml= new XMLWriter();
$xml->openUri("test1.xml");
$xml->startDocument('1.0', 'utf-8');
$xml->startElement('items');

  while($pers=$data->fetch_assoc()){
    $xml->startElement('item');
    $xml->writeElement('passage',$pers['ss']);
    $xml->writeElement('question',$pers['cc']);
    $xml->writeElement('answer',$pers['dd']);
    $xml->endElement();
  }
$xml->endElement();
$xml->endElement();
$xml->flush();



?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Annotation Template</title>


  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- bsbsbsbsbsbsbsbbs -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
   integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
   crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
   crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link href="annotation.css" rel="stylesheet">
</head>

<body>
    <form class="container-sm shadow p-3 bg-white rounded">
    <!-- Statiqtiques -->
    <h1 class="h3 mb-3 fw-normal">Statiqtiques</h1>
    <!-- Tableau 1 -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre total des passages</th>
          <th scope="col">Nombre des passages annotés</th>
          <th scope="col">Nombre des passages non annotés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php 
require_once("db.php");    
    $result1 = $con->query("SELECT count(distinct (p.id_passage)) as total FROM passage p inner join annotation a on a.id_passage = p.id_passage where a.id_group = 1");
    $result2 = $con->query("SELECT  count(DISTINCT id_passage) as total2 FROM annotation");
    $result3 = $con->query("SELECT * FROM utilisateur");

    

?>
        <?php while( $row = $result1->fetch_assoc() ) { ?>  
          <th scope="row"><?php echo $row['total']; ?></th>
          
          <?php while( $row2 = $result2->fetch_assoc() ) { ?>
          <td><?php echo $row2['total2']; ?></td>
          <td><?php echo $row['total'] - $row2['total2']; ?></td>
          <?php } ?>
          <?php } ?>
        </tr>
      </tbody>
    </table>
    <!-- Nombre d'annotations par user -->
    <h3 class="h3 mb-3 fw-normal">Nombre d'annotations par utilisateur</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nom et prénom</th>
          <th scope="col">Nombre d'annotations</th>
          <th scope="col">Objectif à atteindre</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php while( $row3 = $result3->fetch_assoc() ) { ?> 
          <th scope="row"><?php echo $row3['id_uti']; ?></th>
          <td><?php echo $row3['nom'] . " " .$row3['prenom']; ?></td>
         <?php $result4 = $con->query("SELECT  count( id_annot) as total3 FROM annotation where id_uti = ".$row3['id_uti'].' AND id_group = 1'); ?>
        <?php while( $row4 = $result4->fetch_assoc() ) { ?>
        <td><?php echo $row4['total3']; ?></td>
        <?php } ?>
        <?php $result5 = $con->query("SELECT  objectif as total4 FROM affectation where id_uti = ".$row3['id_uti'].' AND id_group = 1'); ?>
        <?php while( $row5 = $result5->fetch_assoc() ) { ?>
          <td><?php echo $row5['total4']; ?></td>
          <?php } ?>
          <?php } ?>
        </tr>
      </tbody>
    </table>
    <!-- Nombre d'annotations par jour -->
    <h3 class="h3 mb-3 fw-normal">Nombre d'annotations par jour</h3>

    <!-- chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['date', 'nombre'],
    <?php
         // $temp = $con->query("SELECT date_annotation FROM annatation");
         // while( $rowt = $temp->fetch_assoc() ) {
         $sql = "SELECT date_annotation , count(date_annotation) as c FROM annotation group by date_annotation "  ;
         $fire = $con->query($sql);
          while ($result = $fire->fetch_assoc()) {
            echo"['".$result['date_annotation']."',".$result['c']."],";
          }
        // }
         ?>
        ]);

        var options = {
          title: 'annotation par jour'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

</html>
