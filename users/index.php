<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des utilisateurs</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
  <?php 
    require_once("db.php");
    // if ( isset($_GET["action"]) && $_GET["action"] == "utilisateur" ) 
    // {    
    //    header("Location: index.php");
    // }
    
    $result = $con->query("SELECT * FROM utilisateur,affectation WHERE utilisateur.id_uti=affectation.id_uti and id_group='".$_GET['projet']."'");
   

?>
    <?php 
    if ( $result->num_rows ) 
    {
    ?>
      <table width="100%">
        <tr>
          <td width="60%"> <img src="oujda.png" alt="" width="100px" /> </td>
          <td> <p>Laboratoire de recherche en sciences appliquées <div class="text"> LaRSA </div> </p> </td>
        </tr>
      </table>
      <h1>Liste des utilisateurs du projet  <?php echo $_GET["projet"] ;?> </h1>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" width="20%">Nom</th>
            <th scope="col" width="20%">Prénom</th>
            <th scope="col" width="30%">Adresse email</th>
            <th scope="col" width="30%">Nombre de passages annotés / <br/>nombre de passages à annoter </th>

          </tr>
        </thead>
        <tbody>
        <?php while( $row = $result->fetch_assoc() ) { 
          $id_utilisateur=$row['id_uti'];
          $id_groupe=$_GET['projet'];
            $result1 = $con->query("SELECT count(id_annot)  annot FROM  annotation a  where  a.id_uti='$id_utilisateur' and a.id_group='$id_groupe'" ); ?>
          <tr>
            <td scope="row"><?php echo htmlspecialchars($row['nom']); ?></td>
            <td><?php echo htmlspecialchars($row['prenom']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            
            <td><?php $row1 = $result1->fetch_assoc()  ;
            echo htmlspecialchars($row1['annot']) .'/'. htmlspecialchars($row['objectif']);?></td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
      <?php }?>
  </body>
</html>
