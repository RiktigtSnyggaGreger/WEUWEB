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


$hitsQuery = "SELECT song_title, release_year FROM top_hits WHERE band_id = $bandId";
$hitsResult = mysqli_query($conn, $hitsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $band['band_name_sv']; ?> - Band Info</title>
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
    <ul class="nav-links">
        <li>    
    <div class="dropdown">
    <button class="dropbtn">Meny</button>
    <div class="dropdown-content">            
        <a id="index" href="index.php">Startsida</a>
            <?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bandId = $row["band_id"];
            $bandName = $row["band_name_sv"];
            $bandInfo = $row["band_info"];

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
    <h1><?php echo $band['band_name_sv']; ?></h1>
    <p><?php echo $band['band_name_sv']; ?> - Skapades: <?php echo $band['formation_year']; ?></p>
    <img src="img/<?php echo $band['picture']; ?>" alt="Bandbild">
    <p> <?php echo $band['band_info']; ?></p>
</div>

<div class="sidebar">
    <h2>Top Hits</h2>
    <ol>
        <?php if (mysqli_num_rows($hitsResult) > 0) { ?>
            <?php while ($hit = mysqli_fetch_assoc($hitsResult)) { ?>
                <li><?php echo $hit['song_title']; ?> (<?php echo $hit['release_year']; ?>)</li>
            <?php } ?>
        <?php } else { ?>
            <li>Inga hits hittades.</li>
        <?php } ?>
    </ol>
    
</div>

<footer>
    
    <p>&copy; 2025 DansBandsKungarna. All rights reserved.</p>
</footer>

</body>
</html>
