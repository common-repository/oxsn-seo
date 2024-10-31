<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: OXSN SEO
Plugin URI: https://wordpress.org/plugins/oxsn-seo/
Description: This plugin adds helpful seo shortcodes with quicktags!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.3
*/


define( 'oxsn_seo_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_seo_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_seo_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_seo_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_seo_settings_link', 10, 2 );
	function oxsn_seo_settings_link( $links, $file ) {

		if ( $file != oxsn_seo_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-seo', false ) . '">' . esc_html( __( 'Settings', 'oxsn-seo' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}


?><?php


/* OXSN Dashboard Tab */

if ( !function_exists('oxsn_dashboard_tab_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_tab_nav_item');
	function oxsn_dashboard_tab_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard_tab' );

	}

}

if ( !function_exists('oxsn_dashboard_tab') ) {

	function oxsn_dashboard_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN / Digital Agency</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Plugin Tab */

if ( ! function_exists ( 'oxsn_seo_plugin_tab_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_seo_plugin_tab_nav_item', 99);
	function oxsn_seo_plugin_tab_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN SEO', 'SEO', 'manage_options', 'oxsn-seo', 'oxsn_seo_plugin_tab');

	}

}

if ( !function_exists('oxsn_seo_plugin_tab') ) {

	function oxsn_seo_plugin_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN / SEO Plugin</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p>Coming soon.</p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-seo" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Include in Header */

if ( ! function_exists ( 'oxsn_seo_header_inc' ) ) {

	add_action( 'wp_head', 'oxsn_seo_header_inc', 1);
	function oxsn_seo_header_inc() { 

		$ID = get_the_ID();

		$oxsn_seo_title = get_post_meta( $ID, 'oxsn_seo_title', true );
		if ($oxsn_seo_title != '') :
			$oxsn_seo_title_display = '<title>' . $oxsn_seo_title . '</title>';
			$oxsn_seo_title_display .= '<meta property="og:title" content="' . $oxsn_seo_title . '">';
			$oxsn_seo_title_display .= '<meta name="twitter:title" content="' . $oxsn_seo_title . '">';
			echo $oxsn_seo_title_display;
		else :
			$oxsn_seo_title = get_post($ID);
			$oxsn_seo_title = $oxsn_seo_title->post_title . ' - ' . get_bloginfo('name');
			$oxsn_seo_title_display = '<title>' . $oxsn_seo_title . '</title>';
			$oxsn_seo_title_display .= '<meta property="og:title" content="' . $oxsn_seo_title . '">';
			$oxsn_seo_title_display .= '<meta name="twitter:title" content="' . $oxsn_seo_title . '">';
			echo $oxsn_seo_title_display;
		endif;

		$oxsn_seo_description = get_post_meta( $ID, 'oxsn_seo_description', true );
		if ($oxsn_seo_description != '') :
			$oxsn_seo_description_display = '<meta name="description" content="' . $oxsn_seo_description . '" />';
			$oxsn_seo_description_display .= '<meta property="og:description" content="' . $oxsn_seo_description  . '">';
			$oxsn_seo_description_display .= '<meta name="twitter:description" content="' . $oxsn_seo_description . '">';
			echo $oxsn_seo_description_display;
		endif;

		$oxsn_seo_keywords = get_post_meta( $ID, 'oxsn_seo_keywords', true );
		if ($oxsn_seo_keywords != '') :
			$oxsn_seo_keywords_display = '<meta name="keywords" content="' . $oxsn_seo_keywords . '" />';
			echo $oxsn_seo_keywords_display;
		endif;

		$oxsn_seo_robots = get_post_meta( $ID, 'oxsn_seo_robots', true );
		if ($oxsn_seo_robots != '') :
			$oxsn_seo_robots_display = '<meta name="robots" content="' . $oxsn_seo_robots . '" />';
			echo $oxsn_seo_robots_display;
		endif;

		$oxsn_seo_schema = get_post_meta( $ID, 'oxsn_seo_schema', true );
		if ($oxsn_seo_schema != '') :
			$oxsn_seo_schema_display = '<noscript>' . $oxsn_seo_schema . '</noscript>';
			echo $oxsn_seo_schema_display;
		endif;

	}

}


?><?php


/* OXSN Remove Title */

if ( ! function_exists ( 'oxsn_seo_remove_title' ) ) {

	add_action( 'init', 'oxsn_seo_remove_title');
	function oxsn_seo_remove_title() { 

		remove_theme_support('title-tag');

	}

}


?><?php


/* OXSN Include Meta Box */

class oxsn_seo_custom_fields {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {

			add_meta_box(
				'oxsn_seo_options',
				__( 'OXSN SEO', 'text_domain' ),
				array( $this, 'render_metabox' ),
				'',
				'normal',
				'default'
			);

		}

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'oxsn_seo_nonce_action', 'oxsn_seo_nonce' );

		// Retrieve an existing value from the database.
		$oxsn_seo_title = get_post_meta( $post->ID, 'oxsn_seo_title', true );
		$oxsn_seo_description = get_post_meta( $post->ID, 'oxsn_seo_description', true );
		$oxsn_seo_keywords = get_post_meta( $post->ID, 'oxsn_seo_keywords', true );

		// Set default values.
		if( empty( $oxsn_seo_title ) ) $oxsn_seo_title = '';
		if( empty( $oxsn_seo_description ) ) $oxsn_seo_description = '';
		if( empty( $oxsn_seo_keywords ) ) $oxsn_seo_keywords = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="oxsn_seo_title" class="oxsn_seo_title_label">' . __( 'Title', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="oxsn_seo_title" name="oxsn_seo_title" class="oxsn_seo_title_field oxsn_xs_width_100pr" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $oxsn_seo_title ) . '">';
		echo '			<p class="description">' . __( 'Place the title of this page here.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="oxsn_seo_description" class="oxsn_seo_description_label">' . __( 'Description', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="oxsn_seo_description" name="oxsn_seo_description" class="oxsn_seo_description_field oxsn_xs_width_100pr" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $oxsn_seo_description ) . '">';
		echo '			<p class="description">' . __( 'Place the description of this page here.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="oxsn_seo_keywords" class="oxsn_seo_keywords_label">' . __( 'Keywords', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="oxsn_seo_keywords" name="oxsn_seo_keywords" class="oxsn_seo_keywords_field oxsn_xs_width_100pr" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $oxsn_seo_keywords ) . '">';
		echo '			<p class="description">' . __( 'Place the keywords of this page here.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['oxsn_seo_nonce'] ) ? $_POST['oxsn_seo_nonce'] : '';
		$nonce_action = 'oxsn_seo_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Sanitize user input.
		$oxsn_seo_title_new = isset( $_POST[ 'oxsn_seo_title' ] ) ? sanitize_text_field( $_POST[ 'oxsn_seo_title' ] ) : '';
		$oxsn_seo_description_new = isset( $_POST[ 'oxsn_seo_description' ] ) ? sanitize_text_field( $_POST[ 'oxsn_seo_description' ] ) : '';
		$oxsn_seo_keywords_new = isset( $_POST[ 'oxsn_seo_keywords' ] ) ? sanitize_text_field( $_POST[ 'oxsn_seo_keywords' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'oxsn_seo_title', $oxsn_seo_title_new );
		update_post_meta( $post_id, 'oxsn_seo_description', $oxsn_seo_description_new );
		update_post_meta( $post_id, 'oxsn_seo_keywords', $oxsn_seo_keywords_new );

	}

}

new oxsn_seo_custom_fields;


?>