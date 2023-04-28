<?php

/**==============================
 * Current term object
 ================================*/
$id = get_the_ID();
$posttype = get_post_type($id);
$post_object = get_post_type_object($posttype);
$taxonomies = 'country';
// $terms = get_terms(['taxonomy' =>  $taxonomies]);
$terms = get_tax_post_type($posttype,$taxonomies);

/**==============================
 * Url Parameters
 ================================*/
$_GET_campaign = (isset($_GET["campaign_post"])) ? $_GET["campaign_post"] : '';
$_GET_country = (isset($_GET["taxonomy_country"])) ? $_GET["taxonomy_country"] : '';

/**
 *  campaign Filter
 */
$campaign_filter_data = [];
$args_campaign = array(
    'post_type'             => $posttype,
    'posts_per_page'        => '-1',
    'post_status'           => array('publish'),
);
$the_query = new WP_Query($args_campaign);
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $id = get_the_ID();
        $realted_campaign = get_field('realted_campaign')['realted_campaign'];
        if ($realted_campaign) {
            foreach ($realted_campaign as $key => $campaign_val_id) {
                if (!in_array($campaign_val_id, $campaign_filter_data)) {
                    array_push($campaign_filter_data, $campaign_val_id);
                }
            }
        }
    }
}
wp_reset_postdata();

?>

<?php echo breadcrumb_section($id); ?>

