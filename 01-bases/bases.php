
<style>
    h2 {
        border-top: 1px solid navy;
        border-bottom: 1px solid navy;
        color: navy
    }
</style>


<?php 

//----------------------------------
echo '<h2> Les balises PHP </h2>';
//----------------------------------
?>

<?php
// pour ouvrir un passage en PHP on utilise la balise précédente (ligne 18)
// pour fermer un passage en PHP on utilise la balise suivante :
?>

<p>Ici je suis en HTML</p> 
<!-- en dehors des balises d'ouverture et de fermeture de PHP, nous pouvons écrire du HTML quand on est dans le fichier ayant l'extension PHP. -->

<?php
// Vous n'êtes pas obligé de fermer un passage PHP en fin de script

// Pour faire une ligne de commentaire
# Pour faire une ligne de commentaire

/* 
pour faire des commentaires 
sur plusieurs lignes
*/


//----------------------------------
echo '<h2> Affichage </h2>';
//----------------------------------

echo 'Bonjour <br>'; // echo permet d'effectuer un affichage dans le navigateur. Nous pouvons y mettre des balises HTML sous forme de string. Notez que toutes les instructions se terminent par un ";".

print 'Nous sommes Jeudi <br>'; // autre instruction d'affichage dans le navigateur.

// Autres instructions d'affichage que nous verrons plus lion :
print_r('code');
echo '<br>';
var_dump('code');


//----------------------------------
echo '<h2> Variable </h2>';
//----------------------------------
// Une variable est un espace mémoire qui porte un nom et qui permet de conserver une valeur. 
// En PHP on représente une variable avec le signe dollars $ 

$a = 127; // on déclare la variable a et lui affecte la valeur 127.
echo gettype($a); // gettype() est une fonction prédéfinie qui permet de voir le type d'une variable. Ici il s'agit d''un INTEGER (= entier).
echo'<br>';

$a = 1.5;
echo gettype($a); // ici nous avons un double = float (= nombre à virgule).
echo'<br>';

$a= 'une chaine de caractères';
echo gettype($a); // ici nous avons un STRING
echo'<br>';
$a= '127'; // un nombre écrit dans des quotes ou des guillemets est interprété comme un string.

$a = true; // ou false
echo gettype($a); // ici nous avons un booleen (=booléen)
echo'<br>';

// Par convention un nom de variable commence par une minuscule puis on met une majuscule à chaque mot (Camel Case). Il peut contenir des chiffres (jamais au début) ou _ (pas au début ni à la fin). Exemple : $maVariable1 ou $ma_variable1


//----------------------------------
echo '<h2> Guillemets et quotes </h2>';
//----------------------------------
$message = "aujourd'hui"; // ou bien : 
$message = 'aujourd\'hui'; // on échappe l'apostrophe dans les quotes simples


$prenom = 'John';
echo "Bonjour $prenom <br>"; // quand on écrit une variable dans des guillemets elle est évalué : c'est son contenu qsui est affiché. Ici "John".
echo 'Bonjour $prenom <br>'; // dans des quotes simples , tout est du texte brut : c'est le nom de la variable qui est affiché.


//----------------------------------
echo '<h2> Concaténation </h2>';
//----------------------------------
// En PHP on concatène les éléments avec le point.

$x = 'Bonojour ';
$y ='tout le mpnde';
echo $x . $y . '<br>'; // Concatènation de variable et d'un string. On peut traduire le point de concatènation par "suivi de ...". 

// ----------
// Concatènation lors de l'affectation avec l'opérateur .=
$message = '<p>Erreur sur le champ email</p>';
$message .= '<p>Erruer sur le champ téléphone</p>'; // avec l'opérateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur précédente dans la variable $message
echo $message; // on affiche donc les 2 messages.


