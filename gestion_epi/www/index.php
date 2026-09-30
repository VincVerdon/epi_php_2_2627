<?php
/**
 * index.php utilisé uniquement par l'appli Web
 * @author V. Verdon
 * @version 20231115
 */


//namespaces management
function importClass($class) {
	$path = "../" . str_replace('\\', DIRECTORY_SEPARATOR, $class);
	require_once($path . '.php');
}
spl_autoload_register('importClass');

use view\DefaultView;
use controller\ManufacturerCtrl;


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
    case '':
        $ctrl = new DefaultView();
        $ctrl->welcome();
        break;
        
    case 'manufacturers':
        
        $ctrl = new ManufacturerCtrl();
        break;
            
    default:
        $ctrl = new DefaultView();
        $ctrl->error404();
        break;
        
}