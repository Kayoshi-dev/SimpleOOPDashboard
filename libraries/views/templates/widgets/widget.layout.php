<h1>Séléction des widgets</h1>

</div>

<div class="container">
    <div class="row">
        <?php
            foreach ($data as $widget): ?>
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $widget->widget_name ?></h5>
                            <p class="card-text"> <?= $widget->widget_desc ?></p>
                            <?php $active = $widget->active ?>
                            <a href="?controllers=widget&task=editWidgetState&appid=<?= $widget->id ?>&active=<?= $active ?>" class="btn btn-outline-<?= $active == 0 ? 'success' : 'danger' ?>"><?= $active == 0 ? 'Ajouter !' : 'Supprimer !' ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</div>
