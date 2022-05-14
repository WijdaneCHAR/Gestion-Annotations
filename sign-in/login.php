<?php session_start(); ?>

<!doctype html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>Signin Template</title>
    
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

<!-- font awesome  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />


<script src="signin.js"></script>

</head>

<body class="text-center">

  <main class="form-signin shadow p-3 bg-white rounded">
    <form method="POST" autocomplete="On">
      <h1 class="h3 mb-3 fw-normal">Application</h1>
      <!-- Email -->
      <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Adresse Email</label>
      </div>
      <!-- Password -->
      <div class="form-floating">
        <input type="password" name="mdp"  class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Mot de passe</label>
      </div>
      <!-- Connexion -->
      
      <?php
      require_once("../db.php");
      $result = $con->query("SELECT * FROM utilisateur ");
      while( $row = $result->fetch_assoc() ){}?>
      <a href="index.php?id=<?php echo $row['id_uti']; ?>"><input type="submit"  class="w-50 btn btn-outline-primary" value="Connexion"></a>
      <?php if((isset($_POST["email"])) && (isset($_POST["mdp"])))
      {
        if( ($_POST["email"] != "")  && ($_POST["mdp"] != ""))
        {
          require_once("../db.php");
          $result = $con->query("SELECT * FROM utilisateur WHERE email = '" . mysqli_real_escape_string($con,$_POST["email"]) . "' and mdp = '" . md5($_POST["mdp"]) . "'");
          $admin = $result->fetch_assoc();
      
          if( isset($admin["email"] ) && $admin["email"] != "")
            {
                $_SESSION['logged'] = true;
                $_SESSION['email']=$_POST['email'];
                $_SESSION['mdp']=md5($_POST['mdp']);
                $_SESSION['id_uti'] = $admin['id_uti'];
                header("location: ../Profil/index.php");
            }
            else
            echo '<h6 style="color:red;margin-top:20px;">wrong password or username !!</h6>';
        }
        else   echo '<h6 style="color:red;margin-top:20px;">fill in all the fields !!</h6>';
      }
      ?>
      <p class="mt-5 mb-3 text-muted">Nouveau sur notre application? <a href="../sign-up/signup.php">Inscrivez-vous!</a>
      </p>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </main>
</body>
</html>