<?php

error_reporting( ~E_NOTICE ); // avoid notice

require_once '../dbconfig.php';

if(isset($_POST['btnsave']))
{
    $nomArticle = $_POST['nomArticle'];//nom_Article


    //determiner l'id correspondant
    $stmtNA=$DB_con->prepare('select idArticle from articles where nom=?');
    $stmtNA->bindParam(1,$nomArticle,Pdo::PARAM_STR);
    $stmtNA->execute();

$idArticle   = $stmtNA->fetch()[0];

    $Quantite = $_POST['Quantite'];

    //determination du prix
    $stmtPrix=$DB_con->prepare('select prix from articles where idArticle=?');
    $stmtPrix->bindParam(1,$idArticle,Pdo::PARAM_INT);
    $stmtPrix->execute();
    $pa= $stmtPrix->fetch()[0];






    $prixTotal= $Quantite * $pa;


    //echo "prix:".$pa."qte".$Quantite."pt".$prixTotal ;


        $stmt = $DB_con->prepare('INSERT INTO commandes VALUES(NULL , ? , ? , ?)');
        $stmt->bindParam(1,$idArticle,PDO::PARAM_INT);
        $stmt->bindParam(2,$Quantite,PDO::PARAM_INT);
        $stmt->bindParam(3,$prixTotal,PDO::PARAM_INT);




        if($stmt->execute())
        {
            $successMSG = "Commande ajouté avec succé ...";
            header("refresh:5;../index.php"); // redirects image view page after 5 seconds.
        }
        else
        {
            $errMSG = "erreur d'insertion....";
        }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gestioncommandes</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body style="background-color: lightblue">
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header" align="center"> <a class="navbar-brand" href="../index.php" >Retour</a>
        </div></div></div></div>

<div class="container">
    <div class="page-header">
        <h1 class="h2">Ajouter une nouvelle commande </h1>
    </div>
    <?php
    if(isset($errMSG)){
        ?>
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
        </div>
        <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
    }
    ?>
    <form method="post" enctype="multipart/form-data" class="form-horizontal">
        <table class="table table-bordered table-responsive">





            <?php

            $stmt_selectAll = $DB_con->prepare("select * from articles");

            $stmt_selectAll->execute();
            $tousLesArticles = $stmt_selectAll->fetchAll(PDO::FETCH_OBJ);


            ?>


            <tr>  <td> <label >Nom Article </label></td>

                <td> <select  class="form-control"  name="nomArticle" >

                        <?php  foreach($tousLesArticles as $ar) :?>

                            <option><?=  $ar->nom ?></option>
                        <?php endforeach; ?>

                    </select>

                </td>
            <tr>

            <tr>
                <td><label class="control-label">Quantité</label></td>
                <td><input class="form-control" type="text" name="Quantite" placeholder="Quantité" value="<?php echo $Quantite; ?>" /></td>
            </tr>



            <tr>
                <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
                        <span class="glyphicon glyphicon-save"></span> &nbsp; Enregistrer Commande
                    </button>
                </td>
            </tr>

        </table>

    </form>







</div>






<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>