($ => {
    /**
	 * Initialize validator
	 * https://jqueryvalidation.org/documentation/
	 */
	$('#formRegister').validate({
		errorClass: "is-invalid",
		validClass: "is-valid",
		rules: {
			name: {
				required: true,
				maxlength: 255,
			},  
			phone: {
				required: true,
                digits: true,
                minlength:10,
                maxlength:10
			},
		}
	});

    /**
     * Submit form
     * 
     * @param {Event} e
     * @returns {void}
     */
    $('#formRegister').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        if (! form.valid()) {
            return;
        }
        
        form.find('.wrap-url').hide();
		form.find('.spinner-border').show();

        const data = form.serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        API.post(API_ENDPOINTS.REGISTER, data).then(res => {
			form.find('.spinner-border').hide();

            if (! res) return;
            form.find('.wrap-url a').attr('href', '/dashboard/' + res);
            form.find('.wrap-url').show();
		});
    });
})(jQuery);