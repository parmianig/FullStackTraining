<?php
session_start();

$usernameErr = '';
$emailErr = '';
$passwordErr = '';
$formErr = '';

$username = '';
$email = '';
$password = '';
$role = 'user';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if ($username === '') {
        $usernameErr = 'Inserisci un username';
    }

    if ($email === '') {
        $emailErr = 'Inserisci una email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Inserisci una email valida';
    }

    if ($password === '') {
        $passwordErr = 'Inserisci una password';
    } elseif (strlen($password) < 6) {
        $passwordErr = 'La password deve avere almeno 6 caratteri';
    }

    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        $_SESSION['utente'] = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'loggato' => true
        ];

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
    <form class="form" method="post">

      <!--<form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      -->

      <?php if (!empty($formErr)) : ?>
        <span class="error"><?php echo $formErr; ?></span>
      <?php endif; ?>

      <h2>Registrati</h2>

      <div class="form-row">
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Scrivi nome utente"
            value="<?php echo htmlspecialchars($username); ?>">
          <?php if (!empty($usernameErr)) : ?>
            <span class="error"><?php echo $usernameErr; ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="text"
            id="email"
            name="email"
            placeholder="Scrivi email utente"
            value="<?php echo htmlspecialchars($email); ?>">
          <?php if (!empty($emailErr)) : ?>
            <span class="error"><?php echo $emailErr; ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-group full-width">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Scrivi password">
        <?php if (!empty($passwordErr)) : ?>
          <span class="error"><?php echo $passwordErr; ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group full-width">
        <label for="role">Role</label>
        <select id="role" name="role">
          <option value="admin" <?php echo $role === 'admin' ? 'selected' : ''; ?>>ADMIN</option>
          <option value="user" <?php echo $role === 'user' ? 'selected' : ''; ?>>USER</option>
          <option value="editor" <?php echo $role === 'editor' ? 'selected' : ''; ?>>EDITOR</option>
        </select>
      </div>

      <div class="button-row">
        <input type="submit" value="Registrati">
      </div>
    </form>
  </div>

  <table class="table">
    <tr>
      <th>Chiave</th>
      <th>Valore< /th>
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