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
    <ul>
    <div class="left">
        <div class="dropdown">
            <button class="dropbtn">Meny</button>
            <div class="dropdown-content">
                <a id="index" href="index.php">Startsida</a>
                
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $bandid = $row["band_id"];
                        $bandname = $row["band_name_sv"];
                        echo '<li><a href="band.php?id=' . $bandid . '">' . $bandname . '</a></li>';
                    }
                }
                ?>
    </ul>
            </div>
        </div>
    </div>
    <div class="right">
        <button id="darkButton" onclick="myFunction()">Byt färgschema</button>
        <a id="aboutme" href="about.php">Om oss</a>
    </div>
</nav>

<div class="main">
<?php
if ($homeresult) {
    while ($row = mysqli_fetch_assoc($homeresult)) {
        $homeid = $row["home_id"];
        $hometitle = $row["home_title"];
        $homeheader = $row["home_header"];
        $funfacttitle = $row["fun_fact_title"];
        $funfact = $row["fun_fact"];
        $funfact2 = $row["fun_fact2"];
        $funfact3 = $row["fun_fact3"];
        $homefooter = $row["home_footer"];

        echo '<h1>' . $hometitle . '</h1>';
        echo '<p>' . $homeheader . '</p>';
    }
}
?>
</div>



<img src="img/dansband2.jpg" alt="Dansband">

<div class="sidebar">
    <ol>
        <?php 
           echo '<h1>' . $funfacttitle .'</h1>' . $funfact . '<br>'.'<br>' . $funfact2 . '<br>'. '<br>'. $funfact3;
        ?>
    </ol> 

    
</div>
<footer>
   <?php
    echo $homefooter;
    ?>
</footer>

</body>
</html>
