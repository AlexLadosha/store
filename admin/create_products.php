<?php

$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_GET['page'] === 'create_product') {
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
         var_dump($_POST);
        //  exit;
        if ($_POST['name'] && $_POST['description'] && $_POST['price']) {
//            var_dump($_POST);

            $file_name = '';
            if(!empty($_FILES["image"])) {
                $file_info = $_FILES["image"];

                $target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/";
                $file_name = basename($file_info["name"]);
                $target_file = $target_dir . $file_name;

                if (!move_uploaded_file($file_info["tmp_name"], $target_file)) {
                    die('file upload error');
                }
            }

            $data = json_encode($_POST);

            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, data ) VALUES (:name, :description, :price, :image, :data)");
            $data = [
                ':name' => $_POST['name'],
                ':description' => $_POST['description'],
                ':price' => $_POST['price'],
                ':image' => $file_name,
                ':data' => $data,
            ];
            $stmt->execute($data);
            $product_id = $pdo->lastInsertId();

            if (!empty($_POST['categories'])) {
                foreach ($_POST['categories'] as $category_id) {
                    $stmt = $pdo->prepare("INSERT INTO categories_products (category_id, product_id) VALUES (:category_id, :product_id)");
                    $data = [
                        ':product_id' => $product_id,
                        ':category_id' => $category_id,
                    ];
                    $stmt->execute($data);
                }
            }

        } else {
            echo 'Please enter product name, description and price';
        }
    }

    $pdo = new PDO($db_dsn, $db_username, $db_password);
    $sth = $pdo->prepare("SELECT id, name FROM `categories`");
    $sth->execute();

    ?>
    <h1>Create Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        Name <input name="name"/>
        <br>
        <br>
        Description
        <textarea name="description" cols="40" rows="3" placeholder="Description"></textarea>
        <br>
        <br>
        Categories
        <?php
        while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
           echo "<label ><input type='checkbox' name='categories[]' value='{$result['id']}' /> {$result['name']} </label>\n";
        }
        ?>
        <br>
        <br>
        Price
        <input name="price" size=5/>$
        <br>
        <br>
        Image
        <input type="file" name="image">
        <br>
        <br>
        <input type="submit" value="Create"/>
    </form>
    <?php
}
