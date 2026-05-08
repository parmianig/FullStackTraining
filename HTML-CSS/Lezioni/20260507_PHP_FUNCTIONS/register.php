<?php
session_start();

$nameErr = '';
$surnameErr = '';
$birthdayErr = '';
$etaErr = '';
$abbonamentoErr = '';
$weightErr = '';
$passwordErr = '';
$formErr = '';

$name = '';
$surname = '';
$birthday = '';
$eta = '';
$abbonamento = '';
$password = '';
$weight = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $birthday = trim($_POST['birthday'] ?? '');
    $eta = $_POST['eta'] ?? '';
    $password = $_POST['password'] ?? '';
    $abbonamento = $_POST['abbonamento'] ?? '';
    $weight = $_POST['weight'] ?? '';

    if ($name === '') {
        $nameErr = 'Inserisci il tuo nome';
    }

    if ($surname === '') {
        $surnameErr = 'Inserisci il tuo cognome';
    }

    if ($birthday === '') {
        $birthdayErr = 'Inserisci la tua data di nascita';
    }

    if ($password === '') {
        $passwordErr = 'Scrivi una password';
    }

    if ($eta === '') {
        $etaErr = 'Inserisci la tua età';
    }

    if ($abbonamento === '') {
        $abbonamentoErr = 'Scegli un abbonamento';
    }
    
    if ($weight === '') {
        $weightErr = 'Inserisci il tuo peso';
    }

    if (
        empty($nameErr) &&
        empty($surnameErr) &&
        empty($birthdayErr) &&
        empty($etaErr) &&
        empty($abbonamentoErr) &&
        empty($weightErr) &&
        empty($passwordErr)
    ) {
        $_SESSION['utente'] = [
            'name' => $name,
            'surname' => $surname,
            'birthday' => $birthday,
            'password' => $password,
            'eta' => $eta,
            'abbonamento' => $abbonamento,
            'peso' => $weight,
            'loggato' => true
        ];

        // evitare di ricaricare i dati nel form ad ogni refresh della pagina
        header('Location: home.php');
        exit();
    } else {
        $formErr = 'Controlla i campi compilati';
    }
}
?>
<?php if (isset($_SESSION['flash'])) : ?>
    <span class="success"><?php echo $_SESSION['flash']; ?></span>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <form class="form" method="post">

                <!--<form class="form" 
                    action="
                    <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
                    " method="post">
                -->

                <?php if (!empty($formErr)) : ?>
                    <span class="error"><?php echo $formErr; ?></span>
                <?php endif; ?>

                <h2>Registrati</h2>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="name">Nome</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Scrivi il tuo nome"
                            value="<?php echo htmlspecialchars($name); ?>">
                        <?php if (!empty($nameErr)) : ?>
                            <span class="error"><?php echo $nameErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group full-width">
                        <label for="surname">Cognome</label>
                        <input
                            type="text"
                            id="surname"
                            name="surname"
                            placeholder="Scrivi il tuo cognome"
                            value="<?php echo htmlspecialchars($surname); ?>">
                        <?php if (!empty($surnameErr)) : ?>
                            <span class="error"><?php echo $surnameErr; ?></span>
                        <?php endif; ?>
                    </div>


                    <div class="form-group full-width">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Scrivi la password">
                        <?php if (!empty($passwordErr)) : ?>
                            <span class="error"><?php echo $passwordErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group full-width">
                        <label for="birthday">Data di nascita</label>
                        <input
                            type="date"
                            id="birthday"
                            name="birthday"
                            placeholder="Scrivi la tua data di nascita">
                        <?php if (!empty($birthdayErr)) : ?>
                            <span class="error"><?php echo $birthdayErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group full-width">
                        <label for="eta">La tua età</label>
                        <input type="number" id="eta" name="eta" placeholder="Scrivi la tua età">
                        <?php if (!empty($etaErr)) : ?>
                            <span class="error"><?php echo $etaErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group full-width">
                        <label for="abbonamento">Abbonamento</label>

                        <div class="select-wrapper">
                            <select id="abbonamento" name="abbonamento">
                                <option value="">Scegli un abbonamento</option>
                                <option value="Mensile">MENSILE</option>
                                <option value="Trimestrale">TRIMESTRALE</option>
                                <option value="Annuale">ANNUALE</option>
                            </select>
                        </div>

                        <?php if (!empty($abbonamentoErr)) : ?>
                            <span class="error"><?php echo $abbonamentoErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group full-width">
                        <label for="weight">Il tuo peso</label>
                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            placeholder="Scrivi il tuo peso"
                            value="<?php echo htmlspecialchars($weight); ?>">
                        <?php if (!empty($weightErr)) : ?>
                            <span class="error"><?php echo $weightErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="button-cell full-width">
                        <button type="submit" class="btn">Registrati</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <tr>
            <th>Chiave</th>
            <th>Valore</th>
        </tr>
        <?php foreach ($_SERVER as $key => $value): ?>
            <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $value ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>