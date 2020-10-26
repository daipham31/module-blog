define([
	"jquery",
	"jquery/ui"
], function($){
	"use strict";

	function main(config, element) {
		var $element = $(element);
		var AjaxCommentPostUrl = config.AjaxCommentPostUrl;

		var dataForm = $('#contact-form');
		dataForm.mage('validation', {});

		$(document).on('click', '.submit', function() {
			if(dataForm.valid()) {
				event.preventDefault();
				var param = dataForm.serialize();
				alert(param);
				$.ajax({
					showLoader: true,
					url: AjaxCommentPostUrl,
					data: param,
					type: "POST"
				}).done(function(data) {
					if(data.result == "error"){
						$('.note').css('color', 'red');
						$('.note').html(data.message);
						return false;
					}				
				});
			}
		});
	};
	return main;
});
