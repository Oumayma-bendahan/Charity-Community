<?php

// Vérification des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cardholder_name = test_input($_POST["cardholder-name"]);
  $card_number = test_input($_POST["card-number"]);
  $expiration_date = test_input($_POST["expiration-date"]);
  $security_code = test_input($_POST["security-code"]);
  $amount = test_input($_POST["amount"]);
  $currency = test_input($_POST["currency"]);

  // Vérification que tous les champs obligatoires ont été remplis
  if (empty($cardholder_name) || empty($card_number) || empty($expiration_date) || empty($security_code) || empty($amount) || empty($currency)) {
    $error_message = "Veuillez remplir tous les champs obligatoires.";
  }

    // Vérification du format des champs de saisie
if (!preg_match("/^[a-zA-Z ]*$/",$cardholder_name)) {
$error_message = "Le nom sur la carte n'est pas valide.";
}

if (!preg_match("/^[0-9]{16}$/",$card_number)) {
$error_message = "Le numéro de carte de crédit n'est pas valide.";
}

if (!preg_match("/^(0[1-9]|1[0-2])/?([0-9]{4}|[0-9]{2})$/",$expiration_date)) {
$error_message = "La date d'expiration n'est pas valide.";
}

if (!preg_match("/^[0-9]{3}$/",$security_code)) {
$error_message = "Le code de sécurité n'est pas valide.";
}

if (!is_numeric($amount) || $amount <= 0) {
$error_message = "Le montant total de la transaction n'est pas valide.";
}

// Vérification des options de paiement
$accepted_payment_methods = array("credit-card", "debit-card", "paypal", "apple-pay");
if (!in_array($_POST["payment_method"], $accepted_payment_methods)) {
$error_message = "La méthode de paiement choisie n'est pas valide.";
}

// Vérification que le formulaire a été soumis depuis votre site web
if (strpos($_SERVER['HTTP_REFERER'], 'votre-site-web.com') === false) {
$error_message = "Le formulaire a été soumis depuis une source non autorisée.";
}

// Si une erreur est survenue, afficher un message d'erreur
if (isset($error_message)) {
echo "<div class='error'>$error_message</div>";
} else {
// Si tout est OK, procéder au traitement de la transaction
// Code de traitement de la transaction avec un service de paiement tiers
// Afficher un message de confirmation
echo "<div class='success'>La transaction a été effectuée avec succès.</div>";
}
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

?>