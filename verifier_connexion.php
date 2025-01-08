<?php
// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'connexion'; // Nom de la base de données
$username = 'root'; // Utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Création de la connexion PDO
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['matricule'], $_POST['mot_de_passe'])) {
        $matricule = $_POST['matricule'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // Requête pour vérifier les informations de connexion
        $sql = "SELECT * FROM etudiants WHERE matricule = :matricule AND mot_de_passe = :mot_de_passe";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['matricule' => $matricule, 'mot_de_passe' => $mot_de_passe]);
        $user = $stmt->fetch();

        if ($user) {
            // Connexion réussie
            echo "<p>Connexion réussie ! Bienvenue, " . htmlspecialchars($user['nom_famille']) . ".</p>";
        } else {
            // Identifiants incorrects
            echo "<p>Identifiants incorrects. Veuillez vérifier votre matricule et mot de passe.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
