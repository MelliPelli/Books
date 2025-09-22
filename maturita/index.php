<?php
require_once('conn.php');
$isSearched = True;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style2.css">
        <script src="main.js"></script>
        <title>Katalog knih</title>
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
                                <li><a href="zanr.php" >Žánry</a></li>
                                <li><a href="search.php" >Search</a></li>
                                <li><a href="sign.php" >Sign up</a></li>
                            </ul>
                    </div>
                </header>
                <!-- header ends-->
                
    <form action="index.php" method="post" class="form1">
  <input class="search" type="text" id="search" name="search" placeholder="Vyhledávání...">
  <input type="submit" class="submit" value="Odeslat">
</form>  

<main>
    <?php
    // vyhledávání podle autora a názvu knihy//
        $isSearched = false;
        $searchBooks = array();

        if (isset($_POST['search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM kniha WHERE Nazev LIKE '%".$search."%' OR Autor LIKE '%".$search."%'";
            $query = $conn->query($sql);

            if (mysqli_num_rows($query) == 0) {
                echo "<p>Nenašla se kniha s takovým jménem a nebo autorem.</p>";
            } else {
                while ($row = mysqli_fetch_array($query)) {
                    array_push($searchBooks, $row);
                }
                $isSearched = true;
            }
        } else {
            $sql = "SELECT * FROM kniha";
            $query = $conn->query($sql);

            while ($row = mysqli_fetch_array($query)) {
                array_push($searchBooks, $row);
            }
        }

        if ($isSearched && count($searchBooks) == 0) {
            echo "<p>Nenašla se kniha s takovým jménem a nebo autorem.</p>";
        } else {
    ?>
    <div class="card2">
        <table>
            <?php
                foreach ($searchBooks as $row) {
            ?>
            <tr>
                <td>
                    <?php
                        echo '<a href="knihy.php?id=' . $row["id"] . '">' . $row["Nazev"] . '</a><br>';
                    ?>
                </td>
                <td class="obrazek">
                    <a href="knihy.php?id=<?php echo $row['id']; ?>">
                        <?php echo '<img src="data:image;base64,' . base64_encode($row["Obrazek"]) . '" alt="Image">'; ?>
                    </a>
                </td>
                <td class="autor"><?php echo "" . $row["Autor"]."<br>"?></td>
                <td class="popis"><?php echo "" . $row["Popis"]."<br>"?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <?php
        }
    ?>
</main>
        <footer>
            <div class="copyright">© 2023 Kabatkova All rights reserved.</div>
        </footer>
    </body>
</html>

