<?php
$heading     = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$paragraph   = (function_exists('get_field') && $paragraph = get_field('paragraph')) ? $paragraph : '';
$view_all_resources_btn   = (function_exists('get_field') && $view_all_resources_btn = get_field('view_all_resources_btn')) ? $view_all_resources_btn : '';
$view_all_resources_btn_link   = (function_exists('get_field') && $view_all_resources_btn_link = get_field('view_all_resources_btn_link')) ? $view_all_resources_btn_link : '';

?>

<section class="latest_resources py-10 sm:py-14 md:py-20">
    <div>
        <div class="container">
            <h2 class="text-center text-n-100 font-bold">
                <?php echo $heading; ?>
            </h2>
            <div class="text-n-80 text-center max-w-[472px] mt-4 mx-auto text-base sm:text-lg">
                <?php echo $paragraph; ?>
            </div>
            <div class="mt-8 sm:mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                <div class="bg-n-0 px-8 py-6 rounded-3xl resources-card">
                    <div class="flex gap-x-2.5 items-center">
                        <img src="<?php echo get_template_directory_uri() . '/dist/images/icons/Tool.svg'; ?>"
                            alt="icon" class="p-5 rounded-2xl resources-image">
                        <div class="text-n-70"> Tool </div>
                    </div>
                    <?php
                    $args = array(
                        'post_type'             => 'toolkit',
                        'numberposts' => 1,
                        'post_status'           => array('publish'),
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        $the_query->the_post();
                        $id = get_the_ID();
                        $excerpt = excerpt(200);
                    ?>
                    <div class="my-5 sm:mb-10">
                        <h3 class="font-bold"> <a
                                href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <div class="text-n-60 mt-3"> <?php echo $excerpt; ?>
                        </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                        Learn more
                        <?php echo useSvg('right-arrow') ?>
                    </a>
                    <?php } ?>
                </div>

                <div class="bg-n-0 px-8 py-6 rounded-3xl resources-card">
                    <div class="flex gap-x-2.5 items-center">
                        <img src="<?php echo get_template_directory_uri() . '/dist/images/icons/Evidence.svg'; ?>"
                            alt="icon" class="p-5 rounded-2xl resources-image">
                        <div class="text-n-70"> Evidence </div>
                    </div>
                    <?php
                    $args = array(
                        'post_type'             => 'evidence',
                        'numberposts' => 1,
                        'post_status'           => array('publish'),
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        $the_query->the_post();
                        $id = get_the_ID();
                        $excerpt = excerpt(200);
                    ?>
                    <div class="my-5 sm:mb-10">
                        <h3 class="font-bold"> <a
                                href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <div class="text-n-60 mt-3"> <?php echo $excerpt; ?>
                        </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                        Learn more
                        <?php echo useSvg('right-arrow') ?>
                    </a>
                    <?php } ?>
                </div>

                <div class="bg-n-0 px-8 py-6 rounded-3xl resources-card">
                    <div class="flex gap-x-2.5 items-center">
                        <img src="<?php echo get_template_directory_uri() . '/dist/images/icons/Best-Practices.svg'; ?>"
                            alt="icon" class="p-5 rounded-2xl resources-image">
                        <div class="text-n-70"> Best Practices </div>
                    </div>
                    <?php
                    $args = array(
                        'post_type'             => 'best_practices',
                        'numberposts' => 1,
                        'post_status'           => array('publish'),
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        $the_query->the_post();
                        $id = get_the_ID();
                        $excerpt = excerpt(200);
                    ?>
                    <div class="my-5 sm:mb-10">
                        <h3 class="font-bold"> <a
                                href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <div class="text-n-60 mt-3"> <?php echo $excerpt; ?>
                        </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" class="flex gap-x-2.5 items-center learn-more-btn">
                        Learn more
                        <?php echo useSvg('right-arrow') ?>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <?php if ($view_all_resources_btn_link) { ?>
            <div class="flex justify-center mt-8">
                <a href="<?php echo $view_all_resources_btn_link; ?>"
                    class="!text-n-100 font-bold py-2.5 px-4 border border-teal rounded-lg transition-all duration-300 hover:bg-teal hover:!text-n-0 more-resources-btn">
                    <?php echo $view_all_resources_btn; ?>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>