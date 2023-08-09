<?php

// get limit value then retuen post excerpt value of certain limit
function excerpt($limit = 115)
{
	$excerpt = get_the_excerpt();
	if ($excerpt) {
		$excerpt = substr($excerpt, 0,  $limit) . '...';
	}
	return $excerpt;
}

// get limit value then retuen post post_title value of certain limit
function post_title_limit($limit = 45)
{
	$post_title = get_the_title();
	if ($post_title) {
		$post_title = substr($post_title, 0,  $limit) . '...';
	}
	return $post_title;
}


// get post id and Taxonomy then return the string of all the taxonomy slug associated with post id 
function taxoTermsSLug($id, $taxonomy_val)
{
	$termsArray = get_the_terms($id, $taxonomy_val);
	$termsSLug = "";
	if ($termsArray) {
		foreach ($termsArray as $term) {
			$termsSLug .= $term->slug . ' ';
		}
	}
	return $termsSLug;
}

function taxoTermsName($id, $taxonomy_val)
{
	$termsArray = get_the_terms($id, $taxonomy_val);
	$termsName = "";
	if ($termsArray) {
		foreach ($termsArray as $term) {
			$termsName .= $term->name . ' ';
		}
	}
	return $termsName;
}

// Display svg icons  

if (!function_exists('useSvg')) {
	function useSvg($filename = 'long-arrow-right')
	{
		$icon = get_stylesheet_directory() . '/dist/images/icons/' . $filename . '.svg';

		$svg_icon_content = @file_get_contents($icon);

		return $svg_icon_content;
	}
}


// pagination
function main_query_pagination()
{

	global $wp_query, $svgIcon;

	$big = 999999999;

	$rightIcon = useSvg('page-navigation-next');
	$leftIcon = useSvg('page-navigation-prev');

	$paginate =  paginate_links(array(
		'prev_text'     => sprintf($leftIcon),
		'next_text'     => sprintf($rightIcon),
	));

	$html_paginate = "";

	if ($paginate) {
		$html_paginate .= '<div class="navigation pagination" role="navigation">';
		$html_paginate .=  '<div class="nav-links">';
		$html_paginate .=  $paginate;
		$html_paginate .=  '</div>';
		$html_paginate .=  '</div>';
	}
	return $html_paginate;
}

function custom_query_pagination($query, $paged)
{

	global $wp_query, $svgIcon;

	$big = 999999999;
	$rightIcon = useSvg('page-navigation-next');
	$leftIcon = useSvg('page-navigation-prev');

	$paginate = paginate_links(array(
		'base'         => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
		'total'        => $query->max_num_pages,
		'current'      => $paged,
		'format'       => '?paged=%#%',
		'show_all'     => false,
		'type'         => 'plain',
		'end_size'     => 4,
		'mid_size'     => 1,
		'prev_next'    => true,
		'prev_text'    => sprintf($leftIcon),
		'next_text'    => sprintf($rightIcon),
		'add_args'     => false,
		'add_fragment' => '',
	));

	$html_paginate = "";

	if ($paginate) {
		$html_paginate .= '<div class="navigation pagination" role="navigation">';
		$html_paginate .=  '<div class="nav-links">';
		$html_paginate .=  $paginate;
		$html_paginate .=  '</div>';
		$html_paginate .=  '</div>';
	}

	return $html_paginate;
}

function paged()
{
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	return $paged;
}

/**
 * =========================================================
 * Breadcrumb
 * =========================================================
 */

function breadcrumb_section($id)
{
	$posttype = get_post_type($id);
	$post_object = get_post_type_object($posttype);
	$labels = $post_object->labels;
	ob_start();
?>
	<div class="breadcrumb bg-n-10">
		<div class="breadcrumb-menu container">
			<div class="breadcrumb-menu__item">
				<a href="<?php echo home_url(); ?>">Home</a>
			</div>
			<div class="breadcrumb-menu__item">
				<?php
				if (is_singular()) {
				?>
					<a href="<?php echo get_post_type_archive_link($posttype); ?>">
						<?php echo  $labels->name; ?>
					</a>
				<?php
				} else {
					echo  $labels->name;
				}
				if (is_singular()) {
					// echo useSvg('page-navigation-next')
				?>
			</div>
			<div class="breadcrumb-menu__item">
			<?php
					echo get_the_title();
				}
			?>
			</div>
		</div>
	</div>

	<?php
	$outupt_breadcrumb_section = ob_get_contents();
	ob_end_clean();

	return $outupt_breadcrumb_section;
}

function custom_breadcrumb_section($id, $posttype, $labels)
{
	$display_breadcrumb     = (function_exists('get_field') && $display_breadcrumb = get_field('display_breadcrumb', $posttype . '_options')) ? $display_breadcrumb : '0';
	$default_breadcrumb     = (function_exists('get_field') && $default_breadcrumb = get_field('default_breadcrumb', $posttype . '_options')) ? $default_breadcrumb : '0';
	$add_custom_breadcrumb     = (function_exists('get_field') && $add_custom_breadcrumb = get_field('add_custom_breadcrumb', $posttype . '_options')) ? $add_custom_breadcrumb : '';

	if ($display_breadcrumb && $default_breadcrumb) {
		echo breadcrumb_section($id);
	}
	if ($display_breadcrumb && !$default_breadcrumb && $add_custom_breadcrumb) {
	?>
		<div class="breadcrumb bg-n-10">
			<div class="breadcrumb-menu container">
				<?php
				foreach ($add_custom_breadcrumb as $key => $value) {
				?>
					<div class="breadcrumb-menu__item">
						<a href="<?php echo $value['link']; ?>"> <?php echo $value['item']; ?> </a>
					</div>
				<?php
				}
				?>
				<div class="breadcrumb-menu__item"> <?php echo  $labels->name; ?> </div>
			</div>
		</div>
<?php
	}
}


/**
 * =========================================================
 * Current URL
 * =========================================================
 */
if (!function_exists('get_current_page_link')) {
	function get_current_page_link()
	{
		global $wp;
		$url = home_url($wp->request);

		return $url;
	}
}

// get all the taxo for post types
function get_tax_post_type($posttype, $taxonomies)
{
	$args_campaign = array(
		'post_type'             => $posttype,
		'posts_per_page'        => '-1',
		'post_status'           => array('publish'),
	);
	$the_query = new WP_Query($args_campaign);
	$tax_post_type_array = [];
	$tax_post_type = [];
	$i = 0;
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$id = get_the_ID();
			$termsArray = get_the_terms($id, $taxonomies);
			if ($termsArray) {
				foreach ($termsArray as $term) {
					if (!in_array($term->slug, $tax_post_type_array)) {
						array_push($tax_post_type_array, $term->slug);
						$tax_post_type[$i]['slug'] = $term->slug;
						$tax_post_type[$i]['name'] = $term->name;
						$i=$i+1;
					}
				}
			}
		}
	}
	wp_reset_postdata();

	return $tax_post_type;
}
