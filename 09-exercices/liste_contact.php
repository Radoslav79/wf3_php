<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

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
// debug($ligne_contact);
$contenu = '';
$photo_bdd = '';

$resultat = $pdo->query("SELECT * FROM contact");

$contenu .= '<table class="table">';

	$contenu .= '<tr>';
		$contenu .= '<th>id_contact</th>';
		$contenu .= '<th>Nom</th>';
		$contenu .= '<th>Prénom</th>';
		$contenu .= '<th>Téléphone</th>';
		$contenu .= '<th>email</th>';
		$contenu .= '<th>Type de contact</th>';
		$contenu .= '<th>Photo</th>';
		$contenu .= '<th>Voir</th>';
	$contenu .= '</tr>';



while ($ligne_contact = $resultat->fetch(PDO::FETCH_ASSOC)) {
	// debug($ligne_contact);
	$contenu .= '<tr>';
		foreach ($ligne_contact as $indice=>$info) {
			if ($indice == 'photo') { 
			$contenu .= '<td>';
			$contenu .= '<img src="'. $ligne_contact['photo'].'" style= "width: 80px">';
			$contenu .= '</td>';
			} else {
			$contenu .= '<td>' . $info . '</td>';
			}
			
			}
			$contenu .= '<td>';
			$contenu .= '<a href="detail_contact.php?id_contact='. $ligne_contact['id_contact'] .'">détail</a>'; // on envoie à la page detail_contact.php l'identifiant du contact "id_contact". Sa valeur se trouve dans le tableau $ligne_contact qui contient un indice "id_contact" d'après le debug fait ci-dessus en ligne 44.

			$contenu .= '</td>';
		}
	$contenu .= '</tr>';
	


$contenu .= '</table>';


echo $contenu;


?>

<style>
    table, th, tr, td {
        border: 1px solid;
    }
    table {
        border-collapse: collapse;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>





















