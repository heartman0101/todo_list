<?php

session_start();

require_once "condb.php";

if (isset($_POST['update'])) {
    $inform = $_POST['information'];
    $id = $_POST['id'];

    $sql = $conn->prepare("UPDATE `tb_list` SET list_name = :list_name WHERE id = $id ");
    $sql->bindParam(':list_name', $inform);
    $sql->execute();
    $result = $sql;

    if($result) {
        $_SESSION['success'] = "Updated information does successfully!";
        header("location: index.php");
    } else {
        $_SESSION['error'] = "Update information doesn't successfully!!";
        header("location: index.php");
    }

}

?>