// ----------------------------------
echo '<h2> Constante </h2>';
// ----------------------------------
// Une constante permet de conserver une valeur sauf que celle-ci ne peut pas changer. C'est à dire qu'on ne pourra pas la modifier durant l'exécution du script. Utile pour conserver par exemple les paramètres de connexion à la BDD.

define('CAPITAL_FRANCE', 'Paris'); // définit la constante appelée CAPITAL_FRANCE à laquelle on donne la valeur Paris. Par convention le nom des constantes est toujours en majuscules.
echo CAPITAL_FRANCE . '<br>'; // affiche Paris


// Autre façon de déclarer une constante :
const TAUX_CONVERSION = 6.55957; // définit la constante TAUX_CONVERSION
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957

// Quelques constantes magiques :
echo __DIR__ . '<br>'; // contient le chemin complet vers notre dossier
echo __FILE__ . '<br>'; // contient le chemin complet vers notre fichier

// ----------
// Exercice : afficher Bleu-Blanc-Rouge en mettant le texte de chaque couleur dans une variable.

$a = 'Bleu-';
$b = 'Blanc-';
$c = 'Rouge';
echo $a . $b . $c . '<br>';

$d = 'Bleu';
$e = 'Blanc';
$f = 'Rouge';
$g = '-';
echo $d . $g . $e . $g . $f . '<br>';

echo "$d-$e-$f <br>";


// -------------------------------------------
echo '<h2> Opérateurs arithmétiques </h2>';
// -------------------------------------------
$a = 10;
$b = 2;

echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 8
echo $a * $b . '<br>'; // affiche 20
echo $a / $b . '<br>'; // affiche 5
echo $a % $b . '<br>'; // modulo = reste de la division entière.Ici affiche = 0. Exemple : 3%2 = 1 car si on a 3 billes, on les répartit sur 2 joueurs, il nous en reste 1. 


// -----------
// Les opérateurs arithmétiques combinés :
$a += $b; // équivaut à $a = $a + $b, soit $a = 10 + 2. $a vaut donc à la fin 12
echo $a . '<br>'; // 12
$a -= $b;  // équivaut à $a = $a - $b, soit $a = 12 - 2. $a vaut donc à la fin 10
echo $a . '<br>'; // 10

$a *= $b;  // équivaut à $a = $a * $b, soit $a = 10 * 2. $a vaut donc à la fin 20
$a /= $b;  // équivaut à $a = $a / $b, soit $a = 20 / 2. $a vaut donc à la fin 10
$a %= $b;  // équivaut à $a = $a % $b, soit $a = 10 % 2. $a vaut donc à la fin 0

// On utilisera le += et le -= dans les paniers d'achat.

// ---------
// Incrémenter et décrémenter :
$i = 0;

$i++; // incrémentation de $i par ajout de 1 : $i vaut donc à la fin 1
$i--; // décrémentation de $i par soustraction de 1 : $i vaut donc à la fin 0 ici


// -------------------------------------------
echo '<h2> Structures conditionnelles </h2>';
// -------------------------------------------

$a = 10;
$b = 5;
$c =2;

// if ... else :
if ($a > $b)
{ // si la condition est vraie, c'est-à-dire que $a est bien supérieur à $b, alors on entre dans les accolades qui sui
    echo'$a est supérieur à $b <br>';
} else { // sinon, on exécute le else
    echo 'Non, c\'est $b qui supérieur ou égal à $a <br>';
}


// L'opérateur AND qui s'écrit && :
if ($a > $b && $b > $c) { // si $a est supérieur $b et dans le même temps $b est supérieur à $c alors on entre dans les accolades
    echo 'vrai pour les 2 conditions <br>';
} 

// TRUE && TRUE     => TRUE
// FALSE && FALSE   => FALSE
// TRUE && FALSE    => FALSE

//L'opératuer OR qui s'écrit || :
if ($a == 9 || $b > $c) { // si $a est égal (==) à 9 ou alors que £b est supérieur $c, dans ce cas on entre dans les accolades qui suivent
    echo 'Vrai pour au moins une des 2 conditions <br>';
} else {
    echo 'Les deux conditions sont fausses <br>';
}

