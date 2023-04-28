<?php

$id = get_the_ID();
$posttype = get_post_type($id);

if (have_posts()) {
?>
<?php echo breadcrumb_section($id); ?>
<div class="container">
    <div
        class="<?php echo $posttype; ?> py-10 sm:py-14 lg:pt-16 lg:pb-32 grid gird-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-7 gap-y-6">
        <?php
        while (have_posts()) {
            the_post();
            $id = get_the_ID();
            $permalink = get_the_permalink($id);
            $title = get_the_title();
            $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default-post-img.jpg';
            $excerpt = excerpt();
        ?>

        <div data-id="<?php echo $id; ?>" class="card-subtle-hover bg-n-0 rounded-3xl">
            <a href="<?php echo $permalink; ?>">
                <div class="pt-[100%] relative card-image-container">
                    <img src="<?php echo $feature_img; ?>" alt="feature-image"
                        class="absolute top-0 h-full w-full object-cover rounded-t-3xl">
                </div>
            </a>
            <div class="info bg-n-0 px-8 py-6 rounded-b-3xl">
                <a href="<?php echo $permalink; ?>" class="text-lg font-bold !text-n-100 card-title-hover">
                    <?php echo $title; ?>
                </a>
                <p class="mt-2.5 text-sm text-n-60 mb-4"> <?php echo $excerpt; ?></p>
                <a href="<?php echo $permalink; ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                    Learn More
                    <?php echo useSvg('right-arrow')?>
                </a>
            </div>
        </div>

        <?php
        }
        ?>
    </div>
</div>
<?php
}
echo main_query_pagination();