<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Action to add menu
add_action('admin_menu', 'pciwgas_pro_plugin_help_menu');

/**
 * Register plugin design page in admin menu
 * 
 * @since 1.0.0
 */
function pciwgas_pro_plugin_help_menu() {
	add_submenu_page( 'pciwgas-pro-settings', __('Getting Started - Post Category Image Grid and Slider Pro', 'post-category-image-with-grid-and-slider'), __('Getting Started', 'post-category-image-with-grid-and-slider'), 'edit_posts', 'pciwgas-pro-designs', 'pciwgas_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @since 1.0.0
 */
function pciwgas_pro_designs_page() {

	$wpos_feed_tabs = pciwgas_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>

	<div class="wrap pciwgas-wrap">
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array('page' => 'pciwgas-pro-designs', 'tab' => $tab_key), admin_url('admin.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo esc_url($tab_link); ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>

		<div class="pciwgas-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				pciwgas_pro_howitwork_page();
			}
		?>
		</div><!-- end .pciwgas-tab-cnt-wrp -->
	</div><!-- end .pciwgas-wrap -->

<?php
}

/**
 * Function to get plugin feed tabs
 *
 * @since 1.0.0
 */
function pciwgas_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work'  => array(
													'name' => __('How It Works', 'post-category-image-with-grid-and-slider'),
												),
					);

	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @since 1.0.0
 */
function pciwgas_pro_howitwork_page() {
	$shrt_mapper = add_query_arg( array( 'page' => 'pciwgas-pro-shrt-mapper' ), admin_url('admin.php') );
?>
	<style type="text/css">
		.wpos-pro-box.postbox .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.pciwgas-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.pciwgas-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.wpos-copy-clipboard{-webkit-touch-callout: all; -webkit-user-select: all; -khtml-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;}
	</style>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!--How it workd HTML -->
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<div class="postbox">

						<h3 class="hndle">
							<span><?php esc_html_e( 'How It Works - Display and Shortcode', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php esc_html_e('Getting Started', 'post-category-image-with-grid-and-slider'); ?></label>
										</th>
										<td>
											<ul><li><?php esc_html_e('Step-1. Navigate to Plugin Settings > Taxonomy Settings section.', 'post-category-image-with-grid-and-slider'); ?></li>
												<li><?php esc_html_e('Step-2. Select custom taxonomy for which you want to enable support for Grid and Slider.', 'post-category-image-with-grid-and-slider'); ?></li>
												<li><?php esc_html_e('Step-3. Once you save, you can see custom setting box like Image Upload and Custom Link enabled at relevant category Add / Edit page.', 'post-category-image-with-grid-and-slider'); ?></li>
												<li><?php esc_html_e('Step-4. You can choose your desired image and etc for category.', 'post-category-image-with-grid-and-slider'); ?></li>
											</ul>
										</td>
									</tr>
									<tr>
										<th>
											<label><?php esc_html_e('How Shortcode Works', 'post-category-image-with-grid-and-slider'); ?></label>
										</th>
										<td>
											<?php esc_html_e('Create any page and put the relevant shortcode in it as mentioned below.', 'post-category-image-with-grid-and-slider'); ?>
										</td>
									</tr>
									<tr>
										<th>
											<label><?php esc_html_e('All Shortcodes', 'post-category-image-with-grid-and-slider'); ?></label>
										</th>
										<td>
											<span class="wpos-copy-clipboard pciwgas-shortcode-preview">[pci-cat-grid]</span> – <?php esc_html_e('Display Categories in Grid View', 'post-category-image-with-grid-and-slider'); ?><br>
											<span class="wpos-copy-clipboard pciwgas-shortcode-preview">[pci-cat-slider]</span> – <?php esc_html_e('Display Categories in Slider View', 'post-category-image-with-grid-and-slider'); ?>
											<br/><br/>
											<div><a class="button button-primary pciwgas-shrt-map-btn" href="<?php echo esc_url( $shrt_mapper ); ?>"><?php esc_html_e('Try Our Shortcode Builder!!', 'post-category-image-with-grid-and-slider'); ?></a></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->


			<!-- Upgrad to Pro HTML -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables wpos-pro-box">
					<div class="postbox wpos-pro-box">
						<h3 class="hndle">
							<span><?php esc_html_e('Need Support?', 'post-category-image-with-grid-and-slider'); ?></span>
						</h3>
						<div class="inside">
							<p><?php esc_html_e('Check plugin document for shortcode parameters and demo for designs.', 'post-category-image-with-grid-and-slider'); ?></p>
							<a class="button button-primary wpos-button-full" href="https://docs.essentialplugin.com/post-category-image-with-grid-and-slider-pro/?utm_source=post_category_pro&utm_medium=Post-Category&utm_campaign=getting_started" target="_blank"><?php esc_html_e('Documentation', 'post-category-image-with-grid-and-slider'); ?></a>
							<p><a class="button button-primary wpos-button-full" href="https://demo.essentialplugin.com/prodemo/post-category-image-with-grid-and-slider-demo/?utm_source=post_category_pro&utm_medium=Post-Category&utm_campaign=getting_started" target="_blank"><?php esc_html_e('View PRO Designs', 'post-category-image-with-grid-and-slider'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- .postbox -->

					<div class="postbox wpos-pro-box">
						<h3 class="hndle">
							<span><?php esc_html_e('Need PRO Support?', 'post-category-image-with-grid-and-slider'); ?></span>
						</h3>
						<div class="inside">
							<p><?php esc_html_e('Hire our experts for any WordPress task.', 'post-category-image-with-grid-and-slider'); ?></p>
							<p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wordpress-services/?utm_source=post_category_pro&utm_medium=Post-Category&utm_campaign=getting_started" target="_blank"><?php esc_html_e('Know More', 'post-category-image-with-grid-and-slider'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- .postbox -->

					<div class="postbox">
						<h3 class="hndle">
							<span><?php esc_html_e( 'Help to improve this plugin!', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
						<div class="inside">
							<p><?php esc_html_e('Enjoyed this plugin? You can help by rate this plugin', 'post-category-image-with-grid-and-slider'); ?> <a href="https://www.essentialplugin.com/your-review/?utm_source=post_category_pro&utm_medium=Post-Category&utm_campaign=getting_started" target="_blank"><?php esc_html_e('5 stars!', 'post-category-image-with-grid-and-slider'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-container-1 -->

		</div><!-- #post-body -->
	</div><!-- #poststuff -->
<?php }