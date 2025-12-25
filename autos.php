<!DOCTYPE html>
<?php
require_once "connect.php";

function checkUrlExists($url) {
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_NOBODY, true); 
 curl_setopt($ch, CURLOPT_FAILONERROR, true); 
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
 $result = curl_exec($ch);
 curl_close($ch);
 return $result !== false;
}

if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}
if ( isset($_POST['Add']) ) {
    if ( strlen($_POST['make']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ) {
        echo '<div class="alert alert-danger" role="alert">All fields are required</div>';
    }
    else if ( strlen($_POST['make']) < 1 ) {
        echo '<div class="alert alert-danger" role="alert">Make is required</div>';
    }
    else if ( ! is_numeric($_POST['year']) || ! is_numeric($_POST['mileage']) ) {
        echo '<div class="alert alert-danger" role="alert">Year and Mileage must be numeric</div>';
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage, url) VALUES ( :mk, :yr, :mi, :ur)');
        $stmt->execute(array(
            ':mk' => $_POST['make'], 
            ':yr' => $_POST['year'], 
            ':mi' => $_POST['mileage'],
            ':ur' => $_POST['url']));
        echo '<div class="alert alert-success" role="alert">Record inserted</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Autos form</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">

<h1>Tracking Autos for: <?php echo htmlentities($_GET['name']); ?></h1>


<form method="post">
    <label for="make">Make:</label>
    <input type="text" name="make" id="make" class="form-control"><br>

    <label for="year">Year:</label>
    <input type="text" name="year" id="year" class="form-control"><br>

    <label for="mileage">Mileage:</label>
    <input type="text" name="mileage" id="mileage" class="form-control"><br>

    <label for="url">Image URL:</label>
    <input type="text" name="url" id="url" class="form-control" placeholder="http://..."><br>

    <input class="btn btn-primary" type="submit" name="Add" value="Add">
    <input class="btn btn-default" type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
<ul>
<?php

$sql = "SELECT make, year, mileage, url FROM autos ORDER BY make";
$stmt = $pdo->query($sql);

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<li>";
    if ( !empty($row['url']) ) {
        echo '<a href="'.htmlentities($row['url']).'" target="_blank">';
        echo htmlentities($row['year']); 
        echo '</a>';
    } else {
        echo htmlentities($row['year']);
    }
    
    echo " ".htmlentities($row['make'])." / ".htmlentities($row['mileage']);
    echo "</li>";
}
?>
</ul>
</div>
</body>
</html>











