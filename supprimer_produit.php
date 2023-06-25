<?php
$host = 'localhost';
$dbName = 'mes_produits';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $idProduit = $_GET['id'];

    // Récupérer les informations du produit à supprimer
    $selectProduit = "SELECT * FROM `information produit` WHERE id = :id";
    $statementProduit = $pdo->prepare($selectProduit);
    $statementProduit->bindParam(':id', $idProduit);
    $statementProduit->execute();
    $produit = $statementProduit->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        die("Le produit spécifié n'existe pas.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Supprimer le produit de la base de données
        $deleteProduit = "DELETE FROM `information produit` WHERE id = :id";
        $statementDelete = $pdo->prepare($deleteProduit);
        $statementDelete->bindParam(':id', $idProduit);

        try {
            $statementDelete->execute();
            echo "Produit supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du produit : " . $e->getMessage();
        }
    }
} else {
    die("Aucun ID de produit spécifié.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un produit</title>
</head>
<body>
    <h1>Supprimer un produit</h1>

    <p>Voulez-vous vraiment supprimer le produit suivant :</p>
    <p><strong>Nom du produit:</strong> <?php echo $produit['Nom du produit']; ?></p>
    <p><strong>Marque:</strong> <?php echo $produit['Marque']; ?></p>
    <p><strong>Code bar:</strong> <?php echo $produit['Code bar']; ?></p>
    <p><strong>Rayon:</strong> <?php echo $produit['Rayon']; ?></p>
    <p><strong>Stock restant:</strong> <?php echo $produit['Stock restant']; ?></p>

    <form method="POST" action="supprimer_produit.php?id=<?php echo $idProduit; ?>">
        <input type="submit" value="Supprimer">
    </form>

    <h2> Retour liste des produits :</h2>
<form method="POST" action="index.php">
<input type="submit" value="retour liste des produits">
</form>
</body>
</html>
