define([
	"jquery",
	"jquery/ui",
	"loadcomment"
], function($, jqueryUi, loadcomment){
	"use strict";

	function main(config, element) {
		var $element = $(element);
		var AjaxCommentLoadUrl = config.AjaxCommentLoadUrl;

		var dataForm = $('#contact-form');
		dataForm.mage('validation', {});

		$(document).on('click', '.submit', function() {
			if(dataForm.valid()) {
				event.preventDefault();
				var param = dataForm.serialize();
				$.ajax({
					showLoader: true,
					url: AjaxCommentLoadUrl,
					data: param,
					type: "POST"
				}).done(function(data) {
					if(data.result== "error"){
						$('.note').css('color', 'red');
						$('.note').html(data.message);
						return false;
					}				
					document.getElementById('contact-form').reset();
					loadcomment.loadComments(config);
					$('.note').html(data.message);
					$('.note').css('color', 'green');
				});
			}
		});
	};
	return main;
});
