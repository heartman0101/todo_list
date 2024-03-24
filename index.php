<?php

session_start();

require_once "condb.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>

    <!-- css files -->

    <link rel="stylesheet" href="style.css">

    <!-- links css framework font awesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

</head>

<body>

    <div class="container-top">
        <div class="header">
            To Do List
        </div>

        <form class="input_add-container" action="add.php" method="post">
            <input type="text" name="information" class="input_add">
            <button name="add">ADD</button>
        </form>
    </div>

    <div class="container_bottom">

        <?php

        $stmt = $conn->prepare("SELECT * FROM `tb_list` ");
        $stmt->execute();
        $row = $stmt->fetchAll();

        foreach ($row as $users) { ?>
        
            <div class="card">
                <div class="card-list">
                    <?php echo $users['list_name']; ?>
                </div>
                <div class="card-action">

                    <form action="edit.php" method="post" class="edit">
                        <button name="edit" value="<?php echo $users['id'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                    <form action="delete.php" method="post" class="delete">
                        <button name="delete" value="<?php echo $users['id'] ?>" >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset ($_SESSION['success'])) { ?>
        <script>
            Swal.fire({
                title: "Congratulations!",
                text: "<?= $_SESSION['success'] ?>",
                icon: "success"
            });
        </script>
        <?php unset($_SESSION['success']) ?>
    <?php } ?>

    <?php if (isset ($_SESSION['warning'])) { ?>
        <script>
            Swal.fire({
                title: "Oh, no!",
                text: "<?= $_SESSION['warning'] ?>",
                icon: "warning"
            });
        </script>
        <?php unset($_SESSION['warning']) ?>
    <?php } ?>

    <?php if (isset ($_SESSION['error'])) { ?>
        <script>
            Swal.fire({
                title: "Opss...!",
                text: "<?= $_SESSION['error'] ?>",
                icon: "error"
            });
        </script>
        <?php unset($_SESSION['error']) ?>
    <?php } ?>

</body>

</html>