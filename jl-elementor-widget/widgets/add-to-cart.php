<?php
namespace JL_Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Button;
use ElementorPro\Base\Base_Widget_Trait;
use ElementorPro\Modules\QueryControl\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Widget_JL_Add_To_Cart extends Widget_Button {

	use Base_Widget_Trait;

	public function get_name() {
		return 'jl-add-to-cart';
	}

	public function get_title() {
		return esc_html__( 'JL Add To Cart', 'elementor-pro' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'cart', 'product', 'button', 'add to cart' ];
	}

	public function on_export( $element ) {
		unset( $element['settings']['product_id'] );

		return $element;
	}

	public function unescape_html( $safe_text, $text ) {
		return $text;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Inline', 'elementor-pro' ),
					'stacked' => esc_html__( 'Stacked', 'elementor-pro' ),
					'auto' => esc_html__( 'Auto', 'elementor-pro' ),
				],
				'prefix_class' => 'elementor-add-to-cart--layout-',
				'render_type' => 'template',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_button_style',
			[
				'label' => esc_html__( 'Button', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wc_style_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'elementor-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor-add-to-cart%s--align-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .cart button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .cart button',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'button_style_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor-pro' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor-pro' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.2,
				],
				'range' => [
					'px' => [
						'max' => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cart button' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_quantity_style',
			[
				'label' => esc_html__( 'Quantity', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}}' => '--button-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'quantity_typography',
				'selector' => '{{WRAPPER}} .quantity .qty',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'quantity_border',
				'selector' => '{{WRAPPER}} .quantity .qty',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'quantity_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quantity_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'quantity_style_tabs' );

		$this->start_controls_tab( 'quantity_style_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor-pro' ),
			]
		);

		$this->add_control(
			'quantity_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'quantity_style_focus',
			[
				'label' => esc_html__( 'Focus', 'elementor-pro' ),
			]
		);

		$this->add_control(
			'quantity_text_color_focus',
			[
				'label' => esc_html__( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_bg_color_focus',
			[
				'label' => esc_html__( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_border_color_focus',
			[
				'label' => esc_html__( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.2,
				],
				'range' => [
					'px' => [
						'max' => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_variations_style',
			[
				'label' => esc_html__( 'Variations', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'variations_width',
			[
				'label' => esc_html__( 'Width', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart .variations' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'variations_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart .variations' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'variations_space_between',
			[
				'label' => esc_html__( 'Space Between', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations tr th, .woocommerce {{WRAPPER}} form.cart table.variations tr td' => 'padding-top: calc( {{SIZE}}{{UNIT}}/2 ); padding-bottom: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_control(
			'heading_variations_label_style',
			[
				'label' => esc_html__( 'Label', 'elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'variations_label_color_focus',
			[
				'label' => esc_html__( 'Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'variations_label_typography',
				'selector' => '.woocommerce {{WRAPPER}} form.cart table.variations label',
			]
		);

		$this->add_control(
			'heading_variations_select_style',
			[
				'label' => esc_html__( 'Select field', 'elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'variations_select_color',
			[
				'label' => esc_html__( 'Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations td.value select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'variations_select_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations td.value select, .woocommerce {{WRAPPER}} form.cart table.variations td.value:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'variations_select_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations td.value select, .woocommerce {{WRAPPER}} form.cart table.variations td.value:before' => 'border: 1px solid {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'variations_select_typography',
				'selector' => '.woocommerce {{WRAPPER}} form.cart table.variations td.value select, .woocommerce div.product.elementor{{WRAPPER}} form.cart table.variations td.value:before',
			]
		);

		$this->add_control(
			'variations_select_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'.woocommerce {{WRAPPER}} form.cart table.variations td.value select, .woocommerce {{WRAPPER}} form.cart table.variations td.value:before' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		if ( in_array( $settings['layout'], [ 'auto', 'stacked' ] ) ) {
			add_action( 'woocommerce_before_add_to_cart_quantity', [ $this, 'before_add_to_cart_quantity' ], 95 );
			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'after_add_to_cart_button' ], 5 );
		}
		?>

		<div class="elementor-add-to-cart elementor-product-<?php echo esc_attr( wc_get_product()->get_type() ); ?>">
			<?php 
				if ($product->get_type() == 'simple') {
					wc_get_template( 'single-product/add-to-cart/simple.php' );
				}	
				if ($product->get_type() == 'grouped') {
					$products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

					if ( $products ) {
						wc_get_template(
							'single-product/add-to-cart/grouped.php',
							array(
								'grouped_product'    => $product,
								'grouped_products'   => $products,
								'quantites_required' => false,
							)
						);
					}
				}	
				if ($product->get_type() == 'external') {
					if ( ! $product->add_to_cart_url() ) {
						return;
					}

					wc_get_template(
						'single-product/add-to-cart/external.php',
						array(
							'product_url' => $product->add_to_cart_url(),
							'button_text' => $product->single_add_to_cart_text(),
						)
					);
				}	
				if ($product->get_type() == 'variable') {
					// Enqueue variation scripts.
					wp_enqueue_script( 'wc-add-to-cart-variation' );

					// Get Available variations?
					$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

					
					wc_get_template(
						'../../jl-elementor-widget/templates/variable.php',
						array(
							'available_variations' => $get_variations ? $product->get_available_variations() : false,
							'attributes'           => $product->get_variation_attributes(),
							'selected_attributes'  => $product->get_default_attributes(),
						)
					);
				}	
				
			 ?>
		</div>

		<?php
		if ( in_array( $settings['layout'], [ 'auto', 'stacked' ] ) ) {
			remove_action( 'woocommerce_before_add_to_cart_quantity', [ $this, 'before_add_to_cart_quantity' ], 95 );
			remove_action( 'woocommerce_after_add_to_cart_button', [ $this, 'after_add_to_cart_button' ], 5 );
		}
	}

	/**
	 * Before Add to Cart Quantity
	 *
	 * Added wrapper tag around the quantity input and "Add to Cart" button
	 * used to more solidly accommodate the layout when additional elements
	 * are added by 3rd party plugins.
	 *
	 * @since 3.6.0
	 */
	public function before_add_to_cart_quantity() {
		?>
		<div class="e-atc-qty-button-holder">
		<?php
	}

	/**
	 * After Add to Cart Quantity
	 *
	 * @since 3.6.0
	 */
	public function after_add_to_cart_button() {
		?>
		</div>
		<?php
	}

	/**
	 * @param \WC_Product $product
	 */
	private function render_ajax_button( $product ) {
		$settings = $this->get_settings_for_display();

		if ( $product ) {
			if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
				$product_type = $product->get_type();
			} else {
				$product_type = $product->product_type;
			}

			$class = implode( ' ', array_filter( [
				'product_type_' . $product_type,
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			] ) );

			$this->add_render_attribute( 'button',
				[
					'rel' => 'nofollow',
					'href' => $product->add_to_cart_url(),
					'data-quantity' => ( isset( $settings['quantity'] ) ? $settings['quantity'] : 1 ),
					'data-product_id' => $product->get_id(),
					'class' => $class,
				]
			);

		} elseif ( current_user_can( 'manage_options' ) ) {
			$settings['text'] = esc_html__( 'Please set a valid product', 'elementor-pro' );
			$this->set_settings( $settings );
		}

		parent::render();
	}

	private function render_form_button( $product ) {
		if ( ! $product && current_user_can( 'manage_options' ) ) {
			echo esc_html__( 'Please set a valid product', 'elementor-pro' );

			return;
		}

		$text_callback = function() {
			ob_start();
			$this->render_text();

			return ob_get_clean();
		};

		add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
		add_filter( 'woocommerce_product_single_add_to_cart_text', $text_callback );
		add_filter( 'esc_html', [ $this, 'unescape_html' ], 10, 2 );

		ob_start();
		woocommerce_template_single_add_to_cart();
		$form = ob_get_clean();
		$form = str_replace( 'single_add_to_cart_button', 'single_add_to_cart_button elementor-button', $form );

		// PHPCS - The HTML from 'woocommerce_template_single_add_to_cart' is safe.
		echo $form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		remove_filter( 'woocommerce_product_single_add_to_cart_text', $text_callback );
		remove_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
		remove_filter( 'esc_html', [ $this, 'unescape_html' ] );
	}

	/**
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	// Force remote render
	protected function content_template() {}

	public function get_group_name() {
		return 'woocommerce';
	}
}
