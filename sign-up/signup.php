<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Signup Template</title>
  <!--  Bootstrap core CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="sign-up.css" rel="stylesheet">

</head>

<body class="text-center">
  <main class="form-signup shadow p-3 bg-white rounded">
    <form method="POST">
      <h1 class="h3 mb-3 fw-normal">S'inscrire</h1>
      <!-- Nom et prénom -->
      <div class="row g-2 mb-3">
        <div class="col-md">
          <div class="form-floating">
            <input type="text" class="form-control" name="nom" id="floatingInputGrid" placeholder="XXXXX">
            <label for="floatingInputGrid">Nom</label>
          </div>
        </div>
        <div class="col-md ">
          <div class="form-floating">
            <input type="text" class="form-control" name="prenom" id="floatingInputGrid" placeholder="XXXXXX">
            <label for="floatingInputGrid">Prénom</label>
          </div>
        </div>
      </div>
      <!-- Email -->
      <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Adrese Email</label>
      </div>
      <!-- Password -->
      <div class="form-floating mb-3">
        <input type="password" class="form-control" name="mdp" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Mot de passe</label>
      </div>
      <!-- Téléphone -->
      <div class="form-floating mb-3">

        <input type="text" class="form-control" name="tlf" id="floatingAdress" placeholder="1234 Main St">
        <label for="floatingAdress">Téléphone</label>
      </div>
      <!-- Boutton submit -->
      <button type="submit" class="w-50 btn btn-outline-primary">Enregistrer</button>
      <?php
          require_once("../db.php");

          if(isset($_POST['mdp']) && $_POST['mdp'] !='' && isset($_POST['nom']) && $_POST['nom'] !='' && isset($_POST['prenom']) && $_POST['prenom'] !='' && isset($_POST['email']) && $_POST['email'] !='' && isset($_POST['tlf']) && $_POST['tlf'] !=''){
            $newPass = md5($_POST['mdp']);
            $nom = mysqli_real_escape_string($con,$_POST['nom']);
            $prenom = mysqli_real_escape_string($con,$_POST['prenom']);
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $tlf = $_POST['tlf'];
            $req = "INSERT INTO utilisateur(nom,prenom,email,mdp,telephone) VALUES ('$nom','$prenom','$email','$newPass','$tlf')" ;    
            $con->query($req);      
            $con->close();      
            header("location: ../sign-in/login.php");

          }
          else echo '<h6 style="color:red;margin-top:20px;"> Entrer tout les données!! </h6>';
    ?>
    </form>


  </main>
</body>

</html>