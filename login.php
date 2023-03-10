<?php
    try {
        require_once 'utils/init.php';
    } catch (Throwable $exp) {
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $validation = [];

        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        
        if (!isset($_POST['password'])) {
            $validation['password'] = 'Password field is required.';
        } else {
            $password = $_POST['password'];
        }

            if (isset($password)) {
                $query = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
                $query->execute([$username, $username]);
                $user = $query->fetchAll();

                if (!is_array(($user)) || count($user) === 0) {
                    $validation['username'] = 'Username or password is incorrect.';
                    $validation['password'] = 'Username or password is incorrect.';
                } else {
                    $user = $user[0];
                    if (password_verify($password, $user['password'])) {
                        $token = bin2hex(random_bytes(64));
                        $user['auth_token'] = $token;
                        $expiration = strtotime('+1 day', time());
                        $user['auth_expire'] = date('Y-m-d H:i:s', $expiration);

                        setcookie('auth', $user['auth_token'], $expiration);

                        $query = $pdo->prepare("UPDATE users SET auth_token = ?, auth_expire = ? WHERE id = ?");
                        $query->execute([$user['auth_token'], $user['auth_expire'], $user['id']]);
                        header("Location: index.php");
                        die();
                    } else {
                        $validation['username'] = 'Username or password is incorrect.';
                        $validation['password'] = 'Username or password is incorrect.';
                    }
                }
            }
        } else {
            $validation['username'] = 'Username field is required.';
        }
        
    }
?>

<!DOCTYPE html>
<html>
<?php include_once 'includes/head.php' ?>
    <body>
    <?php include_once 'includes/nav.php' ?>
        <h1>LOGIN</h1>
       <form method="POST">
        <div class=" box flex-element">
            
            <div>
                <label> Username or E-mail Address </label>
                <input type="text" name="username" value="<?= isset($username) ? $username : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['username'])) {
                ?>
                <span><?= $validation['username'] ?></span>
                <?php
                    }
                ?>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" value="<?= isset($password) ? $password : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['password'])) {
                ?>
                <span><?= $validation['password'] ?></span>
                <?php
                    }
                ?>
            </div>
            <button class="glow-on-hover" type="submit" > Log in</button>
        </div>
        </form>
    </body>
</html>