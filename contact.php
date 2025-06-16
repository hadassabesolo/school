<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("connexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom= htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $num = htmlspecialchars($_POST["numero"]);
    $objet = htmlspecialchars($_POST["objets"]);
    $message = htmlspecialchars($_POST["message"]);
    $date = date("d-m-y H:i:s");

    $ligne = "Parent : $nom <hr> 
            Enfant : $prenom<hr>
            Classe : $num<hr>
            Objet : $objet <hr>
            Message : $message<hr>
            Date et heure d'envoi de votre message : $date\n";

    // a l'interieur de ce variable on a stocke le fichier txt conenant les info du formulaire parent
    $fichier = "contact.txt";

    // On ajoute le message à la fin du fichier
    file_put_contents($fichier, $ligne, FILE_APPEND);

    echo "<p>Merci, votre message a été enregistré.</p>";
} else {
    echo "<p>Erreur : méthode non autorisée.</p>";
}
?>
    
</body>
</html>