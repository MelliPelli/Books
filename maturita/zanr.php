<?php
require_once('conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Žánry</title>
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
                        <li><a href="register.php" >Search</a></li>
                        <li><a href="sign.php" >Sign up</a></li>
                    </ul>
            </div>
           
        </header>
        <!-- header ends-->
    
        <form class="check" action="zanr.php" method="post">
        <div class="box">
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Romance">
                        <span>Romance</span>
                </label> 
                </div>
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Fantasy">
                        <span>Fantasy</span>
                </label> 
            </div>
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Horor">
                        <span>Horor</span>
                </label> 
            </div>
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Sci-fi">
                        <span>Sci-fi</span>
                </label> 
            </div>
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Krimi">
                        <span>Krimi</span>
                </label> 
            </div>
            <div>
                <label>
                    <input type="checkbox" name="zanry[]" value="Detektivky">
                        <span>Detektivky</span>
                </label> 
            </div>
        </div>
        <input type="submit" name="submit1" value="Odeslat">
    </form>

<main>
    <div class="card2">
        <table> 
            <?php   
            $sql = "SELECT * FROM kniha";
            
            if (isset($_POST['submit1'])) {
                if (isset($_POST['zanry'])) {
                    $selectedGenres = $_POST['zanry'];
                    $sql .= " WHERE Zanr IN ('" . implode("', '", $selectedGenres) . "')";
                } else {
                    echo "Vyberte alespoň jeden žánr.";
                }
            }
            
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
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
            } else {
                echo "Nenalezeny žádné knihy.";
            }
            ?>
            </main>
        <footer>
            <div class="copyright">© 2023 Kabatkova All rights reserved.</div>
        </footer>
    </body>
</html>

