<?php

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


$contenu = '';
$photo_bdd = '';



while ($immobilier = $resultat->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<tr>;';
        foreach ($immobilier as $indice=>$valeur) {
            if ($indice == 'photo') { 
                $contenu .= '<td>';
                $contenu .= '<img src="'. $immobilier['photo'].'" style= "width: 80px">';
                $contenu .= '</td>';
                } else {
                $contenu .= '<td>' . $valeur . '</td>';
                }
        } // fin de la foreach
    $contenu .= '</tr>';

} //fin de while

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