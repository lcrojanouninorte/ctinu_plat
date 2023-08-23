=== Post Category Image With Grid and Slider Pro ===
Contributors: wponlinesupport, anoopranawat, pratik-jain
Tags: category, category image, post category image, post category image grid, post category image slider, customization, custom category image, category featured image, category grid, category slider
Author URI: https://www.essentialplugin.com
Requires at least: 4.7
Tested up to: 5.9.3
Stable tag: 1.6
Requires PHP: 5.4

Post Category Image Grid and Slider plugin allow users to upload category image and display in grid and slider view.

== Description ==

Post Category Image With Grid and Slider plugin allow users to upload category image and display in grid and slider.

= This plugin contain 2 shortcode: =

* Display **categories in grid** view
<code>[pci-cat-grid]</code> 

* Display **categories in slider** view
<code>[pci-cat-slider]</code>

= Here is Template code =

<code><?php echo do_shortcode('[pci-cat-grid]'); ?></code>
<code><?php echo do_shortcode('[pci-cat-slider]'); ?></code>

= Features Include: =
* Post Grid Shortcode, Post Slider Shortcode
* 10 Designs for Post Grid and Post Slider
* 25+ Shortcode parameter
* Wp Templating Feature Support
* Image height option
* Limit, Post order, orderby and pagination parameter
* Include & Exclude specific category by category id
* Option to display child category
* Custom CSS to override plugin CSS
* Wpbackery Support
* Gutenberg, Elementor, Bevear and SiteOrigin Page Builder Support.
* Divi Page Builder Native Support.
* Fusion Page Builder native support
* 100% Responsive
* Slide RTL Support

== Installation ==

1. Upload the 'post-category-image-with-grid-and-slider-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the 'post-category-image-with-grid-and-slider-pro' list plugin through the 'Plugins' menu in WordPress.
3. Once activated go to Wp-Admin -> Posts -> Categories to see Custom Category Image options
4. To display use the below shortcodes
<code>[pci-cat-grid]</code> 
<code>[pci-cat-slider]</code> 

== Changelog ==

= 1.6 (26, Apr 2022) =
* [*] New - Added Reset Setting functionality.
* [*] New - Added 'Default Category Image' functionality.
* [*] New - Added 'rows' parameter for slider shortcode [pci-cat-slider]. Now you can display multi row slider.
* [*] Update - Update Slick slider JS to stable version 1.8.0
* [*] Update - Use escaping functions for better security.
* [*] Update - JavaScript syntax for jQuery 3.0 and higher with compatibility to WordPress version 5.6
* [*] Update - Check compatibility to WordPress version 5.9.3
* [*] Update - Update latest license code files.
* [*] Fix - Category description line break is not working.
* [*] Fix - Fixed limit 0 to display all categories is not working in slider shortcode [pci-cat-slider].
* [*] Fix - Fixed pagination issue with offset parameter for [pci-cat-grid] shortcode.
* [*] Fix - Fixed slider initialize issue in Elementor tab and accordion.
* [*] Fix - Fixed one deprecated warning in Gutenberg block from WordPress 5.7
* [*] Fix - Fixed slider width issue in Twenty Twenty-One theme sidebar area due to CSS grid container.
* [*] Remove - Removed unused shortcode parameters 'r_1024','r_768','r_480','r_320' for slider.
* [*] Dev - Added filters to modify plugin query for developers.
* [*] Tweak - Code optimization and performance improvements.
* [*] Template File - Major template file has been changed. If you have an override template file in your theme then verify with the latest copy.

= 1.5.7 (23, Sept 2021) =
* [*] Fix - Fixed Range Control max value issue in Gutenbreg.
* [+] Fix - Resolve Fusion page builder tab related issue, is_avada condition in script.php and js file.
* [*] Update - Improved tool tip text in 'Shortcode Builder' page for better understanding.
* [*] Update - Gutenberg change block_categories to block_categories_all add_filter function
* [*] Update - Update latest license code files.
* [*] Update - JavaScript syntax for jQuery 3.0 and higher with compatibility to WordPress version 5.6.
* [*] Check compatibility to WordPress version 5.8.
* [*] Tweak - Code optimization and performance improvements.

= 1.5.6 (21, Dec 2020) =
* [*] Fix - Minor admin script enqueue condition change for selected category pages to resolve category image uploading issue.

