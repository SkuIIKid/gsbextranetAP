<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeCreation';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeCreation':{
		include("vues/v_creation.php");
		break;
	}
	case 'valideCreation':{
		
           
		$leLogin = htmlspecialchars($_POST['login']);
        $leNom = htmlspecialchars($_POST['nom']);
        $lePrenom = htmlspecialchars($_POST['prenom']);
        $lePassword = htmlspecialchars($_POST['mdp']);

        //RGPD : le consentement doit être un acte positif et explicite de l'utilisateur.
        //On ne fait JAMAIS confiance au seul attribut HTML "required" : il peut être
        //contourné (JS désactivé, requête POST forgée...). La vérification doit être
        //refaite côté serveur, qui est le seul endroit fiable pour prouver le consentement.
        $consentementOk = isset($_POST['consentement']) && $_POST['consentement'] == 'on';
        if (!$consentementOk) {
            echo 'Vous devez accepter la politique de protection des données pour créer un compte<br/>';
        }

        //id de la version de politique qui était affichée au moment où l'utilisateur a coché la case
        $idVersion = isset($_POST['idVersion']) ? (int) $_POST['idVersion'] : 0;
        if ($consentementOk && $idVersion <= 0) {
            echo 'Erreur : version de la politique inconnue, merci de recharger la page<br/>';
            $consentementOk = false;
        }

        if ($leLogin == $_POST['login'])
        {
             $loginOk = true;
             $passwordOk=true;
        }
        else{
            echo 'tentative d\'injection javascript - login refusé';
             $loginOk = false;
             $passwordOk=false;
        }
        //test récup données
        //echo $leLogin.' '.$lePassword;
        $rempli=false;
        if ($loginOk && $passwordOk){
        //obliger l'utilisateur à saisir login/mdp
        $rempli=true; 
        if (empty($leLogin)==true) {
            echo 'Le login n\'a pas été saisi<br/>';
            $rempli=false;
        }
        if (empty($leNom)==true) {
            echo 'Le nom n\'a pas été saisi<br/>';
            $rempli=false;
        }
        if (empty($lePrenom)==true) {
            echo 'Le prenom n\'a pas été saisi<br/>';
            $rempli=false;
        }
        if (empty($lePassword)==true){
            echo 'Le mot de passe n\'a pas été saisi<br/>';
            $rempli=false; 
        }
        
        
        //si le login et le mdp contiennent quelque chose
        // on continue les vérifications
        if ($rempli){
            //supprimer les espaces avant/après saisie
            $leLogin = trim($leLogin);
            $leNom = trim($leNom);
            $lePrenom = trim($lePrenom);
            $lePassword = trim($lePassword);

            

            //vérification de la taille du champs
            
            $nbCarMaxLogin = $pdo->tailleChampsMail();
            if(strlen($leLogin)>$nbCarMaxLogin){
                 echo 'Le login ne peut contenir plus de '.$nbCarMaxLogin.'<br/>';
                $loginOk=false;
                
            }
            
            //vérification du format du login
           if (!filter_var($leLogin, FILTER_VALIDATE_EMAIL)) {
                echo 'le mail n\'a pas un format correct<br/>';
                $loginOk=false;
            }
            
          
            $patternPassword='#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W){12,}#';
            if (preg_match($patternPassword, $lePassword)==false){
                echo 'Le mot de passe doit contenir au moins 12 caractères, une majuscule,'
                . ' une minuscule et un caractère spécial<br/>';
                $passwordOk=false;
            }
            
            
                 
        }
        }
        if($rempli && $loginOk && $passwordOk && $consentementOk){
                echo 'tout est ok, nous allons pouvoir créer votre compte...<br/>';
                $executionOK = $pdo->creeMedecin($leLogin, $leNom, $lePrenom, password_hash($lePassword, PASSWORD_DEFAULT), $idVersion);       
               
                if ($executionOK==true){
                    echo "c'est bon, votre compte a bien été créé ;-)";
                    $pdo->connexionInitiale($leLogin);
                }   
                else
                     echo "ce login existe déjà, veuillez en choisir un autre";
            }

			
        
        break;	
}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>