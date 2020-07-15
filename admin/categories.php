<?php
if($_GET['page'] === 'categories') {
    $pdo = new PDO($db_dsn, $db_username, $db_password);
    $sth = $pdo->prepare("SELECT * FROM `categories`");
    $sth->execute();

    if(!empty($_COOKIE['category_deleted'])) {
        echo '<h2>Category deleted.</h2>';
    }

    ?>
    <h1>Categories</h1>
    <table border="1">

        <?php
        while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $edit_url = "index.php?page=edit_category&category_id={$result['id']}";

            ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td>
                    <a href="<?php echo $edit_url; ?>">
                        <?php echo $result['name']; ?>
                    </a>

                </td>
                <td>
                    <a href="index.php?page=edit_category&category_id=<?php echo $result['id']; ?>">Edit</a>
                    &nbsp;
                    <a href="index.php?page=delete_category&category_id=<?php echo $result['id']; ?>">Delete</a>
                </td>

            </tr>
            <?php
        }
        ?>
    </table>



    <a href="index.php?page=create_category">Create category</a>
    <?php
}
