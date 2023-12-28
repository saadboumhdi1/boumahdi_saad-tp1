<!DOCTYPE html>
<html>
<head> 
<title>Validation de mon mot de passe </title>
    <style>
        .message-bleu {
            color: blue;
        }

        .message-rouge {
            color: red;
        }
    </style>
</head>
<body>

<form method="POST" action="">
    <!-- Champ de saisie du mot de passe -->
    <label for="mot_de_passe">Entrez votre mot de passe :</label>
    <input type="password" id="mot_de_passe" name="mot_de_passe">
    <input type="submit" value="Valider">
</form>

<?php
    // Fonction pour valider le mot de passe
    function validerMotDePasse($motDePasse) {
        // Vérifier la longueur du mot de passe
        if (strlen($motDePasse) < 6 || strlen($motDePasse) > 10) {
            return "<p class='message-rouge'>Erreur : Le mot de passe doit avoir entre 6 et 10 caractères.</p>";
        }

        // Définir le sel statique
        $salt = "julian@";

        // Concaténer le sel au mot de passe
        $motDePasseAvecSel = $motDePasse . $salt;

        // Chiffrer le mot de passe avec SHA-1
        $motDePasseChiffre = hash('sha1', $motDePasseAvecSel);

        // Mot de passe correct 
        $motDePasseCorrect = "saadboum";

        // Comparer le mot de passe entré avec le mot de passe correct
        if ($motDePasseChiffre === hash('sha1', $motDePasseCorrect . $salt)) {
            return "<p class='message-bleu'>Mot de passe correct! Salt: $salt, Mot de passe chiffré: $motDePasseChiffre</p>";
        } else {
            return "<p class='message-rouge'>Mot de passe incorrect! Réessayez!</p>";
        }
    }

    // Vérification lorsque le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $motDePasseUtilisateur = $_POST["mot_de_passe"];
        $resultat = validerMotDePasse($motDePasseUtilisateur);
        echo $resultat;
    }
?>
</body>
</html>
