(function($, undefined){
    $(function(){
        
        $('.fancybox').fancybox({
            openEffect : 'fade',
            closeEffect : 'fade',
            nextEffect : 'fade',
            prevEffect : 'fade'
        });
        
	$(".various").fancybox({
            maxWidth	: 800,
            maxHeight	: 600,
            fitToView	: false,
            width : '70%',
            height : '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
	});
        
        // :contains без учета регистра
        jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function(arg) {
            return function( elem ) {
                return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });
        
        //Поиск по видео
        $('input.searchVideo').keyup(function(){
            var searchText = $(this).val();
            var video = $('.youtube');
            
            if (searchText.length > 2) {                
                video.hide();                
                video.find('.text-info:Contains("'+searchText+'")').closest('.youtube').show();
            } else {
                video.show();
            }
        });
        
        //Фильтр видео по категории
        $('select.filterVideo').change(function(){
            var category = $(this).val();
            var video = $('.youtube');
            
            if (category.length) {
                video.hide();
                video.filter('[data-category="'+category+'"]').show();
            } else {
                video.show();
            }

        });
        
        //Поиск по pdf
        $('input.searchPdf').keyup(function(){
            var searchText = $(this).val();
            var pdf = $('#presentation .block-pdf');
            
            if (searchText.length > 2) {                
                pdf.hide();                
                pdf.find('.text-info:Contains("'+searchText+'")').closest('.block-pdf').show();
            } else {
                pdf.show();
            }
        });
        
        //Фильтр pdf по категории
        $('select.filterPdf').change(function(){
            var category = $(this).val();
            var pdf = $('#presentation .block-pdf');
            
            if (category.length) {
                pdf.hide();
                pdf.filter('[data-category="'+category+'"]').show();
            } else {
                pdf.show();
            }

        });

    });
})(jQuery);