<?php


// Se connecter a la base de donnees MySQL
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$dbname = "nom_de_la_base_de_donnees";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifier la connexion
if (!$conn) {
  die("Connexion echouee : " . mysqli_connect_error());
}

// Recuperer les donnees soumises par l'utilisateur
$id_don = $_POST['ID_DON'];
$type_don = $_POST['type_don'];
$montant = $_POST['montant'];
$date = $_POST['date'];
$mode_paiement = $_POST['mode_paiement'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$pays = $_POST['pays'];

// Verifier que tous les champs sont remplis
if (empty($id_don) || empty($type_don) || empty($montant) || empty($date) || empty($mode_paiement) || empty($nom_donateur) || empty($email_donateur) || empty($adresse) || empty($ville) || empty($code_postal) || empty($pays) || empty($association)) {
    die("Tous les champs sont obligatoires.");
  }

// Preparer la requete SQL pour inserer les donnees de don dans la base de donnees
$sql = "INSERT INTO dons (ID_DON, type_don, montant, date, mode_paiement, nom, email, adresse, ville, code_postal, pays)
VALUES ( '$type_don', '$montant', '$date', '$mode_paiement', '$nom', '$email', '$adresse', '$ville', '$code_postal', '$pays',$association)";

// Executer la requete SQL
if (mysqli_query($conn, $sql)) {
  echo "Don enregistre avec succès dans la base de donnees.";
} else {
  echo "Erreur lors de l'enregistrement du don dans la base de donnees : " . mysqli_error($conn);
}

// Verifier que le montant est un nombre
if (!is_numeric($montant)) {
    die("Le montant doit être un nombre.");
  }

// Inserer les donnees dans la base de donnees
$sql = "INSERT INTO donations (id_don, type_don, montant, date, mode_paiement, nom_donateur, email_donateur, adresse, ville, code_postal, pays, association) VALUES ('$id_don', '$type_don', '$montant', '$date', '$mode_paiement', '$nom_donateur', '$email_donateur', '$adresse', '$ville', '$code_postal', '$pays', '$association')";

if (mysqli_query($connexion, $sql)) {
  echo "Le don a ete enregistre avec succès.";
} else {
  echo "Une erreur est survenue lors de l'enregistrement dudon. Veuillez reessayer plus tard.";
}


// En-tetes pour l'email
$headers = 'From: contact@monassociationcaritative.com' . "\r\n" .
           'Reply-To: contact@monassociationcaritative.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Message pour l'email
$message = "Bonjour $nom,\r\n\r\n";
$message .= "Nous vous remercions pour votre don de $montant MAD a l'association caritative $association . Voici les informations que vous nous avez fournies :\r\n\r\n";
$message .= "Type de don : $type_don\r\n";
$message .= "Date du don : $date\r\n";
$message .= "Mode de paiement :$mode_paiement\r\n";
$message .= "Adresse : $adresse\r\n";
$message .= "Ville : $ville\r\n";
$message .= "Code postal : $code_postal\r\n";
$message .= "Pays : $pays\r\n\r\n";
$message .= "Association : $Association\r\n\r\n";
$message .= "Si vous avez des questions ou des commentaires, n'hesitez pas a nous contacter a l'adresse charity.community@gmail.com. Merci encore pour votre soutien !\r\n\r\n";
$message .= "Cordialement,\r\n";
$message .= "L'equipe de Charity Community";

// Envoyer l'email de confirmation
if(mail($email, "Confirmation de don a Mon Association Caritative", $message, $headers)) {
  echo "Email de confirmation envoye avec succes a $email.";
} else {
  echo "Erreur lors de l'envoi de l'email de confirmation a $email.";
}

// Fermer la connexion a la base de donnees
mysqli_close($conn);
?>