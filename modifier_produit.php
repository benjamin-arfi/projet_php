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

    // Récupérer les informations du produit à modifier
    $selectProduit = "SELECT * FROM `information produit` WHERE id = :id";
    $statementProduit = $pdo->prepare($selectProduit);
    $statementProduit->bindParam(':id', $idProduit);
    $statementProduit->execute();
    $produit = $statementProduit->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        die("Le produit spécifié n'existe pas.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles valeurs du formulaire
        $nomProduit = $_POST['nom_produit'];
        $marque = $_POST['marque'];
        $codeBar = $_POST['code_bar'];
        $rayon = $_POST['rayon'];
        $stockRestant = $_POST['stock_restant'];

        // Mettre à jour les informations du produit
        $updateProduit = "UPDATE `information produit` SET `Nom du produit` = :nomProduit, `Marque` = :marque, `Code bar` = :codeBar, `Rayon` = :rayon, `Stock restant` = :stockRestant WHERE id = :id";
        $statementUpdate = $pdo->prepare($updateProduit);
        $statementUpdate->bindParam(':nomProduit', $nomProduit);
        $statementUpdate->bindParam(':marque', $marque);
        $statementUpdate->bindParam(':codeBar', $codeBar);
        $statementUpdate->bindParam(':rayon', $rayon);
        $statementUpdate->bindParam(':stockRestant', $stockRestant);
        $statementUpdate->bindParam(':id', $idProduit);

        try {
            $statementUpdate->execute();
            echo "Produit mis à jour avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }
    }
} else {
    die("Aucun ID de produit spécifié.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un produit</title>
</head>
<body>
    <h1>Modifier un produit</h1>

    <form method="POST" action="modifier_produit.php?id=<?php echo $idProduit; ?>">
        <label for="nom_produit">Nom du produit:</label>
        <input type="text" name="nom_produit" value="<?php echo $produit['Nom du produit']; ?>" required><br>

        <label for="marque">Marque:</label>
        <input type="text" name="marque" value="<?php echo $produit['Marque']; ?>" required><br>

        <label for="code_bar">Code bar:</label>
        <input type="text" name="code_bar" value="<?php echo $produit['Code bar']; ?>" required><br>

        <label for="rayon">Rayon:</label>
        <input type="text" name="rayon" value="<?php echo $produit['Rayon']; ?>" required><br>

        <label for="stock_restant">Stock restant:</label>
        <input type="text" name="stock_restant" value="<?php echo $produit['Stock restant']; ?>" required><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>
    <h2> Retour liste des produits :</h2>
<form method="POST" action="index.php">
<input type="submit" value="retour liste des produits">
</form>
</body>
</html>
