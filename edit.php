<?php
// Pripojenie k MySQL databáze
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'test';

$conn = mysqli_connect($host, $username, $password, $database);

// Získanie údajov o zázname pre úpravu
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM poradca WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Spracovanie úpravy záznamu
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE poradca SET Meno='$name', Priezvisko='$surname', Telefon='$phone', `E-mail`='$email' WHERE ID=$id";
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
}

?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Úprava záznamu</title>
    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <body>
    <h1>Úprava záznamu</h1>

    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['ID'] ?>">
        <label for="name">Meno:</label>
        <input type="text" name="name" value="<?= $row['Meno'] ?>" required>
        <br>
        <label for="surname">Priezvisko:</label>
        <input type="text" name="surname" value="<?= $row['Priezvisko'] ?>" required>
        <br>
        <label for="phone">Telefón:</label>
        <input type="text" name="phone" value="<?= $row['Telefon'] ?>" required>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" value="<?= $row['E-mail'] ?>" required>
        <br>
        <input type="submit" name="update" value="Atualizovať">
    </form>
    </body>
    </html>

<?php
// Zatvorenie spojenia s databázou
mysqli_close($conn);
?>