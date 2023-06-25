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

$nomProduit = $_POST['nom_produit'];
$marque = $_POST['marque'];
$codeBar = $_POST['code_bar'];
$rayon = $_POST['rayon'];
$stockRestant = $_POST['stock_restant'];

// Insérer les valeurs dans la table produits
$insertInformationProduct = "INSERT INTO `information produit` (`Nom du produit`, `Marque`, `Code bar`, `Rayon`, `Stock restant`) VALUES (:nomProduit, :marque, :codeBar, :rayon, :stockRestant)";
$statementInformationProduct = $pdo->prepare($insertInformationProduct);
$statementInformationProduct->bindParam(':nomProduit', $nomProduit);
$statementInformationProduct->bindParam(':marque', $marque);
$statementInformationProduct->bindParam(':codeBar', $codeBar);
$statementInformationProduct->bindParam(':rayon', $rayon);
$statementInformationProduct->bindParam(':stockRestant', $stockRestant);

try {
    $statementInformationProduct->execute();
    echo "Produit inséré avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion du produit : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<h2> Retour liste des produits :</h2>
<form method="POST" action="index.php">
<input type="submit" value="retour liste des produits">
</form>
</html>