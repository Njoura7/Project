<?php
try {
    require_once 'utils/init.php';
}
catch (Throwable $exp) {}

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = [];

    if (!isset($_POST['movie']) || $_POST['movie'] === '') {
        $validation[] = ['movie' => 'movie name field is required.'];
    } else {
        $movie = $_POST['movie'];
    }

    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';

    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $validation[] = ['name' => 'Your name field is required.'];
    } else {
        $name = $_POST['name'];
    }

    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $validation[] = ['email' => 'Your email address field is required.'];
    } else {
        $email = $_POST['email'];
        $valid = preg_match('/[0-z]+[@][0-z]+[.][A-z]+/', $email) === 1;
        if (!$valid) {
            $validation[] = ['email' => 'Your email address must have a valid email format.'];
        }
    }

    $phone = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    if ($phone !== '') {
        $valid = preg_match('/[+][0-9]{9}[0-9]*/', $phone) === 1;
        $validation[] = ['phonenumber' => 'Your phone number must have a valid telephone number format.'];
    }

    if (count($validation) === 0) {
        $query = $pdo->prepare('INSERT INTO moviebookingrequests(movie, name, email, phone) VALUES(?, ?, ?, ?)');
        $query->execute([$movie, $name, $email, $phone]);

        $errors = $pdo->errorInfo();
        if ($errors[0] === PDO::ERR_NONE) {
            $movie = '';
            $name = '';
            $email = '';
            $phone = '';
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<?php include_once 'includes/head.php' ?>
    <body>
    <?php include_once 'includes/nav.php' ?>
        <p>
            You cannot find the movie you are looking for?
            Worry not, we can mail you when it is starts airing in our cinema.
            Just leave your information below with name of the movie and we will get to you when we start airing the movie.
        </p>
        <h1>REGISTER FOR A MOVIE</h1>
        <?php
            if ($success) {
        ?>
        <h4>Your Email has been registered. We will get back to you.</h4>
        <?php
            }
        ?>
        <form method="POST">
            <div class=" box flex-element">
            <div>
                <label>Movie</label>
                <input type="text" name="movie" value="<?= isset($movie) ? $movie : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['movie'])) {
                ?>
                <span><?= $validation['movie'] ?></span>
                <?php
                    }
                ?>
            </div>
            <div>
                <label>Your Name</label>
                <input type="text" name="name" value="<?= isset($name) ? $name : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['name'])) {
                ?>
                <span><?= $validation['name'] ?></span>
                <?php
                    }
                ?>
            </div>
            <div>
                <label>Your E-mail Address</label>
                <input type="text" name="email" placeholder="abc@def.com" value="<?= isset($email) ? $email : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['email'])) {
                ?>
                <span><?= $validation['email'] ?></span>
                <?php
                    }
                ?>
            </div>
            <div>
                <label>Your Phone Number (Optional)</label>
                <input type="text" name="phone" placeholder="+00 00 000 0000" value="<?= isset($phone) ? $phone : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['phone'])) {
                ?>
                <span><?= $validation['phone'] ?></span>
                <?php
                    }
                ?>
            </div>
            <input type="submit" value="Request" />
            </div>
        </form>
    </body>
</html>