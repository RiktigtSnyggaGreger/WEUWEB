<?php

// Databas connection
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
    <ul class="nav-links">
        <li>    
    <div class="dropdown">
    <button class="dropbtn">Meny</button>
    <div class="dropdown-content">
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
      
            <button id="darkButton" onclick="myFunction()">Byt färgschema</button> 
            <a id="aboutme" href="about.html">Om oss</a>    
        </li>
    </ul>
</nav>

<div class="main">
    
    <p><strong>Välkommen till vår hemsida!</strong> Här har vi samlat allt du behöver veta om Sveriges mest älskade dansband och deras musik. 
        Oavsett om du är en trogen fan av Lasse Stefanz, Sven-Ingvars, Vikingarna eller bara är nyfiken på att utforska den 
        svenska dansbandskulturen, så har vi något för dig. </p>

        <p>På vår sida hittar du information om de största banden, deras historia, och deras mest populära låtar. Du kan också 
        hålla dig uppdaterad med de senaste nyheterna och evenemangen inom dansbandsvärlden. Vi har dessutom en topplista 
        över de mest populära banden i Sverige just nu, så att du alltid vet vilka som är hetast på dansgolvet.</p>

        <p>Utforska vår meny för att läsa mer om dina favoritband, och glöm inte att kolla in våra bilder och artiklar för att 
        få en djupare inblick i denna fantastiska musikgenre. Vi hoppas att du kommer att trivas här och att vår hemsida 
        blir din go-to-plats för allt som rör dansband!</p>

        <p>Tack för att du besöker oss, och vi önskar dig en fantastisk upplevelse!</p>
    </p>
</div>

<img src="img/dansband2.jpg" alt="Dansband">

<div class="sidebar">
    <ol>
        <p>Top Sverige Idag!</p>
        <li>Lasse Stefanz</li>
        <li>Sven-Ingvars</li>
        <li>Vikingarna</li>
        <li>Arvingarna</li>
        <li>Flamingo Personerna</li>
        <li>Dansbandskungen!</li>
        <li>Nån nobody</li>
    </ol> 

    
</div>


</body>
</html>
