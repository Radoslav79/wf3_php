<?php
require_once 'inc/init.php';
// -------------------------------TRAITEMENT------------------------------
$message = ''; // pour afficher le message de déconnexion

// 2- Déconnexion de l'internaute : 
// debug($_GET);

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si le membre a cliqué "déconnexion"
    // debug($_SESSION);
    unset($_SESSION['membre']); // on ne fait pas un session_destry() qui supprimerait toute la session car on veut pouvoir conserver le panier de l'internaute.
    $message = '<div class="alert alert-info">Vous êtes déconnecté.</div>';
}

// 3- Le membre déjà connecté est redirigé vers son profil :
if (estConnecte()) {
    header('location:profil.php'); // nous affichons le formulaire de connexion qu'aux membre non connectés. Les autres sont redirigés vers le profil.
    exist(); // pour quitter le script
}








// 1- Traitement du formulaire
// debug($_POST);

if (!empty($_POST)) { // si le formulaire a été envoyé

    // controle du formulaire
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) { // si le champs pseudo ou le champ mdp sonht vide ou nom définis
        $contenu .= '<div class="alert alert-danger">Les identifiants sont obligatoires</div>';
    }

    // S'il n'y a pas de message d'erreur à l'internaute, on cherche le pseudo en BDD :
    if (empty($contenu)) {
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

        if ($resultat->rowCount() == 1) { // s'il y a une ligne resultat alors le pseudo exist. On peut vérifier le mdp
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetche" l'objet $resultat pour en extraire les données du membre (pas de boucle car le pseudo est unique)
            debug($membre);

            // on vérifie le mdp
            if (password_verify($_POST['mdp'], $membre['mdp'])) { // si le mdp du formulaire correspond au hash du mdp en BDD alors cette fonction retourne true
               // On conecte le membre
                $_SESSION['membre'] = $membre; // nous remplissons la session (ouverte avec le session_start() dans init.php) avec les infos du membre qui proviennent de la BDD

                // Puis on redirige vers la page de profil :
                header('location:profil.php');
                exit(); // et on quitte le script





                
            } else { // sinon c'est que les mdp ne correspondent pas
                $contenu .= '<div class="alert alert-danger">Erreur sur le mot de passe</div>';

            }

        } else { // S'il n'y a pas de ligne de résultat, c'est que le pseudo n'existe pas en BDD
            $contenu .= '<div class="alert alert-danger">Erreur sur le pseudo</div>';
        }




    } // fin du if (empty($contenu))






} // fin du if (!empty($_POST))















// ----------------------------AFFICHAGE---------------------------------
require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>
<?php
echo $message; // pour le message de déconnexion
echo $contenu; // pour les messages de connexion
?>
<form action="" method="post">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="text" name="mdp" id="mdp"></div>
    
    <div>
    <input type="submit" value="se connecter" class="btn btn-info"> 
    </div>

</form>

<?php
require_once 'inc/footer.php';
























