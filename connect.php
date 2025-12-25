<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'Ayoub', 'zap');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Internal Server Error. Please try again later."); 
}
?>