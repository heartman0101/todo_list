<?php

session_start();

require_once "condb.php";

$id = $_POST['delete'];

$sql = $conn->prepare("DELETE FROM `tb_list` WHERE id=$id ");
$sql->execute();
$check = $sql;

if ($check) {
    $_SESSION['success'] = "Deleted information does successfully!";
    header("location: index.php");
} else {
    $_SESSION['error'] = "Deleted information doesn't successfully!";
    header("location: index.php");
}

?>