// TRUE || TRUE     => TRUE
// FALSE || FALSE   => FALSE
// TRUE || FALSE    => TRUE

// --------
// if ... elseif ... else :

if ($a == 8) { // si $a est égal à 8 on entre dans les accolades qui suivent
    echo 'Réponse 1 : $a est égal à 8';
} elseif ($a != 10) { // sinon $a est différent de 10 on entre dans les accolades qui suivent
    echo 'Réponse 2 : $a est différent de 10';
} else { // si je n'entre pas dans le if ni dans le elseif, alors j 'arrive dans le else
    echo 'Réponse 3 : $a est égal à 10';
} 

// Note : le else n'est pas obligatoire (on ne le met pas quand on n'en a pas besoin). Else n'est jamais suivi d'une condition.

// --------
// l'opérateur XOR pour OU exclusif : 
$question1 = 'mineur';
$question2 = 'je vote'; // exemple d'un questionnaire

// Les réponses de l'internaute n'étant pas cohérente, on lui met un message :
if ($question1 == 'mineur' XOR $question2 == 'je vote') { // XOR = OU exclusif. Seulement une des deux conditions doit être valide pour entrer dans le if. Si nous avons  TRUE XOR TRUE cela est FALSE.
    echo 'Vos réponse sont cohérentes <br>';
} else {
    echo 'Vos réponse NE sont PAS cohérentes <br>';
}

// TRUE XOR TRUE   => FALSE
// FALSE XOR TRUE  => TRUE
// FALSE XOR FALSE => FALSE

// --------------
// µForme dite ternaire de la condition (  autre syntaxe du if) : 
$a =10;

echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';
// Le ? remplace if et le : remplace else. On affiche le premier string si la condition est vraie, sinon le second.


// ----------
// Comparaison == ou === :
$varA = 1; // integer et non number
$varB = '1'; // string

if ($varA == $varB) { // avec le double == on compare uniquement la valeur
    echo '$varA est égal à $varB en valeur <br>';
}

if ($varA === $varB) { // avec le === on compare la valeur et le type
    echo 'Les deux variables qont égales en valeur ET en type <br>';
} else {
    echo 'Les deux variables sont différentes en valeur OU en type <br>';
}

// Rappel : le simple = est le signe d'affectation.

// ------------
// isset() et empty() :
// empty() : vérifie si la variable est vide, c'est-à-dire 0, '', NULL, false, ou non définie
// isset() : vérifie si la variable existe et a une valeur non NULL.

$var1 = 0;
$var2 = '';

if (empty($var1)) echo '$var1 contient 0, string vide, NULL false ou n\'est pas définie <br>';  // VRAI car la variable contient 0

if (isset($var2)) echo 'La variable existe et est non NULL <br>'; // VRAI car la variable existe bien et ne contient pas NULL.

// Contexte d'utilisation : empty pour vérifier les champs de formulaire, isset pour vérifier l'existence d'un indice dans un tableau avant d'y accèder.


// ----------
// L'opérateur NOT qui s'écrit "!" : 
$var3 = 'quelque chose';
if (!empty($var3)) { // le ! correspond à une négation : in intervertit le sens booléen : !true devient false et !false devient true. Ici cela signifie "$var3 n'est pas vide". 
    echo 'La variable n\'est pas vide <br>';
}


// ------------
// L'opérateur ?? appelé "NULL coalescent" (PHP7): 

 echo $variable_inconnue ?? 'valeur par défaut <br>';


// -------------------------------------------
echo '<h2> Switch </h2>';
// -------------------------------------------
// La condition switch est une autre syntaxe pour écrire un if elseif else quand on veut comparer une vriable à une multitude de valeurs.

$langue = 'chinois';

