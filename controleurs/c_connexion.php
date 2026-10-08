<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		$connexionOk = $pdo->checkUser($login, $mdp);
		if(!$connexionOk){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else { 
            $infosMedecin = $pdo->donneLeMedecinByMail($login);
			$id = $infosMedecin['id'];
			$nom =  $infosMedecin['nom'];
			$prenom = $infosMedecin['prenom'];
			connecter($id,$nom,$prenom);
                       
			include("vues/v_sommaire.php");
			}

			break;	
	}
       
        
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>