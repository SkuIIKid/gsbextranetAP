<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body background="assets/img/laboratoire.jpg">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
						
                                    <div class="content-wrap">
						<legend>je suis médecin, je souhaite créer un compte</legend>
							<?php $laPolitique = $pdo->donneDernierePolitiqueVersion(); ?>
							<form method="post" action="index.php?uc=creation&action=valideCreation">
                                                            <input name="login" class="form-control" type="email" placeholder="mail"/>
							    <input name="mdp" class="form-control" type="password" placeholder="password"/>
                                                            <input name="prenom" class="form-control" type="text" placeholder="prénom"/>
                                                            <input name="nom" class="form-control" type="text" placeholder="nom"/>
								<br>
                                                            <!-- On mémorise la version EXACTE de la politique proposée à l'utilisateur au
                                                                 moment de l'affichage du formulaire : c'est cette version, et pas une autre,
                                                                 qu'il aura acceptée en validant. Indispensable pour la preuve RGPD. -->
                                                            <input type="hidden" name="idVersion" value="<?php echo htmlspecialchars($laPolitique['id']); ?>"/>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input name="consentement" type="checkbox" required/>
                                                                    J'atteste avoir lu et j'accepte notre
                                                                    <a href="vues/v_politiqueprotectiondonnees.html" target="_blank">politique de protection des données</a>
                                                                    (version <?php echo htmlspecialchars($laPolitique['nom']); ?>)
                                                                </label>
                                                            </div>
								<br>
                                                            <input type="submit" class="btn btn-primary signup" value="Créer"/>
							</form>
							</br>
						
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    
  </body>
</html>