<?php
$servername = "localhost";
$username = "ntigskov_danzuser";
$password = "N)yrw4(V~%,h";

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, "ntigskov_danzos");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    function toggleMenu() {
        document.querySelector("nav ul").classList.toggle("show");
    }
    function myFunction() {
       var element = document.body;
       element.classList.toggle("light-mode");
    }
</script>

<nav class="navbar">
    <ul class="nav-links">
        <li>    
    <div class="dropdown">
    <button class="dropbtn">Dropdown</button>
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
      
            <button onclick="myFunction()">Byt färgschema</button>     
        </li>
    </ul>
</nav>

<div class="main">
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit qui ratione eum quia, maxime excepturi minus sequi quo. ...
    </p>
</div>

<img src="img/lassestefanzbild.jpeg">

<div class="sidebar">
    <ol>
        <p>Top Sverige Idag!</p>
        <li>Lasse Stefanz</li>
        <li>Sven-Ingvars</li>
        <li>Vikingarna</li>
    </ol> 
</div>

<footer>
    <p>&copy; 2025 DansBandsKungarna. All rights reserved.</p>
    <ul class="footer-links">
        <li><a href="about.html">About Us</a></li>
        <li><a href="#">Random Website</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    <p>Follow us on:</p>
    <ul class="social-links">
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Instagram</a></li>
    </ul>
</footer>
</body>
</html>
