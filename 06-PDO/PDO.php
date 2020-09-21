<?php
// ------------------------------------
//                  PDO
// ------------------------------------
// L'extension PDO, pour PHP Data Object, définit une interface pour accéder à une base de données depuis PHP, et permet d'y exécuter des requêtes SQL.

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// -------------------------------------
echo '<h2> Connexion à la BDD </h2>';
// -------------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de lla BDD (host), nom de la BDD (dbname) à changer
                'root', // pseudo de la BDD
                '', // mdp de la BDD
                array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // option 1 : on affiche les erreurs SQL
                PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
                )
);
// $pdo est un objet qui provient de la classe prédéfinie PDO et qui représente la connxion de la base de données.


// ---------------------------------------
echo '<h2> Requêtes avec exec() </h2>';
// ---------------------------------------
// Nous insérons un employé :

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2020-08-26', 1500)"); 

/* 
    exec() est utilisé pour la formulation de requêtes ne retournant pas de résultat : INSERT, UPDATE, DELETE.

    Valeur de retour :
        Succès : renvoie le nombre de lignes affectées
        Echec : false
*/

echo "Nombre d'enregitrements affectés par l'INSERT : $resultat <br>";
echo "Dernier ID généré en BDD : " . $pdo->lastInsertId() . "<br>";

// --------------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test'");
echo "Nombre d'enregistrement affectés par le DELETE : $resultat <br>";



// -------------------------------------------------------------------------
echo '<h2> Requêtes avec query() et fetch() pour 1 seul résultat </h2>';
// -------------------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");

/* 
    Au contraire de l'exect(), query() est utilisé pour le formulation de requêtes qui retournent un ou plusieurs résultats : SELECT.

    Valeur de retour :
        Succès : query() retourne un OBJET qui provient de la classe PDOStatement
        Echec : false
*/

debug($resultat); // $resultat est le résultat de la requête de sélection sous forme inexploitable directement. En effet, nous ne voyons pas les informations de Daniel. Pour accéder à ces informations, il nous faut utiliser la méthode fetch() :

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // La méthode fetch() avec le paramètre PDO::FETCH_ASSOC retourne un tableau associatif exploitable dont les indices correspondent aux champs de la requête. Ce tableau contient les données de Daniel.
debug($employe);
echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';


// On peut aussi utiliser les méthodes suivantes : 
// 1
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(PDO::FETCH_NUM); // pour obtenir un tableau indexé nummériquement
debug($employe);
echo 'Je suis ' . $employe[1] . ' ' . $employe[2] . ' du service ' . $employe[4] . '<br>';

// 2
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(); // pour obtenir un mélange de tableau associatif et numérique
debug($employe);
echo 'Je suis ' . $employe[1] . ' ' . $employe[2] . ' du service ' . $employe[4] . '<br>';

// 3
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(PDO::FETCH_OBJ); // retourne un  objet avec le nom des champs comme propriétés publiques
debug($employe);
echo 'Je suis ' . $employe->prenom . ' ' . $employe->nom . ' du service ' . $employe->service . '<br>';

// Note : vous ne pouvz faire plusieurs fetch() sur le même résultat, ce pourquoi nous répétons la requête.

//----------
// Exercice : 
// Affichez le service de l'employé dont l'id_employes est 417.

$resultat = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $resultat->fetch(PDO::FETCH_OBJ);
debug($resultat);
echo "L'employé d'id_employes 417 fait partie du service " . $employe->service . '<br>';


// -------------------------------------------------------------------------
echo '<h2> Requâtes avec query() et fetch() pour plusieurs résultat </h2>';
// -------------------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

echo "Nombre d'employes : " . $resultat->rowCount() . '<br>'; // compte le nombre de lignes (d'employés) dans l'objet $resultat (exemple : nombre de produits dans une boutique).

// debug($resultat;

// Comme nous avons plusieurs lignes dans $resultat, nous devons faire une boucle pour les parcourir : 
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // fetch() va cercher l=a ligne "suivante" du jeu de résultats qu'il retrourne en tableau associatif. L aboucle while permet de faire avancé le curseur dans la table et s'arrête quand le curseur est à la fin des résultats (quand fetch retourne false).

    debug($employe); // $employe est tableau associatif qui contient les donné&es de 1 employé par tour de boucle.


        echo '<div>';
            echo '<div>' . $employe['prenom'] . '</div>';
            echo '<div>' . $employe['nom'] . '</div>';
            echo '<div>' . $employe['service'] . '</div>';
            echo '<div>' . $employe['salaire'] . ' €</div>';
        echo '</div><hr>';
}


// ----------------------------------------
echo '<h2> La méthode fetchAll() </h2>';
// ----------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC); // fetchAll() retourne toutes les lignes de $resultat dans un tableau multidimensionnel : on a un tableau associatif rangé à chaque indice numérique. Pour info, on peut aussi faire FETCH_NUM pour un sous tableau numérique, ou un fetchAll() sans paramètre pour un sous tableau numérique et associatif.

debug($donnees);
echo '<hr>';

