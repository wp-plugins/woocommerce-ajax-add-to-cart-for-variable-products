=== Woocommerce Ajax add to cart for variable products ===
Contributors: Rcreators
Donate link: NA
Tags: Woocommerce, Ajax, Variable Products, Add to cart
Requires at least: 3.2
Tested up to: 4.2.2
Stable tag: 1.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin activate add to cart through ajax on varible product.

== Description ==

This plugin activate add to cart through ajax on varible product. By default woocommerce is not having this feature. Plugin is adding own jquery which is differ from woocommerce default add to cart jquery for simple product.

== Installation ==

1. Upload `woocommerce-ajax-add-to-cart-variable-products` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How this plugin work? =

This plugin add new javascript file in your theme footer, which gets required data from the page when you click on add to cart button on varible product page and sent it to php ajax function of plugin.

= Is this plugin work with my theme? =

Yes this plugin will work with most themes. Just make sure you didn't removed any css classes from add to cart button from variable product template.

= Is this plugin only add functionality on single page or archive page or category page =

This plugin activate ajax functionality everywhere. So like is it a single page, category page, archive page or even sidebar with shortcode, where ever it gets varible product, it will work with ajax functionality.

== Screenshots ==

1. screenshot-1.jpg

== Changelog ==

= 1.2.4 =
* Updated Jquery issue reported by user. : david127, nonverbla
* Js Improvement suggested by user, now it will work with multiple tye of variations. : Igor Jerosimic
* Removed AddtocartAjax localize script which was not in use.
* Supports Latest Woocommerce and wordpress.

= 1.2.3 =
* Updated Jquery, so it works properly with IE10 / IE11

= 1.2.2 =
* jquery updated. so if no variation selected, user will get error to select variable.

= 1.2.1 =
* Minor fix for setting tab issue

= 1.2 =
* Added Selection in woocommerce product tab wc ajax variable product setting for variation selection need on category / shop page or not.
* Added Strip Html security fix. / Thanks - Michal for pointing out this security bug
* Added support for other variable swatches and color box selection plugin / Thanks - Mycreativeway for updated jquery code

= 1.1.1 =
* Added Ob_start() starting of hooks so it works perfect on chrome and Firefox. / Thanks - Michal for mail on it.

= 1.1 =
* Functions updated to work with minicart widget.
* Now Default cart widget of woocommerce will also update same time with adding to cart.

= 1.0.3 =
* Updated the Function in which Cart Fragments was not updating in Chrome. Will work on all browser now without issue.

= 1.0.2 =
* Updated function as ajax was not working for guest users. / - Thanks - sharpe89 to pointing issue.

= 1.0.1 =
* Bug Fix to not load js file after activation
* Remove files which not required from plugin

= 1.0 =
* Dirctly works after activation.
* No any setting page.

== Upgrade Notice ==

= 1.0 =
As Woocommerce not having add to cart with ajax for variable product, plugin adds this small functionality. So Users cannot dig into code for same.