$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idUser = button.data('iduser');
        let modal = $(this);
        modal.find('#deleteSection').empty();
        modal.find('#deleteSection').append('<a href="index.php?controller=user&task=delete&id=' + idUser + '" class="btn btn-danger" id="buttonDelete">Supprimer</a>');
    });

    $('.toast').toast('show');

    $("#searchMember").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#memberTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});