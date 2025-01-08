<?php
// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'connexion';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['matricule'], $_POST['nom_famille'], $_POST['sexe'], $_POST['filiere'], $_POST['email'], $_POST['numero'])) {
        $matricule = $_POST['matricule'];
        $nom_famille = $_POST['nom_famille'];
        $sexe = $_POST['sexe'];
        $filiere = $_POST['filiere'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];

        // Validation des données
        if (empty($matricule) || empty($nom_famille) || empty($sexe) || empty($filiere) || empty($email) || empty($numero)) {
            die("Erreur : Données invalides.");
        }

        // Générer le mot de passe basé sur le matricule
        $mot_de_passe = $matricule . rand(1000, 9999);  // Exemple simple : concaténer le matricule et un nombre aléatoire

        // Préparer la requête SQL pour insérer les données dans la base
        try {
            $sql = "INSERT INTO etudiants (matricule, nom_famille, sexe, filiere, email, numero, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$matricule, $nom_famille, $sexe, $filiere, $email, $numero, $mot_de_passe]);

            // Si l'insertion réussit, rediriger vers la page Aperçu.php pour afficher les identifiants
            header("Location: apercu.php?matricule=" . urlencode($matricule) . "&mot_de_passe=" . urlencode($mot_de_passe));
            exit;

        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement des données : " . $e->getMessage();
        }
    } else {
        echo "Les données sont incomplètes.";
    }

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
