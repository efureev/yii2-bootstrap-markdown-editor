var appMdEditor = appMdEditor || {};

!(function ($) {
	"use strict";

	$(document).ready(function () {
		/***********************************************************************
		 *                              METHODS
		 **********************************************************************/
		appMdEditor.fixPreviewButton = function (e) {
			var previewButtonIcon = $(e.$textarea)
					.closest('div')
					.find('button[data-handler="bootstrap-markdown-cmdPreview"] span'),
				currentIconLib = e.$options.iconlibrary === 'glyph' ? 'glyphicon' : e.$options.iconlibrary;

			previewButtonIcon.addClass(currentIconLib);

			if (true === e.$isPreview) {
				previewButtonIcon
					.removeClass(e.$options.iconlibraryOff.join(' ') + ' glyphicon-search glyphicon-eye-open fa-eye')
					.addClass('glyphicon-eye-close fa-eye-slash')
				;
			} else {
				previewButtonIcon
					.removeClass(e.$options.iconlibraryOff.join(' ') + ' glyphicon-search glyphicon-eye-close fa-eye-slash')
					.addClass('glyphicon-eye-open fa-eye')
				;
			}
		};

		/***********************************************************************
		 *                          EVENTS HANDLER
		 **********************************************************************/
		appMdEditor.eventsHandler = function () {
			$('body').on('click', 'button[data-handler="bootstrap-markdown-cmdPreview"]', function () {
				if (typeof prettyPrint === 'function') {
					setTimeout(function () {
						var langClass = $(this).attr('class') || '';
						$('code').parent('pre').addClass('prettyprint linenums ' + langClass);
						prettyPrint();
					}, 150);
				}
			});
		};

		/***********************************************************************
		 *                               INIT
		 **********************************************************************/
		appMdEditor.init = function () {
			appMdEditor.eventsHandler();
		};
		appMdEditor.init();
	});
})(jQuery);