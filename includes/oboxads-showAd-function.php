<?php
/**
 * get banner code for given section
 *
 * @since  2015-07-31
 * @author Patrick Forget <patforg@geekpad.ca>
 */
function oboxadsGetAd($section) {
    $escSection = esc_attr($section);
    return <<<HTML
        <div class="oboxads" data-section="{$escSection}">
            <div></div>
            <script>OBOXADSQ ? OBOXADSQ.push({"cmd": "addBanner"}) : 0;</script>
        </div>
HTML;
    
} // oboxadsGetAd()

/**
 * Oboxmedia Wordpress Plugin Oboxads ShowAd Function
 * @version 1.0.0
 * @package Oboxmedia Wordpress Plugin
 */
function oboxadsShowAd ($section) {
    echo oboxadsGetAd($section);
} //oboxadsShowAd()


