=== Crowdfunding Login Form - Make WPCF Login Page ===
Contributors: FahimMurshed
Donate link: http://www.murshidalam.com/donation
Tags: wp-crowdfunding, donation, login-from, crowdfunding, login-redirect, dashboard, custom-login-form
Requires at least: 5.0
Tested up to: 5.5
Requires PHP: 7.0
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

WP Crowdfunding Login Form. Create a simple login form.

== Description ==

WP Crowdfunding Login Form. Create a simple login form. You can use any Page Builder to make beautiful login page.

If you need more assistance, <a href="https://murshidalam.com/contact/">contact me</a>

=== How it works ===

In order to create a login form or custom login page for WordPress with the default options, all you need to do is use this shortcode:

`[wp_login_form]`

However, there are other parameters that you can pass in the shortcode to customize it.

**redirect**

An absolute URL to which the user will be redirected after a successful login. For example,

`[wp_login_form redirect="https://example.com/mypage/"]`

The default is to redirect back to the URL where the form was submitted.

**form_id**

Your own custom ID for the login form. For example,

`[wp_login_form form_id="myloginform"]`

The default is "loginform".

**label_username**

Your custom label for the username/email address field. For example,

`[wp_login_form label_username="Login ID or Email"]`

The default is "Username or Email Address".

**label_password**

Your custom label for the password field. For example,

`[wp_login_form label_password="Login Password"]`

The default is "Password".

**label_remember**

Your custom label for the remember field. For example,

`[wp_login_form label_remember="Remember"]`

The default is "Remember Me".

**label_log_in**

Your custom label for the form submit button. For example,

`[wp_login_form label_log_in="Submit"]`

The default is "Log In".

**id_username**

Your own custom ID for the username field. For example,

`[wp_login_form id_username="wp_user_login"]`

The default is "user_login".

**id_password**

Your own custom ID for the password field. For example,

`[wp_login_form id_password="wp_user_pass"]`

The default is "user_pass".

**id_remember**

Your own custom ID for the remember field. For example,

`[wp_login_form id_remember="login_rememberme"]`

The default is "rememberme".

**id_submit**

Your own custom ID for the form submit button. For example,

`[wp_login_form id_submit="login_form_submit"]`

The default is "wp-submit".

**remember**

Specify whether to display the "Remember Me" checkbox in the WordPress login form. For example,

`[wp_login_form remember="0"]`

The default is "1" (true).

**value_username**

Your custom placeholder attribute for the username input field. For example,

`[wp_login_form value_username="Your Username"]`

The default is NULL.

**value_remember**

Specify whether the "Remember Me" checkbox in the form should be checked by default. For example,

`[wp_login_form value_remember="1"]`

The default is "0" (false).

**lost_password**

Specify whether to display the "Lost your password?" link in the form. For example,

`[wp_login_form lost_password="0"]`

The default is "1" (true).

== Installation ==
a.
1. Go to the Plugins menu
2. Add new plugin
3. Search "Crowdfunding Login Form"
4. Install and activate
5. Create a new page and add this shortcode: [wp_login_form redirect="https://Your-Site.test/cf-dashboard"]
6. Enjoy


b.  
1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Create a new page and add this shortcode: [wp_login_form redirect="https://Your-Site.test/cf-dashboard"]
4. Enjoy

== Frequently Asked Questions ==

= Only for WP Crowdfunding =

Yes, this plugin only works for WP Crowdfunding. If you want to redirect to another page, just ask on the support.

= Do I need to do anything after installation =

No, just install and activate. Add the shortcode "[wp_login_form redirect="https://cfpro.test/cf-dashboard"]" Enjoy.

== Screenshots ==

== Upgrade Notice ==
Just click on the update button.

= Credits =
This plugin fork from "WordPress Login Form" and credit goes to "naa986"

== Changelog ==

= 1.0.1 =
* Latest WordPress Compatibility

= 1.0.0 =
* Initial release