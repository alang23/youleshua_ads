$(function() {

	//微信a标签缓存问题
	(function f_rand() {
		rand = Math.random();
		$('a').each(function() {
			href = $(this).attr('href');
			if (href.length == 0 || href.indexOf("javascript") > -1) return;
			else if (href.indexOf("?") > -1) {
				$(this).attr("href", href + "&" + rand);
			} else {
				$(this).attr("href", href + "?" + rand);
			}
		});
	})();

});