<div class="container">
    <div class="flex flex-wrap gap-x-6">
        <form method="GET" role="search" class="campaign-filter md:flex gap-x-8"
            action="<?php echo home_url() . '/' . $posttype; ?> " id="filter-form">
            <?php if ($campaign_filter_data) { ?>
            <div class="mt-8">
                <p class="text-n-60">Filter <?php echo str_replace('_', ' ', $posttype); ?> by campaign: </p>
                <div
                    class="<?php echo $posttype; ?>-campaign archive-accordion-campaign archive-accordion-category flex flex-wrap gap-2 sm:gap-4 mt-2">
                    <p class="campaign-item category-item <?php echo ($_GET_campaign) ? '' : 'active'; ?>"
                        data-filter="*">
                        <label class="filter-input">
                            <input class="yi-input-radio " type="radio" name="campaign_post" value=""
                                style="display: none">
                            <span>All</span>
                        </label>
                    </p>
                    <?php
                        foreach ($campaign_filter_data as $key => $value_id) {
                            $active_campaign_class =  ($_GET_campaign == $value_id) ? 'active' : '';
                            $checked_campaign = ($_GET_campaign == $value_id) ? 'checked' : '';
                        ?>
                    <p class="campaign-item category-item <?php echo $active_campaign_class; ?> "
                        data-filter="<?php echo '.campaign-' . $value_id; ?>">
                        <label class="filter-input">
                            <input class="yi-input-radio" type="radio" name="campaign_post"
                                value="<?php echo $value_id; ?>" <?php echo $checked_campaign; ?> style="display: none">
                            <span><?php echo get_the_title($value_id); ?></span>
                        </label>
                    </p>
                    <?php
                        }
                        ?>
                </div>
            </div>
            <?php
            }
            /**
             *  country Filter
             */
            if ($terms) { ?>
            <div class="mt-6 md:mt-8">
                <p class="text-n-60">Filter <?php echo str_replace('_', ' ', $posttype); ?> by country: </p>
                <div class="<?php echo $posttype; ?>-country ">
                    <select name="taxonomy_country" id="country-filter"
                        class="mt-2 py-[2px] pl-2 pr-7 rounded-xl border border-teal transition-all duration-300 hover:border-n-60 cursor-pointer">
                        <option value="" class="filter-input">Select a country</option>
                        <?php
                            foreach ($terms as $key => $term) {
                                $select_country = ($_GET_country == $term['slug']) ? 'selected' : '';
                            ?>
                        <option class="filter-input" data-filter="<?php echo "." . $term['slug']; ?>"
                            value="<?php echo $term['slug']; ?>" <?php echo $select_country;  ?>>
                            <?php echo $term['name']; ?> </option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
            </div>
            <?php } ?>
        </form>
    </div>
    <?php
    /**
     *  current page post data list
     */
    $paged = paged();
    $posts_per_page = 12;
    $args = array(
        'post_type'             => $posttype,
        'post_status'           => array('publish'),
        'posts_per_page'        => $posts_per_page,
        'paged'                 =>   $paged,
    );
    if ($_GET_campaign) {
        $meta_query = array(
            'meta_query'    => array(
                'relation'      => 'OR',
                array(
                    'key'       => 'realted_campaign_realted_campaign',
                    'value'     => $_GET_campaign,
                    'compare'   => 'LIKE'
                )
            )
        );
        $args = array_merge($args, $meta_query);
    }
    if ($_GET_country) {
        $tax_query = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'country',
                    'field' => 'slug',
                    'terms' => $_GET_country,
                )
            )
        );
        $args = array_merge($args, $tax_query);
    }
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
    ?>
    <div class="<?php echo $posttype; ?> archive-accordion py-8 w-full">
        <?php
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $id = get_the_ID();
                $permalink = get_the_permalink($id);
                $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default-post-img.jpg';
                $excerpt = excerpt(115);
                $title = get_the_title();
                $realted_campaign = get_field('realted_campaign')['realted_campaign'];
                $campaign_id = ' ';
                $campaign_filter_data = [];
                if ($realted_campaign) {
                    foreach ($realted_campaign as $key => $campaign) {
                        $campaign_id .= 'campaign-' . $campaign . ' ';
                    }
                }
                $taxoTermsSLug = taxoTermsSLug($id, $taxonomies);
            ?>
        <div class="<?php echo $campaign_id;
                            echo $taxoTermsSLug; ?> archive-accordion-items p-5 border border-n-40 rounded-3xl"
            data-id="<?php echo $id; ?>">
            <div class="accordion-card-inside ">

                <div>
                    <a href="<?php echo $permalink; ?>">
                        <div class="pt-[63%] relative">
                            <img src="<?php echo $feature_img; ?>" alt="feature-image"
                                class="absolute h-full w-full object-cover top-0 rounded-[20px]">
                        </div>
                    </a>
                </div>
                <div>
                    <div class="mt-6"> <a href="<?php echo $permalink; ?>"
                            class="text-2xl font-bold card-title-hover leading-none sm:leading-normal">
                            <?php echo $title; ?></a> </div>
                    <div class="mt-2 text-n-60 text-sm"> <?php echo $excerpt; ?> </div>
                    <div class="mt-4">
                        <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                            Learn More
                            <?php echo useSvg('right-arrow') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
            }
            ?>
    </div>
    <?php
        // echo main_query_pagination();
        echo custom_query_pagination($the_query, $paged);
    } else {
    ?>
    <div class="py-10 sm:py-14 lg:py-20">
        <?php
            $data_no_result = '';
            if ($_GET_campaign && $_GET_country) {
                $country_name = get_term_by('slug', $_GET_country, $taxonomies);
                $data_no_result .= 'campaign: "' . get_the_title($_GET_campaign) . '" and country: "' .$country_name->name  . '" ';
            } else if ($_GET_campaign) {
                $data_no_result .= 'campaign: "' . get_the_title($_GET_campaign) . '"';
            } else if ($_GET_country) {
                $country_name = get_term_by('slug', $_GET_country, $taxonomies);
                $data_no_result .= 'country: "' . $country_name->name . '"';
            }
            ?>
        <h3 class="font-medium text-n-80">No data availabe for selected <?php echo $data_no_result; ?></h3>
    </div>
    <?php
    }
    wp_reset_postdata();
    ?>
</div>

<script>
jQuery(function($) {
    $('.filter-input').click(function() {
        $('form').submit();
    });
    $("#country-filter").change(function() {
        $('form').submit();
    });
});
</script>