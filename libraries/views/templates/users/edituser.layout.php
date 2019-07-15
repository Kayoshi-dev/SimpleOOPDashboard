<?php

if(!isset($_GET['id'])) {
    \Http::redirect('index.php?controller=user&task=show');
}

?>

<h1>Modifier un utilisateur</h1>

</div>

<form method="post" action="index.php?afaire">
    <div class="image-upload text-center mb-2">
        <label for="file-input">
            <img src="public/img/default.jpg" alt="defaultProfilePic" height="100" width="100" class="rounded-circle">
            <!--<span class="text-content">Cliquer pour changer de photo de profil</span>-->
        </label>
        <input id="file-input" type="file">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Pseudo</label>
            <input type="text" class="form-control" id="inputEmail4" name="pseudo" placeholder="Pseudo" value="<?= $data->pseudo ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password" value="<?= $data->pass ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress">Adresse Mail</label>
        <input type="email" class="form-control" id="inputAddress" name="email" placeholder="raid@area51.com" value="<?= $data->email ?>" required>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Compte vérifié?
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>