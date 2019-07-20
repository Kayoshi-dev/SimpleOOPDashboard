<?php

if(!isset($_GET['id'])) {
    \Http::redirect('index.php?controller=user&task=show');
} else {
    if($data->profilepic != null) {
        $picName = $data->profilepic;
    } else {
        $picName = 'default.jpg';
    }
}

?>

<h1>Modifier un utilisateur</h1>

</div>

<form method="POST" action="index.php?controller=user&task=update&id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
    <div class="image-upload mb-2 d-flex justify-content-center align-items-center" style="min-height: 200px; background-size: cover; background-image: url(public/upload/bannerpic/<?= 'default.jpg' ?>);">
        <label for="file-input">
            <img src="public/upload/profilepic/<?= $picName ?>" alt="defaultProfilePic" height="100" width="100" class="rounded-circle" id="previewImg">
            <!--<span class="text-content">Cliquer pour changer de photo de profil</span>-->
        </label>
        <input id="file-input" type="file" name="profilePic">
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