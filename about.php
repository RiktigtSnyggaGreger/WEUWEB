<?php
$servername = "localhost";
$username = "ntigskov_danzuser";
$password = "N)yrw4(V~%,h";



$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, "ntigskov_danzos");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    echo "No band ID provided.";
    exit();
}
$query = "SELECT * FROM bands";
$result = mysqli_query($conn, $query);
$bandId = intval($_GET['id']);

$bandQuery = "SELECT * FROM bands WHERE band_id = $bandId";
$bandResult = mysqli_query($conn, $bandQuery);

if (!$bandResult || mysqli_num_rows($bandResult) == 0) {
    echo "Band not found.";
    exit();
}
$band = mysqli_fetch_assoc($bandResult);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Om oss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script>
    /*Funktion för lightmode*/ 
    function myFunction() {
        var element = document.body;
        element.classList.toggle("light-mode");

        document.querySelector(".navbar").classList.toggle("light-mode");
        document.querySelector(".sidebar").classList.toggle("light-mode");

        // Change text color in the sidebar
        var sidebar = document.querySelector(".sidebar");
        var sidebarParagraph = sidebar.querySelector("p");
        var sidebarListItems = sidebar.querySelectorAll("li");
        /*Ändrar text färgen till svart ifall lightmode e true*/
        if (element.classList.contains("light-mode")) {
            sidebar.style.color = "black"; 
            if (sidebarParagraph) {
                sidebarParagraph.style.color = "black"; 
            }
            sidebarListItems.forEach(function (item) {
                item.style.color = "black";
            });
        } else {
            sidebar.style.color = ""; 
            if (sidebarParagraph) {
                sidebarParagraph.style.color = ""; 
            }
            sidebarListItems.forEach(function (item) {
                item.style.color = ""; 
            });
        }
    }
</script>
<nav class="navbar">
    <div class="left">
        <div class="dropdown">
            <button class="dropbtn">Meny</button>
            <div class="dropdown-content">
                <a id="index" href="index.php">Startsida</a>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $bandId = $row["band_id"];
                        $bandName = $row["band_name_sv"];
                        echo '<a href="band.php?id=' . $bandId . '">' . $bandName . '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="right">
        <button id="darkButton" onclick="myFunction()">Byt färgschema</button>
        <a id="aboutme" href="about.html">Om oss</a>
    </div>
</nav>

    <div>
        <h3>
            Vilka är vi?
        </h3>
        <h3>Om oss</h3>
        <p>
            Vi är ett engagerat och kreativt team som brinner för att skapa fantastiska projekt tillsammans. 
            Vårt team består av fem unika individer med olika styrkor och färdigheter:
        </p>
        <div>
            <ul>
                <p><strong>Edwin</strong>: Våran HTML och CSS kodare.</p>
                <p><strong>Oliver</strong>: våran söta Designexpert samt dansbands proffset</p>
                <p><strong>Aleksander</strong>: Php, javascript och lite html kodaren</p>
                <p><strong>Samir</strong>: Han var bara sjuk hela tiden... </p>
                <p><strong>Kevin</strong>: Databas proffs</p>
            </ul>
        </div>
        <img src="img/tackbild.png" alt="tackbild">
        <p>
            Tillsammans kombinerar vi våra styrkor för att skapa något unikt och meningsfullt. Vi tror på samarbete, kreativitet och att ha kul på vägen!
        </p>
    </div>
</body>
</html>