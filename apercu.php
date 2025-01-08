<?php
// Récupérer le matricule et le mot de passe passés par la méthode GET
$matricule = $_GET['matricule'] ?? 'Non disponible';
$mot_de_passe = $_GET['mot_de_passe'] ?? 'Non disponible';
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aperçu de vos identifiants</title>
  </head>
  <body>
    <h2>Aperçu de vos identifiants</h2>
    <p><strong>Matricule :</strong> <?php echo htmlspecialchars($matricule); ?></p>
    <p><strong>Mot de passe :</strong> <?php echo htmlspecialchars($mot_de_passe); ?></p>
  </body>
</html>
