<?php

require_once '../dbconfig.php';

if(isset($_GET['delete_id']))

{



echo $_GET['delete_id'];
$idDel=$_GET['delete_id'];

    $stmt_delete = $DB_con->prepare('DELETE FROM commandes WHERE idCommande =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();

    header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>GestionCommandes</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
</head>

<body style="background-color: lightblue ; ">

<div class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container" >


<div class="navbar-header" align="center"> <a class="navbar-brand" href="../gestion.php" >ESPACE ADMIN</a>
</div>


 </div>
</div>
</div>

<div class="container">

    <div class="page-header">



        <h2  align="center">Les Commandes <span class="badge"><?php echo $nbrCde ?></span></h2>

    </div>
    <div class="panel-success" align="center">


    </div>

    <div class="row" >
        <?php

        $stmt = $DB_con->prepare('SELECT 	idCommande,idArticle,Quantite, prixTotal FROM Commandes ORDER BY idCommande DESC');
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);// extract  use $idCommande !
                ?>
                <div class="col-xs-3" >

                    
                    <h4 class="page-header"> <label > Numéro Commande :</label><?php echo $idCommande ?></h4>

                    <!--recupération des catégories -->
                    <?php

                    $stmt_selectAll = $DB_con->prepare("select * from commandes");

                    $stmt_selectAll->execute();
                    $tousLesArticles = $stmt_selectAll->fetchAll(PDO::FETCH_OBJ);

                    ?>

                    <h4 class="page-header"> <label > Nom Article  :</label>

                            <?php
                            $stmtArtc=$DB_con->prepare('select nom from Articles where idArticle=?');
                            $stmtArtc->bindParam(1,$idArticle,PDO::PARAM_INT);
   $stmtArtc->execute();
                            echo  $stmtArtc->fetch()[0];

   ?>



                       </h4>
                    <h4 class="page-header"> <label > Quantité :</label><?php echo $Quantite ?></h4>

                    <h4 class="page-header"> <label > Total à payer :</label><?php echo $prixTotal?></h4>





 <p class="page-header">
<span>

<a class="btn btn-danger" href="?delete_id=<?php echo $row['idCommande']; ?>" title="supprimer Commande" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
</span> </p> </div>
                <?php
            }
        }
        else
        {
            ?>
            <div class="col-xs-12">
                <div class="alert alert-warning">
                    <span class="glyphicon glyphicon-info-sign"></span> &nbsp;  Pas  encore de Commandes ...
                </div>
            </div>
            <?php
        }

        ?>
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>