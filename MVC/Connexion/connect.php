<?php
/**
 *
 */
 $dsn = 'mysql:dbname=ppe;host=localhost';
 $user = 'root';
 $password = 'root';

 try {
     $conn = new PDO($dsn, $user, $password);
 } catch (PDOException $e) {
     echo 'Connexion échouée : ' . $e->getMessage();
 }


?>
