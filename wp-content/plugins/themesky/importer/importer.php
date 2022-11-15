<?php 
if( !class_exists('TS_Importer') ){
	class TS_Importer{

		function __construct(){
			add_filter( 'ocdi/plugin_page_title', array($this, 'import_notice') );
			
			add_filter( 'pt-ocdi/plugin_page_setup', array($this, 'import_page_setup') );
			add_action( 'pt-ocdi/before_widgets_import', array($this, 'before_widgets_import') );
			add_filter( 'pt-ocdi/import_files', array($this, 'import_files') );
			add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
			add_action( 'pt-ocdi/after_import', array($this, 'after_import_setup') );
			
			add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
		}
		
		function import_notice( $plugin_title ){
			$allowed_html = array(
				'a' => array( 'href' => array(), 'target' => array() )
			);
			ob_start();
			?>
			<div class="ts-ocdi-notice-info">
				<p>
					<i class="fa fas fa-exclamation-circle"></i>
					<span><?php echo wp_kses( __('If you have any problem with importer, please read this article <a href="https://ocdi.com/import-issues/" target="_blank">https://ocdi.com/import-issues/</a> and check your hosting configuration, or contact our support team here <a href="https://skygroup.ticksy.com/" target="_blank">https://skygroup.ticksy.com/</a>.', 'themesky'), $allowed_html ); ?></span>
				</p>
			</div>
			<?php
			$plugin_title .= ob_get_clean();
			return $plugin_title;
		}
		
		function import_page_setup( $default_settings ){
			$default_settings['parent_slug'] = 'themes.php';
			$default_settings['page_title']  = esc_html__( 'BoxShop - Import Demo Content' , 'themesky' );
			$default_settings['menu_title']  = esc_html__( 'BoxShop Importer' , 'themesky' );
			$default_settings['capability']  = 'import';
			$default_settings['menu_slug']   = 'boxshop-importer';
			return $default_settings;
		}
		
		function before_widgets_import(){
			global $wp_registered_sidebars;
			$file_path = dirname(__FILE__) . '/data/custom_sidebars.txt';
			if( file_exists($file_path) ){
				$file_url = plugin_dir_url(__FILE__) . 'data/custom_sidebars.txt';
				$custom_sidebars = wp_remote_get( $file_url );
				$custom_sidebars = maybe_unserialize( trim( $custom_sidebars['body'] ) );
				update_option('ts_custom_sidebars', $custom_sidebars);
				
				if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
					foreach( $custom_sidebars as $name ){
						$custom_sidebar = array(
											'name' 			=> ''.$name.''
											,'id' 			=> sanitize_title($name)
											,'description' 	=> ''
											,'class'		=> 'ts-custom-sidebar'
										);
						if( !isset($wp_registered_sidebars[$custom_sidebar['id']]) ){
							$wp_registered_sidebars[$custom_sidebar['id']] = $custom_sidebar;
						}
					}
				}
			}
		}
		
		function import_files(){
			return array(
				array(
					'import_file_name'           => 'Demo Import',
					'import_file_url'            => plugin_dir_url( __FILE__ ) . 'data/content.xml',
					'import_widget_file_url'     => plugin_dir_url( __FILE__ ) . 'data/widget_data.wie'
				)
			);
		}
		
		function after_import_setup(){
			set_time_limit(0);
			$this->import_theme_options();
			$this->woocommerce_settings();
			$this->menu_locations();
			$this->set_homepage();
			$this->import_revslider();
			$this->change_url();
			$this->update_product_category_id_in_homepage_content();
			$this->delete_transients();
			$this->update_woocommerce_lookup_table();
		}
		
		/* Import Theme Options */
		function import_theme_options(){
			$theme_options_path = dirname( __FILE__ ) . '/data/theme_options.txt';
			if( !file_exists($theme_options_path) ){
				return;
			}
			$theme_options_url = plugin_dir_url( __FILE__ ) . 'data/theme_options.txt';
			$theme_options_txt = wp_remote_get( $theme_options_url );
			$smof_data = json_decode( $theme_options_txt['body'], true );
			boxshop_of_save_options($smof_data);
		}
		
		/* WooCommerce Settings */
		function woocommerce_settings(){
			$woopages = array(
				'woocommerce_shop_page_id' 			=> 'Shop'
				,'woocommerce_cart_page_id' 		=> 'Shopping cart'
				,'woocommerce_checkout_page_id' 	=> 'Checkout'
				,'woocommerce_myaccount_page_id' 	=> 'My Account'
				,'yith_wcwl_wishlist_page_id' 		=> 'Wishlist'
			);
			foreach( $woopages as $woo_page_name => $woo_page_title ) {
				$woopage = get_page_by_title( $woo_page_title );
				if( isset( $woopage->ID ) && $woopage->ID ) {
					update_option($woo_page_name, $woopage->ID);
				}
			}
			
			if( class_exists('YITH_Woocompare') ){
				update_option('yith_woocompare_compare_button_in_products_list', 'yes');
			}

			if( class_exists('WC_Admin_Notices') ){
				WC_Admin_Notices::remove_notice('install');
			}
			delete_transient( '_wc_activation_redirect' );
			
			flush_rewrite_rules();
		}
		
		/* Menu Locations */
		function menu_locations(){
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();

			if( $menus ) {
				foreach($menus as $menu) {
					if( $menu->name == 'Menu main' ) {
						$locations['primary'] = $menu->term_id;
					}
					if( $menu->name == 'Mobile menu' ) {
						$locations['mobile'] = $menu->term_id;
					}
					if( $menu->name == 'Shop by category' ) {
						$locations['vertical'] = $menu->term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		
		/* Set Homepage */
		function set_homepage(){
			$homepage = get_page_by_title( 'Home' );
			if( is_object( $homepage ) ){
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID);
			}
		}
		
		/* Import Revolution Slider */
		function import_revslider(){
			if ( class_exists( 'RevSliderSliderImport' ) ) {
				$rev_directory = dirname(__FILE__) . '/data/revslider/';
			
				foreach( glob( $rev_directory . '*.zip' ) as $file ){
					$import = new RevSliderSliderImport();
					$import->import_slider(true, $file);  
				}
			}
		}
		
		/* Change url */
		function change_url(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			$import_url = 'https://demo.theme-sky.com/boxshop-import';
			$site_url = get_option( 'siteurl', '' );
			$wpdb->query("update `{$wp_prefix}posts` set `guid` = replace(`guid`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_content` = replace(`post_content`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '{$import_url}', '{$site_url}');");
			
			$option_names = array('ts_logo', 'ts_logo_mobile', 'ts_logo_sticky', 'ts_favicon', 'ts_prod_placeholder_img');
			foreach( $option_names as $option_name ){
				$option_value = get_theme_mod($option_name, '');
				if( $option_value ){
					$option_value = str_replace($import_url, $site_url, $option_value);
					set_theme_mod($option_name, $option_value);
				}
			}
			
			/* Update Widgets */
			$widgets = array(
				'text' => array('text')
				,'ts_single_image' => array('img_url')
				,'ts_mailchimp_subscription' => array('bg_image')
			);
			foreach( $widgets as $base => $fields ){
				$widget_instances = get_option( 'widget_' . $base, array() );
				if( is_array($widget_instances) ){
					foreach( $widget_instances as $number => $instance ){
						if( $number == '_multiwidget' ){
							continue;
						}
						foreach( $fields as $field ){
							if( isset($widget_instances[$number][$field]) ){
								$widget_instances[$number][$field] = str_replace($import_url, $site_url, $widget_instances[$number][$field]);
							}
						}
					}
					update_option( 'widget_' . $base, $widget_instances );
				}
			}
		}
		
		/* Update Product Category Id In Homepage Content */
		function update_product_category_id_in_homepage_content(){
			$product_cats = get_terms( array(
							'taxonomy'		=> 'product_cat'
							,'hide_empty'	=> true
							,'orderby'		=> 'count'
							,'order'		=> 'desc'
						)
					);
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$product_cats = wp_list_pluck( $product_cats, 'term_id' );
				$product_cats = array_values($product_cats);
				
				$pages = array(
					'Home'	=> array(
							'62, 220, 221, 80, 245, 244, 246'
							,'243, 240, 241, 165, 242, 132, 163'
							,'234, 233, 239, 235, 237, 236, 238'
							,'75, 151, 225, 124, 247'
					)
					,'Supermarket 2'	=> array(
							'220, 246, 80, 245'
							,'75, 225, 151, 248'
							,'241, 240, 165, 242'
					)
					,'Home Electronic'	=> array(
							'246, 80, 62'
							,'246, 80, 62'
					)
					,'Home Houseware'	=> array(
							'234, 246, 62, 245, 80, 233, 237'
					)
					,'Home Organic'	=> array(
							'62, 80, 245'
					)
				);
				foreach( $pages as $page_title => $need_replaced_cats ){
					$page = get_page_by_title( $page_title );
					if( is_object( $page ) ){
						$index = 0;
						foreach( $need_replaced_cats as $need_replaced_cat ){
							$replaced_cats = array();
							for( $i = 0; $i < 4; $i++ ){
								if( !isset($product_cats[$index]) ){
									$index = 0;
								}
								$replaced_cats[] = $product_cats[$index];
								$index++;
							}
							$replaced_cats = array_unique($replaced_cats);
							$page->post_content = str_replace('product_cats="'.$need_replaced_cat.'"', 'product_cats="'.implode(',', $replaced_cats).'"', $page->post_content);
						}
						wp_update_post( $page );
					}
				}
			}
		}
		
		/* Delete transient */
		function delete_transients(){
			delete_transient('ts_mega_menu_custom_css');
			delete_transient('ts_product_deals_ids');
			delete_transient('wc_products_onsale');
		}
		
		/* Update WooCommerce Loolup Table */
		function update_woocommerce_lookup_table(){
			if( function_exists('wc_update_product_lookup_tables_is_running') && function_exists('wc_update_product_lookup_tables') ){
				if( !wc_update_product_lookup_tables_is_running() ){
					if( !defined('WP_CLI') ){
						define('WP_CLI', true);
					}
					wc_update_product_lookup_tables();
				}
			}
		}
	}
	new TS_Importer();
}
?>