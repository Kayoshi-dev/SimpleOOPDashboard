<?php

class Http {
    public static function redirect(string $path, ?string $option = null) {
        header('Location: ' . $path . '&etat=' . $etat = $option);
        die();
    }
}