// on parcourt le tableau $donnees avec unne boucle foreach pour en afficher le contenu :
foreach ($donnees as $indice => $employe) { // $employe est lui même un tableau. On accède donc à ses valeaurs par les indices entre []. 
    // debug($employe);
    echo '<div>';
            echo '<div>' . $employe['prenom'] . '</div>';
            echo '<div>' . $employe['nom'] . '</div>';
            echo '<div>' . $employe['service'] . '</div>';
            echo '<div>' . $employe['salaire'] . ' €</div>';
        echo '</div><hr>';
}



// ------------------------------
echo '<h2> Exercice </h2>';
// ------------------------------
// Affichez la liste des DIFFERENTS services dans une seule liste <ul> et avec un service par <li>. 

// version fetchAll()
$resultat = $pdo->query("SELECT DISTINCT service FROM employes"); 
// ou 
$resultat = $pdo->query("SELECT service FROM employes GROUP BY service");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

// debug($resultat);

echo '<ul>'; // on met le <ul> en dehors de la boucle pour ne pas le répéter dasn la boucle car on ne veut qu'une seul liste.
foreach ($donnees as $indice => $employe) {
    echo '<li>' . $employe['service'] . '</li>';
}
echo '</ul>';


// version while
$resultat = $pdo->query("SELECT DISTINCT service FROM employes"); // ne pas oublier de refaire la requête avant un nouveau fetch(), sinon on est déjà hors du jeu de résultat et donc il n'y a plus rien à récupérer. 
echo '<ul>';
while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $donnees['service'] . '</li>';
}
echo '</ul>';


// ------------------------------
echo '<h2> Table HTML </h2>';
// ------------------------------
// On veut afficher dynamiquement le jeu de résultat sous forme de table HTML.

$resultat = $pdo->query("SELECT * FROM employes"); // $resultat est un objet PDOStatement qui est retourné par la méthode query. Il contient le jeu de résultats qui représente tuos les employés.
debug($resultat);

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

<?php





echo '<table>';
    // Affichage de ligne d'entête :
    echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Prénom</th>';
        echo '<th>Nom</th>';
        echo '<th>Sexe</th>';
        echo '<th>Service</th>';
        echo '<th>Date embauche</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';

    // Affichage des lignes :
    while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // A chaque tour de boucle de while, fetch() va chercher la ligne suivante qui correspond à 1 emploé et retourne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir :
        echo '<tr>';
            foreach ($employe as $donnee) { // foreach parcourt les données de l'employé, et affiche en colonne (dans le '<td>')
                echo '<td>' . $donnee . '</td>';
            }
        echo '</tr>';
    }
echo '</table>';


// ---------------------------------------
echo '<h2> Requêtes préparées </h2>';
// --------------------------------------
// Les requêtes préparées sont précaunisées si vous exécutez plusieurs fois la même requête et ainsi éviter de répéter le cycle complet analyse / interprétation / exécution re&lisé par la SGBD ( gain de performance).
// Les requêtes réârée sont aussi utilisées pour assainir les données (se prémunir des injections SQL) => chapitre ultérieur.

$nom = 'Sennard';

// Une requête préparée se réalise en 3 étapes :
// 1- On prépare la requête
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // prepare() permet de préparer la requête mais ne l'exécute pas. :nom est un marqueur nominatif qui est vide et attend une valeur.

// 2- On lie le marqueur à sa valeur :
$resultat->bindParam(':nom', $nom); // bindParam() lie le marqueur :nom à la variable $nom.Remarque : cette méthode reçoit exclusivement une variable en second argument, on ne peut pas y mettre une valeur directement.

// Ou alors
$resultat->bindValue(':nom', 'Sennard'); // bindValue() lie le marqueur :nom à la valeur 'Sennard'. Contrairement à bindParam(), bindValue() reçoit au choix une valeur ou une variable.

// 3- On exécute la requête :
$resultat->execute(); // permet d'exécuter une requête préparée avec prépare()

debug($resultat);

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';

/*
    Valeurs de retour :
        prepare() retourne toujours un objet PODStatement.
        execute() :
            Succès : true
            Echec : false
*/


// --------------------------------------------------------------
echo '<h2> Requêtes préparées : points complémentaires </h2>';
// --------------------------------------------------------------

echo '<h3>Le marqueur sous forme d "?"</h3>';
$resultat = $pdo->prepare("SELECT * From employes WHERE nom = ? AND prenom = ?"); // On prépare la requête avec les parties variables représentées avec des marqueurs sous forme de "?"
$resultat->bindValue(1, 'Durand'); // 1 représente le premier "?"
$resultat->bindValue(2, 'Damien'); // 2 représente le deuxième "?"
$resultat->execute();

// OU encore directement ldans le execute() :
$resultat->execute(array('Durand', 'Damien')); // dans l'ordre, "Durand" remplace le premier "?" et "Damien" le second.

/*
    la flèche -> caractérise les objets  : $objet->méthode();
    les crochets [] caractérisent les tableaux : $tableau['indice'];
*/
debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'Le service est ' . $employe['service'] . '<br>';


// -----------------
echo '<h3>Lier les marqueurs nominatifs à leur valeur directement dans execute()</h3>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");

$resultat->execute(array(':nom' => 'Chevel', ':prenom' => 'Daniel')); // on associe chaque marqueur à sa valeur directement dans un tableau. Note : nous ne sommes pas obligés de remettre les ":" devant les marqueurs dans ce tableau.

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo 'Le service est ' . $employe['service'] . '<br>';




// **************************** FIN *********************************








