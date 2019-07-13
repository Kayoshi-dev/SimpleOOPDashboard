<?php

class Renderer {
    public static function Render(string $path, array $variable = []) {
        extract($variable);

        ob_start();
        require('libraries/views/templates/' . $path . '.layout.php');
        $pageContent = ob_get_clean();

        require('libraries/views/layout.php');
    }
}