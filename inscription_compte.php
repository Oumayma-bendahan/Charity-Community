<?php
  // Vérifier si l'utilisateur a soumis le formulaire d'inscription
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $competences = $_POST['competences'];
    $disponibilites = $_POST['disponibilites'];

    // Vérifier que les champs obligatoires sont remplis
    if (empty($nom) || empty($prenom) || empty($email) || empty($adresse) || empty($ville) || empty($code_postal) || empty($pays) || empty($telephone) || empty($competences) || empty($disponibilites)) {
      echo "<p>Tous les champs sont obligatoires</p>";
      exit();
    }

    // Vérifier que l'adresse email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<p>L'adresse email n'est pas valide</p>";
      exit();
    }

    // Connexion à la base de données
    $connexion = mysqli_connect("localhost", "utilisateur", "motdepasse", "benevoles");

    // Vérifier si l'adresse email est déjà utilisée
    $requete = "SELECT * FROM benevoles WHERE email='$email'";
    $resultat = mysqli_query($connexion, $requete);
    if (mysqli_num_rows($resultat) > 0) {
      echo "<p>Cette adresse email est déjà utilisée</p>";
      exit();
    }

    // Enregistrer les données du bénévole dans la base de données
    $requete = "INSERT INTO benevoles (nom, prenom, email, adresse, ville, code_postal, pays, telephone, competences, disponibilites) VALUES ('$nom', '$prenom', '$email', '$adresse', '$ville', '$code_postal', '$pays', '$telephone', '$competences', '$disponibilites')";
    if (mysqli_query($connexion, $requete)) {
      echo "<p>Votre inscription a été enregistrée avec succès</p>";
    } else {
      echo "<p>Une erreurest survenue lors de l'enregistrement de votre inscription</p>";
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
  }
?>
