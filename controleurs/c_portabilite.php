<?php
$id = (int) $_SESSION['id'];
$fichier = __DIR__ . "/../portabilite/$id.json";

if (!isset($_GET['action'])) {
    $_GET['action'] = 'demandePortabilite';
}
$action = $_GET['action'];

switch ($action) {
    case 'demandePortabilite': {
        include("vues/v_portabilite.php");
        break;
    }
    case 'genererPortabilite': {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?uc=portabilite');
            exit;
        }
        $donnees = $pdo->donneDonneesPortabilite($id);
        $json = json_encode($donnees, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if (file_put_contents($fichier, $json) === false) {
            ajouterErreur("La génération du fichier a échoué, veuillez réessayer.");
            include("vues/v_erreurs.php");
        } else {
            $empreinte = hash_file('sha256', $fichier);
        }
        include("vues/v_portabilite.php");
        break;
    }
    case 'telechargerPortabilite': {
        if (!is_file($fichier)) {
            header('Location: index.php?uc=portabilite');
            exit;
        }
        header('Content-Type: application/json; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"$id.json\"");
        readfile($fichier);
        exit;
    }
    default: {
        include("vues/v_portabilite.php");
        break;
    }
}