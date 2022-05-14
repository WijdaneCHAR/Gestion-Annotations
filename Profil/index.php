<?php
    session_start();
      if(! isset($_SESSION['logged']) || $_SESSION['logged'] == false)
      {
          // if($_SESSION['email'] != $admin['email'] && $_SESSION['mdp'] != $admin['mdp'])
          // {
          //     $con->close();
              header("Location: ../sign-in/login.php");
          // }
      }
      if ( isset($_GET["deco"]) && $_GET["deco"] == 1 ) 
      {
        $_SESSION['logged'] = false;
    
      header("Location: ../sign-in/login.php");
      }
    ?>

<!DOCTYPE html>
<html>

<head>
  <title>Profil Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="profil.css" rel="stylesheet">
</head>

<body>
  <div class="container-lg shadow p-3 bg-white rounded">
    <div class="row">
      <div class="col-sm-3">
        <!--left col-->

        <div class="text-center">
          <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="rounded-circle mb-4" alt="avatar" id="prof" style="display:block;" onclick="triggerClick()">
          <h6>Télécharger une nouvelle photo...</h6><br>
          <form action="index.php"  method="POST" enctype="multipart/form-data">
          <input type="file"  name="image"class="text-center center-block file-upload" id="image" onchange="displayImage" >
          <input type="submit" name="upload" value="télécharger la photo">
           <?php
           require_once("../db.php");
            if(isset($_POST['upload'])){
              //  echo "<pre>",print_r($_FILES['image']['name']),"</pre>";

              $prfImgName =time() .'_' .  $_FILES['image']['name'];

              $target = 'images/' . $prfImgName;
              $id = (isset($_SESSION['id_uti']) ? $_SESSION['id_uti'] : '' );

              if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
                  $sql = "UPDATE utilisateur SET photo = '$prfImgName' WHERE id_uti =".$id ;
                  $run = $con->query($sql);
                  if($run){
                      echo "image saved";
                  }
                  else{
                      echo "image not saved";
                  }
                
              }
              else {
                  echo "Failed to upload";

              }
            }
          ?>
          </form>
        </div>
        <br>
        <hr>
        <!--Activités-->
        <ul class="list-group">
          <a href="../Annotation/index.php"><li class="list-group-item text-muted">Activités </li></a>
          
          <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-1 me-auto">
                <div class="fw-bold">Passages à annoter</div>
              </div>
              <span class="badge bg-primary rounded-pill">125</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-1 me-auto">
                <div class="fw-bold">Passages annotés</div>
              </div>
              <span class="badge bg-primary rounded-pill">110</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-1 me-auto">
                <div class="fw-bold">Passages non annotés</div>
              </div>
              <span class="badge bg-primary rounded-pill">15</span>
          </li>
          
        </ul>
      </hr>
        <!--Colonne du droite-->


      </div>
      <div class="col-sm-9">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item col-sm-6" role="presentation">
            <button class="w-100 nav-link active text-center" id="pills-home-tab" data-bs-toggle="pill"
              data-bs-target="#home" type="button" role="tab" aria-controls="pills-home"
              aria-selected="true">Informations</button>
          </li>
          <li class="nav-item col-sm-6" role="presentation">
            <button  class="w-100 nav-link text-center" id="pills-profile-tab" data-bs-toggle="pill"
              data-bs-target="#edit" type="button" role="tab" aria-controls="pills-profile"
              aria-selected="false">Editer</button>
          </li>
        </ul>
        <!-- Pane informations -->
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="pills-home-tab">
            <hr>
            <?php 
                require_once("../db.php");
              
                $id = (isset($_SESSION['id_uti']) ? $_SESSION['id_uti'] : '' );
                $infos = $con->query("SELECT * FROM utilisateur WHERE id_uti=". $id);
                $res = $infos->fetch_assoc(); 

                   ?>
                    <form class="form" action="##" method="post" id="affichage">
                      <div class="row g-3" style="margin-top: 20px;">
                        <div class="col-6" >
                          <label for="first_name">
                            <h4 style="color: rgba(9, 121, 226, 0.904);">Nom :</h4>
                          </label>
                          <p> <?php echo htmlspecialchars($res['nom']); ?> </p>
                        </div>
                        <div class="col-6">
                          <label for="last_name">
                            <h4 style="color: rgba(9, 121, 226, 0.904);">Prénom :</h4>
                          </label>
                          <p><?php echo htmlspecialchars($res['prenom']); ?></p>
                        </div>
                      </div>

              

                <div class="col-12 mb-3">
                  <label for="phone">
                    <h4 style="color: rgba(9, 121, 226, 0.904);">Téléphone :</h4>
                  </label>
                  <p><?php echo htmlspecialchars($res['telephone']); ?></p>
                </div>
              
              

                <div class="col-12 mb-3">
                  <label for="email">
                    <h4 style="color: rgba(9, 121, 226, 0.904);">Adresse Email :</h4>
                  </label>
                  <p><?php echo htmlspecialchars($res['email']); ?></p>
                </div>
              
  
              
            </form>
            <a href="index.php?deco=1" style="margin-left:80%;font-weight: bold;font-size:20px;background-color:#0D6EFD;color:#FFFFFF;border-radius:3px;text-decoration: none;">Deconnexion</a>
            </hr>
          </div>
          <!-- Pane editer -->
          <div class="tab-pane fade show" id="edit" role="tabpanel" aria-labelledby="pills-profile-tab">
            <hr>
            <form class="form" method="post" id="modification" >
            <div class="row g-2" style="margin-top: 20px;">
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="nom" id="floatingInputGrid" placeholder="Votre nom">
                  <label for="floatingInputGrid">Nom</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="prenom" id="floatingInputGrid" placeholder="Votre prénom">
                  <label for="floatingInputGrid">Prénom</label>
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="tlf" id="floatingInput" placeholder="Numéro de téléphone">
                <label for="floatingInput">Téléphone</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Adresse Email</label>
              </div>
              <div class="row g-2">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="mdpA" id="floatingInputGrid" placeholder="Ancien mot de passe">
                    <label for="floatingInputGrid">Ancien mot de passe</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="mdp" id="floatingInputGrid" placeholder="Nouveau mot de passe">
                    <label for="floatingInputGrid">Nouveau mot de passe</label>
                  </div>
                </div>
              </div>
              <div class="col-md text-center">
                <input type="submit" class="w-25 btn btn-outline-primary" value="Enregistrer">
                <!-- Partie modification des donnees -->
                <?php
                      require_once("../db.php");

                      $result = $con->query("SELECT * FROM utilisateur WHERE id_uti = $id");
                      $admin = $result->fetch_assoc();

                      if(isset($_POST['mdp']) && $_POST['mdp'] !='' && isset($_POST['nom']) && $_POST['nom'] !='' && isset($_POST['prenom']) && $_POST['prenom'] !='' && isset($_POST['email']) && $_POST['email'] !=''){
                        $newPass = md5($_POST['mdp']);
                        $nom = mysqli_real_escape_string($con,$_POST['nom']);
                        $prenom = mysqli_real_escape_string($con,$_POST['prenom']);
                        $email = mysqli_real_escape_string($con,$_POST['email']);
                        $telephone = $_POST['tlf'];
                        if(md5($_POST['mdpA']) == $admin['mdp']){
                          $req = ("UPDATE utilisateur SET nom='$nom',prenom='$prenom',email='$email',mdp='$newPass',telephone='$telephone' WHERE id_uti= $id") ;    
                          $con->query($req);      
                          $con->close();      
                          echo "<meta http-equiv='refresh' content='0'>";
                          //header("location: index.php");
                          
                        }
                        else echo '<h6 style="color:red;margin-top:20px;">Ancien mot de passe incorrect !!</h6>';

                      }
                      else echo '<h6 style="color:red;margin-top:20px;"> Entrer tout les données!! </h6>';
                ?>
              </div>
            </form>
          </hr>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
        function triggerClick(){
            document.querySelector('#image').click();
        }
        function displayImage(e){
            if(e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    document.querySelector('#prof').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>


</body>

</html>