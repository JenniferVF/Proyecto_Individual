<?php

class My_Widget {
    protected static $instance = null;
    
    public static function get_instance() {
        if (!isset(static::$instance)){
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function _construct() {
        require_once('proyecto.php');
        add_action('elementor/widgets/widgets_registered', [ $this, 'registered_widgets']);
    }

    public function register_widgets() {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Proyecto_Widget());
    }
}

add_action('init', 'my_elementor_init');
function my_elementor_init(){
    My_Widget::get_instance();
}