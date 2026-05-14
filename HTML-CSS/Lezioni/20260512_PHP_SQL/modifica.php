<?php
require_once __DIR__ . '/DB/db_config.php';

$error = '';
if(!isset($_SESSION['utente_id'])) {
    header('Location: login.php');
    exit();
}

$id = sanifica($link, $_GET['id'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = sanifica($link, $_POST['nome'] ?? '');
    $email = sanifica($link, $_POST['email'] ?? '');
    $eta = sanifica($link, $_POST['eta'] ?? '');
    $citta = sanifica($link, $_POST['citta'] ?? '');

    $sql_update = "UPDATE utenti SET nome='$nome', email='$email', eta='$eta', citta='$citta' WHERE id='$_POST[id]'";
    if (mysqli_query($link, $sql_update)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Errore durante l'aggiornamento: " . mysqli_error($link);
        die ($error);
    }
}

$sql = "SELECT * FROM utenti WHERE id='$id'";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $utente = mysqli_fetch_assoc($result);
} else {
    $error = "Utente non trovato";
    die ($error);
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Utente</title>
    <style>
        * { box-sizing: border-box; font-family: sans-serif; }
        body { background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
        button { width: 100%; padding: 12px; background-color: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; }
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

<div class="box">

     <div class="<?php echo !empty($error) ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($error); ?>
    </div>


    <h2>Modifica Utente</h2>
    <form method="post">
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $utente['nome']; ?>" required>
        
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $utente['email']; ?>" required>
        
        <label>Età</label>
        <input type="number" name="eta" value="<?php echo $utente['eta']; ?>">
        
        <label>Città</label>
        <input type="text" name="citta" value="<?php echo $utente['citta']; ?>">
        
        <button type="submit">Aggiorna Dati</button>
    </form>
    <a href="dashboard.php" class="back-link">Annulla e torna indietro</a>
</div>

</body>
</html>


<?php
mysqli_close($link);

?>