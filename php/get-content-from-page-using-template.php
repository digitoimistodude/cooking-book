<?php

function siteprefix_function_get_from_template() {

	// check if data id cached in transient, return cached data if is
	$contact = get_transient( 'siteprefix_content_from_template' );
	if ( ! empty( $contact ) ) {
		return $contact;
	}

	// get all pages with specific template
	$pages = get_pages( array(
		'meta_key'		=> '_wp_page_template',
		'meta_value'	=> 'template-contact.php'
	) );

	// no pages, bail
	if ( empty( $pages ) ) {
		return false;
	}

	// get first (usually also only) page
	$post_id = $pages[0]->ID;

	// get data
	$title = get_the_title( $post_id );

	$return = array(
		'title'	=> $title,
	);

	// cache library hours for one day
	set_transient( 'siteprefix_content_from_template', $return, MONTH_IN_SECONDS );

	// retrun
	return $return;
}
