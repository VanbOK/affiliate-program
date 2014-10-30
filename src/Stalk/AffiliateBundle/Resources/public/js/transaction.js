(function($, undefined){
    $(function(){
        
        $('.toogle-income').click(function(){
            
            //Обнуляем
            $('tr.income').hide();            
            $('#income tr').removeClass('info');       
            $('.glyphicon-folder-open')
                .removeClass('glyphicon-folder-open')
                .addClass('glyphicon-folder-close');

            if ( $(this).is('.active') ) {
                
                $(this).removeClass('active').closest('tr').removeClass('info').next().hide();
                
            } else {
                
                $('.toogle-income').removeClass('active');
            
                $(this).addClass('active').closest('tr').addClass('info').next().show();            

                $(this).find('span')
                    .removeClass('glyphicon-folder-close')
                    .addClass('glyphicon glyphicon-folder-open');
            
            }
            
        });
        
        
        /*
         * Всплывающая форма заказа платежа
         */
        $('a[data-target="#paymentModal"]').click(function(){    
            $('[name="form[payment]"]').val($(this).attr('data-payment'));            
        });
        
        $('.contactModal').click(function(){            
            $('#paymentModal').modal('hide');            
            $('#contactModal').modal('show');            
        });
        
        $('.confirmationModal').click(function(){
            
            var modal = $('#confirmationModal');
            
            $('#contactModal').modal('hide');
            modal.modal('show'); 
            
            modal.find('.firstname').text($('[name="form[firstname]"]').val());
            modal.find('.surname').text($('[name="form[surname]"]').val());
            modal.find('.email').text($('[name="form[email]"]').val());
            modal.find('.phone').text($('[name="form[phone]"]').val());
            modal.find('.company').text($('[name="form[company]"]').val());            
            modal.find('.paymentMethod').text($('[name="form[paymentMethod]"] option:selected').text());
            modal.find('.payment').text($('[name="form[payment]"]').val());
        });
        
        $('.backContactModal').click(function(){
            $('#confirmationModal').modal('hide'); 
            $('#contactModal').modal('show');            
        });
        
        $('#confirmationModal .confirmationSend').click(function(){
            $('#confirmationModal').modal('hide'); 
            $('#successfulModal').modal('show');
        });

    });
})(jQuery);