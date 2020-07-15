<?php
if($_GET['page'] === 'products') {
    $pdo = new PDO($db_dsn, $db_username, $db_password);
    $sth = $pdo->prepare("SELECT * FROM `products` ORDER BY name");
    $sth->execute();

    if(!empty($_COOKIE['product_deleted'])) {
        echo '<h2>Product deleted.</h2>';
    }

    ?>
	<h1>Products</h1>
    <table border="1">
    <?php
    while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
        $edit_url = "index.php?page=edit_product&product_id={$result['id']}";

?>
        <tr>
            <td><?php echo $result['id']; ?></td>
            <td>
                <a href="<?php echo $edit_url; ?>">
                    <?php echo $result['name']; ?>
                </a>

            </td>
            <td><?php echo $result['price']; ?></td>
            <td><?php echo $result['image']; ?></td>
            <td>
                <a href="index.php?page=edit_product&product_id=<?php echo $result['id']; ?>">Edit</a>
                &nbsp;
                <a href="index.php?page=delete_product&product_id=<?php echo $result['id']; ?>">Delete</a>
            </td>

        </tr>
        <?php
    }
    ?>
    </table>
	<a href="index.php?page=create_product">Create product</a>
	<?php
}
