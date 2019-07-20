$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idUser = button.data('iduser');
        let modal = $(this);
        modal.find('#deleteSection').empty();
        modal.find('#deleteSection').append('<a href="index.php?controller=user&task=delete&id=' + idUser + '" class="btn btn-danger" id="buttonDelete">Supprimer</a>');
    });

    $('.toast').toast('show');

    // Function to find a member in the table
    $("#searchMember").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#memberTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $('body').on('click','#menu-icon',function(){
        // if the sidebar is visible then
        if($("#container-sidebar").is(":visible")) {
            $("#container-sidebar").hide();
            $("#main").addClass("col-md-12 ml-sm-auto col-lg-12").removeClass("col-md-9 col-lg-10");

        } else {
            $("#container-sidebar").show();
            $("#main").addClass("col-md-9 ml-sm-auto col-lg-10").removeClass("col-md-12 col-lg-12");
        }
    });

    function readURL(input, picId) {
        if(input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#' + picId).attr('src', e.target.result).hide().fadeIn(500);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Met à jour la photo de la bannière dès qu'un fichier de type image lui est transmis
    $('#banner-input').change(function() {
        readURL(this, 'bannerPicture');
    });

    $('#file-input').change(function() {
        readURL(this, 'previewImg');
    });

    // let labelID;
    // $('#bannerPicture').click(function() {
    //     alert('test');
    //     e.stopPropagation();
    //     labelID = $(this).attr('for');
    //     $('#'+labelID).trigger('click');
    // });
});

