<?php 
$estVendeur=false;
if(LOGGED){
  $notificationListNew = requeteSqlArray("SELECT * from notification where idUtilisateur = '{$_SESSION['idUtilisateur']}' and  vu = 0 ORDER BY dateNotif DESC",$pdo);
  $textColor="text-dark";
  if($_SESSION['estVendeur']){
    $estVendeur=true;
  }
  if($page=="notifications"){
    $textColor="text-secondary";
  }
   else   $textColor= "text-dark";
  if(sizeof($notificationListNew)>0){
    $textColor="text-danger";
  }
 
}
  
?>
<main>
  <header class="p-3 text-white" style="background: rgb(210,210,210)">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="../images/logo.png" style="width:50px;" alt="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="?page=accueil" class="nav-link px-2 <?php if($page=="accueil") echo "text-secondary"; else   echo "text-dark"?>">Accueil</a></li>
          <li><a href="?page=toutParcourir" class="nav-link px-2 <?php if($page=="toutParcourir") echo "text-secondary"; else   echo "text-dark"?>">Tout Parcourir </a></li>
          <?php if(LOGGED) : ?>
          <li><a href="?page=notifications" class="nav-link px-2 <?php echo $textColor; ?>" <?php if(sizeof($notificationListNew)>0) : ?>id="clignote"<?php endif ?>>Notifications</a></li>
          <li><a href="?page=panier/panier" class="nav-link px-2 <?php if($page=="panier/panier") echo "text-secondary"; else   echo "text-dark"?>">Panier</a></li>
          <?php endif ?>
        </ul>
        <div class="text-end">
        <?php if(LOGGED) : ?>
          <?php if($_SESSION['estAdmin']) : ?>
          <button onclick="location.href='?page=admin'" type="button" class="btn btn-danger">Admin</button>
          <?php endif ?>
          <?php if($estVendeur) : ?>
          <button onclick="location.href='?page=vendeur'" type="button" class="btn btn-danger">Vendeur</button>
          <?php endif ?>
          
          <button onclick="location.href='?page=votre_compte'" type="button" class="btn btn-warning">Votre compte</button>
          <button onclick="location.href='script_php/Utilisateur/deconnexion.php'" type="button" class="btn btn-outline-light me-2">D??connexion</button>

        <?php else: ?>
          <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-outline-light me-2">Connexion</button>
          <button onclick="location.href='Utilisateur/inscription.php'" type="button" class="btn btn-warning">Inscription</button>
        <?php endif ?>
        </div>
      </div>
    </div>
  </header>
</main>
<?php  $deco =isset($_REQUEST["deconnexion"])? $_REQUEST['deconnexion'] : NULL; 
    $co =isset($_REQUEST["connexion"])? $_REQUEST['connexion'] : NULL; 
?>


   

      
