jQuery(document).ready(function($){

    /** Custimize the theme options behavior */
    $('#customize-controls').on('click', 'input[name="_customize-radio-show_on_front"]', function(){

        if($(this).val() == 'posts') {
            $('#customize-control-homepage_template').show();
        } else {
            $('#customize-control-homepage_template').hide();
        }
    });
});