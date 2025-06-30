<!-- ajouter le code PHP pour afficher un message -->
<?php
function afficherMessage($type, $message) {
    echo "<div class='alert alert-$type'>$message</div>";
}
?>
