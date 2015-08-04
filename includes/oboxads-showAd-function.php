<?php
/**
 * Oboxmedia Wordpress Plugin Oboxads ShowAd Function
 * @version 1.0.0
 * @package Oboxmedia Wordpress Plugin
 */

function oboxadsShowAd ($section, $options = array()) {
    $escSection = esc_attr($section);
    return <<<HTML
        <div class="oboxads" data-section="{$escSection}">
            <div></div>
            <script>OBOXADSQ ? OBOXADSQ.push({"cmd": "addBanner"}) : 0;</script>
        </div>
HTML;
} //oboxadsShowAd()


