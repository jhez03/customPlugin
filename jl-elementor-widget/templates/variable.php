<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<style type="text/css">
	.variable-items-wrapper {

	  margin: 0 !important;
	  padding: 5px;
	  list-style: none;
	}
.variable-items-wrapper .variable-item.button-variable-item {
    width: 100px;
}
.variable-items-wrapper .variable-item:not(.radio-variable-item).button-variable-item {
    text-align: center;
}
.variable-items-wrapper .variable-item {
    border-radius: 2px;
}
.variable-items-wrapper .variable-item:not(.radio-variable-item) {

    display: flex;
    justify-content: center;
    align-items: center;


}
.variable-items-wrapper .variable-item {
    margin: 0;
    padding: 0;
    list-style: none;
    transition: all .2s ease;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    outline: none;
}
.jl-variation-swatches td:not(.jl-label){
	    flex: 50%;
    box-sizing: border-box;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    box-shadow: 0 0 0 1px rgb(0 0 0 / 30%);
    padding: 2px;
    margin: 4px 8px 4px 0;
}
/*hover*/
.jl-variation-swatches td:not(.jl-label):hover {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
}

.jl-variation-swatches td:focus {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.3);
}

.jl-variation-swatches td.selected,
.jl-variation-swatches td.selected{
  box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.9);
  
}

/* Tooltip container */
.jl-variation-swatches .radio-variable-item[data-wvstooltip] {
  position: relative;
}

.jl-variation-swatches .radio-variable-item[data-wvstooltip]::before,
.jl-variation-swatches .radio-variable-item[data-wvstooltip]::after {
  left: 8px;
  bottom: 100%;
}

.jl-variation-swatches .radio-variable-item .image-tooltip-wrapper {
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  left: 8px;
}

.jl-variation-swatches.wvs-archive-align-center .wvs-archive-variation-wrapper .radio-variable-item[data-wvstooltip]::before,
.jl-variation-swatches.wvs-archive-align-center .wvs-archive-variation-wrapper .radio-variable-item[data-wvstooltip]::after {
  left: 50%;
}

.jl-variation-swatches.wvs-archive-align-center .wvs-archive-variation-wrapper .radio-variable-item .image-tooltip-wrapper {
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  left: 50%;
}

.jl-variation-swatches.wvs-archive-align-right .wvs-archive-variation-wrapper .radio-variable-item[data-wvstooltip]::before,
.jl-variation-swatches.wvs-archive-align-right .wvs-archive-variation-wrapper .radio-variable-item[data-wvstooltip]::after {
  left: 100%;
}

.jl-variation-swatches.wvs-archive-align-right .wvs-archive-variation-wrapper .radio-variable-item .image-tooltip-wrapper {
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  left: 100%;
}

[data-wvstooltip],
.wvs-has-image-tooltip {
  position: relative;
  cursor: pointer;
  outline: none;
}

[data-wvstooltip]:before,
[data-wvstooltip]:after,
.wvs-has-image-tooltip:before,
.wvs-has-image-tooltip:after {
  visibility: hidden;
  opacity: 0;
  pointer-events: none;
  box-sizing: inherit;
  position: absolute;
  bottom: 130%;
  left: 50%;
  z-index: 999;
  -webkit-transform: translateZ(0);
          transform: translateZ(0);
  box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
  transition: opacity 300ms linear, bottom 300ms linear;
}

[data-wvstooltip]:before,
.wvs-has-image-tooltip:before {
  margin-bottom: 5px;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  padding: 7px;
  border-radius: 3px;
  background-color: #000;
  background-color: rgba(51, 51, 51, 0.9);
  color: #fff;
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

[data-wvstooltip]:before {
  min-width: 100px;
  content: attr(data-wvstooltip);
}

.wvs-has-image-tooltip:before {
  content: attr(data-title);
  background-image: var(--tooltip-background);
  background-repeat: no-repeat;
  width: var(--tooltip-width);
  height: calc( var(--tooltip-height) + 20px);
  background-size: contain;
  border: 2px solid;
  background-position: center top;
  padding: 0;
  line-height: 20px;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  font-size: 12px;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
}

[data-wvstooltip]:after,
.wvs-has-image-tooltip:after {
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000000;
  border-top: 5px solid rgba(51, 51, 51, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

[data-wvstooltip]:hover:before,
[data-wvstooltip]:hover:after,
.wvs-has-image-tooltip:hover:before,
.wvs-has-image-tooltip:hover:after {
  bottom: 120%;
  visibility: visible;
  opacity: 1;
}
.jl-variation-swatches .hidden{
	display: none !important;
}

</style>
<script type="text/javascript">
	jQuery( function($) {
		
		$(".variable-items-wrapper").closest('td').click(function(){
			var attributeName = $(this).data('attribute');
			
            $('td.selected').removeClass('selected');
		  	$(this).addClass('selected');
		  	//add gray color on non selected
		  	$('.jl-variation-swatches td:not(.selected, .jl-label)').css({
		
		  		"background-color" : "rgba(0, 0, 0, 0.1)"
		  	})
		  	$('.jl-variation-swatches td.selected:not(.jl-label)').css({
		
		  		"background-color" : "#fff"
		  	})
		  	$(".jl-variation-swatches .value").closest('tr').addClass('hidden')
		  	$("select[data-attribute_name=attribute_"+attributeName+"]").closest('td').closest('tr').removeClass('hidden')

		});

	})
</script>
<form class="variations_form cart  " action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<div class="single_variation_wrap">
			<div class="elementor-shortcode jl_turnto_stars" >
			<?php
			echo do_shortcode('[turnto_stars_under_title]');
			?>
			</div>
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				?>
				<table class="variations jl-variation-swatches " cellspacing="0">
					<tbody>
							<tr>
								<td class="jl-label">How would you like to shop?</td>
							</tr>
							<tr>

							  
									<?php foreach ( $attributes as $attribute_name => $options ) : ?>

										<td data-attribute="<?php echo $attribute_name; ?>">

													<ul class="variable-items-wrapper" data-wvstooltip="<?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>">
														
													<li class="variable-item">
														<div class="variable-item-contents">
															<span><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></span>
														</div>
													</li>
													</ul>
										</td>
									<?php endforeach; ?>
									
							</tr>
					</tbody>
					<tbody>
						<?php foreach ( $attributes as $attribute_name => $options ) : ?>
							<tr class="hidden">
							
								<td class="value">
									<?php
										wc_dropdown_variation_attribute_options(
											array(
												'options'   => $options,
												'attribute' => $attribute_name,
												'product'   => $product,
											)
										);
										
									?>
								</td>
								<?php
								//echo wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) ;
								?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<?php
				echo '<div class="woocommerce-variation single_variation"></div>';
				wc_get_template( '../../jl-elementor-widget/templates/variation-add-to-cart-button.php' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
