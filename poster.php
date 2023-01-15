<?php
    try {
        require_once 'utils/init.php';

        $categories = $pdo->query("SELECT name, url FROM movies");
    } catch (Throwable $exp) { }
?>

<!DOCTYPE html>
<html>
    <?php include_once 'includes/head.php' ?>
    <body>
        <?php include_once 'includes/nav.php' ?>
        <?php
                if (isset($_GET['row_id'])) {
                    $row = $_GET['row_id'];
                

                $query = $pdo->prepare("SELECT * FROM movies WHERE id = {$row}");
                $query->execute();
                $post = $query->fetchAll();
                foreach ($post as $row) {
                    ?>
                    <div class="flex">
                    <div class="flex-element">
                        <p><?= $row['name'] ?></p>
                            <img class="dynamic" src="<?= $row['url'] ?>" />
                        <p><?= $row['description'] ?></p>
                    </div>
                </div>
        <?php
                }
            }
        ?>
    </body>
</html>
