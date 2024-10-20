($ => {
    /**
	 * EventHandler for the history button
	 */
	$('#history').on('click', function () {
        const url = getTokenFromUrl(window.location.href);
		if (! url) return;

		$(this).find('.spinner-border').show();
        $('.history-list-group').hide();

		API.get(API_ENDPOINTS.HISTORY, {url}).then(res => {
			$(this).find('.spinner-border').hide();
            if (!res) return;

            if (!res.length) {
                $('.history-list-group')
                    .html('<li class="list-group-item text-warning fw-bold">No history found</li>')
                    .show();
            } else {
                $('.history-list-group')
                    .html(res.map(item => `<li class="list-group-item text-uppercase text-${item.result == 'win' ? 'success': 'danger'} fw-bold">${item.result}: ${item.sum}</li>`).join(''))
                    .show();
            }
		})
	})

    /**
	 * EventHandler for the imfeelinglucky button
	 */
	$('#imfeelinglucky').on('click', function () {
		const url = getTokenFromUrl(window.location.href);
		if (! url) return;

		$(this).find('.spinner-border').show();
        $('.game-result, .history-list-group').hide();

		API.post(API_ENDPOINTS.IMFEELINGLUCKY, {url}).then(res => {
			$(this).find('.spinner-border').hide();

            if (!res) return;

            $('.game-result')
                .html(`<div class="alert alert-${res.result == 'win' ? 'success': 'danger'} fw-bold" role="alert">${res.result}: ${res.sum}</div>`)
                .show();
		});
	});

    /**
     * Get token from the url
     * 
     * @param {string} url
     * @returns {string}
     */
    const getTokenFromUrl = url => {
        const regex = /\/dashboard\/([^/]+)/; 
        const match = url.match(regex); 
    
        if (match && match[1]) {
            return match[1];
        }
    
        return null;
    }
})(jQuery);