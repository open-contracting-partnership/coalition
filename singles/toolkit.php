<?php

$id = get_the_ID();
$posttype = get_post_type($id);
$permalink = get_the_permalink($id);
$title = get_the_title();
$content = get_the_content();
$feature_img = get_the_post_thumbnail_url();
$published_date = get_the_date('d M, Y');
$tags = get_the_tags();

?>

<?php echo breadcrumb_section($id); ?>


<div class="container py-10 sm:pt-16 lg:pb-20">

    <div class="<?php echo $posttype . '-' . $id ?> ">
        <?php if ($feature_img) { ?>
        <div class="pt-[45%] relative">
            <img src="<?php echo $feature_img; ?>" alt="feature_img"
                class=" absolute top-0 h-full w-full object-cover rounded-xl">
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
                        <li class="text-sm px-2 py-1 bg-n-10 rounded-xl max-w-fit mt-2.5"
                            data-tag="<?php echo $tag->slug; ?>">
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
            <div
                class="mt-8 sm:mt-0 sm:col-start-4 sm:col-span-9 lg:col-span-7 text-base sm:text-lg single-detail-content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>