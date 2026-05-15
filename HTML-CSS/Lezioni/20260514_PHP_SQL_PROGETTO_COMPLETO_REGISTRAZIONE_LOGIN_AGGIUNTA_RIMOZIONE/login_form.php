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

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }

        .error:empty {
            display: none;
        }
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