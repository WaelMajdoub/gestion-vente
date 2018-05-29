<!DOCTYPE html>
<?php

require_once 'dbconfig.php';



?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Gestion</title>
    <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" >


</head>
<body style="
background-color:lightblue ; padding: 50px ;500px;500px ;500px ">

<div class="panel panel-default"><div class="panel panel-default">


<h1 align="center" class="header" >ESPACE ADMIN</h1>





<div class="
<?php
if ($nbrAr>0)

{
    echo "alert alert-info";
}
else echo "alert alert-danger"
?>
" >


        <strong><a  align="center" href="GestionDesArticles/index.php"><h3 >Gestion des articles
        <span class="badge"><?php echo $nbrAr ?></span> </h3></a></strong>
    </div>






<div class="<?php
if ($nbrCde>0)

{
    echo "alert alert-info";
}
else echo "alert alert-danger"
?>">
  <strong><a  align="center"  href="GestionDesCommandes/index.php"><h3  >Gestion des commandes
  <span class="badge"><?php echo $nbrCde ?></span></h3></a></strong>
</div>


<div class="<?php
if ($nbrC>0)

{
    echo "alert alert-info";
}
else echo "alert alert-danger"
?>">
    <strong><a align="center"   href="GestionDesCategories/index.php"><h3   >Gestion des catégories et stock
    <span class="badge"><?php echo $nbrC?></span> </h3></a></strong>
</div>

        <div class="alert alert-info">
        <strong><a align="center"   href="../SessionAdmin/contacts.php"><h3   >Consulter  les remarques des clients
                    </h3></a></strong>
    </div>




        <div class="panel-footer">
<div class="footer">
<p align="center">
    <button  class="btn btn-warningr"  style="
    border-radius: 10px">

        <a  href="../SessionAdmin/logout.php"> Déconnexion </a></button>



</p>

</div>
        </div></div>
</div>
</body>
</html>
