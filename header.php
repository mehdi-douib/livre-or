<?php

if(isset($_SESSION['connexion']))
{
    $btn_deconnect = '';
}
if(!isset($_SESSION['connexion']))
{
    $btn_connect = '';
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Livre-or</title>
  </head>

  <body>
  
  <header class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil
          <span class="sr-only">(current)</span>
        </a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="livre-or.php">Livre d'or</a>
      </li>

      <?php if(isset($_SESSION['connexion'])) 
      { 
      echo "
            <li class='nav-item'>
            <a class='nav-link' href='profil.php'>Profil</a>
            </li>"
      ;} 
      else echo "<li class='nav-item'>
                <a class='nav-link' href='connexion.php'></a>
                </li> 
                <li class='nav-item'>
                <a class='nav-link' href='inscription.php'>Inscription</a>
              </li>"
      ?>

    </ul>
  </div>

<?php if(isset($_SESSION['connexion'])) 
{ 
echo "<a class='btn btn-primary' href='deconnexion.php' role='button'>Deconnexion</a>"
;} 
else echo "<a class='btn btn-primary' href='connexion.php' role='button'>Connexion</a>"
?>

</header>