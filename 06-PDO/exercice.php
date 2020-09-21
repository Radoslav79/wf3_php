<h1>Les commerciaux et leur salaire</h1>

<?php
// Exercice :
// 1- Affichez dans une liste <ul><li> le prénom, le nom et le salaire des commerciaux ( 1 commercial par <li>). Pour cela, vous faites une requête préparée.
// 2- Affichez le nombre de commerciaux.

// 1- Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de lla BDD (host), nom de la BDD (dbname) à changer
                'root', // pseudo de la BDD
                '', // mdp de la BDD
                array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // option 1 : on affiche les erreurs SQL
                PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
                )
);
function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// Requête
$service = 'commercial';

$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service");

$resultat->bindParam(':service', $service);

$resultat->execute();
  
debug($resultat);

echo '<hr>';


echo '<ul>';
while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $employe['prenom'] . ' ' . $employe['nom'] . ' ' . $employe['salaire'] . ' €</li>';
}
echo '</ul>';

echo '<hr>';

// Nombre de commerciaux :
echo "Nombre d'employes au service commercial : " . $resultat->rowCount() . '<br>';








