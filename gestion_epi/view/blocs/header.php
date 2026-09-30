<?php 
session_start()
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appli WebEPI</title>
    <link rel="stylesheet" type="text/css" href="css/global.css" />
</head>

<body>
<header>
	<a href="."><img src="pictures/epi.png" alt="Retour page d'accueil" /></a>
	<h1>Appli WebEPI</h1>
	<h2>Gestion des EPI</h2>
	<nav>
    	<ul>
    		<?php 
    		  require_once 'menu.php';
    		?>
    		
    	</ul>
	</nav>
</header>

<?php 
if (!empty($_SESSION['notification'])) {
    echo '<div id="notification">' . $_SESSION['notification'] . '</div>';
    unset($_SESSION['notification']);
}
?>
<article>
