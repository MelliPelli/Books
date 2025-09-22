<?php
require_once('conn.php');
session_start();

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    
    $query = "SELECT * FROM kniha WHERE id = $book_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Kniha</title>
</head>
<body>
    <!-- header starts-->
    <header>
            <div class="logo">
                <a href="index.php">
                    <img src="logo.png" alt="">
                </a>
            </div>
            <div class="navigace">
                <input type="checkbox" class="toggle">
                <div class="hamburger"></div>
                    <ul class="menu">
                        <li><a href="index.php" >Home</a></li>
                        <li><a href="zanr.php" onclick>Žánry</a></li>
                        <li><a href="search.php" >Search</a></li>
                        <li><a href="sign.php" >Sign up</a></li>
                    </ul>
            </div>
        </header>
        <!-- header ends-->
    <?php if (isset($row)) { ?>
    <table>
        <tr>
            <td class="nazev"><?php echo $row["Nazev"] ?></td>
            <td class="obrazek"><img src="data:image;base64,<?php echo base64_encode($row["Obrazek"]) ?>" alt="Image"></td>
            <td class="popis"><?php echo $row["Popis"] ?></td>
            <td class="autor"><?php echo "Autor: " . $row["Autor"] ?></td>
            <td class="zanr"><?php echo "Žánry: " . $row["Zanr"] ?></td>
            <td class="isbn"><?php echo "ISBN:" . $row["ISBN"]."<br>"?></td>
        </tr>
    </table>
    <?php } else { ?>
    <p>Nenalezeny žádné knihy.</p>
    <?php } ?>
</body>
</html>

