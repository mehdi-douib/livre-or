
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
      $password2 = $_POST['password2'];

          //ici on verifie que tous les champs sont remplis
          if($login && $password && $password2)
          {
              //ici on verifie si les mots de passe sont similaires
              if($password==$password2)
              {
        
              //on connecte la base de donnée et on lance la requete préparée pour verifier que le pseudo est disponible
              $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
              $request = $PDO->prepare("SELECT*FROM utilisateurs WHERE login = ? ");         
              $request->bindValue(1, $login);
              $request->execute();
                  
              $row = $request->rowCount();
              // var_dump($row);
              // $request->close();
              // $request->closeCursor();
              // $PDO->close();

                     if($row==0)
                     {
                       $request2 = $PDO->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
                       $request2->bindValue(1, $login);
                       $request2->bindValue(2, $password);
                       $request2->execute();
                      
                       $request2->closeCursor();
                       // $PDO->close();
                       header('location: connexion.php');
                       exit();

                     }
                     else $erreur= "<p class='erreur_ins'>Ce login est deja utilisé</p>";
                     // else $PDO->close();
              }
              else $erreur= "<p class='erreur_ins'>Les mots de passes ne sont pas similaires</p>";
          }
          else $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
      } 
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}

?>

<?php

include('header.php');

?>
<body class="bodyinscription">
        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins"  method="post">
                    <article class="pseudo_ins">
                        <label for="login">Votre pseudo :</label>
                        <input type="text" id="login" name="login" >
                    </article>
                    <article class="mp_ins">
                        <label for="enterMp">Mot de passe : </label>
                        <input type="password" id="enterMp" name="password" >
                    </article>    
                    <article class="mp_ins">
                        <label for="confirmMp">Confirmez votre mot de passe :</label>
                        <input type="password" id="confirmMp" name="password2" >
                    </article>  
                    <article class="button_ins">
                        <button type="submit" value="Submit"  name="submit">Valider</button><br/>
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="index.php">Retour accueil</a>
                        <?php if(isset($erreur)){echo $erreur;}?>
                    </article>
                </form>
            </section>
        </main>
        </body>
  <?php
include('footer.php');
?>
</html>