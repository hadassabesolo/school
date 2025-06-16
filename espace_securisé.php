<!-- les info remplit dans le formulaire d'accés a l'esppace parent son stocke ici -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
session_start();
include("connexion.php");
$parent=$_POST['parent'];
$enfant_noms=$_POST['nom_enfant'];
$classe=$_POST['classe'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$stmt = $connexion->prepare("SELECT * FROM securiteparent WHERE e_mail = ?");
// $stmt->bind_param("s", $email);
$stmt->execute([$email]);
$parent= $stmt->fetch(PDO::FETCH_ASSOC);

if ($parent) {

     if (password_verify($mot_de_passe, $parent['mot_de_passe'])) {

        // Connexion réussie : enregistrer les infos dans la session
        $_SESSION['parent_id'] = $parent['id'];
        $_SESSION['parent'] = $parent['parent'];
        $_SESSION['nom_enfant'] = $parent['nom_enfant'];
        $_SESSION['classe'] = $parent['classe'];
        $_SESSION['email'] = $parent['email'];

        // 🔸 on cre le fichier texte
        $fichier = fopen("compt.txt", "a"); // "a" = ajout à la fin
        $date_connexion = date("d-m-y à  H:i:s");

        // on prend ces memes info  on le stocke dans une variable
        // $ligne ="<div class='moi'>"."parent :".$parent['parent']."<br>"."</div>".
        //             "Enfant : " . $parent['nom_enfant']."<br>"
        //             . "classe: " . $parent['classe'] ."email"."<br>".
        //          $parent['e_mail'] ." Date d'entrer dans le site " . $date_connexion . "<br>";

    
      
    // $ligne = '<div class="carte"> ??
    //                 <div class="compt">
    //                     <img src="toph/WhatsApp Image 2025-05-21 à 23.18.28_60f3bf57.jpg"
    //                     width="350" heith="450">
    //                  </div>
                     
    //                 <div class="info"><strong>Nom :</strong> ' . $parent['nom_enfant'] . '</div>
    //                 <div class="info"><strong>Nom :</strong> ' . $parent['parent'] . '</div>
    //                 <div class="info"><strong>classe :</strong> ' . $parent['classe'] . '</div>
    //                 <div class="info"><strong>Votre email :</strong> ' . $parent['e_mail']. '</div>
    //                 <div class="info"><strong>heure et date de votre entré:</strong> ' .$date_connexion. '</div>
    //                 <hr>
    //                 <button><a href="espace parent.html">espace parent
    //                 <span class="cloche">&#128276;</span>
    //                 </a></button>

    //         </div>'; 

    $ligne = '<div class="carte">
                    <div class="compt">
                        <img src="toph/WhatsApp Image 2025-05-21 à 23.18.28_60f3bf57.jpg"
                        width="350" heith="450">
                     </div>
                     
                     
                <div class="info">
                    <img src="toph/WhatsApp Image 2025-05-21 à 23.18.28_60f3bf57.jpg" width="80" heith="100">
                    <strong> Votre noms :</strong> ' . $parent['parent'] . 
                '</div>
                <div class="info"><strong>Votre email :</strong> ' . $parent['e_mail']. '</div> <hr>


                <div class="info">
                    <img src="toph/WhatsApp Image 2025-05-21 à 23.18.28_60f3bf57.jpg" width="80" heith="100">
                <strong>Votre enfant :</strong> ' . $parent['nom_enfant'] .
                '</div>
                <div class="info"><strong>Sa classe :</strong> ' . $parent['classe'] . '</div>
                <div class="info"><strong>Ecole:</strong> ' .'Collège Sainte trinite'. '</div>
                <div class="info"><strong> Années Scolaire:</strong> ' .'2024_2025'.'</div> <hr>


                <div class="info"><strong>heure et date de votre entré:</strong> ' .$date_connexion. '</div>
                    <button><a href="espace parent.html">espace parent
                    <span class="cloche">&#128276;</span>
                    </a></button>

            </div>';    




        //  on prend cette variable ont l'ajoute dans ce fichier
        fwrite($fichier, $ligne);
        fclose($fichier);

        // Redirection vers l’espace parents
        header("Location: espace parent.html");
            exit();
    } 

    else {
        echo "Mot de passe incorrect.";
    }

} 

else {
    echo "Identifiants non reconnus.";
}

?>


    
    
</body>
</html>