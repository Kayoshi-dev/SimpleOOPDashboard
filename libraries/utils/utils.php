<?php


namespace utils;


class utils
{
    public static function triggerToast(string $etat, ?string $message = '') {
        if($etat == 1) {
            $class = 'text-success';
            if($message) {
                $text = $message;
            } else {
                $text = 'Succès dans l\'execution de la requête';
            }
        } else {
            $class = 'text-danger';
            $text = 'Erreur dans l\'execution de la requête';
        }
        echo
        '<div class="toast" style="position: absolute;top:50px;right:0;" data-autohide="true" data-delay="2000">
            <div class="toast-header">
                <strong class="mr-auto ' . $class . '">Résultat</strong>
                <small class="text-muted">A l\'instant</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                ' . $text . '
            </div>
        </div>';
    }

    public static function sendMail(string $to, string $subject, string $message): void {
        $body = "
        <html lang='fr'>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <p>$message</p>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <maxime@SimpleDashboard.com>' . "\r\n";

        mail($to, $subject, $body, $headers);
    }
}