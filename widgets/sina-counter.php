<?php

/**
 * Counter Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Counter_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_counter';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Counter', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-counter';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina counter', 'sina number' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_script_depends() {
	    return [
	        'jquery-numerator',
	        'sina-widgets',
	    ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Counter Content
		// =====================
		$this->start_controls_section(
			'counter_content',
			[
				'label' => __( 'Counter', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Satisfied Customers', 'sina-ext' ),
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-user',
			]
		);
		$this->add_control(
			'start_number',
			[
				'label' => __( 'Start Number', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'step' => 1,
			]
		);
		$this->add_control(
			'stop_number',
			[
				'label' => __( 'Stop Number', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'step' => 1,
			]
		);
		$this->add_control(
			'delimiter',
			[
				'label' => __( 'Thousand Delimiter', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					',' => __( 'Comma', 'sina-ext' ),
					'.' => __( 'Dot', 'sina-ext' ),
					'|' => __( 'Pipe', 'sina-ext' ),
					' ' => __( 'space', 'sina-ext' ),
				],
				'default' => ',',
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Counting Duration', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
			]
		);
		$this->add_control(
			'prefix',
			[
				'label' => __( 'Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Prefix', 'sina-ext' ),
			]
		);
		$this->add_control(
			'prefix_space',
			[
				'label' => __( 'Prefix Space', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'step' => 1,
					],
				],
				'condition' => [
					'prefix!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => __( 'Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter Suffix', 'sina-ext' ),
			]
		);
		$this->add_control(
			'suffix_space',
			[
				'label' => __( 'Suffix space', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -20,
						'step' => 1,
					],
				],
				'condition' => [
					'suffix!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Counter Content
		// =====================


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0a0',
				'selectors' => [
					'{{WRAPPER}} .sina-counter-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sina-counter-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-title',
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Number Style
		// =====================
		$this->start_controls_section(
			'number_style',
			[
				'label' => __( 'Number', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-counter-number-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .sina-counter-number-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'number_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-number-wrap',
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => ''
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d300d0',
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-icon i',
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'sina-counter-title' );
		$this->add_inline_editing_attributes( 'title' );
		?>
		<div class="sina-counter">
			<?php if ( $data['icon'] ): ?>
				<div class="sina-counter-icon">
					<i class="<?php echo esc_attr($data['icon']); ?>"></i>
				</div>
			<?php endif; ?>

			<?php if ( $data['start_number'] && $data['stop_number'] ): ?>
				<div class="sina-counter-number-wrap">
					<?php if ( $data['prefix']): ?>
						<span class="sina-counter-prefix"><?php echo esc_html($data['prefix']); ?></span>
					<?php endif; ?>

					<span class="sina-counter-number"
					data-duration="<?php echo esc_attr($data['speed']); ?>"
					data-to-value="<?php echo esc_attr($data['stop_number']); ?>"
					data-delimiter="<?php echo esc_attr($data['delimiter']); ?>">
						<?php echo esc_html($data['start_number']); ?>
					</span>

					<?php if ( $data['suffix']): ?>
						<span class="sina-counter-suffix">
							<?php echo esc_html($data['suffix']); ?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div <?php echo $this->get_render_attribute_string( 'title' ); ?>>
				<?php echo esc_html($data['title']); ?>
			</div>
		</div><!-- .sina-counter -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'title', 'class', 'sina-counter-title' );
		view.addInlineEditingAttributes( 'title' );
		#>
		<div class="sina-counter">
			<# if (settings.icon) { #>
				<div class="sina-counter-icon">
					<i class="{{{settings.icon}}}"></i>
				</div>
			<# } #>

			<# if ( settings.start_number && settings.stop_number ) { #>
				<div class="sina-counter-number-wrap">
					<# if (settings.prefix) { #>
						<span class="sina-counter-prefix">{{{settings.prefix}}}</span>
					<# } #>

					<span class="sina-counter-number" 
					data-duration="{{{settings.speed}}}"
					data-to-value="{{{settings.stop_number}}}"
					data-delimiter="{{{settings.delimiter}}}">
						{{{settings.start_number}}}
					</span>

					<# if (settings.suffix) { #>
						<span class="sina-counter-suffix">{{{settings.suffix}}}</span>
					<# } #>
				</div>
			<# } #>

			<# if (settings.title) { #>
				<div {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</div>
			<# } #>
		</div>
		<?php
	}
}