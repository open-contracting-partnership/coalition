<?php
$heading     = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$paragraph   = (function_exists('get_field') && $paragraph = get_field('paragraph')) ? $paragraph : '';
$who_we_are   = (function_exists('get_field') && $who_we_are = get_field('who_we_are')) ? $who_we_are : '';
$args = array(
    'post_type'             => 'member',
    'posts_per_page'        => '-1',
    'post_status'           => array('publish'),
    'meta_key'      => 'members_type_of_member',
    'meta_value'    => '12'
    // Organization tag_Id 12

);

$the_query = new WP_Query($args);
?>

<section class="member-organization who_we_are_block pt-[1px] pb-10 sm:pb-14 md:pb-20">
    <div class="container">
        <h2 class="text-center text-n-100 font-bold">
            <?php echo $heading; ?>
        </h2>
        <div class="slider-container">
            <div class="my-10 sm:my-14 md:my-20 flex justify-around members-slider">
                <?php
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $id = get_the_ID();
                        $logoprofile_photo = get_field('members', $id)['logoprofile_photo'];
                        $website = get_field('members', $id)['website'];
                        $type_of_member = get_field('members', $id)['type_of_member'];
                        // if ($type_of_member == 'Organization') {
                ?>
                <div>
                    <a href="<?php echo $website; ?>" target="_blank" class="flex items-center justify-center">
                        <img src="<?php echo ($logoprofile_photo)?$logoprofile_photo:get_template_directory_uri() . '/dist/images/default-post-img.jpg'; ?>"
                            alt="member-organization-logo" class="max-h-14 transition-all duration-300 ">
                    </a>
                </div>
                <?php
                        // }
                    }
                }
                // Reset Post Data
                wp_reset_postdata();
                ?>
            </div>
            <div class="slider-navigation">
                <div class="slick-arrow prev"></div>
                <div class="slick-arrow next"></div>
            </div>
        </div>
        <div class="text-n-50 text-center max-w-[748px] mt-4 mx-auto text-base sm:text-lg">
            <?php echo $paragraph; ?>
        </div>
    </div>
</section>