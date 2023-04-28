<?php

$id = get_the_ID();
$posttype = get_post_type($id);
$permalink = get_the_permalink($id);
$title = get_the_title();
$content = get_the_content();
$feature_img = get_the_post_thumbnail_url();
$published_date = get_the_date('d M, Y');
$tags = get_the_tags();

$realted_campaign = get_field('realted_campaign')['realted_campaign'];

?>

<?php echo breadcrumb_section($id); ?>

<div class="container py-10 sm:pt-16 lg:pb-20">

    <div class="<?php echo $posttype . '-' . $id ?> ">
        <?php if ($feature_img) { ?>
            <div class="pt-[45%] relative">
                <img src="<?php echo $feature_img; ?>" alt="feature_img" class=" absolute top-0 h-full w-full object-cover rounded-xl">
            </div>
        <?php } ?>
        <div class="pt-8 sm:pt-14 lg:pt-20 grid gap-x-4 grid-cols-1 sm:grid-cols-12">
            <div class="sm:col-span-3">
                <div class="flex items-center gap-x-4 sm:block">
                    <p class="text-lg font-bold">Published date</p>
                    <p class="text-n-60 text-sm mt-1"> <?php echo $published_date; ?> </p>
                </div>

                <?php
                if ($tags) {
                ?>
                    <div class="mt-4 sm:mt-9">
                        <p class="text-lg font-bold">Related tags</p>
                        <ul class="flex gap-x-4 sm:block">
                            <?php
                            foreach ($tags as $tag) {
                            ?>
                                <li class="text-sm px-2 py-1 bg-n-10 rounded-xl max-w-fit mt-2.5" data-tag="<?php echo $tag->slug; ?>">
                                    <?php echo $tag->name; ?> </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="mt-8 sm:mt-0 sm:col-start-4 sm:col-span-9 lg:col-span-7 text-base sm:text-lg single-detail-content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>

<div class="bg-n-10">
    <div class="container py-10 md:pt-16 md:pb-20">
        <h2 class="font-bold">In other news</h2>
        <?php
        $args = array(
            'post_type'             => 'news',
            'posts_per_page'        => '3',
            'post_status'           => array('publish'),
            'post__not_in' => array($id)
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) { ?>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                <?php
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $id = get_the_ID();
                    $excerpt = excerpt(120);
                    $post_title_limit = get_the_title();
                    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default-post-img.jpg';
                ?>
                    <div id="news_<?php echo $id; ?>" class="p-5 border border-n-30 rounded-3xl bg-n-0 news-card-hover">
                        <div class="pt-[63.8%] relative">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img src="<?php echo $feature_img; ?>" alt="news-image" class=" absolute top-0 h-full w-full object-cover rounded-2xl">
                            </a>
                        </div>
                        <div class="pt-6">
                            <a href="<?php echo get_the_permalink(); ?>" class="text-heading-3 font-bold !text-n-100 card-title-hover leading-tight">
                                <?php echo $post_title_limit; ?></a>
                            <p class="mt-2 text-sm text-n-60 mb-4"> <?php echo $excerpt; ?></p>
                            <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                                Learn more
                                <?php echo useSvg('right-arrow') ?>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        // Reset Post Data
        wp_reset_postdata();
        ?>
    </div>
</div>