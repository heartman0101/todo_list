<?php

session_start();

require_once "condb.php";

?>

<?php

if (isset ($_POST['add'])) {
    $list_name = $_POST['information'];

    if (empty ($list_name)) {
        $_SESSION['warning'] = "Please Enter, To do list frist!";
        header("location: index.php");
    } else {
        try {

            $info_check = $conn->prepare("SELECT * FROM `tb_list` WHERE list_name = :list_name ");
            $info_check->bindParam(':list_name', $list_name);
            $info_check->execute();
            $row = $info_check->fetch(PDO::FETCH_ASSOC);

            if ($row['list_name'] == $list_name) {
                $_SESSION['warning'] = "Information is already exist!";
                header("location: index.php");
            } else {
                $stmt = $conn->prepare("INSERT INTO `tb_list` (list_name) VALUES (:list_name) ");
                $stmt->bindParam(':list_name', $list_name);
                $stmt->execute();
                $result = $stmt;

                if ($result) {
                    $_SESSION['success'] = "Added todo list!";
                    header("location: index.php");
                } else {
                    $_SESSION['error'] = "Added todo list failed!";
                    header("location: index.php");
                }
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

?>