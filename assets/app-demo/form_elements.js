$(function(){
	'use strict';

	$('.form-theme').on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			box = $this.parent().parent().parent().parent().parent(),
			form = box.find('[role="form"]'),
			fieldset = form.find('fieldset'),
			form_controls = form.find('.form-control'),
			buttons = form.find('.btn'),
			theme = $this.attr('data-toggle');

		if (theme == 'default') {
			form_controls.removeClass('form-flat form-ion');
			buttons.removeClass('btn-flat btn-ion');
		}
		else if(theme == 'flat'){
			form_controls.removeClass('form-ion');
			form_controls.addClass('form-flat');

			buttons.removeClass('btn-ion');
			buttons.addClass('btn-flat');
		}
		else if(theme == 'ion'){
			form_controls.removeClass('form-flat');
			form_controls.addClass('form-ion');

			buttons.removeClass('btn-flat');
			buttons.addClass('btn-ion');
		}
		else if(theme == 'disabled-fieldset'){
			if (fieldset.is(':disabled'))
				fieldset.prop('disabled', false);
			else
				fieldset.prop('disabled', true);
		}
		else{
			form_controls.addClass('form-flat form-ion');

			buttons.removeClass('btn-flat');
			buttons.addClass('btn-ion');
		}
	})
})