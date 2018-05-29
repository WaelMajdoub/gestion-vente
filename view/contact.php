

<!DOCTYPE html>


<html>
<head>
<title>Contact</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">



</head>
<body>

<div class="page-header" style="font-size: 50px ; color: #495ea9">Espace Contact  </div>
<div id="page" >

	</div>
	<div id="body" style="padding-left: 20px ;padding-right: 100px">
		<div class="content" style="border-radius: 10px;
		padding-left: 50px ; padding-top: 20px;
background-color: #afb3b6;
		 opacity: 0.9; "
		>

			<form action="submit.php" method="post" enctype="multipart/form-data">
				<table class="section">
<tr>



							<label for="email">
                                <span>Email:</span>
								<input type="text" id="email" name="Email">
							</label>

</tr>

<tr>

    <label for="Commentaire">
            <span>Message: </span></label>
        <input type="text" id="Commentaire" name="Commentaire" style="height: 30px; width: 800px">
        </input>



	</tr>
					<tr         style="padding-bottom: 10px">

						<td class="even"><button class="btn btn-info" type="submit" id="submit"

onclick=" return confirm('Merci pour votre interaction!')">Envoyer&nbsp;</button></td>
					</tr>
				</table>
			</form>


		</div>
	</div>
	<div id="footer" style="
	 border-radius: 25px;
background-color: #FFFFFF;
		 opacity: 0.6">
		<ul>
			<li id="section">
                <h3 style="color: #6235aa">Veuiller mettre votres remarques en commentaires !  </h3>
                <img src="../view/tech.jpg" style="border-radius: 25px" class="img-fluid"/>

</div>

</body>
</html>