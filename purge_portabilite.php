<?php
/**
 * Script de purge des fichiers JSON du droit à la portabilité (RGPD art. 20).
 * Supprime tous les fichiers .json du dossier "portabilite".
 * À exécuter en ligne de commande, par le planificateur de tâches :
 *   Linux (cron, tous les jours à 4h) : 0 4 * * * php /var/www/html/gsbextranetB3/purge_portabilite.php
 *   Windows : schtasks /create /tn "PurgePortabiliteGSB" /sc daily /st 04:00 /tr "php C:\\xampp\\htdocs\\gsbextranetB3\\purge_portabilite.php"
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("Accès interdit : script exécutable uniquement en ligne de commande.\n");
}

$dossier = __DIR__ . '/portabilite';
$nb = 0;
foreach (glob($dossier . '/*.json') ?: [] as $fichier) {
    if (is_file($fichier) && unlink($fichier)) {
        $nb++;
    }
}
echo date('Y-m-d H:i:s') . " - $nb fichier(s) JSON supprimé(s) de $dossier\n";