switch ($langue) {
    case 'français' : // on compart $langue  à la valeur des "case" et exécute le code qui suit si elle correspond :
        echo 'Bonjour !';
    break; // obligatoire pour quitter le switch une fois un "case" exécuté    
    case 'italian' : 
        echo 'Buongiorno';
    break;
    case 'espagnol' :
        echo 'Hola !';
    break;
    default : // cas par défaut qui est exécuté si on n'entre pas dans l'un des "case"
        echo 'Hello !<br>';
    break;
}

// Exercice : vous réécrivez ce switch sous forme de conditions if... pour obtenir exactement le même résultat.

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol') {
    echo 'Hola !';
} else {
    echo 'Hello !<br>';
}


// -------------------------------------------
echo '<h2> Fonction utilisateur (vous en tant que de développeur) </h2>';
// -------------------------------------------
// Une fonction est un morceau de code encapsulé dans des accolades et qui porte un nom. On appelle cette fonction au besoin pour exécuter le code qui s'y trouve. Le fait de définir des fonctions pour ne pas répéter s'appelle "factoriser" son code.

// On définit puis on exécute une fonction : 
function separation() { // déclaration d'une fonction prévue pour ne pas recevoir d'arguments
    echo '<hr>';
}

separation(); // on appelle notre fonction par son nom suivi d'une paire de ().

// ----------
// Fonction avec paramètres et return :
function bonjour($prenom, $nom) { // $prenom et $nom sont des paramètres de la fonction. Ils permettent de recevoir une valeur car il s'agit de variables de réception.

    return 'Bonjour ' . $prenom . ' ' . $nom . ' ! <br>'; // return renvoie la chaine de caractères "Bonjour..." à l'endroit où la fonction est appelée

    echo 'Cette ligne ne sera pas exécutée'; // car après un return on quitte la fonction.
}

echo bonjour('John', 'Doe'); // si la fonction attend des valeurs, il faut les lui envoyer dans le même ordre que les pâramètres de réception. Les valeurs envoyées s'appellent "arguments". Quand on souhaite affficher le résultat, et qu'il n'y a pas de echo dans la fonction, il faut le faire en même temps que l'appel de la fonction.

//-----------(sous chapitre)
$prenom = 'Pierre';
$nom = 'Quiroule';
echo bonjour($prenom, $nom); // on peut mettre des variables à la place des valeurs dans l'appel d'une fonction (exemple : quand on voudra récupérer les valeurs d'un formulaire).


// ---------- (sous chapitre)
// Exercice :// - Ecrivez la fonction factureEssence() qui calcul le coût total de votre facture en fonction du nombre de litres d'essence que vous indiquez lors de l'appel de la fonction. Cette fonction retourne la phrase "Votre facture est de X euros pour Y litres d'essence." où X et Y  sont des variable.Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d'esseznce. Vous utilisez donc pour calculer le total de la facture/

function prixLitre() {
    return rand(100, 200)/100;
}


function factureEssence($nbreLitre) {
    echo 'Votre facture est de ' . $nbreLitre * prixLitre() . ' euros pour ' . $nbreLitre . ' litres d\'essence. <br>';
}

$nbreLitre = 40;

echo factureEssence($nbreLitre);

// ------------ ( sous chapitre )
// En PHP7 on peurt préciser le type des valeurs entrantes dans une fonction :
function identite(string $nom, int $age) { // array (tableau), bool (booléen), float (nbre à virgule), int (integer), string
    echo gettype($nom) . '<br>'; // string
    echo gettype($age) . '<br>'; // integer
    echo $nom . ' a ' . $age . ' ans <br>';

}

identite('Astérix', 60); // le type attendu dans la foncion est repecté, il n'y a pas d'erreur.
identite('Astérix', '60'); // ici l n'y a pas d'erreur, cependant le string '60' a été casté en integer (Note : si nous êtions en mode strict, il y aurait une erreur).
// identite('Astérix', 'soixante'); // fatal error car on passe un string qui ne peut être transformé en integer. On commente donc  la ligne pour poursuivre.

