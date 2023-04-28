<?php

$id = get_the_ID();
$posttype = get_post_type($id);
$post_object = get_post_type_object($posttype);
$labels = $post_object->labels;
$person_member_data = [];
$organization_member_data = [];
$taxonomies = 'type_of_member';
if (have_posts()) {
    $i = 0;
    while (have_posts()) {
        the_post();
        $id = get_the_ID();
        $permalink = get_the_permalink($id);
        $title = get_the_title();
        $content = get_the_content();
        $taxoTermsName = taxoTermsName($id, $taxonomies);

        $type_of_member = get_field('members')['type_of_member'];
        $logoprofile_photo = get_field('members')['logoprofile_photo'];
        $address = get_field('members')['address'];
        $email = get_field('members')['email'];

        if ($type_of_member == 'Person') {
            $person_member_data[$i]['title'] = $title;
            $person_member_data[$i]['content'] = $content;
            $person_member_data[$i]['logoprofile_photo'] = ($logoprofile_photo)?$logoprofile_photo:get_template_directory_uri() . '/dist/images/default-post-img.jpg';
            $person_member_data[$i]['designation'] = get_field('members')['designation'];
            $person_member_data[$i]['address'] = $address;
            $person_member_data[$i]['email'] = $email;
            $person_member_data[$i]['quotes'] = get_field('members')['quotes'];
        }
        if ($type_of_member == 'Organization') {
            $organization_member_data[$i]['title'] = $title;
            $organization_member_data[$i]['content'] = $content;
            $organization_member_data[$i]['logoprofile_photo'] = ($logoprofile_photo)?$logoprofile_photo:get_template_directory_uri() . '/dist/images/default-post-img.jpg';
            $organization_member_data[$i]['phone'] = get_field('members')['phone'];
            $organization_member_data[$i]['address'] = $address;
            $organization_member_data[$i]['email'] = $email;
            $organization_member_data[$i]['website'] = get_field('members')['website'];
        }

        $i++;
    }
}

// archive member page breadcrumb 
custom_breadcrumb_section($id, $posttype, $labels);

?>

<div class="container">
    <div class="members-tab-menu">
        <div class="max-w-fit mx-auto mt-8 sm:mt-10 lg:mt-12 flex border rounded-3xl">
            <p class="active members-tab-item members-experts-btn">Experts</p>
            <p class="members-tab-item members-organizations-btn">Organizations</p>
        </div>
    </div>

    <!-- List of experts members  -->
    <div class="members-experts-list">
        <div
            class="<?php echo $posttype; ?> grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 pt-10 sm:pt-12 lg:pt-16 pb-10 sm:pb-14 lg:pb-32">
            <?php
            foreach ($person_member_data as $key => $member_data) {
            ?>
            <div data-id="<?php echo $id; ?>" class="relative member-card">
                <div class="pt-[120%] relative members-list-image">
                    <img src="<?php echo $member_data['logoprofile_photo']; ?>" alt="feature-image"
                        class="absolute top-0 h-full w-full object-cover rounded-3xl">
                </div>
                <div class="absolute bottom-10 left-8 member-quote-animation">
                    <div class="member-quote hidden opacity-0 font-medium text-lg text-n-0 mb-8 pr-8">
                        <?php echo useSvg('quote')?>
                        <?php echo $member_data['quotes']; ?>
                    </div>
                    <div class="font-bold text-heading-3 text-n-0"> <?php echo $member_data['title']; ?> </div>
                    <div class="text-n-30 mt-2"><?php echo $member_data['address']; ?> </div>

                    <!-- <div class="mt-4">
                        <a href="#"
                            class="gap-x-2.5 items-center member-learn-more hidden absolute bottom-0 left-0 text-n-0">
                            Learn More
                            <?php echo useSvg('right-arrow') ?>
                        </a>
                    </div> -->
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- List of organizations members  -->

    <div class="members-organizations-list hidden">
        <div class="pt-10 sm:pt-12 lg:pt-14 pb-10 sm:pb-14 lg:pb-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($organization_member_data as $key => $organization_member) { ?>
            <a href="<?php echo $organization_member['website'] ?>" target="_blank">
                <div class="member-org-item">
                    <img src="<?php echo $organization_member['logoprofile_photo'] ?>">
                </div>
            </a>
            <?php } ?>
        </div>
    </div>

</div>