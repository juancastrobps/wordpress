<style>
	.section {
		margin-left: -20px;
		margin-right: -20px;
		font-family: "Raleway", san-serif;
		background-repeat: no-repeat;
	}

	.section h1 {
		text-align: center;
		text-transform: uppercase;
		color: #808a97;
		font-size: 35px;
		font-weight: 700;
		line-height: normal;
		display: inline-block;
		width: 100%;
		margin: 50px 0 0;
	}

	.section ul {
		list-style-type: disc;
		padding-left: 15px;
	}

	.section-even {
		background-color: #fafafa;
		background-position: 85% 100%;
	}

	.section:nth-child(odd) {
		background-color: #fafafa;
		background-position: 15% 100%;
	}

	.section .section-title img {
		display: table-cell;
		vertical-align: middle;
		width: auto;
		margin-right: 15px;
	}

	.section h2,
	.section h3 {
		display: inline-block;
		vertical-align: middle;
		padding: 0;
		font-size: 24px;
		font-weight: 700;
		color: #808a97;
		text-transform: uppercase;
	}

	.section .section-title h2 {
		display: table-cell;
		vertical-align: middle;
		line-height: 25px;
	}

	.section-title h2 {
		border: 0;
		background:transparent;
	}

	.section-title {
		display: table;
	}

	.section h3 {
		font-size: 14px;
		line-height: 28px;
		margin-bottom: 0;
		display: block;
	}

	.section p {
		font-size: 13px;
		margin: 25px 0;
	}

	.section ul li {
		margin-bottom: 4px;
	}

	.landing-container {
		max-width: 70%;
		margin-left: auto;
		margin-right: auto;
		padding: 50px 0 30px;
	}

	.landing-container:after {
		display: block;
		clear: both;
		content: '';
	}

	.landing-container .col-1,
	.landing-container .col-2 {
		float: left;
		box-sizing: border-box;
		padding: 0 15px;
	}

	.landing-container .col-1 img {
		width: 100%;
	}

	.landing-container .col-1 {
		width: 55%;
	}

	.landing-container .col-2 {
		width: 45%;
	}

	.premium-cta {
		background-color: #808a97;
		color: #fff;
		border-radius: 6px;
		padding: 20px 15px;
	}

	.premium-cta:after {
		content: '';
		display: block;
		clear: both;
	}

	.premium-cta p {
		margin: 7px 0;
		font-size: 14px;
		font-weight: 500;
		display: inline-block;
		width: 60%;
	}

	.premium-cta a.button {
		border-radius: 6px;
		height: 60px;
		float: right;
		background: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/upgrade.png) #ff643f no-repeat 13px 13px;
		border-color: #ff643f;
		box-shadow: none;
		outline: none;
		color: #fff;
		position: relative;
		padding: 9px 50px 9px 70px;
	}

	.premium-cta a.button:hover,
	.premium-cta a.button:active,
	.premium-cta a.button:focus {
		color: #fff;
		background: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/upgrade.png) #971d00 no-repeat 13px 13px;
		border-color: #971d00;
		box-shadow: none;
		outline: none;
	}

	.premium-cta a.button:focus {
		top: 1px;
	}

	.premium-cta a.button span {
		line-height: 13px;
	}

	.premium-cta a.button .highlight {
		display: block;
		font-size: 20px;
		font-weight: 700;
		line-height: 20px;
	}

	.premium-cta .highlight {
		text-transform: uppercase;
		background: none;
		font-weight: 800;
		color: #fff;
	}

		.section.one {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/01-bg.png);
		}

		.section.two {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/08-bg.png);
		}

		.section.three {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/04-bg.png);
		}

		.section.four {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/13-bg.png);
		}

		.section.five {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/09-bg.png);
		}

		.section.six {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/03-bg.png);
		}

	.section.seven {
		background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/10-bg.png);
	}

	.section.eight {
		background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/11-bg.png);
	}

	.section.nine {
		background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/05-bg.png);
	}

		.section.ten {
			background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/12-bg.png);
		}

	.section.eleven {
		background-image: url(<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/21-bg.png);
	}

	@media (max-width: 768px) {
		.section {
			margin: 0
		}

		.premium-cta p {
			width: 100%;
		}

		.premium-cta {
			text-align: center;
		}

		.premium-cta a.button {
			float: none;
		}
	}

	@media (max-width: 480px) {
		.wrap {
			margin-right: 0;
		}

		.section {
			margin: 0;
		}

		.landing-container .col-1,
		.landing-container .col-2 {
			width: 100%;
			padding: 0 15px;
		}

		.section-odd .col-1 {
			float: left;
			margin-right: -100%;
		}

		.section-odd .col-2 {
			float: right;
			margin-top: 65%;
		}
	}

	@media (max-width: 320px) {
		.premium-cta a.button {
			padding: 9px 20px 9px 70px;
		}

		.section .section-title img {
			display: none;
		}
	}
