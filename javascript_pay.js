// Récupération des éléments du formulaire
const form = document.querySelector('#payment-form');
const cardholderNameInput = document.querySelector('#cardholder-name');
const cardNumberInput = document.querySelector('#card-number');
const expirationDateInput = document.querySelector('#expiration-date');
const securityCodeInput = document.querySelector('#security-code');
const amountInput = document.querySelector('#amount');
const paymentMethodInput = document.querySelector('#payment-method');

// Ajout d'un écouteur d'événement sur le formulaire
form.addEventListener('submit', (event) => {
  // Empêche l'envoi du formulaire par défaut
  event.preventDefault();

  // Validation des champs de saisie
  let isValid = true;

  if (cardholderNameInput.value.trim() === '') {
    isValid = false;
    setErrorFor(cardholderNameInput, 'Veuillez entrer le nom sur la carte.');
  } else {
    setSuccessFor(cardholderNameInput);
  }

  if (cardNumberInput.value.trim() === '') {
    isValid = false;
    setErrorFor(cardNumberInput, 'Veuillez entrer le numéro de carte de crédit.');
  } else if (!isValidCardNumber(cardNumberInput.value.trim())) {
    isValid = false;
    setErrorFor(cardNumberInput, 'Le numéro de carte de crédit n\'est pas valide.');
  } else {
   setSuccessFor(cardNumberInput);
  }

  if (expirationDateInput.value.trim() === '') {
    isValid = false;
    setErrorFor(expirationDateInput, 'Veuillez entrer la date d\'expiration.');
  } else if (!isValidExpirationDate(expirationDateInput.value.trim())) {
    isValid = false;
    setErrorFor(expirationDateInput, 'La date d\'expiration n\'est pas valide.');
  } else {
    setSuccessFor(expirationDateInput);
  }

  if (securityCodeInput.value.trim() === '') {
    isValid = false;
    setErrorFor(securityCodeInput, 'Veuillez entrer le code de sécurité.');
  } else if (!isValidSecurityCode(securityCodeInput.value.trim())) {
    isValid = false;
    setErrorFor(securityCodeInput, 'Le code de sécurité n\'est pas valide.');
  } else {
    setSuccessFor(securityCodeInput);
  }

  if (amountInput.value.trim() === '' || isNaN(amountInput.value.trim()) || Number(amountInput.value.trim()) <= 0) {
    isValid = false;
    setErrorFor(amountInput, 'Veuillez entrer un montant valide.');
  } else {
    setSuccessFor(amountInput);
  }

  if (paymentMethodInput.value === '') {
    isValid = false;
    setErrorFor(paymentMethodInput, 'Veuillez sélectionner une méthode de paiement.');
  } else {
    setSuccessFor(paymentMethodInput);
 isValid = true;
  }

  // Si tous les champs sont valides, soumettre le formulaire
  if (isValid) {
    form.submit();
  }
});

// Fonction pour afficher un message d'erreur
function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const errorMessage = formControl.querySelector('.error-message');

  // Ajout de la classe d'erreur
  formControl.className = 'form-control error';

  // Affichage du message d'erreur
  errorMessage.innerText = message;
}

// Fonction pour afficher un message de succès
function setSuccessFor(input) {
  const formControl = input.parentElement;

  // Ajout de la classe de succès
  formControl.className = 'form-control success';
}

// Fonction pour valider le numéro de carte de crédit
function isValidCardNumber(cardNumber) {
  // Algorithme de Luhn
  let sum = 0;
  let numDigits = cardNumber.length;
  let parity = numDigits % 2;

  for (let i = 0; i < numDigits; i++) {
    let digit = parseInt(cardNumber.charAt(i));

    if (i % 2 === parity) {
      digit *= 2;

      if (digit > 9) {
        digit -= 9;
      }
    }

    sum += digit;
  }

  return sum % 10 === 0;
}

// Fonctionpour valider la date d'expiration
function isValidExpirationDate(expirationDate) {
  // Vérifie que la date est au format mm/aa
  if (!/^\d{2}\/\d{2}$/.test(expirationDate)) {
    return false;
  }

  // Récupère le mois et l'année de la date d'expiration
  const [month, year] = expirationDate.split('/');

  // Vérifie que l'année est supérieure ou égale à l'année en cours
  const currentYear = new Date().getFullYear();
  if (Number('20' + year) < currentYear) {
    return false;
  }

  // Vérifie que le mois est compris entre 1 et 12
  if (Number(month) < 1 || Number(month) > 12) {
    return false;
  }

  // Vérifie que la date d'expiration n'est pas déjà passée
  const expirationDateObj = new Date(Number('20' + year), Number(month) - 1, 1);
  expirationDateObj.setMonth(expirationDateObj.getMonth() + 1);
  expirationDateObj.setDate(expirationDateObj.getDate() - 1);
  const currentDate = new Date();
  if (expirationDateObj < currentDate) {
    return false;
  }

  return true;
}

// Fonction pour valider le codede sécurité (CVV)
function isValidSecurityCode(securityCode) {
  // Vérifie que le code de sécurité est composé de 3 ou 4 chiffres
  if (!/^\d{3,4}$/.test(securityCode)) {
    return false;
  }

  return true;
}