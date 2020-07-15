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

    $pdo = new PDO($db_dsn, $db_username, $db_password);
    $sth = $pdo->prepare("SELECT id, name FROM `categories`");
    $sth->execute();

    ?>
    <h1>Create Category</h1>
    <form action="" method="POST">
        Parent category:<br>
        <select name="name" >
            <option></option>
            <?php
            while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option><?php echo $result['name']; ?></option>
                <?php
            }
            ?>
        </select>
        <br>
        <br>
        Name<br>
        <input name="name" />
        <br>
        <br>
        <input type="submit" value="Create" />
    </form>


    <?php

}
