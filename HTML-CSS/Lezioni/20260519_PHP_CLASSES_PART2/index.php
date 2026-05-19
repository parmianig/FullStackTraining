<?php
declare(strict_types=1);

require_once __DIR__ . '/persona.php';
require_once __DIR__ . '/post.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$utenteCreato = $_SESSION['utente_creato'] ?? null;
$ultimoPostData = $_SESSION['ultimo_post'] ?? null;
$messaggio = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message'], $_SESSION['ultimo_post']);

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function hasPublishAccess(Persona $utente): bool
{
    return $utente->hasRole('admin') || $utente->hasRole('editor');
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progetto PHP</title>
</head>

<body>
    <?php if ($messaggio !== ''): ?>
        <div style="padding:10px; border:1px solid #4caf50; background:#e8f5e9; margin-bottom:1rem;">
            <?php echo $messaggio; ?>
        </div>
    <?php endif; ?>

    <?php if (!$utenteCreato instanceof Persona): ?>
        <h2>Registrazione utente</h2>
        <form action="register.php" method="post">
            <input type="hidden" name="action" value="register">

            <div>
                <label for="nome">Nome</label><br>
                <input id="nome" type="text" name="nome" required maxlength="100">
            </div>

            <div>
                <label for="email">Email</label><br>
                <input id="email" type="email" name="email" required>
            </div>

            <div>
                <label for="ruoli">Ruoli</label><br>
                <select id="ruoli" name="ruoli[]" multiple required size="3">
                    <option value="user">Utente semplice</option>
                    <option value="editor">Utente editore</option>
                    <option value="admin">Utente admin</option>
                </select>
            </div>

            <fieldset>
                <legend>GENERE:</legend>
                <label for="maschio">
                    <input type="radio" name="genere" id="maschio">
                    Maschio
                </label>
                <label for="femmina">
                    <input type="radio" name="genere" id="femmina">
                    Femmina
                </label>
                
            </fieldset>
            <input type="submit" name="crea_persona" value="Registrati">
        </form>
    <?php else: ?>

        <p>
            <?php $utenteCreato->activate()
        </p>
        <section>
            <h2>Benvenuto, <?php echo escape($utenteCreato->getNome()); ?></h2>
            <p>Email: <?php echo escape($utenteCreato->getEmail()); ?></p>
            <p>Ruoli: <?php echo escape(implode(', ', $utenteCreato->getRuoli())); ?></p>
            <p>Stato: <?php echo escape($utenteCreato->getStato()); ?></p>
        </section>

        <?php if (hasPublishAccess($utenteCreato)): ?>
            <section>
                <h3>Crea un nuovo post</h3>
                <form action="register.php" method="post">
                    <input type="hidden" name="action" value="publish_post">

                    <div>
                        <label for="titolo">Titolo</label><br>
                        <input id="titolo" type="text" name="titolo" required maxlength="150">
                    </div>

                    <div>
                        <label for="contenuto">Contenuto</label><br>
                        <textarea id="contenuto" name="contenuto" rows="5" required></textarea>
                    </div>

                    <button type="submit">Pubblica post</button>
                </form>
            </section>
        <?php else: ?>
            <p>Non hai il permesso per creare post. Solo admin e editor possono farlo.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (is_array($ultimoPostData) && isset($ultimoPostData['titolo'], $ultimoPostData['contenuto'])): ?>
        <?php
            $post = new Post($ultimoPostData['titolo'], $ultimoPostData['contenuto'], $utenteCreato);
            require __DIR__ . '/views/post_view.php';
        ?>
    <?php endif; ?>
</body>

</html>