<?php

$id = get_the_ID();
$posttype = get_post_type($id);
$post_object = get_post_type_object($posttype);
$labels = $post_object->labels;

?>

<?php echo breadcrumb_section($id); ?>


<div class="bg-n-20">
    <div class="continer py-10 sm:py-14 md:py-20 toolkit-container">
        <div class="wrapper">
            <h1 class="coming-soon">
                Coming soon <span class="dot">.</span>
            </h1>
        </div>
    </div>
</div>


<style>
@keyframes fadeIn {
    from {
        top: 20%;
        opacity: 0;
    }

    to {
        top: 100;
        opacity: 1;
    }

}

.toolkit-container {
    height: 60vh;
    position: relative;
}

.wrapper {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    animation: fadeIn 1000ms ease;
    -webkit-animation: fadeIn 1000ms ease;
}

h1.coming-soon {
    font-size: 50px;
    margin-bottom: 0;
    line-height: 1;
    font-weight: 700;
    color: #1D6FA3;
}


.dot {
    color: #4FEBFE;
}
</style>