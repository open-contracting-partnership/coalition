<?php
/*
Template Name: Single Default
*/

$block_content = do_blocks('
    <!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
    <main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:post-featured-image {"overlayColor":"contrast","dimRatio":50,"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50","top":"calc(-1 * var(--wp--preset--spacing--50))"}}}} /-->
            <!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:post-content {"layout":{"type":"constrained"}} /-->
        <!-- wp:template-part {"slug":"post-meta"} /-->
        <!-- wp:template-part {"slug":"comments","tagName":"section"} /-->
    </main>
    <!-- /wp:group -->
');

ob_start();
block_header_area();
$block_header_area =  ob_get_contents();
ob_clean();

ob_start();
block_footer_area();
$block_footer_area =  ob_get_contents();
ob_clean();

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="wp-site-blocks">
        <header class="wp-block-template-part">
            <?php echo $block_header_area; ?>
        </header>

        <div class="single-page wp-block-post-content">
            <?php
                $posttype = get_post_type();
                $filepath = dirname(__FILE__) . '/singles/' . $posttype . '.php';
                if (file_exists($filepath)) {
                    include_once($filepath);
                } else {
                    echo $block_content;
                }
                ?>
        </div>

        <footer class="wp-block-template-part">
            <?php echo $block_footer_area; ?>
        </footer>
    </div>
    <?php wp_footer(); ?>

</body>

</html>