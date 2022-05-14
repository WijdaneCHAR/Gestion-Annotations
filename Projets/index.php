<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Projets Template</title>


  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="projets.css" rel="stylesheet">
  <!-- ------------------------------------------- -->
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
  <!-- profil icone -->
  <div class="action">
    <div class="profile" onclick="menuToggle();">
      <img src="profil.png" alt="">
    </div>
    <div class="menu">
      <h3>XXXXX XXXXX</h3>
      <ul>
        <li><img src="moncompte.png"><a href="../Profil/index.html">Mon compte</a></li>
        <li><img src="logout.png"><a href="#">Déconnexion</a></li>
      </ul>
    </div>
  </div>
  <!-- Projets -->
  <main class="form-projets shadow p-3 bg-white rounded">

      <?php 
require_once("db.php");
if ( isset($_GET["action"]) && $_GET["action"] == "supp" ) 
    {
       $con->query("DELETE FROM groupe WHERE id_group = " . $_GET['id']); 
    
       header("Location: index.php");
    }
    
    $result = $con->query("SELECT * FROM groupe");
    /*<?php
/*include 'fichier.php';


$items = new SimpleXMLElement($xmlstr); */

/* For each <character> node, we echo a separate <name>. 
foreach ($items->item as $i) {
   $con->query("INSERT INTO passage(text) VALUES ('$i->passage')");
}
?>*/

?>
<?php 
    if ( $result->num_rows ) 
    {
    ?>
        <table class="table">
        <thead>
            <tr>
          <th style="width: 50px;" scope="col">Id</th>
          <th style="width: 150px;" scope="col">Projet</th>
          <th style="width: 150px;" scope="col">description</th>
          <th style="width: 150px;" scope="col">Date de début</th>
          <th style="width: 150px;" scope="col">Payant</th>
          <th style="width: 150px;" scope="col">Prix par annotation</th>
          <th style="width: 150px;" scope="col">Supression</th>
          <th style="width: 150px;" scope="col">Liste de utilisateurs</th>
          <th style="width: 150px;" scope="col">Facture</th>


            </tr>
    </thead>
            <?php while( $row = $result->fetch_assoc() ) { ?>
              <tbody>
                <tr>
                    <th scope="row"><?php echo $row['id_group']; ?></th>
                    <td><mark><a href="../Annotation/index.php?id=<?php echo $row['id_group']; ?>"><?php echo htmlspecialchars($row['nom']); ?></a></mark></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['datedebut']); ?></td>
                    <td><?php echo htmlspecialchars($row['payant']); ?></td>
                    <td><?php echo htmlspecialchars($row['prix_par_annot']); ?></td>
                    <td><mark><a href="index.php?id=<?php echo $row['id_group']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce client?');">Supprimer</a></mark></td>
                    <td><mark><a href="../users/index.php?projet=<?php echo $row['id_group']; ?>">liste des utilisateurs</a></mark></td>
                    <td><mark><a href="../invoice/index.php?projet=<?php echo $row['id_group']; ?>">facturer</a></mark></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
    <?php }
        else {
            echo "Pas de projets.";
        }
    ?>
    <div class="text-center">
      <button type="button" class="w-25 btn btn-outline-primary">+Ajouter</button>
    </div>
</body>
</html>

    </div>
  </main>



  <script>
    function menuToggle() {
      const toggleMenu = document.querySelector('.menu');
      toggleMenu.classList.toggle('active')
    }
  </script>
</body>

</html>
