<?php
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
                'root', 
                '',
                array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
				)
				);

function debug($var) {
	echo '<pre>';
		print_r($var);
	echo '</pre>';
}
 // debug($_GET);

if (isset($_GET['id_contact'])) { // si id_contact est dans l'URL c'est que l'on a demandé le détail contact

   // Echappement des données
   $_GET['id_contact'] = htmlspecialchars($_GET['id_contact'], ENT_QUOTES); // pour se prémunir des risuqes XSS et CSS (les chevrons sont transformés en entités HTML).

   // requête préparé car le $_GET vient de l'internaute :
   $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact"); // marqueur "vide"
   $resultat->execute(array(':id_contact'=> $_GET['id_contact'])); // on associe le marqeur à la valeur qui passe par l'URL donc dans $_GET. 

   $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetche" $resultat pour aller chercher les données du contact dans l'objet $resultat qui s'y trouvent. 

   // debug($contact);

}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Détail contact</title>
</head>
<body>
   
   <?php 
   if (empty($contact)) {
      echo '<p>Contact inexistant...</p>';
   } else {
      echo '<div><img src="'. $contact['photo'] .'"></div>';
      echo '<h1>'. $contact['prenom'] . ' ' . $contact['nom'] .'</h1>';
      echo '<h2>Téléphone : '. $contact['telephone'] .'</H2>';
      echo '<h2>Email : '. $contact['email'] .'</H2>';
      echo '<div>Type de cointact : '. $contact['type_contact'] .'</div>';

   }


   
   ?>



</body>
</html>











