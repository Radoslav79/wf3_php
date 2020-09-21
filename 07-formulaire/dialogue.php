<?php
// -----------------------------------------------------------
// Cas pratique : formulaire pour poster des commentaires
//------------------------------------------------------------
// Objectif : protéger la requête SQL dont les données viennet de l'internaute.

/*
 Création de la BDD :

    Nom de la BDD : dialogue
    Nom de la table : commentaire
    Colonnes (champsz) : id_commentaire INT PK AI
                        pseudo VARCHAR(50)
                        message TEXT
                        date_enregistrement DATETIME
*/
// print_r($_POST);


// 2. Connexion à la BDD et traitement de $_POST :
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 
                'root', 
                '', 
                array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8'
                )
);

if (!empty($_POST)) { // si le formulaire a été envoyé

    // 5. Traitement contre les failles XSS (JavaScript) et les failles CSS : on parle d'échapoper les données.
    // Pour l'exemple on onjecte ce CSS : <style>body{display:none}</style>  
    
    // Pour s'en prémunir, nous faisons :
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES); // cette fonction prédéfinie convertit les caractères spéciaux (<, >, & et les "") en entité HTML(le chevron < devient &lt; le > devient &gt; les "" deviennent &quot; etc...). 


    // Nous insérons le message en BDD avec une requête qui n'est protégée contre les injections et qui n'accepte pas les apostrophes :
    // $resultat = $pdo->query("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')"); // ici on insère directement dans la requête des données qui viennent d'un formulaire sans avoir pris de précaution.

// 4. Nous ,fesons une injection SQL suivante '); DELETE FROM commentaire; #
// Cette injection a pour effet de VIDER la table. 

// Pour s'en prémunir, nous faisons la requête préparée suivante (en commentant la requête précédente) :
$resultat =$pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message)");

$resultat->execute(array(
    ':pseudo' => $_POST['pseudo'],
    ':message' => $_POST['message']
));

// Avec la requête préparée, on constate que l'injection SQL est neutralisée. Par ailleurs, on peut mettre des apostrophes dans le formulaire.
// Comment ça marche ? Le fait de mettre des marqueurs dans la requête évite que les instructions SQL d'origine et injectées se concatènent. Ces instructions ne s'exécutent donc plus ensemble. En liant les marqueurs vides à leur valeur dans execute(), les instructions SQL injectées sont neutralisées par cette méthode qui les rend inoffensives. La BDD ne les exécute donc pas.


} // fin du if (!empty($_POST))

// 1. Formulaire
?>
<h1>Votre message</h1>
<form method="post" action="">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? '';?>"></div>

    <div><label for="message">Message</label></div>
    <div><textarea name="message" id="message" cols="30" rows="10"><?php  echo $_POST ['message'] ?? '';?></textarea></div>

    <div><input type="submit"></div>

</form>


<?php
// 3. Affichage des commentaires
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%Hh%im%ss') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC"); // DATE_FORMAT() en SQL permet de reformater une date et l'heure.

echo '<h2>' .$resultat->rowCount() . ' commentaires </h2>';

while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)) {

    //print_r($commentaire); // on retrouve les alias de la requête sous forme d'indices dans le tableau $commentaire

    echo '<div>Par ' . $commentaire['pseudo'] . ' le ' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</div>';

    echo '<div>' . $commentaire['message'] . '</div><hr>';


}











