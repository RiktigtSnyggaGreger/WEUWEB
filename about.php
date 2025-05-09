<?php

$servername = "localhost";
$username = "ntigskov_danzuser";
$password = "N)yrw4(V~%,h";

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, "ntigskov_danzos");
if ($conn->connect_error) {
    echo("det funka inte");
}

$query = "SELECT * FROM bands";
$result = mysqli_query($conn, $query);

$homequery = "SELECT * FROM home_page";
$homeresult = mysqli_query($conn, $homequery);
$band = mysqli_fetch_assoc($result);

$aboutquery = "SELECT * FROM about_us";
$aboutresult = mysqli_query($conn, $aboutquery);
$about = mysqli_fetch_assoc($aboutresult);

$creatorquery = "SELECT * FROM creators";
$creatorresult = mysqli_query($conn, $creatorquery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Page</title>
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
        <a id="aboutme" href="about.php">Om oss</a>
    </div>
</nav>
<div>
        <h3>
            <?php echo $about["about_us_header"]; ?>
        </h3>
        <p><?php echo $about["about_us_"]; ?></p>
        <div>
            <ul>
            <?php
                if (mysqli_num_rows($creatorresult) > 0) {
                    while ($creator = mysqli_fetch_assoc($creatorresult)) {
                        echo "<li><strong>" . $creator['creator_name'] . ":</strong> " . $creator['creator_info'] . "</li>";
                    }
                }
        ?>
            </ul>
        </div>
        <img src="img/tackbild.png" alt="tackbild">
        <p>
            <?php echo $about["about_us_footer"]; ?>
        </p>
    </div>
</body>
</html>