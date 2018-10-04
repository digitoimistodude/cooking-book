var search = new Vue({
  el: '.search',
  data: {
    results: []
  }
});

$('input.search-field').on('input', debounce(function() {
  	var search_str = $('input.search-field').val();

  	if ( search_str === '' ) {
  		$('.search').removeClass('no-results');
  		$('body').removeClass('search-active');
		$('.search .item').remove();
  	} else {
  		$.ajax({
			url: wpfi.rest_baseurl + 'wpfi/v1/search?s=' + search_str,
			}).done(function( response ) {
				$('.search .item').remove();

			  if( response.length !== 0 && response !== false ) {
          jQuery.each( response, function() {
            var self = this;
            search.results.push(this);
          } );

          $('body').addClass('search-active');
          $('.search').removeClass('no-results');
        } else {
         	$('body').addClass('search-active');
        	$('.search').addClass('no-results');
        }
			});
  	}
	}, 300 ));

	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};
