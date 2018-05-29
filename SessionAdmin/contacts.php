<?php

require_once '../dbconfig.php';


if(isset($_GET['delete_id']))
{





    $stmt_delete = $DB_con->prepare('DELETE FROM contacts WHERE id =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();

    header("Location: gestion.php");
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">


</head>

<body style="background-color: lightblue">

<div class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container">


        <div class="navbar-header" align="center"> <a class="navbar-brand" href="gestion.php" >ESPACE ADMIN</a>
        </div>


    </div>
</div>
</div>





<div class="container">
    <div class="pager" style="text-align : left">
        <h2  align="center">Les Contacts Clients</h2>

    </div>




    <table class="table table-bordered" >
        <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #863829
" >Email Client </th>
        <th style="text-align: center ;font-family: 'Comic Sans MS' ;font-size: 20px ;color: #863829">Commentaires</th>
        <?php





        $stmt = $DB_con->prepare('SELECT * FROM Contacts ORDER BY id DESC ');
        $stmt->execute();

        $cn = $stmt->rowCount();

        if($cn> 0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);

                ?>
                <tr>
                    <td>

                        <h4 class="pager"> <label >Email  :</label>
                            <span class="badge"><?php echo $email ?></span>
                        </h4>

                    </td>

                    <td>
                        <h4 class="pager"> <label >Commentaire:</label><span class="badge badge-pill badge-info">
                        <?php echo $Commentaire ?></span></h4>
                    </td>


                    <td>

                        <p class="pager">
				<span>

				<a class="btn btn-danger" href="?delete_id=<?php echo $row['id']; ?>" title="click for delete"
                   onclick="return confirm('surpprimer ce commentaire ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
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
                    <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Pas de remarques...
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