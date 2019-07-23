<h1>Ajouter un membre</h1>

</div>

<form method="post" action="index.php?task=add">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Pseudo</label>
            <input type="text" class="form-control" id="inputEmail4" name="pseudo" placeholder="Pseudo" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress">Adresse Mail</label>
        <input type="email" class="form-control" id="inputAddress" name="email" placeholder="raid@area51.com" required>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Compte vérifié?
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>