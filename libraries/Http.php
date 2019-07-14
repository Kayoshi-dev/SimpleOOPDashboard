<?php

class Http {
    public static function redirect(string $path, ?string $option = null) {
        if($option != null) {
            header('Location: ' . $path . '&etat=' . $etat = $option);
        } else {
            header('Location: ' . $path);
        }
        die();
    }
}