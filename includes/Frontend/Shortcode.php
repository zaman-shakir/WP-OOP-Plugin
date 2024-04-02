<?php

namespace WPlgoic\Dev\Frontend;

class Shortcode
{

    function __construct()
    {
        add_shortcode('wplgoic-dev', [$this, 'render_shortcode']);
    }
    public function render_shortcode($atts, $content = '')
    {

        return 'hellloo dev guys??';
    }
}