= 1.5.5 (17, Dec 2020) =
* [+] New - Added "aria-category-name" as an attribute on the category image link.
* [+] Update - Update WP code editor JS code to prevent initialize two times.
* [+] Update - Minor license code update for better notice.
* [*] Template File - Minor template file has been updated. If you have an override template file then verify with the latest copy.

= 1.5.4 (08, Dec 2020) =
* [+] New - Added Fusion Page Builder (Avada) native support.
* [+] Update - Minor JS and CSS file updated related to fusion builder.

= 1.5.3 (12 Nov, 2020) =
* [*] Fix - Resolved category image uploading issue.

= 1.5.2 (26 Oct, 2020) =
* [+] New - Improved WP Bakery Page Builder Support. Now plugin works in page builder tab, accordion, toggle and etc elements.
* [+] Update - Minor JS and CSS file updated related to VC.

= 1.5.1 (12 Oct, 2020) =
* [*] Fix - Resolved minor admin script initialize issue. 

= 1.5 (08 Oct, 2020) =
* [+] New - Added Divi page builder native support.
* [+] New - Click to copy the shortcode from the getting started page.
* [+] New - Added Elementor page builder support.
* [+] New - Added SiteOrigin page builder support.
* [+] New - Added Beaver builder support.
* [*] Check compatibility to WordPress version.
* [*] Update - License code for usage. Now user/agency can hide license page or license info from the page.
* [+] Update - Major js and css file updated.
* [*] Check compatibility with latest version of the WordPress.
* [*] Tweak - Code optimization and performance improvements.

= 1.4.1 (18 August, 2020) =
* [*] Fix - Resolved shortcode builder minor issue.
* [*] Update - Add support CSS code suggestion WordPress editor to Custom CSS setting.
* [*] Fix - Minor CSS changes related to setting page design 

= 1.4 (14 March, 2019) =
* [+] New - Added Gutenberg block. Now use plugin easily with Gutenberg!
* [+] New - Added 'hover_pause' and 'focus_pause' shortcode parameter for slider shortcodes. Now you can pause the slider on mouse hover and slider element focus.
* [+] New - Added 'lazyload' shortcode parameter for all slider shortcodes. Now you can able to set lazy loading in two different method lazyload="ondemand" OR lazyload="progressive".
* [+] New - Added 'image_fit' shortcode parameter for all shortcodes.
* [*] Fix - Minor CSS Changes.
* [+] Update - Minified some CSS and JS.
* [*] Tweak - Pagination will if page is divided into multiple pages with <!--nextpage--> tag.
* [*] Tweak - Pagination will work on a single post also.
* [*] Tweak - Code optimization and performance improvements.
* [*] Template File - Major template file has been updated. If you have an override template file then verify with the latest copy.

= 1.3 (18 March, 2019) =
* **Note - We have updated plugin compatibility to WordPress 4.5**
* [+] New - Added Templating feature. Now you can override plugin design from your current theme!!
* [+] New - Introduced 'Shortcode Generator' functionality with Preview Panel.
* [+] New - Added 'Custom Link' functionality. Now you can add your custom link to taxonomy!!
* [+] New - Added 'Visual Composer' page builder support.
* [+] New - Added pagination for category grid shortcode.
* [+] New - Added 'extra_class' shortcode parameter in plugin shortcode. Now you can add your extra class and use it for custom designing.
* [+] New - Added 'show_title', 'pagination' and 'child_of' shortcode parameters.
* [*] Tweak - Taken better care of Category Title as an image ALT tag.
* [*] Tweak - Optimized CSS and fixed some CSS issues.
* [*] Tweak - Code Optimization and Improved Performance.
* [*] Fix - Taken better care of numbers of slides when it is greater than the total slide.
* [*] Fix - Fixed some minor issues.
* [*] Bumped compatibility to WordPress version 4.4

= 1.2.1 (23 March 2018) =
* Note: If you are using v1.1.1 then please do not update this plugin OR first take backup and then update 
* [+] Re-structured complete plugin.

= 1.1.1(11 Nov 2017) =
* [+] Added 'parent_id' shortcode parameter to display child category of specific parent.
* [+] Added 'exclude_cat' shortcode parameter to exclude some category.
* [+] Added 'r_1024','r_768','r_480','r_320' shortcode parameter for responsive slider.

= 1.0.1 =
* Fixed some code related issues

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.3 =
* Bumped compatibility to WordPress version 4.5