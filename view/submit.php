<?php
require_once  'dbconfig.php';

$Email = $_POST['Email'];
$Message = $_POST['Commentaire'];

echo $Email ,$Message ;



$stmt = $DB_con-> prepare( 'INSERT INTO contacts VALUES(null , ?, ? )' );
$stmt->bindParam(1,$Email,PDO::PARAM_STR);
$stmt->bindParam(2,$Message,PDO::PARAM_STR);
if($stmt->execute()){

    echo "Merci pour soumettre votre message  ,votre remarque va étre traitée dans quelques jours";

}

header ('location:contact.php');


?>