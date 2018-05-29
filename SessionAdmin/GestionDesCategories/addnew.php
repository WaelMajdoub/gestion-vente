<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{

		$nomC= $_POST['nomCategorie'];


		if(!isset($errMSG))
		{$stmt = $DB_con->prepare('INSERT INTO categories VALUES(null, ? )');

			$stmt->bindParam(1,$nomC,PDO::PARAM_STR);

			
			if($stmt->execute())
			{
				$successMSG = "Ajout avec succés ... ...";
				header("refresh:1;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "erreur d'insertion...";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GestionArticles</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body style="background-color: lightblue">

<div class="navbar navbar-default navbar-static-top" role="navigation">

	<div class="container">


<div class="navbar-header" align="center"> <a class="navbar-brand" href="../gestion.php" >ESPACE ADMIN</a> </div>


 </div>
</div>
</div>
<div class="container">


	<div class="page-header">
    	<h1 class="h2">Ajouter un nouveau article <a class="btn btn-default" href="index.php">
                <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Afficher tous les Categories </a></h1>
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
	

    
    <tr>
    	<td><label class="control-label">NomCategorie</label></td>
        <td><input class="form-control" type="text" name="nomCategorie"
                   placeholder="NomCategorie" value="<?php echo $nomCategorie; ?>" /></td>
    </tr>




        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span>  Enregistrer
        </button>
        </td>
    </tr>
    
    </table>
    
</form>





    

</div>



	


<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>