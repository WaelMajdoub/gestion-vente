<?php

require_once '../dbconfig.php';

if(isset($_GET['delete_id']))
{


    // it will delete an actual record from db
  echo $idDel= $_GET['delete_id'];
    $stmt_delete_pre = $DB_con->prepare('DELETE  FROM articles where 	idArticle =?');
   $stmt_delete_pre->bindParam(1,$idDel);
   $stmt_delete_pre->execute();






  header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>GestionDesarticles</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
</head>

<body style="background-color: lightblue">

<div class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container">


<div class="navbar-header" align="center"> <a class="navbar-brand" href="../gestion.php" >ESPACE ADMIN</a> </div>


</div>
</div>
<div class="container">

    <div class="page-header">
        <h2  align="center">Les articles <span class="badge"><?php echo $nbrAr ?></span></h2>
        <a class="btn btn-primary" href="addnew.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp;Ajouter</a>
    </div>

    <div class="row">
        <?php

        $stmt = $DB_con->prepare('SELECT idArticle, nom, description, image ,idCategorie ,prix FROM articles ORDER BY idArticle DESC');
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                ?>
                <div class="col-xs-3" >
                    
                     <h4 class="page-header"><label > Nom Article:</label><?php echo $row['nom'] ?></h4>
                     
                    <h4 class="page-header"><label > Description:</label><?php echo $row['description']  ; ?></h4>
                    <h4 class="page-header"><label > Prix:</label><?php echo $row['prix']  ; ?> TND</h4>
                    <h4 class="page-header"><label > Nom Categorie:</label><?php

                        $stmtCat =$DB_con->prepare('select nomCategorie from categories WHERE 
idCategorie=?');
                    $stmtCat->bindValue(1,$row['idCategorie'],pdo::PARAM_INT);
                    $stmtCat->execute();

                        echo $stmtCat->fetch()[0];
                        ; ?></h4>
                    <img src="imageArticle/<?php echo $row['image']; ?>" class="img-rounded" width="200px" height="200px" />


                    <p class="page-header">
				<span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['idArticle']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a>
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['idArticle']; ?>" title="click for delete"
                   onclick="return confirm('Supprimer l`article <?php echo $row['idArticle']; ?>?')">
                    <span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
				</span>
                    </p>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            <div class="col-xs-12">
                <div class="alert alert-warning">
                    <span class="glyphicon glyphicon-info-sign"></span>   Pas  encore des articles ...
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