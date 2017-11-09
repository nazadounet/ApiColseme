<?php
//link https://www1.zonewebmaster.eu/tutoriel-php-mysql:php:affichage-erreurs-php
// Affichage des erreurs
$type_gestion = 1; // 1=>mode debug, 2=>mode production (erreur dans log/error.log), 0=>Aucun traitement
switch ($type_gestion) {
    case '1':
        if (PHP_VERSION_ID < 50400) error_reporting (E_ALL | E_STRICT);
        else error_reporting (E_ALL);
        ini_set('display_errors', true);
        ini_set('html_errors', false);
        ini_set('display_startup_errors',true);

        /*Cette ligne permet l'écriture des erreurs dans un fichier log. Mettre à 'true' pour activer l'option.
        ini_set('error_log', CHG_ROOT_PATH.'log/error.log');*/
        ini_set('log_errors', false);

        ini_set('error_prepend_string','<span style="color: red;">');
        ini_set('error_append_string','<br /></span>');
        ini_set('ignore_repeated_errors', true);
        break;
    case '2':
        error_reporting (E_ALL);
        ini_set('display_errors', false);
        ini_set('html_errors', false);
        ini_set('display_startup_errors',false);
        ini_set('log_errors', true);
        ini_set('error_log', CHG_ROOT_PATH.'log/error.log');
        ini_set('error_prepend_string','<span style="color: red;">');
        ini_set('error_append_string','</span>');
        ini_set('ignore_repeated_errors', true);
        break;
    default:
        error_reporting (E_ALL);
        ini_set('display_errors', false);
        ini_set('html_errors', false);
        ini_set('display_startup_errors',false);
        ini_set('log_errors', false);
}

//Permet l'affichage formater de la fonction print_r
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}