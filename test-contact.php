<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Test Contact PHP</title>
</head>
<body>
<h2>Test envoi POST vers process-contact.php</h2>

<form id="test-form" method="post">
  <label for="name">Nom :</label>
  <input type="text" id="name" name="name" value="Jean Dupont"><br><br>

  <label for="email">Email :</label>
  <input type="email" id="email" name="email" value="jean@example.com"><br><br>

  <label for="message">Message :</label><br>
  <textarea id="message" name="message" rows="4" cols="50">Ceci est un test</textarea><br><br>

  <!-- Honeypot -->
  <input type="text" name="website" style="display:none">

  <button type="submit">Envoyer</button>
</form>

<h3>Réponse du script :</h3>
<pre id="response" style="background:#f0f0f0;padding:1rem;"></pre>

<script>
document.getElementById('test-form').addEventListener('submit', function(e){
  e.preventDefault();

  const formData = new FormData(this);
  const responseDiv = document.getElementById('response');

  fetch('process-contact.php', { method: 'POST', body: formData })
    .then(r => r.text())
    .then(text => responseDiv.textContent = text)
    .catch(err => responseDiv.textContent = 'Erreur : ' + err);
});
</script>

</body>
</html>
