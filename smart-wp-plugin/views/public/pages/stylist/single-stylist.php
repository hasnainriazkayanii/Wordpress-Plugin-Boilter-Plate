<?php get_header(); ?>
<div data-elementor-type="wp-page" data-elementor-id="412" class="elementor elementor-412" data-elementor-settings="[]">
    <div class="elementor-section-wrap">
        <section class="elementor-section elementor-top-section elementor-element elementor-element-2aefcad elementor-section-boxed elementor-section-height-default elementor-section-height-default" style="overflow:hidden" data-id="2aefcad" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-8965265" data-id="8965265" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated" style="margin-left:30px">
                        <div class="elementor-element elementor-element-d1bb377 elementor-widget elementor-widget-heading" data-id="d1bb377" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">
                                    <?= $employee->first_name . ' ' . $employee->last_name ?></h2>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-ec7a7fb elementor-widget elementor-widget-text-editor" data-id="ec7a7fb" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p><?= $stylist->post_content ?>
                                </p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-a587701 elementor-button-warning elementor-align-left elementor-widget elementor-widget-button" data-id="a587701" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    <a href="<?= get_permalink(get_setting_by_slug('appointment_page_id')) ?>" class="elementor-button-link elementor-button elementor-size-md" role="button">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-text" style="color:white">BOOK AN APPOINTMENT</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-e49aba8" data-id="e49aba8" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-8c98e8b elementor-widget__width-inherit  elementor-widget elementor-widget-image" data-id="8c98e8b" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <?php if (get_the_post_thumbnail_url($stylist->ID)) { ?>
                                    <img width="243" height="433" src="<?php echo get_the_post_thumbnail_url($stylist->ID) ?>" class="attachment-large size-large" alt="" loading="lazy">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="elementor-section elementor-top-section elementor-element elementor-element-17f19f1 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="17f19f1" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8b4543d" data-id="8b4543d" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-a4f5407 elementor-widget elementor-widget-heading" data-id="a4f5407" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">
                                    &#8220; <?= $employee->first_name . ' ' . $employee->last_name ?> &#8221; IS EXPERT IN</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="elementor-section elementor-top-section elementor-element elementor-element-7060c57 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7060c57" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default" style="flex-wrap: wrap">
                <?php foreach ($services as $service) { ?>
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-a331297" data-id="a331297" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-5564abf elementor-widget elementor-widget-price-table" data-id="5564abf" data-element_type="widget" data-widget_type="price-table.default">
                                <div class="elementor-widget-container">

                                    <div class="elementor-price-table">
                                        <div class="elementor-price-table__header">
                                            <h3 class="elementor-price-table__heading" style="font-size:20px"><?= $service->name ?></h3>

                                        </div>

                                        <div class="elementor-price-table__price">
                                            <span class="elementor-price-table__currency">$</span> <span class="elementor-price-table__integer-part"><?= format_currency('', $service->price) ?></span>



                                        </div>

                                        <ul class="elementor-price-table__features-list" style="list-style: none;">
                                            <li class="elementor-repeater-item-71e0c45">
                                                <div class="elementor-price-table__feature-inner">
                                                    <span class="elementor-price-table__integer-part">Duration</span><br><br>
                                                    <span>
                                                        <?php

                                                        $t = $service->duration;
                                                        $h = floor($t / 60) ? floor($t / 60) . ' hours' : '';
                                                        $m = $t % 60 ? $t % 60 . ' minutes' : '';
                                                        echo $h && $m ? $h . ' and ' . $m : $h . $m;
                                                        ?>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="elementor-price-table__footer" style="margin:10px">
                                            <a class="sb-btn-default elementor-price-table__button elementor-button elementor-size-md" href="<?= get_permalink(get_setting_by_slug('appointment_page_id')) ?>">BOOK AN APPOINTMENT</a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <?php if ($stylist->gallery && count($stylist->gallery) > 0) {  ?>
            <section class="elementor-section elementor-top-section elementor-element elementor-element-5e0f7b7 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle" data-id="5e0f7b7" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-af31812" data-id="af31812" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-9ee506d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="9ee506d" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ede491b" data-id="ede491b" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-d4d1814 elementor-view-default elementor-widget elementor-widget-icon" data-id="d4d1814" data-element_type="widget" data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <div class="elementor-icon">
                                                            <i aria-hidden="true" class="fas fa-anchor"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-81f28b7 elementor-widget elementor-widget-heading" data-id="81f28b7" data-element_type="widget" data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <h3 class="elementor-heading-title elementor-size-default">Gallery</h3>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-00bebaa elementor-widget elementor-widget-text-editor" data-id="00bebaa" data-element_type="widget" data-widget_type="text-editor.default">
                                                <div class="elementor-widget-container">
                                                    <p>Our Stylists have a wide range of Hair styles options. Visit our Gallery to see the latest Hair Styles available.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-section elementor-top-section elementor-element elementor-element-04a651f elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle" data-id="04a651f" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-be25138" data-id="be25138" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-a195cc3 customWidth elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a195cc3" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e36de7f" data-id="e36de7f" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-5ffc703 elementor-widget elementor-widget-gallery" data-id="5ffc703" data-element_type="widget" data-settings="{&quot;gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:0,&quot;sizes&quot;:[]},&quot;aspect_ratio&quot;:&quot;4:3&quot;,&quot;gallery_layout&quot;:&quot;grid&quot;,&quot;columns&quot;:4,&quot;columns_tablet&quot;:2,&quot;columns_mobile&quot;:1,&quot;gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;link_to&quot;:&quot;file&quot;,&quot;overlay_background&quot;:&quot;yes&quot;,&quot;content_hover_animation&quot;:&quot;fade-in&quot;}" data-widget_type="gallery.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-gallery__container e-gallery-container e-gallery-grid e-gallery--ltr" style="--hgap:0px; --vgap:0px; --animation-duration:350ms; --columns:4; --rows:2; --aspect-ratio:75%; --container-aspect-ratio:37.5001%;">
                                                        <?php
                                                        foreach ($stylist->gallery as $single_image) { ?>
                                                            <a class="e-gallery-item elementor-gallery-item elementor-animated-content" href="<?php echo $single_image->url ?>" data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="all-5ffc703" data-elementor-lightbox-title="Group 3542" style="--column:0; --row:0;">
                                                                <div class="e-gallery-image elementor-gallery-item__image" data-thumbnail="<?php echo $single_image->url ?>" data-width="1920" data-height="1080" alt="" style="background-image: url(&quot;<?php echo $single_image->url ?>&quot;);">
                                                                </div>
                                                                <div class="elementor-gallery-item__overlay"></div>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <section style="" class="elementor-section elementor-top-section elementor-element elementor-element-4f4c173 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4f4c173" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-42fc9b1" data-id="42fc9b1" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-0456e01 elementor-view-default elementor-widget elementor-widget-icon" data-id="0456e01" data-element_type="widget" data-widget_type="icon.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-wrapper">
                                    <div class="elementor-icon">
                                        <i aria-hidden="true" class="fas fa-anchor"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-781c0e7 elementor-widget elementor-widget-heading" data-id="781c0e7" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h3 class="elementor-heading-title elementor-size-default">What Our Clients SAY ABOUT
                                    &#8220; <?= $employee->first_name . ' ' . $employee->last_name ?> &#8221;
                                </h3>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-64a0b83 elementor-testimonial--skin-default elementor-testimonial--layout-image_inline elementor-testimonial--align-center elementor-arrows-yes elementor-pagination-type-bullets elementor-widget elementor-widget-testimonial-carousel" data-id="64a0b83" data-element_type="widget" data-settings="{&quot;show_arrows&quot;:&quot;yes&quot;,&quot;pagination&quot;:&quot;bullets&quot;,&quot;speed&quot;:500,&quot;autoplay&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;loop&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;space_between&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;space_between_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;space_between_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]}}" data-widget_type="testimonial-carousel.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-swiper">
                                    <div class="elementor-main-swiper swiper-container swiper-container-initialized swiper-container-horizontal" style="cursor: grab;">
                                        <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-2300px, 0px, 0px);">
                                            <?php foreach ($reviews as $key => $review) { ?>
                                                <div class="swiper-slide" data-swiper-slide-index="<?= ($key + 1) ?>" style="width: 1140px; margin-right: 10px;">
                                                    <div class="elementor-testimonial">
                                                        <div class="elementor-testimonial__content">
                                                            <div class="elementor-testimonial__text" style="text-align:center">
                                                                <?= $review->message ?>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-testimonial__footer" style="text-align:center;margin-top:25px;margin-bottom:25px;">
                                                            <cite class="elementor-testimonial__cite"><span class="elementor-testimonial__name"> <?= $review->customer_name ?></span></cite>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>
                                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
                                            <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span>
                                        </div>
                                        <div class="elementor-swiper-button elementor-swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide">
                                            <i class="eicon-chevron-left" aria-hidden="true"></i>
                                            <span class="elementor-screen-only">Previous</span>
                                        </div>
                                        <div class="elementor-swiper-button elementor-swiper-button-next" tabindex="0" role="button" aria-label="Next slide">
                                            <i class="eicon-chevron-right" aria-hidden="true"></i>
                                            <span class="elementor-screen-only">Next</span>
                                        </div>
                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<link rel="stylesheet" id="elementor-post-412-css" href="<?php echo site_url() . '/wp-content/uploads/elementor/css/post-412.css?ver=1630501130' ?>" media="all">
<link rel="stylesheet" id="elementor-gallery-css" href="<?php echo site_url() . '/wp-content/plugins/elementor/assets/lib/e-gallery/css/e-gallery.min.css?ver=1.2.0' ?>" media="all">
<script src="<?php echo site_url() . '/wp-content/plugins/elementor/assets/lib/e-gallery/js/e-gallery.min.js?ver=1.2.0' ?>" id='elementor-gallery-js'></script>
<script src="<?php echo site_url() . '/wp-includes/js/imagesloaded.min.js?ver=4.1.4' ?>" id='imagesloaded-js'></script>
<?php get_footer();
exit; ?>