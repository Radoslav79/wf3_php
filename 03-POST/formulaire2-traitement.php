<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';



if (!empty($_POST)) {
    echo '<p>Ville : ' . $_POST['ville'] . '</p>';
    echo '<p>Code postal : ' . $_POST['code_postal'] . '</p>';
    echo '<p>Adresse : ' . $_POST['adresse'] . '</p>';

    // -----------------------------
    // Ecrire dans un fichier txt
    // -----------------------------
    // On va écrire les adresses des internautes dans un fichier texte créé dynamiquement sur le serveur (en labsence de BDD).

    $file = fopen('adresses.txt', 'a'); // fopen() en mode "a" créer le fichier s'il n'existe pas encore sinon l'ouvre.

    $adresse = $_POST['adresse'] . ' - ' . $_POST['code_postal'] . ' - ' . $_POST['ville'] . "\n"; // On concatène l'adresse de l'internaute avec un saut de ligne à la fin ("\n").

    fwrite($file, $adresse); // fwrite() écrit le contenu de la variable $adresse dans le fichier représsenté par $file.

    fclose($file); // puis on ferme le fichier pour libérer de la ressource.

} // fin de notre condition