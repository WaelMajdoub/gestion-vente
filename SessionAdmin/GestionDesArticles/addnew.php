<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$nom = $_POST['name'];// nomArticle
		$description = $_POST['description'];// description
        $prix = $_POST['prix'];
        $categorie = $_POST['nomCat'];

        $stmtId = $DB_con->prepare("select idCategorie from categories where nomCategorie=?");

        $stmtId->bindParam(1,$categorie,pdo::PARAM_STR);
        $stmtId->execute();

      $idCategorie=$stmtId->fetch()[0];





	//image
		$imgFile = $_FILES['imageToLoad']['name'];
		$tmp_dir = $_FILES['imageToLoad']['tmp_name'];
		$imgSize = $_FILES['imageToLoad']['size'];
		

		if(empty($nom)){
			$errMSG = "Le  nom d'article est obligatoire.";
		}
		else if(empty($prix)){
			$errMSG = "Le  prix  d'article est obligatoire.";
		}
		else if(empty($imgFile)){
			$errMSG = "L'image d'article est obligatoire.";
		}
		else
		{
			$upload_dir = 'imageArticle/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

            // rename uploading image
            $artImg = rand(1000,1000000).".".$imgExt;
            // rename uploading image
            //$picArt = rand(1000,1000000).".".$imgExt;
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$artImg);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....

       // rechreche idcatégorie à partir du nomCatégorie








		if(!isset($errMSG))
		{$stmt = $DB_con->prepare('INSERT INTO articles VALUES(null, ? , ? , ? ,  ? , ?)');
			$stmt->bindParam(1,$nom,PDO::PARAM_STR);
			$stmt->bindParam(2,$description,PDO::PARAM_STR);
			$stmt->bindParam(3,$artImg,PDO::PARAM_STR);
			$stmt->bindParam(4,$idCategorie,PDO::PARAM_INT);
			$stmt->bindParam(5,$prix,PDO::PARAM_INT);

			
			if($stmt->execute())
			{
				$successMSG = "Ajout avec succés ... ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "erreur d'
}insertion...";
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
                <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Afficher tous les Articles </a></h1>
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
    	<td><label class="control-label">Nom Article</label></td>
        <td><input class="form-control" type="text" name="name" placeholder="Nom Article" value="<?php echo $nom; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Description</label></td>
        <td><input class="form-control" type="text" name="description" placeholder="Description" value="<?php echo $description; ?>" /></td>
    </tr>

        <tr>
    	<td><label class="control-label">Image Article</label></td>
        <td><input class="input-group" type="file" name="imageToLoad" accept="image/*" /></td>
    </tr>




        <!--recupération des catégories -->
        <?php

        $stmt_selectAll = $DB_con->prepare("select * from categories");

        $stmt_selectAll->execute();
        $tousLescategories = $stmt_selectAll->fetchAll(PDO::FETCH_OBJ);

        ?>




        <tr>
            <td><label class="control-label">NomCategorie</label></td>
            <td>

                <select  class="form-control" id="nomCat" name="nomCat" >
                    <!--population du CB catégories -->
                    <?php  foreach($tousLescategories as $cat) :?>

                        <option><?=  $cat->nomCategorie ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>



        <tr>
            <td><label class="control-label">Prix</label></td>
            <td><input class="form-control" type="text" name="prix" placeholder="Prix" value="<?php echo $prix; ?>" /></td>
        </tr>
    
    <tr>
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