// passer du mode non-strict au mode strict : 
// declare(strict_types=1); // doit être en premier dans le fichier script pour passer au modae strict

// PHP7 on peut aussi préciser la valeur de retour que doit sortir la fonction : 
function adulte(int $age) : bool { // array (tableau), bool (booléen), float (nbre à virgule), int (integer), ou string
    if ($age >=18) {
        return true;
    } else {
        return false;
    }
}

var_dump(adulte(7)); // ici la fonction nous retourne bien un booléen, il n'y a  donc pas d'erruer. Nous faisons un var_dump() car il permet d'afficher le false que retourne la fonction, "echo false" n'affichant rien.

// ------ ( sous chapitre )
// Variable locale et variable globale : 

// De l'espace local vers l'espace global :
function jourSemaine() {
    $jour = 'vendredi'; // variable local
    return $jour;

}
// echo $jour; // ne fonctionne pâs car cette variable n'est connue qu'à l'intérieur de la fonction
echo '<br>' . jourSemaine() . '<br>'; // on affiche ce que nous retourne la fonction grâce à son return

// de l'espace global vers l'espace local :
$pays ='France'; // variable globale
function affichePays() {
    global $pays; // le mot clé global permet de récupérer une variable globale au sein de l'espace local de la fonction. On peut donc l'afficher :
    echo $pays;
}

affichePays();


// ------------------------------------------------------
echo '<h2> Structures itératives : les boucles </h2>';
// ------------------------------------------------------
// les boucles sont destinées à répéter des lignes de code de façon automatique.

// Boucle while : 
$i = 0; // on initialise à 0 une variable qui sert de compteur 

while ($i < 3) { // tant que $i est inférieur à 3 nous entrons dans la boucle
    echo $i . '<br>';
    $i++; // on incrémente $i à chaque tour de boucle afin de ne pas avoir une boucle infinie (à 3 la condition étant fausse, on quitte le boucle. 

}

// Exercice : à l'aide d'une boucle while, afficher un sélecteur avec les années depuis 1920 jusqu'à 2020
// rappel :
echo '<select>';
    echo '<option>Valeur 1</option>';
    echo '<option>Valeur 2</option>';
    echo '<option>Valeur 3</option>';
echo '</select>';


 echo '<select>';
$annee = 1920;
    while ($annee <= 2020) {
        echo '<option>' . $annee . '</option>';
        $annee++;
}
echo '</select>';

echo '<select>';
$annee = 2020;
    while ($annee >= 1920) {
        echo '<option>' . $annee . '</option>';
        $annee--;
}
echo '</select>';


// --------- ( sous chapitre )
// La boucle do while
// La boucle do while a la particularité de s'exécuté au moins une fois puis tant que la condition de fin est vraie.

$j = 0;

do {
    echo '<br> je fais 1 tour <br>';
    $j++;
} while ($j > 10); // la condition est false et pourtant la boucle a tourné 1 fois.

echo '<br>';

// -----------
// La boucle for : 
// La boucle for est une autre syntaxe de la boucle while.

for ($i = 0; $i < 3; $i++) { // Nous trouvons dans les parentyhèse de for : la valeur de départ; la condition d'entrée dans la boucle; la variation de $i
    echo $i . '<br>';
}

// Exercie : afficher les mois de 1 à 12 dans un sélecteur à l'aide d'une boucle for.

for ($mois = 1; $mois <= 12; $mois++) {
    echo $mois . '<br>';
}
    
echo '<select>';
    for ($i = 1; $i < 13; $i++) {
        echo '<option>' . $i .'</option>';
    }
echo '</select>';


// ------------ (sous chapitre)
// Il existe aussi la boucle foreach que nous verrons un peu plus loin. Elle sert à parcourir les tableuax ou les objets.

