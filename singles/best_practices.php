<?php

$id = get_the_ID();
$posttype = get_post_type($id);
$permalink = get_the_permalink($id);
$title = get_the_title();
$content = get_the_content();
$feature_img = get_the_post_thumbnail_url();
$realted_campaign = get_field('realted_campaign')['realted_campaign'];
$published_date = get_the_date('d M, Y');
$tags = get_the_tags();

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
    <?php
    if ($realted_campaign) {
    ?>
        <div class="realted_campaign container py-10 sm:py-14 lg:pt-24 lg:pb-32">
            <h2 class="font-bold">Related Campaigns</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                <?php
                foreach ($realted_campaign as $key => $campaign) {
                    $campaign_id = $campaign;
                    $campaign_title = get_the_title($campaign_id);
                    $campaign_feature_img = (has_post_thumbnail($campaign_id)) ? get_the_post_thumbnail_url($campaign_id) : get_template_directory_uri() . '/dist/images/default-post-img.jpg';
                    $campaign_permalink = get_the_permalink($campaign_id);
                ?>
                    <div class="campaign">
                        <a href="<?php echo  $campaign_permalink; ?>">
                            <div class="pt-[65%] relative">
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <img src="<?php echo $campaign_feature_img; ?>" alt="campaign-image" class=" absolute top-0 h-full w-full object-cover rounded-t-3xl">
                                </a>
                            </div>
                            <div class="bg-n-0 px-8 sm:px-12 py-6 rounded-b-3xl">
                                <a href="<?php echo get_the_permalink(); ?>" class="text-lg font-bold !text-n-100">
                                    <?php echo $campaign_title; ?></a>
                                <p class="mt-2.5 text-sm text-n-60 mb-4"> <?php echo $excerpt; ?></p>
                                <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                                    Learn More
                                    <?php echo useSvg('right-arrow') ?>
                                </a>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>