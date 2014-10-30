(function($, undefined){
    $(function(){
        
        $('a.login').click(function(){
            
            $(this).closest('div').hide();
            
            $('form.form-signin').show();
            
        });
        
    });
})(jQuery);