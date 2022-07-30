<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Awesomesauce extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'awesomesauce', plugins_url( '/assets/css/awesomesauce.css', ELEMENTOR_AWESOMESAUCE ), array(), '1.0.0' );
	}

	public function get_name() {
		return 'B67751 Widget';
	}

	public function get_title() {
		return __( 'B67751 Widget', 'elementor-awesomesauce' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return array( 'basic' );
	}
	
	public function get_style_depends() {
		return array( 'awesomesauce' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-awesomesauce' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementor-awesomesauce' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Ingrese un título', 'elementor-awesomesauce' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'elementor-awesomesauce' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 10,
				'default' => __( 'Ingrese una descripción', 'elementor-awesomesauce' ),
			)
		);

		$this->add_control(
			'text_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__( 'Text Color', 'elementor-awesomesauce' ),
				'default' => '#fefefe',
				'selectors' => [
					'{{WRAPPER}} h4' => 'color: {{VALUE}}',
					'{{WRAPPER}} h5' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-awesomesauce' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
            'link',
            [
                'label' => __( 'Link', 'elementor-awesomesauce' ),
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

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );
		
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}
		
		?>
		<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
		<h4 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses( $settings['title'], array() ); ?></h4>
		<h5 <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo wp_kses( $settings['description'], array() ); ?></h5>;
		</a>
		<?php
	}


	protected function _content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		view.addInlineEditingAttributes( 'description', 'basic' );

		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		var image_url = elementor.imagesManager.getImageUrl( image );

		if ( ! image_url ) {
			return;
		}
		#>
		<a href="{{ settings.link.url }}">
		<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		<img src="{{{ image_url }}}"/>
		</a>
		<?php
	}
}
