<?php
/**
 *  File: field--field-images-slideshow.tpl.php
 *  Purpose: Custom slideshow module for Drupal 7
 *  Version: 1.0.0
 *  Default template implementation to display the value of a field.
 *
 * This file is not used by Drupal core, which uses theme functions instead for
 * performance reasons. The markup is the same, though, so if you want to use
 * template files rather than functions to extend field theming, copy this to
 * the custom theme. See theme_field() for a discussion of performance.
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 *
 */
?>

<!-- Stylesheets -->
<link rel="stylesheet" href="/modules/slideshow/css/style.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<!-- End Stylesheets -->

<div class="slider-container" id="fullscreen">
    <div class="slider-inner">
        <div class="owl-main-slider owl-carousel owl-theme slider" id="owl-slideshow-main" slide-count="<?php print_r(count($slidecount)); ?>">
            <?php foreach($slides as $slide): ?>
                <?php  if($slide['status'] == 1): ?>

                    <?php $currentslide++; ?>
                    <div class="item slide-image" data-type="normal" data-hash="<?php print $slide['fid']; ?>"><img src="/sites/default/files/<?php print $slide['filename'];?>"><br>
                        <div class="slide-info-container">
                        <div class="slide-info">
                            <a class="slide-title"><?php print $slide['title']; ?></a>
                            <a class="slide-count"> <?php print $currentslide?> of <?php print_r(count($slidecount)); ?></a>
                            <a id="enter-fullscreen" class="slide-fullscreen" onclick="UI.fullscreenSlider();" class="slide-count">Fullscreen</a>
                            <a id="exit-fullscreen" class="exit-fullscreen" onclick="UI.fullscreenSlider();" class="slide-count">Exit Fullscreen</a>
                        </div>
                            <p class="slide-caption">
                                <?php print $slide["image_field_caption"]['value'] ?>

                            </p>
                        </div>
                    </div>
                <?php
                    $isTouch = isset($variable);?>
                <?php else: ?>
                    <div class="item" data-type="ad" id="slide-ad">
                        <p><?php print $slide['title']; ?></p><br>
                        *Advertisement
                        <p class="slide-caption">
                            And now. A quick message from our sponsors.
                        </p>
                    </div>
            <? endif; ?>
        <?php endforeach; ?>
    </div>
        <div class="owl-thumbnails owl-carousel owl-theme navigation-thumbs" id="owl-slideshow-thumbnails">
            <?php foreach($slides as $slide): ?>
                <?php if($slide['status'] == 1): ?>
                    <a href="#<?php print $slide['fid']; ?>">
                        <div class="item" data-hash="<?php print $slide['fid']; ?>"><img style="max-height: 50px; max-width:75px;" src="/sites/default/files/<?php print $slide['filename']; ?>"><br></div>
                    </a>
                <? endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="/modules/slideshow/js/jquery-3.3.1.min.js"></script>
<script src="/modules/slideshow/js/owl.carousel.min.js"></script>
<script src="/modules/slideshow/js/scripts.min.js"></script>
<!-- End Scripts -->
