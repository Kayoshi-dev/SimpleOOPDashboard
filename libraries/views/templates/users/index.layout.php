<?php
    $widget = new \Controllers\Widget();
    $data = $widget->showActiveWidget();
    $widgetData = new \Models\Widget();

?>

<div class="row">
    <h1 class="d-inline-block">Accueil</h1>
    <a href="?controllers=widget&task=widgetSection" class="btn btn-outline-primary">Choisir des widgets</a>
</div>

</div>

<div class="container-fluid">
    <div class="row-eq-height mb-3">
        <?php
        foreach ($data as $activeWidget):
            $resultCommand = $widgetData->doCommand($activeWidget->id);?>
            <div class="col-md-3" id="<?= base64_encode($activeWidget->widget_name); ?>">
                <div class="card border-primary">
                    <div class="card-header"><h5> <?= $activeWidget->widget_name ?></h5></div>
                    <div class="card-body">
                        <p class="card-text"> <?= $resultCommand ?></p>
                    </div>
                </div>
            </div>

        <?php endforeach;?>
    </div>
</div>
