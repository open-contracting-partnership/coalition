<?php

$heading     = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$paragraph   = (function_exists('get_field') && $paragraph = get_field('paragraph')) ? $paragraph : '';
$button_text     = (function_exists('get_field') && $button_text = get_field('button_text')) ? $button_text : '';
$button_url_link     = (function_exists('get_field') && $button_url_link = get_field('button_url_link')) ? $button_url_link : '';
$image     = (function_exists('get_field') && $image = get_field('image')) ? $image : '';

$id = get_the_ID();
$posttype = get_post_type($id);
// if(is_front_page()){}

?>

<style>
header {
    background-image: url(<?php echo $image; ?>);
    background-attachment: fixed;
}

.block-editor-page .single-header h1 {
    display: none;
}
</style>

<canvas id="heroCanvas"></canvas>
<section class="hero_banner_1">
    <div class="container pb-8 sm:pb-16 h-[75vh] md:h-[65vh] lg:h-[55vh] flex items-center justify-center">
        <div class="max-w-[910px] text-center">
            <h1 class="font-bold text-n-0">
                <?php echo $heading; ?>
            </h1>
            <div class="mt-4 text-base text-n-0 tracking-wider">
                <?php echo $paragraph; ?>
            </div>
            <a class="text-lg !text-n-0 flex justify-center pointer-events-none" href="<?php echo $button_url_link; ?>">
                <div
                    class="mt-11 py-2.5 px-4 md:py-5 md:px-8 border border-[#FFF200] rounded-lg flex gap-x-4 sm:gap-x-6 hero-btn max-w-fit items-center">
                    <p class="text-lg text-n-0 transition-all duration-[400ms]"> <?php echo $button_text; ?>
                    </p>
                    <?php echo useSvg('right-arrow') ?>
                </div>
            </a>
        </div>
    </div>
</section>

<?php
// archive page title and sub-title at header
if (is_archive()) {
    $post_object = get_post_type_object($posttype);
    $labels = $post_object->labels;
    $sub_heading     = (function_exists('get_field') && $sub_heading = get_field('sub_heading', $posttype . '_options')) ? $sub_heading : '';
?>
<div class="archive-header container text-center text-n-0 pt-12 pb-10 md:pt-20 md:pb-16">
    <h1 class="font-bold"><?php echo $labels->name; ?></h1>
    <p class="text-lg mt-2"> <?php echo $sub_heading; ?> </p>
</div>
<?php
}

// single page title at header
if (is_search()) {
?>
<div class="single-header text-n-0 pb-10">
    <h1 class="font-bold"><?php echo 'Search results for: ' . esc_html( $_GET['s'] );?> </h1>
</div>
<?php
} else if ((is_single() || ($posttype == 'page')) && !is_front_page() && !is_admin())  {
?>
<div class="single-header text-n-0 pb-10">
    <h1 class="font-bold"><?php echo get_the_title(); ?></h1>
</div>
<?php
}