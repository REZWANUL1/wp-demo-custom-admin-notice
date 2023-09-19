(function ($) {
	$(document).ready(function () {
		$("body").on("click", "#wdan_notice_success .notice-dismiss", function () {
			// alert("click");
			setCookie("dc-close", "1", 60);
		});
	});
})(jQuery);

function setCookie(cookieName, cookieValue, expiryInSeconds) {
	var expiry = new Date();
	expiry.setTime(expiry.getTime() + 1000 * expiryInSeconds);
	document.cookie =
		cookieName +
		"=" +
		escape(cookieValue) +
		"; expires=" +
		expiry.toGMTString() +
		"; path=/";
}
