<?php


// set posts_per_page for post

function filter_main_query($query)
{
	if( $query->is_main_query() && is_post_type_archive( 'member' )){
		// post per pagination
		$post_per_page = -1;
		$query->set('posts_per_page', $post_per_page);
	}
	else if ($query->is_main_query() && is_post_type_archive() ) {
		// post per pagination
		$post_per_page = 12;
		$query->set('posts_per_page', $post_per_page);
	}
	else if (is_search()){
		// post per pagination
		$post_per_page = 9;
		$query->set('posts_per_page', $post_per_page);
	}
}
add_action('pre_get_posts', 'filter_main_query', 11);
