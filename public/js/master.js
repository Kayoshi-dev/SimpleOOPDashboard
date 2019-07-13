$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idUser = button.data('iduser');
        var modal = $(this);
        modal.find('#deleteSection').empty();
        modal.find('#deleteSection').append('<a href="index.php?controller=user&task=delete&id=' + idUser + '" class="btn btn-danger" id="buttonDelete">Supprimer</a>');
    });

    $('.toast').toast('show');
});