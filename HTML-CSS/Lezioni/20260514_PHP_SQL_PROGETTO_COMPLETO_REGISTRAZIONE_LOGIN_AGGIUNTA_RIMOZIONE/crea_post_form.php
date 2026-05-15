<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Post</title>

    <style>
        .container {
            width: 50%;
            margin: auto;
            font-family: sans-serif;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input,
        textarea {
            padding: 10px;
        }

        textarea {
            height: 150px;
        }

        .msg {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #8d1f2a;
        }

        .btn {
            background-color: rgb(49, 164, 240);
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Crea il tuo post</h2>
        <a href="home.php"> Torna alla home</a>
        <br><br>

        <?php if ($success): ?>
            <div class="msg success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="msg error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="crea_post.php" method="POST">
            <input type="text" name="titolo" placeholder="Inserisci il titolo:" value="<?php echo htmlspecialchars($titolo); ?>">
            <textarea name="contenuto" placeholder="Scrivi il tuo post...."><?php echo htmlspecialchars($contenuto); ?></textarea>
            <input type="submit" class="btn" value="Pubblica Post">
        </form>
    </div>
</body>

</html>
