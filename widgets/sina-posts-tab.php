<?php

/**
 * Posts Tab Widget.
 *
 * @since 1.2.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Posts_Tab_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.2.0
	 */
	public function get_name() {
		return 'sina_posts_tab';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.0
	 */
	public function get_title() {
		return __( 'Sina Posts Tab', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.0
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_keywords() {
		return [ 'sina posts tab', 'sina tab' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.0
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
	 * @since 1.2.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.2.0
	 */
	protected function _register_controls() {
		// Start Tab Content
		// ===================
		$this->start_controls_section(
			'tab_content',
			[
				'label' => __( 'Tab Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => __('Add Categories', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'category',
						'label' => __( 'Select Category', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => sina_get_categories(),
						'default' => 'Uncategorized',
					],
				],
				'default' => [
					[
						'title' => __('Uncategorized', 'sina-ext'),
						'category' => 'Uncategorized',
					],
				],
				'title_field' => '{{{category}}}',
			]
		);
		$this->add_control(
			'posts_num',
			[
				'label' => __( 'Number of Posts', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'max' => 6,
				'default' => 3,
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' => __( 'Order by', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => __( 'Date', 'sina-ext' ),
					'title' => __( 'Title', 'sina-ext' ),
					'author' => __( 'Author', 'sina-ext' ),
					'modified' => __( 'Modified', 'sina-ext' ),
					'comment_count' => __( 'Comments', 'sina-ext' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'sort',
			[
				'label' => __( 'Sort', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => __( 'ASC', 'sina-ext' ),
					'DESC' => __( 'DESC', 'sina-ext' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'date',
			[
				'label' => __( 'Date', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
			]
		);
		$this->add_control(
			'tag',
			[
				'label' => __( 'Tag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
			]
		);
		$this->add_control(
			'preview_right',
			[
				'label' => __( 'Preview Right', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Tab Content
		// =================


		// Start Categories Style
		// =======================
		$this->start_controls_section(
			'cat_style',
			[
				'label' => __( 'Categories', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .sina-pt-cat-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'cat_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-cat-btn',
			]
		);

		$this->start_controls_tabs( 'cat_tabs' );

		$this->start_controls_tab(
			'cat_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'cat_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_border',
				'selector' => '{{WRAPPER}} .sina-pt-cat-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-cat-btn',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'cat_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'cat_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'hover_cat_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_cat_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-cat-btn:hover',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'cat_gap',
			[
				'label' => __( 'Gap From Content', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-btns' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Categories style
		// =====================


		// Start Thumb Style
		// =======================
		$this->start_controls_section(
			'thumb_style',
			[
				'label' => __( 'Thumbnail', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label' => __( 'Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content' => 'width: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content .sina-pt-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_title_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumb_tabs' );

		$this->start_controls_tab(
			'thumb_title',
			[
				'label' => __( 'Title', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'thumb_title_typography',
				'selector' => '{{WRAPPER}} .sina-pt-thumb-content h2 a',
			]
		);
		$this->add_control(
			'thumb_title_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content h2 a,
					{{WRAPPER}} .sina-pt-thumb-content h2 a:hover,
					{{WRAPPER}} .sina-pt-thumb-content h2 a:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumb_meta',
			[
				'label' => __( 'Meta', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'thumb_meta_typography',
				'selector' => '{{WRAPPER}} .sina-pt-thumb-content p,
				{{WRAPPER}} .sina-pt-thumb-content p a',
			]
		);
		$this->add_control(
			'thumb_meta_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content p,
					{{WRAPPER}} .sina-pt-thumb-content p a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_meta_gap',
			[
				'label' => __( 'Gap From Title', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content p' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Thumb style
		// =================


		// Start Preview Style
		// =======================
		$this->start_controls_section(
			'preview_style',
			[
				'label' => __( 'Preview List', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'preview_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content .sina-pt-post' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_responsive_control(
			'preview_width',
			[
				'label' => __( 'List Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content .sina-pt-posts' => 'width: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'title_width',
			[
				'label' => __( 'Title Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title-wraper' => 'width: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'preview_thumb_width',
			[
				'label' => __( 'Preview Thumb Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb' => 'width: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'preview_thumb_height',
			[
				'label' => __( 'Preview Thumb Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb, {{WRAPPER}} .sina-pt-title-wraper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => __( 'List Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Preview style
		// ===================


		// Start Title Style
		// =======================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sina-pt-title h3',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title h3' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title h3',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title h3:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title h3:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title style
		// ===================


		// Start Meta Style
		// =======================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => __( 'Meta', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'date' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title p' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .sina-pt-title p',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'meta_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title p',
			]
		);
		$this->add_responsive_control(
			'meta_gap',
			[
				'label' => __( 'Gap From Title', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title p' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Meta style
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		if ( !empty($data['categories']) ) :
			$id = $this->get_id();
			?>
			<div class="sina-posts-tab">
				<div class="sina-pt-btns">
					<?php
						foreach ($data['categories'] as $cats):
							$bid = $id.'-'.str_replace(' ', '-', $cats['category']);
							?>
							<button class="sina-pt-cat-btn sina-button" data-sina-pt="#<?php echo esc_attr($bid); ?>"><?php echo esc_html( $cats['category'] ); ?></button>
					<?php endforeach; ?>
				</div>

				<div class="sina-pt-content">
					<?php foreach ($data['categories'] as $key => $cats):
						$cid = $id.'-'.str_replace(' ', '-', $cats['category']);
						?>
						<div class="sina-pt-item <?php echo $key == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($cid); ?>">
							<div class="sina-pt-content<?php echo 'yes' == $data['preview_right'] ? '-right' : ''; ?>">
								<div class="sina-pt-content-content">
									<?php
										$tc = 0;
										$default	= [
											'category_name'		=> $cats['category'],
											'orderby'			=> array( $data['order_by'] => $data['sort'] ),
											'posts_per_page'	=> $data['posts_num'],
											'has_password'		=> false,
											'post_status'		=> 'publish',
											'post__not_in'		=> get_option( 'sticky_posts' ),
										];

										// Post Query
										$post_query = new WP_Query( $default );

										while ( $post_query->have_posts() ) : $post_query->the_post();
											$tid = $id.'-'.str_replace(' ', '-', $cats['category']).'-'.$tc;
											?>
											<?php if ( get_the_post_thumbnail_url() ): ?>
												<div class="sina-pt-item sina-bg-cover <?php echo $tc == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($tid); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>); ">
													<a class="sina-overlay" href="<?php the_permalink(); ?>"></a>
													<div class="sina-pt-thumb-content">
														<h2>
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>
														<?php if ('yes' == $data['tag'] && get_the_tags()): ?>
															<p>
																<span class="fa fa-tag"></span>
																<?php the_tags( '' ); ?>
															</p>
														<?php endif; ?>
													</div>
												</div>
											<?php else: ?>
												<div class="sina-pt-item sina-bg-cover <?php echo $tc == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($tid); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>); ">
													<a class="sina-overlay" href="<?php the_permalink(); ?>"></a>
													<div class="sina-pt-thumb-content">
														<h2>
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>
														<?php if ('yes' == $data['tag'] && get_the_tags()): ?>
															<p>
																<span class="fa fa-tag"></span>
																<?php the_tags( '' ); ?>
															</p>
														<?php endif; ?>
													</div>
												</div>
											<?php endif; ?>
											<?php
											$tc++;
										endwhile;
										wp_reset_query();
									?>
								</div>
								<div class="sina-pt-posts">
									<?php
										$pc = 0;
										while ( $post_query->have_posts() ) : $post_query->the_post();
											$pid = $id.'-'.str_replace(' ', '-', $cats['category']).'-'.$pc;
											?>
											<div class="sina-pt-post">
												<?php if ( 'yes' == $data['preview_right'] ): ?>
													<?php if ( get_the_post_thumbnail_url() ): ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
														</div>
													<?php else: ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>)">
														</div>
													<?php endif; ?>
													<div class="sina-pt-title-wraper sina-flex">
														<div class="sina-pt-title">
															<h3 data-sina-pt="#<?php echo esc_attr( $pid ); ?>"><?php the_title(); ?></h3>
															<?php if ('yes' == $data['date']): ?>
																<p><span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?></p>
															<?php endif ?>
														</div>
													</div>
												<?php else: ?>
													<div class="sina-pt-title-wraper sina-flex">
														<div class="sina-pt-title">
															<h3 data-sina-pt="#<?php echo esc_attr( $pid ); ?>"><?php the_title(); ?></h3>
															<?php if ('yes' == $data['date']): ?>
																<p><span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?></p>
															<?php endif ?>
														</div>
													</div>
													<?php if ( get_the_post_thumbnail_url() ): ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
														</div>
													<?php else: ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>)">
														</div>
													<?php endif; ?>
												<?php endif ?>
											</div>
											<?php
											$pc++;
										endwhile;
										wp_reset_query();
									?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div><!-- .sina-posts-tab -->
			<?php
		endif;
	}


	protected function _content_template() {

	}
}