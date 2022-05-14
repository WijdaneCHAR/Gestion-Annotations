<?php
    session_start();
    require_once("../db.php");
    // test le sur le login 
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false || !isset($_SESSION['id_uti']) ||  $_SESSION['id_uti'] == '') 
    {  
      header("Location : ../sign-in/login.php");
    }

     // test id du groupe 
     if (!isset($_GET['id']) && $_GET['id'] ==''){
      header("Location: ../Projets/index.php");
      }
      $id_group = $_GET['id'];


      // creation  de l'annotation 
    if (isset($_POST['question']) && $_POST['question'] != '' && isset($_POST['reponse']) && $_POST['reponse'] !='' && isset($_POST['ajout']) && isset($_POST['typequestion']) && $_POST['typequestion'] !='')
    {
        $question =  $_POST['question'];
        $reponse =  $_POST['reponse'];
        //$datedebut =  date("Y-m-d    H:i:s");
        $id_type = $_POST['typequestion'];
        $id_uti = $_SESSION['id_uti'];
        //id passage a revoir 
        $id_passage= 1;

        $query= "INSERT INTO annotation (id_group, id_type, id_passage, question, reponse, id_uti) VALUES  ( '$id_group', '$id_type', '$id_passage', '$question', '$reponse', '$id_uti') " ;
            $con->query($query);
    }

    //suppression 
    if ( isset($_POST['supp'])){
        $query ="DELETE FROM annotation WHERE id_annot=". $_POST['supp'];
        $con->query($query);
    }

    if (isset($_GET['deco']) && $_GET['deco']==1){
      $_SESSION['logged'] == false;
      header("Location: ../sign-in/login.php");
    }


?>

<!doctype html>
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
  <!-- profil icone -->
  <div class="action">
    <div class="profile" onclick="menuToggle();">
      <img src="../Projets/profil.png" alt="">
    </div>
    <div class="menu">
      <h3>XXXXX XXXXX</h3>
      <ul>
        <li><img src="../Projets/moncompte.png"><a href="../Profil/index.php">Mon compte</a></li>
        <li><img src="../Projets/logout.png"><a href="index.php?deco=1">Déconnexion</a></li>
      </ul>
    </div>
  </div>
  <!-- Annotations -->
  <form class="container-sm shadow p-3 bg-white rounded" method="post"  action="" >
    <h1 class="h3 mb-3 fw-normal">Annotation</h1>
    <!-- Importer le fichier -->
    <div class="input-group mb-3">

      <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03"
        aria-label="Upload">
    </div>
    <h3 style="text-align: left;">Titre du passage</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
    <!--Type de question -->
    <div class="form-floating mb-3">
      <!--input type="text" class="form-control" id="floatingInput" placeholder="Votre question" name="question"-->
      <select  class="form-control" name="typequestion" required> 
        <option value="">Selectionnez le type question </option>
        <?php
            $type_result = $con->query("SELECT * From typequestion ");
            if ($type_result->num_rows){
              while($row = $type_result->fetch_assoc()){ ?>
                <option value= "<?php echo  $row['id_type'];?>" > <?php echo  $row['nom_type'];?></option>
              <?php
              }  
            }
            $type_result->close();
        ?>
      </select>
      <label for="floatingInput">Type Question</label>
    </div>
    <!-- Question -->
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" placeholder="Votre question" name="question" required>
      <label for="floatingInput">La question</label>
    </div>
    <!-- Reponse -->
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" placeholder="Votre réponse" name="reponse" required>
      <label for="floatingInput">La réponse</label>
    </div>
    <!-- Boutton -->
    <div class="boutton">
      <button type="submit" class="w-50 btn btn-outline-primary add " name="ajout" >Ajouter annotation</button>
      <p>ou</p>
      <button type="submit" class="w-50 btn btn-outline-dark deletes">Supprimer le paragraphe</button>
    </div>
    </form>
    <form form class="container-sm shadow p-3 bg-white rounded" method="post"  action="" >
    <!-- Tableau -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Question</th>
          <th style="width: 300px;" scope="col">Réponse</th>
          <th style="width: 150px;" scope="col">Editer</th>
        </tr>
      </thead>
      <tbody>
          <?php
              $id_uti = $_SESSION['id_uti'];
              $result = $con->query("SELECT * FROM annotation WHERE id_uti = '$id_uti'");
              if ($result->num_rows){
                while($row= $result->fetch_assoc()){
                  echo '<tr>';
                  echo '<th scope="row">' . $row['question'] .'</th>';
                  echo '<td>' . $row['reponse'] . '</td>' ;?>
                  <td><button type="submit" class="btn btn-outline-danger" onclick="return confirm('Vous voulez vraiment supprimer cette annotation?');" value="<?php echo $row['id_annot'];?>" name="supp"> Supprimer</button></td>
                 <?php echo '</tr>';
                }
              }
              //$con->close();
          ?>
        </tr>
      </tbody>
    </table>
    </form>
    <?php
    /*
    <form class="container-sm shadow p-3 bg-white rounded">
    <!-- Statistiques -->
    <h1 class="h3 mb-3 fw-normal">Statistiques</h1>
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
          <th scope="row">100</th>
          <td>0</td>
          <td>0</td>
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
          <th scope="row">1</th>
          <td>XXXXX XXXXX</td>
          <td>0</td>
          <td>50</td>
        </tr>
      </tbody>
    </table>
    <!-- Nombre d'annotations par jour -->
    <h3 class="h3 mb-3 fw-normal">Nombre d'annotations par jour</h3>
  </form>

  <script>
    function menuToggle() {
      const toggleMenu = document.querySelector('.menu');
      toggleMenu.classList.toggle('active')
    }  

  </script>
</body>

</html>
*/
?>


<form class="container-sm shadow p-3 bg-white rounded">
    <!-- Statistiques -->
    <h1 class="h3 mb-3 fw-normal">Statistiques</h1>
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
//require_once("../db.php");    
    $result1 = $con->query("SELECT count(distinct (p.id_passage)) as total FROM passage p inner join annotation a on a.id_passage = p.id_passage where a.id_group = '$id_group'");
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
        <?php while( $row3 = $result3->fetch_assoc() ) { ?> 
          <tr>
          <th scope="row"><?php echo $row3['id_uti']; ?></th>
          <td><?php echo $row3['nom'] . " " .$row3['prenom']; ?></td>
         <?php $result4 = $con->query("SELECT  count( id_annot) as total3 FROM annotation where id_uti = ".$row3['id_uti'].' AND id_group = ' . $id_group); ?>
        <?php while( $row4 = $result4->fetch_assoc() ) { ?>
        <td><?php echo $row4['total3']; ?></td>
        <?php } ?>
        <?php $result5 = $con->query("SELECT  objectif as total4 FROM affectation where id_uti = ".$row3['id_uti'].' AND id_group = '.$id_group); ?>
        <?php while( $row5 = $result5->fetch_assoc() ) { ?>
          <td><?php echo $row5['total4']; ?></td>
          <?php } ?>
          </tr>
          <?php } ?>
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