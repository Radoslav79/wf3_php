<?php
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 
'root', 
'', 
array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8'
)
);

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

debug($_POST);
$contenu = '';

foreach ($param as $indice => $valeur) {
    $param[$indice] = htmlspecialchars($valeur);
}

if (!empty($_POST)) {
    if (!isset($_POST['pseudo']) || strlen($_POST['titre']) < 4 || strlen($_POST['pseudo']) > 255) { 
        $contenu .= '<div class="alert alert-danger">Le titre doit contenir entre 4 et 255 caractères.</div>';
    }
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 255) { 
        $contenu .= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 255 caractères.</div>';
    }
    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 50) { 
        $contenu .= '<div class="alert alert-danger">La ville doit contenir entre 1 et 50 caractères.</div>';
    }
    if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
        $contenu .= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
    }
    if (!isset($_POST['surface']) || !preg_match('#^[0-9]{6}$#', $_POST['surface'])) {
        $contenu .= '<div class="alert alert-danger">La surface n\'est pas valide.</div>';
    }
    if (!isset($_POST['prix']) || !preg_match('#^[0-9]{8}$#', $_POST['prix'])) {
        $contenu .= '<div class="alert alert-danger">Le prix n\'est pas valide.</div>';
    }
    if(!isset($_POST['type']) || $_POST['type'] !='location' && $_POST['type'] != 'vente') {
        $contenu .= '<div class="alert alert-danger">Le type de l\'annonce doit être sélectionné.</div>';
    }
} // fin de if (!empty($_POST))

$req = $pdo->prepare("REPLACE INTO logement VALUES (:id_logement, :titre, :adresse, :ville, :code_postal, :surface, :prix, :photo, :type, :description)");

$succes = $req->execute(array(
    ':id_logement'  => $_POST['id_logement'],
    ':titre'        => $_POST['titre'],
    ':adresse'      => $_POST['adresse'],
    ':ville'        => $_POST['ville'],
    ':code_postal'  => $_POST['code_postal'],
    ':surface'      => $_POST['surface'],
    ':prix'         => $_POST['prix'],
    ':photo'        => $photo_bdd,
    ':type'         => $_POST['type'],
    ':description'  => $_POST['description'],
    ));


    if ($req) {
        $contenu .= '<div class="alert-success">Le logement a été enregistré.</div>';
    } else {
        $contenu .= '<div class="alert-danger">Erreur lors de l\'enregistrement.</div>';
    }


$contenu .= '<table class="logement">';

        $contenu .= '<tr>';
            $contenu .= '<th>titre</th>';
            $contenu .= '<th>adresse</th>';
            $contenu .= '<th>ville</th>';
            $contenu .= '<th>code postal</th>';
            $contenu .= '<th>surface</th>';
            $contenu .= '<th>prix</th>';
            $contenu .= '<th>photo</th>';
            $contenu .= '<th>type</th>';
            $contenu .= '<th>desription</th>';
        $contenu .= '</tr>';

$contenu .= '</table>';






?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Evaluation SQL PHP</title>
</head>
<body>

<h3>Evaluation SQL-PHP</h3>
<h1>Répertoire de logement</h1>

<form method="post" action="" enctype="multipart/form-data"></form>
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre"><?php  echo $_POST ['titre'] ?? '';?><br>

    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse"><?php  echo $_POST ['adresse'] ?? '';?><br>

    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville"><?php  echo $_POST ['ville'] ?? '';?><br>

    <label for="code_postal">Code postal</label>
    <input type="text" name="code_postal" id="code_postal"><?php  echo $_POST ['code_postal'] ?? '';?><br>

    <label for="surface">Surface en m²</label>
    <input type="text" name="surface" id="surface"><?php  echo $_POST ['surface'] ?? '';?><br>

    <label for="prix">Prix en €</label>
    <input type="text" name="prix" id="prix"><?php  echo $_POST ['prix'] ?? '';?><br>

    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo">

    <p>Type :</p>
    <select name="type" id="type">Type
        <option name="type" id="type" value=""></option>
        <option name="type" id="type" value="location" <?php if (isset($logement['type']) && $logement['type'] == 'location') echo 'selected'; ?>>Location</option>
        <option name="type" id="type" value="vente" <?php if (isset($logement['type']) && $logement['type'] == 'vente') echo 'selected'; ?>>Vente</option>
    </select><br>

    <br><input type="submit" name="enregistrement" id="enregistrement" value="enregistrement">





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>



