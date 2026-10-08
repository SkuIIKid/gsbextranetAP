<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>GSB - extranet - Mes données personnelles</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top:20px;">
  <p><a href="index.php">&laquo; Retour à l'accueil</a></p>
  <div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Récupérer mes données personnelles</h3></div>
    <div class="panel-body">
      <p>Conformément à l'article 20 du RGPD, vous pouvez obtenir une copie de vos données
         personnelles au format <strong>JSON</strong> (hors identifiant et mot de passe).</p>
      <form method="post" action="index.php?uc=portabilite&amp;action=genererPortabilite">
        <button type="submit" class="btn btn-primary">Générer mon fichier</button>
      </form>

<?php if (isset($empreinte)) { ?>
      <hr/>
      <p><a class="btn btn-success" href="index.php?uc=portabilite&amp;action=telechargerPortabilite">
         Télécharger <?php echo $id; ?>.json</a></p>
      <h4>Vérifier l'intégrité du fichier</h4>
      <p>Empreinte SHA-256 : <code><?php echo $empreinte; ?></code></p>
      <p>Calculez l'empreinte du fichier téléchargé et comparez-la à celle ci-dessus :</p>
      <ul>
        <li>Linux / macOS : <code>sha256sum <?php echo $id; ?>.json</code></li>
        <li>Windows : <code>certutil -hashfile <?php echo $id; ?>.json SHA256</code></li>
      </ul>
      <p class="text-muted">Ce fichier est supprimé du serveur chaque nuit.</p>
<?php } ?>
    </div>
  </div>
</div>
</body>
</html>
