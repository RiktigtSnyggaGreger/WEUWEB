<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, "ntigskov_danzos");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $bandId = $_GET['id'];

    $query = "SELECT * FROM bands WHERE band_id = $bandId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $band = mysqli_fetch_assoc($result);
        }
    }
     else {
        echo "Band not found.";
        exit();
    }
} else {
    echo "No band ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $band['band_name_sv']; ?> - Band Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php">Tillbaka till startsidan</a>
</nav>

<div class="main">
    <h1><?php echo $band['band_name_sv']; ?></h1>

    <p><?php echo $band['band_name_sv'];  '. ' ?> Skapades: <?php echo $band['formation_year']; ?></p>
    
    <img src="img/<?php echo $band['picture'];?>">

    <p></p>
</div>

<div class="sidebar">
    <ol>
    </ol> 
</div>

<footer>
    <p>&copy; 2025 DansBandsKungarna. All rights reserved.</p>
</footer>

</body>
</html>
