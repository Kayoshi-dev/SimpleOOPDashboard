<?php


namespace Controllers;


class Widget extends Controller {

    protected $modelName = \Models\Widget::class;

    public function widgetSection () {
        \Renderer::Render('users/widget');
    }

    public function editWidgetState() {
        $widgetId = base64_decode($_GET['appid']);
    }
}