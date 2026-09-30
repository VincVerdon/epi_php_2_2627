<?php
/**
 * api.php appelé uniquement par requêtes sur l'API REST
 * @author V. Verdon
 * @version 20231121
 * @note Les routes ont été réécrites en amont par Apache  dans .htaccess du rep www
 *
 */

//namespaces management
function importClass($class) {
	$path = "../" . str_replace('\\', DIRECTORY_SEPARATOR, $class);
	require_once($path . '.php');
}
spl_autoload_register('importClass');

use api\ErrorApi;
use api\ManufacturerApi;


/**
 * The requested route
 * @warning Code sensible aux attaques
 * @todo Attention prévoir de protéger le code des injections !
 */
$route = '';
if (isset($_GET['route'])) {
    $route = $_GET['route'];
}

//We switch to the good controller
switch ($route) {
        
    case 'manufacturers':
        new ManufacturerApi();
        break;
        
    default:
        new ErrorApi();
        break;
        
}

