<?php


namespace Controllers;


class Widget extends Controller {

    protected $modelName = \Models\Widget::class;

    public function showActiveWidget() {
        return $this->model->showActiveWidget();
    }

    public function widgetSection () {
        $pageTitle = 'Séléction d\'un widget';

        $data = $this->model->getWidget();

        \Renderer::Render('widgets/widget', compact('pageTitle', 'data'));
    }

    public function editWidgetState() {
        $appid = $_GET['appid'];
        $updateEtat = $_GET['active'];
        $this->model->updateWidget($appid, $updateEtat);

        $this->widgetSection();
    }
}