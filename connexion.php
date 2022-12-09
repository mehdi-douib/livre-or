<?php

include('conect.php');

?>
<?php
try
{
//configuration des erreurs et enlever l'emulation des requetes préparées
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
      //ici on verifie que le boutton submit est utilisé
      if(isset($_POST['submit']))
      {
      $login = $_POST['login'];
      $password = $_POST['password'];

          //ici on verifie que tous les champs sont remplis
          if($login && $password)
          {
          //on connecte la base de donnée et on lance la requete préparée pour verifier que l'utilisateur existe et a bien remplis ses infos
          $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
          $request = $PDO->prepare("SELECT login, password, id FROM utilisateurs WHERE login = ? && password = ? ");         
          $request->bindValue(1, $login);
          $request->bindValue(2, $password);
          $request->execute();
                  
          $row = $request->rowCount();
          
          $ligne = $request->fetch(PDO::FETCH_ASSOC);

                // if($ligne["login"]=='admin' && $ligne["password"]=='admin')
                // {
                //   $_SESSION['admin'] = 'admin';
                //   header('location: admin.php');
                //   exit();
                // }
                if($row==1)
                { 
                  $_SESSION['connexion'] = $ligne['id'] ;             
                  header('location:livre-or.php');
                  exit();
                }          
          }
          else $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
      } 
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}

//affichage boutton conenxion/deconnexion
if(isset($_SESSION['connexion']))
{
    $btn_deconnect = '';
}
if(!isset($_SESSION['connexion']))
{
    $btn_connect = '';
}
?>


<?php

include('header.php');

?>


<form  class="text-center border border-light p-5"  action="connexion.php" method="post">
    <p class="h4 mb-4">Connectez-vous</p>

    <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins"  method="post">
                    <article class="pseudo_ins">
                        <label for="pseudo"> Pseudo :</label>
                        <input type="text" id="pseudo" name="login" required>
                    </article>
                    <article class="mp_ins">
                        <label for="motdepasse"> Mot de passe :</label>
                        <input type="password" id="motdepasse" name="password" required>
                    </article>
                    <article class="button_ins">
                        <button type="submit" name="submit" >Valider</button>
                    </article>
                </form>
                    <article class="linkcreate">
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="inscription.php">Créer un compte</a><br/>
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="index.php">Retour accueil</a>
                    </article>
            </section>
        </main>
</form>

<?php
include('footer.php')
?>
  </body>
</html>