// ------------ 
// Exercice : faites une boucle for qui affiche les chiffre 0 à 9 dans une table HTML sur une seul ligne. Vous faites du CSS dans la balise <style> du début pour mettre une bordure sur ce tableu.

echo '<table style= "border-collapse: collapse">';
    echo '<tr>';
            for ($i = 0; $i <= 9; $i++) {
                echo '<td style = "border : 1px solid black">';
                    echo $i . ' ';
                echo '</td>';
            }
    echo '</tr>';         
echo'</table>';

// Exercice : faite une boucle qui affiche de 0 à 9 sur la même ligne, cette ligne se répétant 10 fois, le tout dans une table HTML.

// principe de la boucle imbriquée :
echo '<table style= "border-collapse: collapse">';
for ($j = 0; $j <= 9; $j++) {  // ici on fait les lignes
    echo '<tr>';
        for ($i = 0; $i <= 9; $i++) { // ici on fait les colonnes
            echo '<td style = "border : 1px solid black">';
                echo $i . ' ';
            echo '</td>';
        }
    echo '</tr>'; 
}          
echo'</table>';


// -------------------------------------------------
echo '<h2> Quelques fonctions prédéfinies </h2>';
// -------------------------------------------------
//Une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP.

// strlen
$phrase = 'mettez une phrase ici';
echo strlen($phrase) . '<br>'; // affiche  le nombre d'octets occupés par ce string, 1 caractère accentué comptant pour 2, les autres pour 1.

// substr (sous chaine)
$texte = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis accusamus rem fugit non esse odio placeat praesentium, veritatis itaque asperiores saepe mollitia, facilis, cupiditate neque quia pariatur laudantium deleniti quis!';

echo substr($texte, 0, 20). '...<a href="">lire la suite</a>'; // coupe le texte de la position 0 et sur 20 caractères.

echo '<br>';

// strtolower (mettre en minuscule), strtoupper (mettre en majuscule), et trim :
$message = '     Hello World !     ';
echo strtolower($message) . '<br>'; // affiche tout en minuscules
echo strtoupper($message) . '<br>'; // affiche tout en majuscules 

echo strlen($message) . '<br>'; // on compte la longueur y compris des espaces.
echo strlen(trim($message)) . '<br>'; // trim() supprime les espaces dans le comptage au début et à la fin de la chaîne de caractères. Puis ici on compte le résultat sans les espaces.

$message = trim($message); // supprime les espaces au début et à la fin.

// La documentation PHP en ligne : 
// https://www.php.net/


// ------------------------------------
echo '<h2> Tableaux (array) </h2>';
// ------------------------------------
// Un tableau ou encore arry en anglais est déclaré comme une variable amélioré dans laquelle on stock une multitude de valeurs. Ces valeurs peuvent être de n'importe quel type est possède un indice par défaut dont la numérotation commence à 0.

// Utilisation : souvent quand on récupère des informations de la BDD, nousd les retrouvons sous forme de tableau.

// Déclarer un tableau (méthode 1) :
$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'George');

echo gettype($liste) . '<br>'; // Type array

echo $liste; // erreur de type " Array to string conversion" car on ne peut pas afficher directement un tableau

echo 'var_dump et print_r :';
echo '<pre>';
    var_dump($liste); // affiche le contenu du tableau avec le type des valeurs
echo '</pre>';

echo '<pre>';
    print_r($liste); // affiche le contenu du tableau sans le type des valeurs
echo '</pre>'; // la balise <pre> permet de formater l'affichage du print_r ou du var_dump


// Déclaration de notre fonction d'affichage :
function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

debug($liste);


// Autre méthode pour déclarer un tableau (méthode 2) :
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];
debug ($tab);

echo $tab[1] . '<br>'; // pour afficher "Italie", on écrit le nom du tableau $tab suivi de l'indice de "Italie" écrit entre crochets []

