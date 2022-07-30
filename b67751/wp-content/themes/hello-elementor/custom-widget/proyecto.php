<?php
namespace Elementor;

class Proyecto_Widget extends Widget_Base {
    public function get_name(){
        return 'proyecto';
    }

    public function get_title(){
        return 'Proyecto';
    }

    public function get_icon(){
        return 'eicon-folder-o';
    }

    public function get_categories(){
        return [ 'basic' ];
    }

    protected function _register_controls(){

        $this->start_constrols_section(
            'section_title',
            [
                'label' => _( 'Title & Content', 'elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Ingrese un título', 'elementor' ),
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Ingrese una descripción', 'elementor' ),
            ]
        );
        
        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://ejemplo.com', 'elementor' ),
                'default' => [
                    'url' => '',
                    ] 
            ]
        );
        
        $this->end_controls_section();

    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $url = $settings['link']['url'];
    echo "<a href='$url'><div class = 'title'>$settings[title]</div><div class='description'>$settings[description]</div></a>";
}

protected function _content_template() {
}

}