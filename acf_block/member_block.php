<?php
$heading     = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$paragraph   = (function_exists('get_field') && $paragraph = get_field('paragraph')) ? $paragraph : '';
$btn_text   = (function_exists('get_field') && $btn_text = get_field('btn_text')) ? $btn_text : 'See more';
$button_link   = (function_exists('get_field') && $button_link = get_field('button_link')) ? $button_link : '/member';
$number_of_member   = (function_exists('get_field') && $number_of_member = get_field('number_of_member')) ? $number_of_member : '6';
$args = array(
    'post_type'             => 'member',
    'posts_per_page'        => '-1',
    'post_status'           => array('publish'),
    'meta_key'      => 'members_type_of_member',
    'meta_value'    => '13'
    // Person tag_Id 13
);

$the_query = new WP_Query($args);

?>

<section class="member_block member-person pt-10 sm:pt-14 md:pt-20">
    <div class="container">
        <div class="md:flex gap-x-16">
            <div class="md:max-w-[50%] md:mt-20 mb-8 md:mb-0">
                <h2 class="text-n-100 font-bold sm:max-w-[260px] text-center sm:text-start">
                    <?php echo $heading; ?>
                </h2>
                <div class="text-n-80 mt-4 mx-auto text-base sm:text-lg mb-8 md:mb-12">
                    <?php echo $paragraph; ?>
                </div>
                <a href="<?php echo $button_link; ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                    <?php echo $btn_text; ?>
                    <?php echo useSvg('right-arrow') ?>
                </a>
            </div>
            <?php
            if ($the_query->have_posts()) { ?>
            <div class="member-animation">
                <div class="member-data">
                    <div class="left-side-data -mt-28">
                        <?php
                            $i = 0;
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                $id = get_the_ID();
                                $logoprofile_photo = get_field('members', $id)['logoprofile_photo'];
                                $type_of_member = get_field('members', $id)['type_of_member'];
                                if ($i % 2 == 0) {
                            ?>
                        <div id="member_<?php echo $id; ?>" class="member-item mb-6">
                            <div class="pt-[124%] relative overflow-hidden rounded-3xl homepage-member-container">
                                <img src="<?php echo ($logoprofile_photo) ? $logoprofile_photo : get_template_directory_uri() . '/dist/images/default-post-img.jpg'; ?>"
                                    alt="member-image"
                                    class=" absolute top-0 h-full w-full object-cover rounded-2xl transition-all duration-300 ">
                            </div>
                            <h4 class="mt-2 lg:mt-4 font-bold">
                                <p class="text-n-100">
                                    <?php echo get_the_title(); ?>
                            </h4>
                        </div>

                        <?php
                                }
                                $i = $i + 1;
                            }
                            ?>
                    </div>
                    <div class="right-side-data">
                        <?php
                            $i = 0;
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                $id = get_the_ID();
                                $logoprofile_photo = get_field('members', $id)['logoprofile_photo'];
                                $type_of_member = get_field('members', $id)['type_of_member'];
                                if ($i % 2 != 0) {
                            ?>
                        <div id="member_<?php echo $id; ?>" class="member-item mb-6">
                            <div class="pt-[124%] relative overflow-hidden rounded-3xl homepage-member-container">
                                <img src="<?php echo ($logoprofile_photo) ? $logoprofile_photo : get_template_directory_uri() . '/dist/images/default-post-img.jpg'; ?>"
                                    alt="member-image"
                                    class=" absolute top-0 h-full w-full object-cover rounded-2xl transition-all duration-300 ">
                            </div>
                            <h4 class="mt-2 lg:mt-4 font-bold">
                                <p class="text-n-100">
                                    <?php echo get_the_title(); ?>
                            </h4>
                        </div>
                        <?php
                                }
                                $i = $i + 1;
                            }
                            ?>
                    </div>
                </div>
            </div>

            <?php
            }
            // Reset Post Data
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>