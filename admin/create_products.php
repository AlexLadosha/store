<?php

$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_GET['page'] === 'create_product') {
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
         var_dump($_POST);
        //  exit;
        if ($_POST['name'] && $_POST['description'] && $_POST['price']) {
            var_dump($_POST);

            $stmt = $pdo->prepare("INSERT INTO products (name, description, price ) VALUES (:name, :description, :price)");
            $data = [
                ':name' => $_POST['name'],
                ':description' => $_POST['description'],
                ':price' => $_POST['price'],
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
        <input type="submit" value="Create"/>
    </form>
    <?php
}
