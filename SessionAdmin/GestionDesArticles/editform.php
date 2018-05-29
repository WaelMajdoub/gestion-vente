<?php

	error_reporting( ~E_NOTICE );
	
	require_once '../dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];

		$stmt_edit = $DB_con->prepare('SELECT 
  
  idArticle ,nom	,description	,image	,idCategorie,	prix
  FROM articles WHERE idArticle =:id');
		$stmt_edit->execute(array(':id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$nom = $_POST['nom'];//
		$description = $_POST['description'];
        $prix = $_POST['prix'];//

        $categorie = $_POST['nomCat'];

        $stmtId = $DB_con->prepare("select idCategorie from categories where nomCategorie=?");

        $stmtId->bindParam(1, $categorie,pdo::PARAM_STR);
        $stmtId->execute();

        $idCategorie=$stmtId->fetch()[0];

			
		$imgFile = $_FILES['imageLoad']['name'];
		$tmp_dir = $_FILES['imageLoad']['tmp_name'];
		$imgSize = $_FILES['imageLoad']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'imageArticle/'; // upload directory
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $imageGen = rand(1000,1000000).".".$imgExt;

            if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{

					unlink($upload_dir.$edit_row['image']);
					move_uploaded_file($tmp_dir,$upload_dir.$imageGen);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
            $image = $edit_row['image']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{


			$stmtUpdate = $DB_con->prepare('UPDATE articles SET   
									      nom=?,description=?, image=?,idCategorie=?, prix=?							       
									      WHERE idArticle=?');


            $stmtUpdate->bindParam(1,$nom);
           $stmtUpdate->bindParam( 2,$description);
            $stmtUpdate->bindParam(3,$imageGen);
            $stmtUpdate->bindParam(4,$idCategorie);
            $stmtUpdate->bindParam(5,$prix);
            $stmtUpdate->bindParam(6,$id);
            $stmtUpdate->execute();

			if($stmtUpdate->execute()){
				?>
                <script>
				alert('Modification avec success !');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Pas de modification !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestionarticles</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
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
    	<h1 class="h2">Modifier Article <a class="btn btn-default" href="index.php"> Tous les articles </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">NomArticle</label></td>
        <td><input class="form-control" type="text" name="nom" value="<?php echo $nom; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Description</label></td>
        <td><input class="form-control" type="text" name="description" value="<?php echo $description; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">ImageArticle</label></td>

        <td>
        	<p><img src="imageArticle/<?php echo $image; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="imageLoad" accept="image/*" />
        </td>
    </tr>

        <tr>
            <td><label class="control-label">Prix</label></td>
            <td><input class="form-control" type="text" name="prix" value="<?php echo $prix; ?>" required /></td>
        </tr>



        <tr>
            <td><label class="control-label">Categorie</label></td>


            <!--populer le CB cat-->
            <!--recupération des catégories -->
            <?php

            $stmt_selectAll = $DB_con->prepare("select * from categories");

            $stmt_selectAll->execute();
            $tousLescategories = $stmt_selectAll->fetchAll(PDO::FETCH_OBJ);

            ?>

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
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Modifier
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> Annuler </a>
        
        </td>
    </tr>
    
    </table>
    
</form>



</div>
</body>
</html>