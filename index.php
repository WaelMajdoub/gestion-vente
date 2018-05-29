<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Acceuil-Vente</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px)
    {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }
  </style>
</head>

<body>

  <?php
  include "includes/NavBar.php";
  ?>

  <?php
  include "includes/Slider.php";
  ?>

  <main>
      <div class="container" style="background-color: #fff2f7"  style="width: 100%; height: 100%;" >

          <table class="table table-bordered"  style="width: 100%; height: 100%;">

              <th  style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #858a9f"> Nom Article</th>
              <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #858a9f"> Description</th>
              <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #858a9f">Image</th>
              <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #858a9f">Catégorie</th>
              <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #858a9f" >Prix</th>

              <?php
              require_once 'dbconfig.php';

              $stmt=$DB_con->prepare('select * from articles ');
              $stmt->execute();
              if($stmt->rowCount() > 0)
              {
                  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                  {
                      extract($row);?>
                      <tr>
                          <td> <?php echo $row['nom']; ?></td>
                          <td><?php echo $row['description']; ?> </td>
                          <td>
<img src="SessionAdmin/GestionDesArticles/imageArticle/<?php echo $row['image'];?>  "   class="img-rounded" width="200px" height="200px" />
                          </td>
                          <!-- recupération des catégories  -->
                          <?php
                          $stmt_selectCat = $DB_con->prepare("select nomCategorie from categories where idCategorie=?");
                          $stmt_selectCat->bindParam(1,$row['idCategorie'],PDO::PARAM_INT);
                          $stmt_selectCat->execute();
                          $CatNom = $stmt_selectCat->fetch()[0];
                          ?>
                          <td>
                              <?php echo $CatNom; ?>
                          </td>
                          <td><?php echo $row['prix']; ?> </td>
                      </tr>
                      <?php
                  }
              }
              else
              {
                  ?>
                  <div class="col-xs-12">
                      <div class="alert alert-warning">
                          <span class="glyphicon glyphicon-info-sign"></span>   Pas  encore d'articles ...
                      </div>
                  </div>
                  <?php
              }

              ?>
          </table>

      </div>
  </main>

  <?php
  include "includes/Footer.php";
  ?>

  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
</body>

</html>