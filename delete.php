<?php

ob_start();

$id = $_GET['id'];

require('includes/db.php');

//set up sql query

$sql = "DELETE FROM climbingclub WHERE id = :id";

//prepare

$cmd = $conn->prepare($sql);

$cmd->bindParam(':id', $id);

$cmd->execute();

$cmd->closeCursor();

header('location:club.php');


ob_flush();


?>