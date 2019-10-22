/*
* @Author: Timi Wahalahti
* @Date:   2019-10-22 16:06:26
* @Last Modified by:   Timi Wahalahti
* @Last Modified time: 2019-10-22 16:09:46
*/

// search functions
function search_fn( search ) {
  if ( search.length ) {
    var Result = {
      list: [],
      loadList: function() {
        return m.request( {
          method: 'GET',
          url: rest_api_settings.root + 'wpfi/v1/search?s=' + search,
          withCredentials: true,
        } )
        .then( function( result ) {
          Result.list = result;
        } )
      }
    }

    var ResultList = {
      oninit: Result.loadList,
      view: function() {
        return m( '.search-results', [
          m( 'ul', Result.list.map( function( result ) {
            return m( 'li', [
              m( 'h2', { id: 'heading-' + result.id, class: 'search-title underlined-hover' }, [
                m( 'a', { href: result.permalink }, result.title ),
              ] ),
            ] );
          } ) )
        ] )
      }
    }

    m.mount( document.getElementById('search-results'), ResultList );
  }
}

// debounce search
var search_fn_debounced = debounce( function() {
  search_fn( jQuery(this).val().toLowerCase() );
}, 250 );

// trigger searh functionality
jQuery('.overlay-search input').on( 'input', search_fn_debounced );
