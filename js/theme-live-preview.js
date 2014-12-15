jQuery(document).ready(function($){

    // Update the theme brand:
    wp.customize('display_theme_brand', function(value){
        value.bind(function(newval){
            $('#theme-brand').toggle(100);
        });
    });

    // Update the sharing buttons panel:
    wp.customize('display_sharing', function(value){
        value.bind(function(newval){
            $('.sharing').toggle(100);
        });
    });

    // Update the campaign date:
    wp.customize('display_single_campaign_date', function(value){
        value.bind(function(newval){
            $('.post-date').toggle(100);
        });
    });
// [name="_customize-radio-show_on_front"]
    $('#customize-controls').on('click', 'input', function(){
        console.log($(this).val())
    });
});