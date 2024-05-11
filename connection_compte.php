    <?php  

      // Vérifier si l'utilisateur a soumis le formulaire de connexion
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];

        // Vérifier si l'utilisateur est déjà enregistré dans la base de données
        $connexion = mysqli_connect("localhost", "utilisateur", "motdepasse", "donateurs");
        $requete = "SELECT * FROM utilisateurs WHERE email='$email' AND motdepasse='$motdepasse'";
        $resultat = mysqli_query($connexion, $requete);
        if (mysqli_num_rows($resultat) == 1) {
          // L'utilisateur est connecté, rediriger vers la page d'accueil
          header("Location: accueil.php");
          exit();
        } else {
          // Afficher un message d'erreur si les informations de connexion sont incorrectes
          echo "<p>Nom d'utilisateur ou mot de passe incorrect</p>";
}
      }

    ?>