//----------- (sous chapitre)
// Ajouter une valeur à la fin de notre tableau $tab
$tab[] = 'Suisse'; // les [] vides permettent d'ajouter une valeur à la fin du tableau
debug($tab);

// ------------ (sous chapitre)
// Tableau associatif :
// Dans un tableau associatif, on peut choisir les indices.
$couleur = array(
    'j' => 'jaune', 
    'b' => 'bleu',
    'v' => 'vert'
);

// pour afficher un élément du tableau associatif :
    echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // affiche "bleu"
echo "la seconde couleur est le $couleur[b] <br>"; // un tableau associatif écrit dan sdes guillemets perd les quotes autour de son indice

// -------------(sous chapitre)
// Mesurer le nombre d'élément dans un tableau :
echo 'Taille du tableau :' . count($couleur) . '<br>'; // compte le nombre d'élément dans le tableau, ici 3.
echo 'Taille du tableau :' . sizeof($couleur) . '<br>'; // sizeof() fait la même chose que count() dont il est un alias.


// --------------------------------- 
echo '<h2> Boucle foreach </h2>';
// --------------------------------- 
// foreach est un moyen simple de parcourir un tableau de façon automatique. Cette boucle fonctionne uniquement sur les tableaux et les objets. Elle retourne une erreur si vous l'utiliser sur une variable d'un autre type ou non initialisée.

debug($tab);

foreach($tab as $pays) { // la variable $pays vient parcourir la colonne des valeurs, elle prend chaque valeur successivement à chaque tour de boucle. Le mot "as" est obligatoire et fait partie de la syntaxe. 
    echo $pays . '<br>'; // affiche successivement les valeurs du tableau
}

foreach ($tab as $indice => $pays) { // quand il y a 2 variables, celle qui est à gauche de la flèche => parcourt la colonne des indices, et celle de droite parcourt la colonne des valeurs.
    echo $indice . ' correspond à ' . $pays . '<br>';
}

//-------------
// Exercice :
// - Ecrivez un tableau associatif avec les INDICES prenom, nom, email et telephone, auxquels vous associez des valeurs pour 1 contact.
// - Puis avec une boucles foreach, affichez les valeurs dans <p>, sauf le prénom qui doit être dans un <h3>. 

$renseignement = array(
    'prenom' => 'John', 
    'nom' => 'Doe',
    'email' => 'john.doe@gmail.com',
    'telephone' => '0601020304'
);


foreach ($renseignement as $indice => $donnee) {
    if ($indice == 'prenom') {
        echo '<h3> Bonjour ' . $donnee . ' !</h3><br>';
    } else {
         echo '<p> ' . $indice . ' ' . $donnee .' </p><br>';
    }
}


// ---------------------------------------------
echo '<h2> Tableau multidimensionnel </h2>';
// ---------------------------------------------
// Nous parlons de tableau multidimensionnels quand un tableau est contenu dans un auter tableau. Chaque tableau représente une dimension.

// Déclaration d'un tableau multidimensionnel : 
$tab_multi = array(
    array(
        'prenom' => 'Julien',
        'nom' => 'Dupon',
        'telephone' => '0612345678'
    ),
    array(
        'prenom' => 'Nicolas',
        'nom' => 'Duran',
        'telephone' => '0698765432'
    ),
    array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac'
    ),
);

// il est possible de choisir le nom des indices dans un tableau multidimensionnel.
debug($tab_multi);


// Afficher la valeur "Julien" :
echo $tab_multi[0]['prenom'] . '<hr>'; // pour afficher "Julien" nous entrons d'abord dans le tableau $tab_multi, puis nous allons à son indice [0], dans lequel nous allons à l'indice ['prenom'] (les crochets sont succrssifs). 

