<?php
$heading     = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$paragraph   = (function_exists('get_field') && $paragraph = get_field('paragraph')) ? $paragraph : '';
$btn_text   = (function_exists('get_field') && $btn_text = get_field('btn_text')) ? $btn_text : 'Learn more';
$view_all_news_btn   = (function_exists('get_field') && $view_all_news_btn = get_field('view_all_news_btn')) ? $view_all_news_btn : '';
$view_all_news_btn_link   = (function_exists('get_field') && $view_all_news_btn_link = get_field('view_all_news_btn_link')) ? $view_all_news_btn_link : '';
$number_of_news   = (function_exists('get_field') && $number_of_news = get_field('number_of_news')) ? $number_of_news : '6';

$args = array(
    'post_type'             => 'news',
    'posts_per_page'        => $number_of_news,
    'post_status'           => array('publish'),
);

$the_query = new WP_Query($args);

?>


<section class="news_block py-10 sm:py-14 md:py-20">
    <div class="container">
        <div>
            <h2 class="text-center text-n-100 font-bold">
                <?php echo $heading; ?>
            </h2>
            <div class="text-n-80 text-center max-w-[614px] mt-4 mx-auto text-base sm:text-lg">
                <?php echo $paragraph; ?>
            </div>
        </div>
        <?php
        if ($the_query->have_posts()) { ?>
        <div class="mt-8 sm:mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
            <?php
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $id = get_the_ID();
                    $excerpt = excerpt(100);
                    $post_title_limit = get_the_title();
                    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default-post-img.jpg';

                ?>
            <div id="news_<?php echo $id; ?>" class="p-5 border border-n-30 rounded-3xl news-card-hover">
                <div class="pt-[63.8%] relative">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <img src="<?php echo $feature_img; ?>" alt="news-image"
                            class=" absolute top-0 h-full w-full object-cover rounded-2xl ">
                    </a>
                </div>
                <div class="pt-6">
                    <a href="<?php echo get_the_permalink(); ?>"
                        class="text-heading-3 font-bold !text-n-100 card-title-hover leading-tight">
                        <?php echo $post_title_limit; ?></a>
                    <p class="mt-2 text-sm text-n-60 mb-4"> <?php echo $excerpt; ?></p>
                    <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                        <?php echo $btn_text; ?>
                        <?php echo useSvg('right-arrow')?>
                    </a>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
        <div class="flex justify-center mt-8">
            <a href="<?php echo $view_all_news_btn_link; ?>"
                class="!text-n-100 font-bold py-2.5 px-4 border border-teal rounded-lg transition-all duration-300 hover:bg-teal hover:!text-n-0">
                <?php echo $view_all_news_btn; ?>
            </a>
        </div>

        <?php
        } 
        // Reset Post Data
        wp_reset_postdata();
        ?>
    </div>
</section>