<?php

$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$product_id = $_GET['product_id'];


if (isset($_POST['name'])) {
//    var_dump($_POST);
//      exit;
    if ($_POST['name'] && $_POST['description'] && $_POST['price']) {
//            var_dump($_POST);

        $file_name = '';
        if(!empty($_FILES["image"]["name"])) {
            $file_info = $_FILES["image"];

            $target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/";
            $file_name = basename($file_info["name"]);
            $target_file = $target_dir . $file_name;

            if (!move_uploaded_file($file_info["tmp_name"], $target_file)) {
                die('file upload error');
            }
        }

        $stmt = $pdo->prepare("
            UPDATE products 
            SET name = :name, description = :description, price = :price, image = :image 
            WHERE id = :id 
        ");
        $data = [
            ':name' => $_POST['name'],
            ':description' => $_POST['description'],
            ':price' => $_POST['price'],
            ':image' => $file_name,
            ':id' => $_POST['product_id'],
        ];
        $stmt->execute($data);

        $stmt = $pdo->prepare("DELETE FROM categories_products WHERE product_id = :product_id");
        $data = [
            ':product_id' => $product_id,
        ];
        $stmt->execute($data);

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

$categories = [];
$pdo = new PDO($db_dsn, $db_username, $db_password);
$query_categories = $pdo->prepare("SELECT id, name FROM `categories`");
$query_categories->execute();
while ($category = $query_categories->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $category;
}

$product_category_ids = ['dfdf' => []];
$query_product_categories = $pdo->prepare("SELECT category_id FROM `categories_products` WHERE product_id = '{$product_id}'");
$query_product_categories->execute();
while ($product_category = $query_product_categories->fetch(PDO::FETCH_ASSOC)) {
    $product_category_ids['dfdf'][$product_category['category_id']] = $product_category['category_id'];
}
//var_dump($product_category_ids);exit;


$sth2 = $pdo->prepare("SELECT * FROM `products` WHERE id = '{$product_id}'");
$sth2->execute();
$product = $sth2->fetch(PDO::FETCH_ASSOC);
//var_dump($product);exit;

?>
<h1>Edit Product</h1>
<form action="" method="POST" enctype="multipart/form-data">

    Name <input name="name" value="<?php echo $product['name']; ?>"/>
    <br>
    <br>
    Description
    <textarea name="description" cols="40" rows="3" placeholder="Description"><?php echo $product['description']; ?></textarea>
    <br>
    <br>
    Categories
    <?php
    foreach ($categories as $category) {
?>
        <label ><input type='checkbox' name='categories[]' value='<?php echo $category['id']; ?>'
        <?php
            foreach ($product_category_ids['dfdf'] as $product_category_id) {
                if($product_category_id == $category['id']) {
                    echo 'checked';
                }
            }
        ?>

        /> <?php echo $category['name']; ?> </label>
<?php
    }
    ?>
    <br>
    <br>
    Price
    <input name="price" size=5 value="<?php echo $product['price']; ?>" />$
    <br>
    <br>
    Image
    <input type="file" name="image">
    <?php if($product['image']) { ?>
        <img src="/uploads/<?php echo $product['image']; ?>" width="150" />
    <?php } ?>
    <br>
    <br>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="submit" value="Save"/>
</form>
