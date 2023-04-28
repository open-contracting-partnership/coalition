<?php
$id = get_the_ID();
$posttype = get_post_type($id);

if ($id && ($posttype == 'page')) {

    $display_breadcrumb = (function_exists('get_field') && $display_breadcrumb = get_field('display_breadcrumb', $id)) ? $display_breadcrumb : '';
    $default_breadcrumb = (function_exists('get_field') && $default_breadcrumb = get_field('default_breadcrumb', $id)) ? $default_breadcrumb : '';
    $add_custom_breadcrumb = (function_exists('get_field') && $add_custom_breadcrumb = get_field('add_custom_breadcrumb', $id)) ? $add_custom_breadcrumb : '';

    if ($display_breadcrumb && $default_breadcrumb) {
?>
        <div class="breadcrumb bg-n-10">
            <div class="breadcrumb-menu container">
                <div class="breadcrumb-menu__item">
                    <a href="<?php echo home_url(); ?>">Home</a>
                </div>
                <div class="breadcrumb-menu__item"> <?php echo get_the_title(); ?> </div>
            </div>
        </div>
    <?php
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
                <div class="breadcrumb-menu__item"> <?php echo get_the_title($id_my); ?> </div>
            </div>
        </div>
<?php
    }
}
