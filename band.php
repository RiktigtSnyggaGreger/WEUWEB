<?php

// Databas connection
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

<nav class="navbar">
    <a href="index.php">Tillbaka till startsidan</a>
</nav>

<div class="main">
    <h1><?php echo $band['band_name_sv']; ?></h1>
    <p><?php echo $band['band_name_sv']; ?> - Skapades: <?php echo $band['formation_year']; ?></p>
    <img src="img/<?php echo $band['picture']; ?>" alt="Bandbild">
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
