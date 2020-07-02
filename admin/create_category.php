<?php
if($_GET['page'] === 'create_category') {
    // var_dump($_POST);
    if(isset($_POST['name'])) {
        if($_POST['name']) {
            $pdo = new PDO($db_dsn, $db_username, $db_password);
            $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
            $data = [
                ':name' => $_POST['name'],
            ];
            $stmt->execute($data);

        }else {
            echo 'please enter category name';
        }
    }
    // if(empty($_POST['name'])) {
    // echo 'please enter category name';
    // }
    ?>
    <h1>Create Category</h1>
    <form action="" method="POST">
        <input name="name" />
        <br>
        <br>
        <input type="submit" value="Create" />
    </form>


    <?php

}
