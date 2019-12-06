<?php
/**
 * Display all Freesia Corporate functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Freesia Corporate
 * @since Freesia Corporate 1.0
 */

add_action( 'wp_enqueue_scripts', 'freesia_corporate_enqueue_styles' );

function freesia_corporate_enqueue_styles() {
	$freesia_corporate_color_styles = get_theme_mod('freesia_corporate_colors','pink-color');

	wp_enqueue_style( 'freesia-corporate-parent-style', trailingslashit(get_template_directory_uri() ) . 'style.css');


	if($freesia_corporate_color_styles == 'pink-color'){
		wp_enqueue_style( 'freesia-corporate-pink', trailingslashit(get_stylesheet_directory_uri() ) . 'css/pink-color-style.css');
	} elseif($freesia_corporate_color_styles == 'blue-color'){
		wp_enqueue_style( 'freesia-corporate-blue', trailingslashit(get_stylesheet_directory_uri() ) . 'css/blue-color-style.css');
	} else {
		wp_enqueue_style( 'freesia-corporate-green', trailingslashit(get_stylesheet_directory_uri() ) . 'css/green-color-style.css');
	}
}

function freesia_corporate_admin_css (){

  wp_enqueue_style( 'freesia-corporate-admin-css', get_stylesheet_directory_uri() . '/css/admin/admin.css' );

}

add_action( 'admin_enqueue_scripts', 'freesia_corporate_admin_css' );

require get_stylesheet_directory() . '/inc/welcome-notice.php';

function freesia_corporate_customize_register( $wp_customize ) {
	if(!class_exists('Freesia_Empire_Plus_Features')){
		class Freesia_Corporate_Customize_upgrade extends WP_Customize_Control {
			public function render_content() { ?>
				<a title="<?php esc_attr_e( 'Review Freesia Corporate', 'freesia-corporate' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/freesia-corporate/' ); ?>" target="_blank" id="about-freesia-corporate">
				<?php esc_html_e( 'Review Freesia Corporate', 'freesia-corporate' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/freesia-corporate/' ); ?>" title="<?php esc_attr_e( 'Theme Instructions', 'freesia-corporate' ); ?>" target="_blank" id="about-freesia-corporate">
				<?php esc_html_e( 'Theme Instructions', 'freesia-corporate' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://tickets.themefreesia.com' ); ?>" title="<?php esc_attr_e( 'Support Ticket', 'freesia-corporate' ); ?>" target="_blank" id="about-freesia-corporate">
				<?php esc_html_e( 'Tickets', 'freesia-corporate' ); ?>
				</a><br/>
			<?php
			}
		}

		$wp_customize->add_section('freesia_corporate_upgrade_links', array(
			'title'					=> __('About Freesia Corporate', 'freesia-corporate'),
			'priority'				=> 1000,
		));
		$wp_customize->add_setting( 'freesia_corporate_upgrade_links', array(
			'default'				=> false,
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new Freesia_Corporate_Customize_upgrade(
			$wp_customize,
			'freesia_corporate_upgrade_links',
				array(
					'section'				=> 'freesia_corporate_upgrade_links',
					'settings'				=> 'freesia_corporate_upgrade_links',
				)
			)
		);
	}
}
	add_action( 'customize_register', 'freesia_corporate_customize_register' );

	/************ Renaming Panel and Section Customizer name  to Freesia Corporate *******************/
	add_action( 'customize_register', 'freesia_corporate_customize_register_wordpress_default' );
	function freesia_corporate_customize_register_wordpress_default( $wp_customize ) {
		$wp_customize->add_panel( 'freesiaempire_wordpress_default_panel', array(
			'priority' => 5,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Freesia Corporate WordPress Settings', 'freesia-corporate' ),
			'description' => '',
		) );
	}
	add_action( 'customize_register', 'freesia_corporate_customize_register_options', 20 );
	function freesia_corporate_customize_register_options( $wp_customize ) {
		$wp_customize->add_panel( 'freesiaempire_options_panel', array(
			'priority' => 6,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Freesia Corporate Theme Options', 'freesia-corporate' ),
			'description' => '',
		) );
	}
	add_action( 'customize_register', 'freesia_corporate_customize_register_featuredcontent' );
	function freesia_corporate_customize_register_featuredcontent( $wp_customize ) {
		$wp_customize->add_panel( 'freesiaempire_featuredcontent_panel', array(
			'priority' => 7,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Freesia Corporate Slider Options', 'freesia-corporate' ),
			'description' => '',
		) );
	}
	add_action( 'customize_register', 'freesia_corporate_customize_register_widgets' );
	function freesia_corporate_customize_register_widgets( $wp_customize ) {
		$wp_customize->add_panel( 'widgets', array(
			'priority' => 8,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Freesia Corporate Widgets', 'freesia-corporate' ),
			'description' => '',
		) );
	}

	add_action( 'customize_register', 'freesia_corporate_customize_register_color_styles' );
	function freesia_corporate_customize_register_color_styles( $wp_customize ) {
		$wp_customize->add_setting('freesia_corporate_colors', array(
			'default' => 'pink-color',
			'sanitize_callback' => 'freesiaempire_sanitize_select',
			));
		$wp_customize->add_control('freesia_corporate_colors', array(
			'priority' =>10,
			'label' => __('Custom Color Styles', 'freesia-corporate'),
			'description' => __('Change Color Styles into Blue and Green Color. If Plus version used, this feature is Optional', 'freesia-corporate'),
			'section' => 'colors',
			'settings' => 'freesia_corporate_colors',
			'type' => 'select',
			'checked' => 'checked',
			'choices' => array(
				'pink-color' => __('Pink ','freesia-corporate'),
				'blue-color' => __('Blue','freesia-corporate'),
				'green-color' => __('Green','freesia-corporate'),
			),
		));
	}

if(!class_exists('Freesia_Empire_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}
