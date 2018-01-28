
(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.needed .validate-form').on('submit',function(){
        var check = true;
        if (input.length == 5) {
            var a = $(input[2]).val();
            var b = $(input[3]).val();
            if (a != b) {
                showValidate(input[3]);
                return false;
            }
        } else if (input.length == 4) {
            var a = $(input[1]).val();
            var b = $(input[2]).val();
            if (a != b) {
                showValidate(input[2]);
                return false;
            }
        }    
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });
    
    $('.notNeeded .validate-form').on('submit',function(){
        var check = true;
        var a = $(input[1]).val();
        var b = $(input[2]).val();
        if (a != "" && b!= "") {
            if (a != b) {
                showValidate(input[2]);
                return false;
            } 
        }
        return check;
    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);