($ => {
    /**
     * Add a new method to jQuery validator
     * @param {jQuery} form 
     * @param {Validator} validator 
     */

    $.validator.clearErrors = (form, validator) => {
        validator.resetForm();
        form.find('.is-valid, .is-invalid').removeClass('is-invalid is-valid');
        form.find('.invalid-feedback').remove();
    }
})(jQuery);