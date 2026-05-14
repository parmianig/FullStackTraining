<?php
require_once __DIR__ . '/DB/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// gestione user loggato
$user_name = $_SESSION['user_name'] ?? 'Utente';
if (isset($_GET['elimina'])) {
    $id_elimina = sanifica($link, ($_GET['elimina']));
    $delete_user = "DELETE FROM utenti WHERE id = '$id_elimina'";
    mysqli_query($link, $delete_user);
    header('Location: dashboard.php');
    exit();
}

// recupero dati utenti
$sql = "SELECT id, nome, email, eta, citta FROM utenti";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Amministrativa</title>
    <style>
        * { box-sizing: border-box; font-family: sans-serif; }
        body { background-color: #f4f7f6; padding: 40px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 1000px; margin: auto; }
        h2 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; display: flex; justify-content: space-between; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #555; }
        
        .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 0.9rem; color: white; display: inline-block; }
        .btn-edit { background-color: #ffc107; color: #000; }
        .btn-delete { background-color: #dc3545; margin-left: 5px; }
        .btn-logout { background-color: #6c757d; font-size: 0.8rem; }
        
        tr:hover { background-color: #f1f1f1; }
    </style>

<body>

    <div class="container">
        <h2>
            Gestione Utenti
            <a href="logout.php" class="btn btn-logout">Esci</a>
        </h2>
        <p>Benvenuto, <strong><?php echo $_SESSION['user_name']; ?></strong>!</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Età</th>
                    <th>Città</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['eta']; ?></td>
                        <td><?php echo $row['citta']; ?></td>
                        <td>
                            <a href="modifica.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Modifica</a>
                            <a href="dashboard.php?elimina=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>


<?php
mysqli_close($link);

?>