<?php
// Pripojenie k MySQL databáze
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'test';

$conn = mysqli_connect($host, $username, $password, $database);

// Vytvorenie záznamu
if (isset($_POST['create'])) {
    $name = $_POST['Meno'];
    $surname = $_POST['Priezvisko'];
    $phone = $_POST['Telefon'];
    $email = $_POST['E-mail'];

    $sql = "INSERT INTO poradca (ID, Meno, Priezvisko, Telefon, `E-mail`) VALUES (NULL, '$name', '$surname', '$phone', '$email')";
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
}

// Vymazanie záznamu
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM poradca WHERE ID = $id";
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
}

// Zobrazenie existujúcich záznamov
$sql = "SELECT * FROM poradca";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin stránka</title>
</head>
<body>
<h1>Admin stránka</h1>

<!-- Vytvorenie záznamu -->
<style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<h2>Vytvoriť záznam</h2>
<form action="admin.php" method="POST">
    <label for="Meno">Meno:</label>
    <input type="text" name="Meno" required>
    <br>
    <label for="Priezvisko">Priezvisko:</label>
    <input type="text" name="Priezvisko" required>
    <br>
    <label for="Telefon">Telefón:</label>
    <input type="text" name="Telefon" required>
    <br>
    <label for="E-mail">E-mail:</label>
    <input type="email" name="E-mail" required>
    <br>
    <input type="submit" name="create" value="Vytvoriť">
</form>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    a {
        margin-right: 5px;
        text-decoration: none;
        color: #333;
    }

    a:hover {
        color: #000;
    }
</style>

<!-- Zobrazenie záznamov -->
<h2>Zoznam záznamov</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Meno</th>
        <th>Priezvisko</th>
        <th>Telefón</th>
        <th>E-mail</th>
        <th>Akcia</th>
    </tr>
    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['Meno'] ?></td>
            <td><?= $row['Priezvisko'] ?></td>
            <td><?= $row['Telefon'] ?></td>
            <td><?= $row['E-mail'] ?></td>
            <td>
                <a href="admin.php?delete=<?= $row['ID'] ?>">Vymazať</a>
                <a href="edit.php?id=<?= $row['ID'] ?>">Upraviť</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>

<?php
// Zatvorenie spojenia s databázou
mysqli_close($conn);
?>