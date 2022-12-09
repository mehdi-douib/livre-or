<?php

include('conect.php');

?>
<?php
try
{
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
if(!isset($_SESSION['connexion']))
{
    header('location: connexion.php');
    exit();
}
//ici on stocke le contenu de la variable SESSION (le login entré precedemment) dans $loginverify
//pour pouvoir l'utiliser pour fixer la ligne lors de la requete UPDATE
$idverify = $_SESSION['connexion'];

      if(isset($_POST['submit']))
      {
            if(!empty($_POST))
            {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $test= 'salut';

                  if($password==$password2)
                  {
                    
                  $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
                  $request = $PDO->prepare("SELECT*FROM utilisateurs WHERE login = ? ");         
                  $request->bindValue(1, $login);
                  $request->execute();

                  $row = $request->rowCount();
                            

                         if($row==0)
                         {
                         $request2 = $PDO->prepare("UPDATE utilisateurs SET login = ?, password = ?  WHERE id = ? ");
                        

                         $request2->bindValue(1, $login);
                         $request2->bindValue(2, $password);
                         $request2->bindValue(3, $idverify);
                         $request2->execute();
                         var_dump($request2);
                         }
                  }
            }
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

<body>
<main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins" action="profil.php" method="post">
                <h1 class="head_profile">Modifiez vos informations</h1>
                    <article class="pseudo_ins">
                        <label for="login">Votre pseudo :</label>
                        <input type="text" id="login" name="login" required>
                    </article>
                    <article class="mp_ins">
                        <label for="enterMp">Votre mot de passe : </label>
                        <input type="password" id="enterMp" name="password" required>
                    </article>
                    <article class="mp_ins">
                        <label for="confirmMp">Confirmez votre mot de passe :</label>
                        <input type="password" id="confirmMp" name="password2" >
                    </article>      
                    <article class="button_ins">
                        <button type="submit" name="submit">Valider</button>
                    </article>
                    <a style="color:white; text-decoration:none;" href="deconnexion.php">Deconnexion</a>
                </form>
            </section>
        </main>
  </body>

  <?php

include('footer.php');

?>


</html>