<?php

if (!isset($post) || !$post instanceof Post) {
    return;
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
?>

<div style="border:1px solid #999; padding:1rem; margin:1rem 0;">
    <h2><?php echo escape($post->getTitolo()); ?></h2>
    <p><?php echo nl2br(escape($post->getContenuto())); ?></p>
    <small>Scritto da <strong><?php echo escape($post->getAutore()->getNome()); ?></strong></small>
</div>
