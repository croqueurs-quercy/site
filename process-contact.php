<?php
// Encodage UTF-8
header('Content-Type: text/plain; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Méthode non autorisée.";
    exit;
}

// Anti-spam honeypot
if (!empty($_POST['website'])) {
    exit(''); // ne rien faire si champ invisible rempli
}

// Récupération et nettoyage des champs
$name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

// Vérifications basiques
if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Veuillez remplir correctement tous les champs.";
    exit;
}

// Limitation de la taille pour éviter les abus
if (strlen($name) > 100 || strlen($message) > 2000) {
    echo "Votre message est trop long.";
    exit;
}

// Destinataire
$to = "contact@croqueurs-du-lot.fr";
$subject = "Nouveau message depuis le site";

// Corps du mail
$body = "Nom : $name\nEmail : $email\n\nMessage :\n$message";

// En-têtes sécurisés
$headers = "From: contact@croqueurs-du-lot.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoi du mail
if (mail($to, $subject, $body, $headers)) {
    echo "Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.";
} else {
    echo "Une erreur est survenue. Veuillez réessayer.";
}
?>
