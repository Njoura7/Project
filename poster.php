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
                    <div class="poster-container">
                    <div class="box flex-element">
                        <p><?= $row['name'] ?></p>
                            <img class="dynamic" src="<?= $row['url'] ?>" />
                        <p class="movie-description"><?= $row['description'] ?></p>
                    </div>
                    <button class="glow-on-hover book-btn" type="submit" > Book Now!</button>
                </div>
                
        <?php
                }
            }
        ?>
    </body>
</html>
