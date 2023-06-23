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

// Classement par nom du produit
$orderByNomProduit = "SELECT * FROM `information produit` ORDER BY `information produit`.`Nom du produit`ASC";
$statementNomProduit = $pdo->query($orderByNomProduit);
$produitsParNom = $statementNomProduit->fetchAll(PDO::FETCH_ASSOC);

// Classement par code bar
$orderByCodeBar = "SELECT * FROM `information produit` ORDER BY `information produit`.`Code bar`ASC";
$statementCodeBar = $pdo->query($orderByCodeBar);
$produitsParCodeBar = $statementCodeBar->fetchAll(PDO::FETCH_ASSOC);

// Classement par stock restant
$orderByStock = "SELECT * FROM `information produit` ORDER BY `information produit`.`Stock restant` ASC";
$statementStock = $pdo->query($orderByStock);
$produitsParStock = $statementStock->fetchAll(PDO::FETCH_ASSOC);

// Classement par marque

// Moyenne du stock des produits
$averageStock = "SELECT AVG(`Stock restant`) AS moyenne_stock FROM `information produit`";
$statementAverageStock = $pdo->query($averageStock);
$moyenneStock = $statementAverageStock->fetch(PDO::FETCH_ASSOC)['moyenne_stock'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interrogation de la base de données</title>
</head>
<body>
    <h1>Interrogation de la base de données</h1>

    <h2>Classement par nom du produit :</h2>
    <table>
        <tr>
            <th>Nom du produit</th>
            <th>Marque</th>
            <th>Code bar</th>
            <th>Rayon</th>
            <th>Stock restant</th>
        </tr>
        <?php foreach ($produitsParNom as $produit) : ?>
            <tr>
                <td><?php echo $produit['Nom du produit']; ?></td>
                <td><?php echo $produit['Marque']; ?></td>
                <td><?php echo $produit['Code bar']; ?></td>
                <td><?php echo $produit['Rayon']; ?></td>
                <td><?php echo $produit['Stock restant']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Classement par code bar :</h2>
    <table>
        <tr>
            <th>Nom du produit</th>
            <th>Marque</th>
            <th>Code bar</th>
            <th>Rayon</th>
            <th>Stock restant</th>
        </tr>
        <?php foreach ($produitsParCodeBar as $produit) : ?>
            <tr>
                <td><?php echo $produit['Nom du produit']; ?></td>
                <td><?php echo $produit['Marque']; ?></td>
                <td><?php echo $produit['Code bar']; ?></td>
                <td><?php echo $produit['Rayon']; ?></td>
                <td><?php echo $produit['Stock restant']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Classement par stock :</h2>
<table>
    <tr>
        <th>Nom du produit</th>
        <th>Marque</th>
        <th>Code bar</th>
        <th>Rayon</th>
        <th>Stock restant</th>
    </tr>
    <?php foreach ($produitsParStock as $produit) : ?>
        <tr>
            <td><?php echo $produit['Nom du produit']; ?></td>
            <td><?php echo $produit['Marque']; ?></td>
            <td><?php echo $produit['Code bar']; ?></td>
            <td><?php echo $produit['Rayon']; ?></td>
            <td><?php echo $produit['Stock restant']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>


    <h2>Moyenne du stock des produits :</h2>
    <p><?php echo "La moyenne du stock des produits est de : " . $moyenneStock; ?></p>
</body>
</html>

