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
$orderByMarque = "SELECT * FROM `information produit` ORDER BY `information produit`.`Marque` ASC";
$statementMarque = $pdo->query($orderByMarque);
$produitsParMarque = $statementMarque->fetchAll(PDO::FETCH_ASSOC);

// Classement par rayon
$orderByRayon = "SELECT * FROM `information produit` ORDER BY `information produit`.`Rayon` ASC";
$statementRayon = $pdo->query($orderByRayon);
$produitsParRayon = $statementRayon->fetchAll(PDO::FETCH_ASSOC);

// Moyenne du stock des produits
$averageStock = "SELECT AVG(`Stock restant`) AS moyenne_stock FROM `information produit`";
$statementAverageStock = $pdo->query($averageStock);
$moyenneStock = $statementAverageStock->fetch(PDO::FETCH_ASSOC)['moyenne_stock'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Information produits</title>
</head>
<body>
    <h1>Information produits</h1>

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
                <td>
                <a href="modifier_produit.php?id=<?php echo $produit['id']; ?>">Modifier</a>
                <a href="supprimer_produit.php?id=<?php echo $produit['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                </td>
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
            <th>Actions</th>
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

<h2>Classement par marque :</h2>
<table>
    <tr>
        <th>Nom du produit</th>
        <th>Marque</th>
        <th>Code bar</th>
        <th>Rayon</th>
        <th>Stock restant</th>
    </tr>
    <?php foreach ($produitsParMarque as $produit) : ?>
        <tr>
            <td><?php echo $produit['Nom du produit']; ?></td>
            <td><?php echo $produit['Marque']; ?></td>
            <td><?php echo $produit['Code bar']; ?></td>
            <td><?php echo $produit['Rayon']; ?></td>
            <td><?php echo $produit['Stock restant']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Classement par Rayon :</h2>
<table>
    <tr>
        <th>Nom du produit</th>
        <th>Marque</th>
        <th>Code bar</th>
        <th>Rayon</th>
        <th>Stock restant</th>
    </tr>
    <?php foreach ($produitsParRayon as $produit) : ?>
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

<h2>Ajouter un produit :</h2>
<form method="POST" action="ajouter_produit.html">
<input type="submit" value="Ajouter">
</form>


</html>

