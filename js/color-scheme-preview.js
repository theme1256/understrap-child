(function ($) {
	var style = $('#ts-bootstrap-color-scheme-css'),
		api = wp.customize;

	if (!style.length) {
		style = $('head').append('<style type="text/css" id="ts-bootstrap-color-scheme-css" />')
			.find('#ts-bootstrap-color-scheme-css');
	}
	// Color Scheme CSS.
	api.bind('preview-ready', function () {
		api.preview.bind('update-color-scheme-css', function (css) {
			style.html(css);
		});
	});
})(jQuery);