<?php
    try {
        require_once 'utils/init.php';

        $categories = $pdo->query("SELECT * FROM movies");
    } catch (Throwable $exp) { }
?>

<!DOCTYPE html>
<html>
<?php include_once 'includes/head.php' ?>
    <body>
    <?php include_once 'includes/nav.php' ?>

        <div >
         
        <!-- for the BG -->
         <div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
         </div>

            <h1>CINEMA CITY</h1>
            <div class="center"><h2 class="animate-character">Let the movies carry you away</h2></div>
            
            <p class="movies">Movies</p>
   
            

            <div class="flex">
                <?php
                    if ($error->type === 'db' || !isset($categories)) {
                ?>
                    <p>Could not load products. Please try again later.</p>
                <?php
                    } else {
                        foreach ($categories as $row) {
                ?>
                        
                            <div class="flex-element">
                                <a href="poster.php?row_id=<?php echo $row['id'] ?>"><?= $row['name'] ?></a>
                                <a href="poster.php?row_id=<?php echo $row['id'] ?>">
                                    <img class="dynamic" src="<?= $row['url'] ?>" />
                                </a>
                            </div>
                        
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
