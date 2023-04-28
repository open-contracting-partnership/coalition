<?php

$heading   = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$heading_body   = (function_exists('get_field') && $heading_body = get_field('heading_body')) ? $heading_body : '';
$form_short_code   = (function_exists('get_field') && $form_short_code = get_field('form_short_code')) ? $form_short_code : '';
$background_image   = (function_exists('get_field') && $background_image = get_field('side_information')['background_image']) ? $background_image : '';
$side_information_heading   = (function_exists('get_field') && $side_information_heading = get_field('side_information')['heading']) ? $side_information_heading : '';
$side_information_heading_body   = (function_exists('get_field') && $side_information_heading_body = get_field('side_information')['heading_body']) ? $side_information_heading_body : '';
$social_link   = (function_exists('get_field') && $social_link = get_field('side_information')['social_link']) ? $social_link : '';


?>

<div class="contact-us pb-10 sm:pb-14 md:pb-28">
    <h2 class="font-bold"> <?php echo $heading; ?></h2>
    <p class="sm:mt-4 text-base sm:text-lg"> <?php echo $heading_body; ?></p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 mt-6 sm:mt-9">
        <div class="lg:col-span-5 px-8 py-10 sm:py-14 md:pt-24 sm:pl-14 md:pl-8 lg:pl-14 sm:pr-11 rounded-t-lg md:rounded-tr-none md:rounded-l-lg text-n-0 contact-us-background"
            style="background-image: url(<?php echo $background_image; ?>);">
            <h3 class="font-bold"><?php echo $side_information_heading; ?></h3>
            <p class="text-base pt-1 sm:pt-4"> <?php echo $side_information_heading_body; ?></p>
            <ul class="mt-8 sm:mt-12 contact-admin">
                <?php
            if($social_link ){
                foreach($social_link as $key=>$value){
                    ?>
                <li class="flex gap-x-1.5 sm:gap-x-2.5 mt-4 sm:mt-6 icon-hover max-w-fit">
                    <div class="flex justify-center items-center">
                        <img src="<?php echo $value['icon']; ?>" alt="icon"
                            class="h-4 w-4 sm:h-6 sm:w-6 transition-all cursor-pointer duration-300">
                    </div>
                    <div class="contact-links"><?php echo $value['text']; ?></div>
                </li>
                <?php
                }
            }
            ?>
            </ul>
        </div>
        <div
            class="lg:col-start-6 lg:col-span-7 px-8 py-10 sm:px-14 md:px-8 sm:py-14 md:pt-24 md:pb-48 rounded-b-lg md:rounded-bl-none md:rounded-r-lg bg-n-10">
            <?php echo $form_short_code; ?>
        </div>
    </div>
</div>