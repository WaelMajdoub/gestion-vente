<?php

require_once '../dbconfig.php';

if(isset($_GET['delete_id']))
{
    // select  from db to delete
    $stmt_select = $DB_con->prepare('SELECT nomCategorie FROM categories WHERE idCategorie =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['delete_id']));


    // it will delete an actual record from db

    $stmt_delete = $DB_con->prepare('DELETE FROM categories WHERE idCategorie =:uid');
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
    <title>Gestion Catgories et Stock</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
</head>

<body style="background-color: lightblue">

<div class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container">


<div class="navbar-header" align="center"> <a class="navbar-brand" href="../gestion.php" >ESPACE ADMIN</a>
</div>


 </div>
</div>
</div>





<div class="container">
  <div class="pager" style="text-align : left">
        <h2  align="center">Les Catégories  <span class="badge"><?php echo $nbrC ?></span></h2>
      <a class="btn btn-primary" href="addnew.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp;AjouterCatégorie</a>

    </div>




    <table class="table table-bordered" >
        <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #863829
" >Code Catégorie</th>
        <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #863829">Nom Catégorie</th>
        <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #863829">Quantité disponible</th>
        <?php


        $stmt = $DB_con->prepare('SELECT idCategorie,  nomCategorie FROM categories ORDER BY idCategorie DESC ');
        $stmt->execute();

        $cn = $stmt->rowCount();

        if($cn> 0)
        {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
        extract($row);

        ?>

        <tr>
            <!--codeCat-->
            <td>

                <h4 class="pager"> <label > Code  Catégorie  :</label>
                    <span class="badge"><?php echo $idCategorie ?></span>
                </h4>

            </td>

<!--nomCat-->
            <td>
                <h4 class="pager"> <label > Nom  Catégorie:</label><span class="badge badge-pill badge-info">
                        <?php echo $nomCategorie ?></span></h4>
            </td>





            <!--Qte-->

            <?php
            $stmtQte = $DB_con->prepare('SELECT count(*) 
 
 FROM articles where idCategorie =? ');
            $stmtQte->bindParam(1,$idCategorie,PDO::PARAM_INT);
            $stmtQte->execute();
            $qte= $stmtQte->fetch()[0];

            ?>

            <td>
                <h4 class="pager"> <label > Quantité disponible:</label>

                    <span class="badge"><?php echo $qte?></span></h4>

            </td>


            <!--delete-->
            <td>

                <p class="pager">
				<span>

				<a class="btn btn-danger" href="?delete_id=<?php echo $row['idCategorie']; ?>" title="click for delete"
                   onclick="return confirm('surpprimer la catégorie ' +
                           '<?php echo  $row['idCategorie'];  ?> '+' et tous ses produits ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
				</span>

                </p>



            </td>
        </tr>

            <?php
        }
        }
        else
        {
            ?>
            <div class="col-xs-12">
                <div class="alert alert-warning">
                    <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Pas  encore de catégories...
                </div>
            </div>
            <?php
        }

        ?>
    </table>


  

    <div class="row" >
  
                <div class="col-xs-5" >


                  <!--  class="modal-dialog modal-sm"-->

                    










                </div>

    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>