// Parcourir le tableau multidimensionnel avec une boucle for : 
for ($i = 0; $i < sizeof($tab_multi); $i++) { // tant que $i est inférieur au nombre d'éléments du tableau $tab_multi (ici 3), on entre dans la boucle
    echo $tab_multi[$i]['prenom'] . '<br>'; // on passe succrssivement par 0 puis 1 puis 2 pour afficher les 3 prénoms
}

echo '<hr>';

// ---------------
// Exercice : Afficher les 3 prénoms avec une boucle foreach.
foreach ($tab_multi as $indice => $donnee) {
        echo $tab_multi[$indice]['prenom'] . '<br>';
}
 echo '<hr>';

 // Autre version :
 foreach ($tab_multi as $contact) {
    // debug($contact); // on voit que $contact est un array qui contient l'indice prénom. On accède donc aux prénoms en mettant cet indice dans des [] :
    echo $contact['prenom'] . '<br>';
 }


//------------
// Exercice (option) : vous déclarez un tableau contenant les tailles S, M, L et XL. Puis vous les affichez dans un menu déroulant (select/option) à l'aide d'une boucle foreach.

$taille = ['S', 'M', 'L', 'XL'];
// debug($taille);
 echo '<select>';
foreach ($taille as $donnee) {
   
    echo '<option>' . $taille . '</option>';
   
}
 echo '</select>';

// ------------------------------------------
echo '<h2> Inclusions de fichiers </h2>';
// ------------------------------------------

echo 'Première inclusion : ';
include 'exemple.inc.php'; // le fichier est inclus. C'est-à-dire que son code s'exécute ici. En cas d'erreur lors de l'inclusion, include génère une erreur de type "warning" et continue l'exécution du script. 

echo '<br> Seconde inclusion : ';
include_once 'exemple.inc.php'; // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclut pas.

echo '<br> Troisième inclusion : ';
require 'exemple.inc.php'; // Le fichier est "requis", donc obligatoire : en cas d'erreur lors de l'inclusion, require génère une erreur de type "fatal error" qui stoppe l'exécution du code. 

echo '<br> Quatrième inclusion : <br>';
require_once 'exemple.inc.php'; // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclut pas.

echo '<br>' . $inclusion; // comme le fichier exempl.onc.php est inclus, on accède aux éléments qui sont déclarés à l'intérieur de celui-ci, comme les variables, les fonctions... 

// La mention "inc" dans le nom du fichier précise aux développeurs qu'il s'agit d'un fichier d'inclusion, et non pas d'une page à part entière.



// ------------------------------------------
echo '<h2> Introduction aux objets </h2>';
// ------------------------------------------
// Un objet est un autre type de données (bject en anglais). Il représente un objet réel (par exemple: voiture, membre, panier d'achet, produit...) auquel on peut associer des variables, appelées PROPRIETES, et de fonctions appelées METHODES. 

// Pour créer des objets, il nous faut un "plan de construction" : c'est le rôle de la classe. 
// Nous céons ici une classe pour faire des objets "meubles" : 
class Meuble { // avec une majuscule

   public $marque = 'ikea'; // $marque est une propriété. "public" précise qu'elle sera accessible partout. 

   public function prix() { // prix() est une méthode.
       return rand(50, 200) . ' € ';
   }


}

// -----------
$table = new Meuble(); // neest un mot clé qui permet d'instancier la classe pour en faire un objet. L'intérêt est que notre $table bénéficie de la propriété "ikea" et de la méthode prix() définis dans la classe.

debug($table); // nous observons le type "object", le nom de sa classe "Meuble" et sa propriété "marque". 

echo 'Marque du meuble : ' . $table->marque . '<br>'; // pour accéder à la propriété d'un objet, on écrit cet objet suivi de la flèche -> puis du nom de la propriété sans le $. 

echo 'Prix du meuble : ' . $table->prix() . '<br>'; // pour accéder à la méthode d'un objet, on l'écrit après la flèche -> à laquelle on ajoute une paire de ().

// ************************** FIN ****************************

