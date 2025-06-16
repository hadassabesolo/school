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

                    // Sécurisation des données
            // $enfant = htmlspecialchars($_POST['nom_enfant']);
            // $date = htmlspecialchars($_POST['date']);
            // $genre= htmlspecialchars($_POST['genre']);
            // $classe= htmlspecialchars($_POST['classe']);
            // $nationalite= htmlspecialchars($_POST['nationalite']);
            // $adresse = htmlspecialchars($_POST['adresse']);
            // $pere = htmlspecialchars($_POST['nom_pere']);
            // $mere= htmlspecialchars($_POST['nom_mere']);
            // $tuteur= htmlspecialchars($_POST['nom_tuteur']);
            
            // $postnom_pere= htmlspecialchars($_POST['postnom_pere']);
            // $postnom_mere= htmlspecialchars($_POST['postnom_mere']);
            // $postnom_tuteur= htmlspecialchars($_POST['postnom_tuteur']);
            
            // $prenom_pere= htmlspecialchars($_POST['prenom_pere']);
            // $prenom_mere= htmlspecialchars($_POST['prenom_mere']);
            // $prenom_tuteur= htmlspecialchars($_POST['prenom_tuteur']);
            
            // $prof_pere= htmlspecialchars($_POST['prof_pere']);
            // $prof_mere= htmlspecialchars($_POST['prof_mere']);
            // $prof_tuteur= htmlspecialchars($_POST['prof_tuteur']);
            
            // $num_pere= htmlspecialchars($_POST['num_pere']);
            // $num_mere= htmlspecialchars($_POST['num_mere']);
            // $num_tuteur = htmlspecialchars($_POST['num_tuteur']);
            
            // $adresse_pere= htmlspecialchars($_POST['adresse_pere']);
            // $adresse_mere= htmlspecialchars($_POST['adresse_mere']);
            // $adresse_tuteur= htmlspecialchars($_POST['adresse_tuteur']);
            
            

            // Vérification si l'utilisateur existe déjà
            // $requete_prep = $connexion->prepare("SELECT * FROM inscription WHERE tel_pere= ?"); ??
            // $check->bind_param("s", $num_pere);
            // $requete_prep->execute([$num_pere]);??
            // $result = $requete_prep->rowCount();

            // if ($requete_prep->rowCount()> 0) {??
            //     echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
            // } else {??
                // Insertion dans la base
                // $req_prep= $connexion->prepare("INSERT INTO inscription ( 'enfant', 'naissance', 'genre', 'classe', 'nationalite',
                // 'adresse', 'pere', 'mere', 'tuteur', 'postnom_pere', 'postnom_mere', 'postnom_tuteur', 'prenom_pere', 'prenom_mere', 
                //     'prenom_tuteur', 'profession_pere', 'profession_mere', 'profession_tuteur', 'tel_pere', 'tel_mere', 'tel_tuteur', 'adresse_pere', 'adresse_mere', 'adresse_tuteur') VALUES 
                //     (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                //  $req_prep->execute([ $enfant, $date, $genre, $classe, $nationalite, $adresse, $pere,
                // $mere, $tuteur, $postnom_pere, $postnom_mere, $postnom_tuteur, $prenom_pere,
                //  $prenom_mere,
                // $prenom_tuteur, $prof_pere, $prof_mere, $prof_tuteur, $num_pere, $num_mere, $num_tuteur,
                //  $adresse_pere, 
                // $adresse_mere, $adresse_tuteur]);

                // if ($req_prep->execute()) ??
                // {
                    // Redirection après succès
                    

                // $stmt->close();/
            

            // $conn->close();

            


            if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ecole", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération de toutes les données du formulaire
        $enfant = ($_POST['enfant']);
        $naissance = $_POST['naissance'];
        $genre = $_POST['genre'];
        $classe = $_POST['classe'];
        $nationalite = $_POST['nationalite'];
        $adresse = $_POST['adresse'];

        $nom_pere = $_POST['pere'];
        $nom_mere = $_POST['mere'];
        $nom_tuteur = $_POST['tuteur'];
         $postnom_pere = $_POST['postnom_pere'];
        $postnom_mere = $_POST['postnom_mere'];
        $postnom_tuteur = $_POST['postnom_tuteur'];

        $prenom_pere = $_POST['prenom_pere'];
        $prenom_mere = $_POST['prenom_mere'];
        $prenom_tuteur = $_POST['prenom_tuteur'];

        $profession_pere = $_POST['profession_pere'];
        $profession_mere = $_POST['profession_mere'];
        $profession_tuteur = $_POST['profession_tuteur'];

        $tel_pere = $_POST['tel_pere'];
        $tel_mere = $_POST['tel_mere'];
        $tel_tuteur = $_POST['tel_tuteur'];

        $adresse_pere = $_POST['adresse_pere'];
        $adresse_mere = $_POST['adresse_mere'];
        $adresse_tuteur = $_POST['adresse_tuteur'];


        // Vérification : est-ce que l'enfant est déjà inscrit ?
        $verif = $pdo->prepare("SELECT * FROM inscription WHERE nom_enfant = ?");
        $verif->execute([$enfant]);

        if ($verif->rowCount() > 0) {
            echo "❌ Vous êtes déjà inscrit(e). Impossible d'envoyer ce formulaire deux fois.";
        } else {
            // Insertion dans la base
            $stmt = $pdo->prepare("INSERT INTO inscription (
                nom_enfant, naissance, genre, classe, nationalite, adresse,
                pere, mere, tuteur,
                postnom_pere, postnom_mere, postnom_tuteur,
                prenom_pere, prenom_mere, prenom_tuteur,
                profession_pere, profession_mere, profession_tuteur,
                tel_pere, tel_mere, tel_tuteur,
                adresse_pere, adresse_mere, adresse_tuteur
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->execute([
                $enfant, $naissance, $genre, $classe, $nationalite, $adresse,
                $nom_pere, $nom_mere, $nom_tuteur,
                $postnom_pere, $postnom_mere, $postnom_tuteur,
                $prenom_pere, $prenom_mere, $prenom_tuteur,
                $profession_pere, $profession_mere, $profession_tuteur,
                $tel_pere, $tel_mere, $tel_tuteur,
                $adresse_pere, $adresse_mere, $adresse_tuteur
            ]);

            echo "✅ Inscription réussie ! Merci.";
        }

    } catch (PDOException $e) {
        echo "❌ Erreur : " . $e->getMessage();
}
}

            


































                
                
                
?>
                
</body>
</html>