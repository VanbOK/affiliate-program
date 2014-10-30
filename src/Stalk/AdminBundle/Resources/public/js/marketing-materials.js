(function($, undefined){
    $(function(){
        
        $('.deletePriceImage').click(function(){
            
            $(this).prev().remove();
            
            $(this).remove();

            $('input[id$="_priceImage"]').remove();
            
            return false;
            
        });

    });
})(jQuery);