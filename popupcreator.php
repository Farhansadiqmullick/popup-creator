<?php

/*
Plugin Name: Popup Creator WPPOOL
Plugin URI: https://wppool.dev
Description: Creates Beautiful Popups
Version: 1.0
Author: WPPOOL
Author URI: https://wppool.dev
License: GPLv2 or later
Text Domain: popupcreator
Domain Path: /languages/
Plugin Type: Piklist
*/

class PopupCreator
{
	public function __construct()
	{
		add_action('plugins_loaded', array($this, 'load_textdomain'));
		add_action('init', array($this, 'register_cpt_popup'));
		add_action('init', array($this, 'register_popup_size'));
		add_action('wp_enqueue_scripts', array($this, 'load_assets'));
		add_action('wp_footer', array($this, 'print_modal_markup'));
	}

	function load_assets()
	{
		wp_enqueue_style('popupcreator-css', plugin_dir_url(__FILE__) . "assets/css/modal.css", null, time());
		wp_enqueue_style('popupcreator-style-css', plugin_dir_url(__FILE__) . "assets/css/styles.css", null, time(), 'all');
		wp_enqueue_script('plainmodal-js', plugin_dir_url(__FILE__) . "assets/js/plain-modal.min.js", null, "1.0.27", true);
		wp_enqueue_script('popupcreator-main', plugin_dir_url(__FILE__) . "assets/js/popupcreator-main.js", array(
			'jquery',
			'plainmodal-js'
		), time(), true);
	}

	function register_popup_size()
	{
		add_image_size('popup-landscape', '800', '500', true);
		add_image_size('popup-square', '500', '500', true);
	}

	function load_textdomain()
	{
		load_plugin_textdomain('popupcreator', false, plugin_dir_path(__FILE__) . "languages");
	}

	function register_cpt_popup()
	{

		$labels = array(
			"name"               => __("Popups", "popupcreator"),
			"singular_name"      => __("Popup", "popupcreator"),
			"featured_image"     => __('Popup Image', 'popupcreator'),
			"set_featured_image" => __('Set Popup Image', 'popupcreator')
		);

		$args = array(
			"label"               => __("Popups", "popupcreator"),
			"labels"              => $labels,
			"description"         => "",
			"public"              => false,
			"publicly_queryable"  => true,
			"show_ui"             => true,
			"delete_with_user"    => false,
			"show_in_rest"        => true,
			"has_archive"         => false,
			"show_in_menu"        => true,
			"show_in_nav_menus"   => false,
			"exclude_from_search" => true,
			"capability_type"     => "post",
			"map_meta_cap"        => true,
			"hierarchical"        => false,
			"rewrite"             => array("slug" => "popup", "with_front" => true),
			"query_var"           => true,
			"supports"            => array("title", "thumbnail"),
		);

		register_post_type("popup", $args);
	}

	function print_modal_markup()
	{
		$arguments = array(
			'post_type'   => 'popup',
			'post_status' => 'publish',
			'meta_key'    => 'popupcreator_active',
			'meta_value'  => 1
		);
		$query     = new WP_Query($arguments);
		while ($query->have_posts()) {
			$query->the_post();
			$size  = get_post_meta(get_the_ID(), 'popupcreator_popup_size', true);
			$popupDisplay = get_post_meta(get_the_ID(), 'popupcreator_display', true);
			$backgroundColor = get_post_meta(get_the_ID(), 'popupcreator_background_color', true);
			$exit  = get_post_meta(get_the_ID(), 'popupcreator_on_exit', true);
			$promoTitle = get_post_meta(get_the_ID(), 'popupcreator_promo_text', true);
			$promoImage = get_post_meta(get_the_ID(), 'popupcreator_image_upload_field', true);
			$discountText  = get_post_meta(get_the_ID(), 'popupcreator_discount_text', true);
			$discountColor  = get_post_meta(get_the_ID(), 'popupcreator_discount_color', true);
			$discountBackground  = get_post_meta(get_the_ID(), 'popupcreator_discount_background', true);
			$deadlineBackground  = get_post_meta(get_the_ID(), 'popupcreator_deadline_background', true);
			$buttonTxt  = get_post_meta(get_the_ID(), 'popupcreator_button_text', true);
			$promoUrl  = get_post_meta(get_the_ID(), 'popupcreator_url', true);
			$dateTime  = get_post_meta(get_the_ID(), 'popupcreator_date_field', true);
			$close_button_height = get_post_meta(get_the_ID(), 'close_button_field', true);
			//$dateTime = substr($dateTime, 4, 2);
			$delay = get_post_meta(get_the_ID(), 'popupcreator_display_after', true);
			if ($delay > 0) {
				$delay *= 1000;
			} else {
				$delay = 0;
			}
			$backgroundImage = get_the_post_thumbnail_url(get_the_ID(), $size);
			$promoImage = wp_get_attachment_image_src($promoImage);
			

?>

			<div class="modal-content" data-modal-id="<?php the_ID(); ?>" data-size="<?php echo esc_attr($size); ?>" data-exit="<?php echo esc_attr($exit); ?>" data-delay="<?php echo esc_attr($delay); ?>">
			<?php if($popupDisplay == 1): ?>
				<div class="jitsi-promo-inner" style="background-color:<?php echo $backgroundColor ?? '#000'; ?> ">
					<span class="close-promo">&times;</span>
					<img src="<?php echo esc_url($backgroundImage); ?>" class="promo-img">
					<h3 class="promo-title"><?php echo $promoTitle; ?></h3>
					<?php if ($promoImage != '') : ?>
						<div class="discount-img">
							<img src="<?php echo $promoImage[0]; ?>" alt="Image" />
						</div>
					<?php endif; ?>
					<div class="discount"><span style="color:<?php echo $discountColor; ?>;background:<?php echo $discountBackground; ?>;" class="discount-special">SPECIAL</span><span class="discount-text"><?php echo $discountText; ?></span></div>
					<div class="simple_timer">
						<!--days-->
						<div class="deadline-format" style="background-color: <?php echo $deadlineBackground; ?>">
							<div class="date-count">
								<h4 class="days" data-countdown="<?php echo $dateTime; ?>"></h4>
								<span>days</span>
							</div>
						</div>
						<!--end of days-->
						<!--hours-->
						<div class="deadline-format" style="background-color: <?php echo $deadlineBackground; ?>">
							<div>
								<h4 class="hours">34</h4>
								<span>hours</span>
							</div>
						</div>
						<!--end of hours-->
						<!--minutes-->
						<div class="deadline-format" style="background-color: <?php echo $deadlineBackground; ?>">
							<div>
								<h4 class="minutes">34</h4>
								<span>minutes</span>
							</div>
						</div>
						<!--end of minutes-->
						<!--seconds-->
						<div class="deadline-format" style="background-color: <?php echo $deadlineBackground; ?>">
							<div>
								<h4 class="seconds">34</h4>
								<span>seconds</span>
							</div>
						</div>
						<!--end of seconds-->
					</div>
					<a href="<?php echo $promoUrl; ?>" target="_blank"><?php echo $buttonTxt; ?></a>
				</div>
		<?php elseif($popupDisplay == 0): ?>

				<div class="image-box scroll"><span style="top:calc(<?php echo $close_button_height; ?>%); " class="close-promo">&times;</span>
				<a target="_blank" href="<?php echo $promoUrl; ?>"><img src="<?php echo $backgroundImage; ?>" alt="Popup"></a>
				</div>
			</div>
<?php endif;
		}
		wp_reset_query();
	}
}

new PopupCreator();
