<?php 
  // Vérifier si l'utilisateur a soumis le formulaire de postulation
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $mission = $_POST['mission'];
    $disponibilites = $_POST['disponibilites'];
    $competences = $_POST['competences'];

    // Vérifier que les champs obligatoires sont remplis
    if (empty($mission) || empty($disponibilites) || empty($competences)) {
      echo "<p>Tous les champs sont obligatoires</p>";
      exit();
    }

    // Connexion à la base de données
    $connexion = mysqli_connect("localhost", "utilisateur", "motdepasse", "postulants");

    // Enregistrer les données de postulation dans la base de données
    $requete = "INSERT INTO postulants (mission, disponibilites, competences) VALUES ('$mission', '$disponibilites', '$competences')";
    if (mysqli_query($connexion, $requete)) {
      echo "<p>Votre postulation a été enregistrée avec succès</p>";
    } else {
      echo "<p>Une erreur est survenue lors de l'enregistrement de votre postulation</p>";
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
  }
?>
