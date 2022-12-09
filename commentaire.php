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
      $commentaire = $_POST['com'];
      $iduser = $_SESSION['connexion'];

          //ici on verifie que tous les champs sont remplis
          if($commentaire)
          {               
              //on connecte la base de donnée et on lance la requete préparée pour verifier que le pseudo est disponible
              $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
              $request = $PDO->prepare('INSERT INTO commentaires(commentaire,id_utilisateur,date) VALUES (?,? ,NOW())');        
              $request->bindValue(1, $commentaire);
              $request->bindValue(2, $iduser);
              $request->execute(); 
              header('location:livre-or.php');          
          }      } 
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}
?>

<?php

include('header.php');

?>

<form  class="text-center border border-light p-5"  action="commentaire.php" method="post">
    <p class="h4 mb-4">Laissez un commentaire</p>

    <div class="form-group">
      <textarea class="form-control" id="exampleTextarea" rows="3" name="com"></textarea>
    </div>
    <button class="btn btn-info btn-block my-4" type="submit" name="submit">C'est parti !</button>
</form>

<?php

include('footer.php');

?>

  </body>
</html>