</style>
<div class="landing">
	<div class="section section-cta section-odd">
		<div class="landing-container">
			<div class="premium-cta">
				<p>
					<?php echo wp_kses_post( sprintf(  __( 'Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Subscription%2$s to benefit from all features!', 'yith-woocommerce-subscription' ) , '<span class="highlight">', '</span>' ) ); ?>
				</p>
				<a href="<?php echo esc_url( $this->get_premium_landing_uri() ); ?>" target="_blank"
					class="premium-cta-button button btn">
					<span class="highlight"><?php esc_html_e( 'UPGRADE', 'yith-woocommerce-subscription' ); ?></span>
					<span><?php esc_html_e( 'to the premium version', 'yith-woocommerce-subscription' ); ?></span>
				</a>
			</div>
		</div>
	</div>
	<div class="one section section-even clear">
		<h1><?php esc_html_e( 'Premium Features', 'yith-woocommerce-subscription' ); ?></h1>
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/02.jpg" alt="Feature 01"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Use product variations to create different subscription plans', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php echo wp_kses_post( sprintf(  __( 'Use product variations to create unlimited subscription plans for your product or service and allow your users to easily upgrade and downgrade or switch from one plan to the other. %1$sYou can set the conditions, for example, if a customer will need to pay the difference between the old and new subscription plan.', 'yith-woocommerce-subscription'  ), '<br>')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="two section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Allow users to switch, pause or cancel the subscription plan', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php echo wp_kses_post( sprintf(  __( 'Choose whether to let the user %1$spause a subscription%2$s (set limits like the maximum number of pauses or the maximum number of paused days allowed before it automatically gets reactivated), to switch to another plan or to cancel a subscription right from their account.', 'yith-woocommerce-subscription'  ), '<b>','</b>')); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/03.jpg" alt="feature 02"/>
			</div>
		</div>
	</div>
	<div class="three section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/04.jpg" alt="Feature 03"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Set a free trial period to create a list of customers and push them to buy later', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'A %1$sfree trial period%2$s might be the most effective tool to encourage your users to subscribe and test your products or services for free: on the trial expiration, it will be easier for you to push them to buy and increase conversions.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="four section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Choose how to handle failed payments and when to suspend or cancel a subscription', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Thanks to some advanced options, you can choose how to handle subscriptions with failed payments: set the number of days allowed before the subscription gets suspended and how long it can stay suspended before it gets canceled.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/05.jpg" alt="Feature 04"/>
			</div>
		</div>
	</div>
	<div class="five section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/06.jpg" alt="Feature 05"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'A wide range of e-mail notifications for admins and customers', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'The plugin allows sending different kinds of email notifications both to the admin and to the subscribers. %1$sFor example, the user can be notified multiple times about the expiring subscription, the expired subscription, a failed payment or successful payment, if the subscription is getting suspended and so on.', 'yith-woocommerce-subscription' ), '<br>')); ?>
				</p>
			</div>
		</div>
	</div>

	<div class="six section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Set a sign-up fee on your subscriptions', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Choose whether to ask for a sign-up fee on your subscription-based products.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/07.jpg" alt="Feature 06"/>
			</div>
		</div>
	</div>
	<div class="seven section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/08.jpg" alt="Feature 07"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Two additional coupon types to apply discounts on the sign-up fee or on the recurring payment price', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Create a coupon to offer your customers a discount on the sign-up fee or on the recurring fee.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="eight section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'A dashboard to easily track all subscriptions and subscription activities', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Monitor the status of every subscription (start and end date, next payment date, payment amount etc.) from the built-in dashboard.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/09.jpg" alt="Feature 08"/>
			</div>
		</div>
	</div>
	<div class="nine section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/10.jpg" alt="Feature 09"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'A Gutenberg block to easily create and show subscription modules in your shop
', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'If you are using Gutenberg, you will be able to find the “Subscription plan” block and create custom forms in a couple of clicks to visually display your available subscription plans. You can customize colors, typography, add gradients, icons and much more.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="ten section section-odd clear">
		<div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Integration with YITH WooCommerce Membership ', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Integrate our Membership plugin and let your subscribers access to private contents and to sections with restricted access.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/11.jpg" alt="Feature 10"/>
			</div>
		</div>
	</div>
	<div class="eleven section section-even clear">
		<div class="landing-container">
			<div class="col-1">
				<img src="<?php echo esc_url( YITH_YWSBS_ASSETS_URL ); ?>/images/12.jpg" alt="Feature 11"/>
			</div>
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Integration with YITH WooCommerce Stripe', 'yith-woocommerce-subscription' ); ?></h2>
				</div>
				<p>
					<?php  echo wp_kses_post( sprintf(  __(  'Stripe is one of the integrated payment gateways to let your customers join and renew a subscription plan automatically.', 'yith-woocommerce-subscription' ), '<b>','</b>')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="section section-cta section-odd">
		<div class="landing-container">
			<div class="premium-cta">
				<p>
					<?php echo sprintf( esc_html( __( 'Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Subscription%2$s to benefit from all features!', 'yith-woocommerce-subscription' ) ), '<span class="highlight">', '</span>' ); ?>
				</p>
				<a href="<?php echo esc_url( $this->get_premium_landing_uri() ); ?>" target="_blank"
					class="premium-cta-button button btn">
					<span class="highlight"><?php esc_html_e( 'UPGRADE', 'yith-woocommerce-subscription' ); ?></span>
					<span><?php esc_html_e( 'to the premium version', 'yith-woocommerce-subscription' ); ?></span>
				</a>
			</div>
		</div>
	</div>
</div>
