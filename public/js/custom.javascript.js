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

        if (iKeyCode !== 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) && iKeyCode !== 188) {
            if($(this).next('span').length === 0 ) {
                $($error).insertAfter($(this));
            }
            return false;
        }else{
            $(this).next('span').remove();
        }
    });
});
