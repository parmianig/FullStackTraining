<?php
require 'Persona.php';
require 'Post.php';
require 'register.php';

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione dei post</title>
</head>
<body>
    
    <h1>PAGINA DI CREAZIONE DEI POST:</h1>

    <?php if(!$utenteCreato): ?>
        <!-- creazione utente -->
        <h2>Registrati:</h2>
        <form method="post">

            <input type="text" name="nome" placeholder="inserisci il tuo nome:">
            <input type="email" name="email" placeholder="inserisci la tua email:">
            <label>Seleziona uno o più ruoli </label>
            <select name="ruoli[]" multiple>
                <option value="user">Utente Semplice</option>
                <option value="editor">Utente Editore</option>
                <option value="admin">Utente Admin</option>
            </select>

            <input type="submit" name="crea_persona" value="Crea utente">
        </form>
    <?php else:?>
        <!-- creazione del post -->

        <p>Benvenuto nella creazione del post</p>
        <p>Nome Utente: <?php echo $utenteCreato->getNome('1234'); ?></p>
        <p>Email Utente: <?php echo $utenteCreato->getEmail(); ?></p>
        <p>Ruoli Utente: <?php echo implode(", ", $utenteCreato->ruoli); ?></p>

        <?php if( in_array("admin", $utenteCreato->ruoli) || in_array("editor", $utenteCreato->ruoli)): ?>
            <form method="post">

                <input type="hidden" name="auth_nome" value="<?php echo $utenteCreato->getNome('1234') ?>">
                <input type="hidden" name="auth_email" value="<?php echo $utenteCreato->getEmail() ?>">
                <?php foreach($utenteCreato->ruoli as $r): ?>
                    <input type="hidden" name="auth_ruoli[]" value="<?php echo $r; ?>" >
                <?php endforeach; ?>

                <input type="text" name="titolo" placeholder="Inserisci il titolo" require>
                <input type="text" name="contenuto" placeholder="Inserisci il contenuto" require>
                
                <input type="submit" name="pubblica_post" value="Crea post">
            </form>
        <?php else: ?>
            <p>Sei un utente USER non puoi creare i post</p>
        <?php endif ?>
    <?php endif ?>

    <div>
        <?php echo $messaggio ?>
    </div>
</body>
</html>
