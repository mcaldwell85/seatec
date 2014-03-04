$(function(){
	'use strict';
	// panel refresh
    $('.panel [data-refresh]').on('click', function(){
        var $this = $(this),
            panel = $this.attr('data-refresh');

        setTimeout(function(){
            $(panel).find('.panel-progress').remove();  // remove proggress spinner
        }, 1000 );
    });

	$('.button-theme').on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			panel = $this.parent().parent().parent().parent().parent().parent(),
			buttons = panel.find('.panel-body').find('.btn'),
			theme = $this.attr('data-toggle');

		if (theme == 'flat') {
			buttons.removeClass('btn-ion');
			buttons.addClass('btn-flat');
		}
		else if(theme == 'ion'){
			buttons.removeClass('btn-flat');
			buttons.addClass('btn-ion');
		}
		else{
			buttons.removeClass('btn-flat btn-ion');
		}
	})
})