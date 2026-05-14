<?php

require_once __DIR__ . '/DB/db_config.php';

$php_errormsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = sanifica($link, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {

        $php_errormsg = "Inserisci sia Eamil e sia la Password";
    } else {
        // controlla se l'utente esiste ne DB
        $sql = "SELECT id, nome, password FROM utenti WHERE email = '$_POST[email]'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($_POST['password'], $row['password'])) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nome'];

                header('Location: dashboard.php');
                exit();
            } else {
                $php_errormsg = "Password errata";
            }
        } else {
            $php_errormsg = "Email non registrata";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        form { display: flex; flex-direction: column; }
        input { margin-bottom: 10px; padding: 8px; }
        .btn { background-color: #007BFF; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
        .error { 
            color: #721c24; 
            background-color: #f8d7da; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        .error:empty { display: none; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Accedi</h2>

        <div class="<?php echo !empty($php_errormsg) ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($php_errormsg); ?>
        </div>

        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" class="btn" value="Login">
        </form>

        <p>Non hai un account? <a href="register.php">Registrati qui</a></p>
    </div>

</body>
</html>

<?php
mysqli_close($link);
?>