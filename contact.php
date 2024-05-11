<!DOCTYPE html>
<html>
  <head>
    <title>Page de contact</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo/logo.png" type="png"> 
    <link rel="stylesheet" href="contact.css">
  </head>
  <body>
    <h1>Page de contact</h1>
    
    <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "yourusername";
    $password = "yourpassword";
    $dbname = "yourdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connexion échouée: " . mysqli_connect_error());
    }

    // Récupération des informations de contact depuis la base de données
    $sql = "SELECT * FROM associations";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Affichage des informations de contact pour chaque association
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='association'>";
            echo "<h2>" . $row["nom"] . "</h2>";
            echo "<p><strong>ID_CTC:</strong> " . $row["ID_CTC"] . "</p>";
            echo "<p><strong>Adresse:</strong> " . $row["adresse"] . "</p>";
            echo "<p><strong>Ville:</strong> " . $row["ville"] . "</p>";
            echo "<p><strong>Code postal:</strong> " . $row["code_postal"] . "</p>";
            echo "<p><strong>Pays:</strong> " . $row["pays"] . "</p>";
            echo "<p><strong>Téléphone:</strong> " . $row["telephone"] . "</p>";
            echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Heures d'ouverture:</strong> " . $row["heures_ouverture"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "Aucune association trouvée dans la base de données.";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
    ?>
    
  </body>
</html>