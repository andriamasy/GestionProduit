$(document).ready(function () {

    $html = '<p class="errorMessage" style="color: #dc3545">Veuillez rensegnier ce champ</p>';
    $error = ' <span class="error" style="color: red; ">* Veuillez Entre (0 - 9)</span>';
    /**
     * validation formulaire
     */
    $('#produit_Enregistrer').on('click', function() {

        $("input[required='required']").each(function (i) {
            if($(this).val() === '') {
                $(this).addClass('is-invalid');
                var error = $('.errorMessage');
                if(error.length === 0) {
                    $($html).insertAfter($(this));
                }
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(this),
                }, 200);
                return false;
            }
        })

    });
});
$(document).ready(function() {
    $(".only-numeric").bind("keypress", function (e) {
        var iKeyCode = e.which ? e.which : e.keyCode

        if (iKeyCode !== 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) ) {
            if($(this).next('span').length === 0 ) {
                $($error).insertAfter($(this));
            }
            return false;
        }else{
            $(this).next('span').remove();
        }
    });
});

/**
 * print file
 */
$(document).ready(function () {
    $('.printProduit').on('click', function () {
        var $id = $(this).attr('data-id');
        var $url = Routing.generate('api_produit_view', {id:$id});
        var title = $(this).attr('data-title');
        $.ajax({
            url : $url,
            type : "GET",
            data  : {},
            success: function (data) {
                printJS({
                    printable: data,
                    properties: ['Nom', 'Valeur'],
                    type: 'json',
                    header: '<h2 class="custom-h2">'+title+'</h2>',
                    style: '.custom-h2 { color: #17a2b8; }',
                    documentTitle: 'Detail Produit'
                })
            }
        })
    })
});

/**
 * sweet alert2 delete produit
 */
$(document).ready(function () {
    $('.deleteProduit').on('click', function () {
        var $id = $(this).attr('data-id');
        var $url = Routing.generate('produit_delete', {id:$id});
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Suppression',
            text: "Voulez vous vraiment supprimer ce Produit ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : $url,
                    data: {},
                    type: "DELETE",
                    success: function (data) {
                        if(!data.error){
                            swalWithBootstrapButtons.fire(
                                'Suppression!',
                                data.message,
                                'success'
                            ).then((response) => {
                                if (response.value) {
                                    var $urlProduitlist = Routing.generate('produit');
                                    window.location.href = $urlProduitlist;
                                }
                            })
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Suppression!',
                                data.message,
                                'cancel'
                            )
                        }
                    }
                });

            }
        })
    })
});

/**
 * edit produit Ajax
 */
$(document).ready(function () {
    $('.saveProduit').on('click', function () {
        var $form = $("#form_data");
        var $data = getFormData($form);
        var $urlEdit = Routing.generate('produit_edit');
        $.ajax({
            url : $urlEdit,
            data : $data,
            type : 'POST',
            success: function (value) {

            }
        });
    });

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }
});

/**
 * bootstrapSwitch
 */
$(document).ready(function () {
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
});

/**
 * ajax desactiver ou activer categorie
 */

$(document).ready(function () {
    $('.isActivated').on('switchChange.bootstrapSwitch', function (event, state) {
        let isActivated = $(this).prop('checked');
        let $url = Routing.generate('category_isActivated');
        let $id = $(this).attr('data-id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: isActivated ? "Activation!" : "Désactivation",
            text: "Voulez vous vraiment sur ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: $url,
                    data: {"isActivated" : isActivated, 'id': $id},
                    type: "POST",
                    success: function (data) {
                        if(data.code === 200){
                            swalWithBootstrapButtons.fire(
                                isActivated ? "Activation!" : "Désactivation",
                                data.message,
                                'success'
                            )
                        } else {
                            swalWithBootstrapButtons.fire(
                                isActivated ? "Activation!" : "Désactivation",
                                data.message,
                                'cancel'
                            )
                        }
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                event.preventDefault();
                //let state = $(this).bootstrapSwitch('state');
               location.reload();
            }
        })
    });
});

/**
 * delete category
 */
$(document).ready(function () {
    $('.isDeleteCategory').on('click', function () {
        let $id = $(this).attr('data-id');
        let $url = Routing.generate('category_delete', {id: $id});
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Suppression !!",
            text: "Voulez vous vraiment supprimer cet categorie ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: $url,
                    data: {},
                    type: "DELETE",
                    success: function (data) {
                        if(data.code === 200){
                            swalWithBootstrapButtons.fire(
                               "Suppression categorie",
                                data.message,
                                'success'
                            ).then((response) => {
                                if(response.value) {
                                    location.reload();
                                }
                            })
                        } else {
                            swalWithBootstrapButtons.fire(
                                "Suppression categorie",
                                data.message,
                                'cancel'
                            )
                        }
                    }
                });

            }
        })
    });
});

