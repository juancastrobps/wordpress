<?php

namespace DgoraWcas;

use  DgoraWcas\Engines\TNTSearchMySQL\SearchQuery\SearchResultsPageQuery ;
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Helpers
{
    /**
     * Logger instance
     *
     * @var \WC_Logger
     */
    public static  $log = false ;
    /**
     * Prepare short description based on raw string including HTML
     *
     * @param string $string
     * @param int $numWords
     * @param string $allowableTags
     * @param bool $removeBreaks
     *
     * @return string
     */
    public static function makeShortDescription(
        $string,
        $numWords = 20,
        $allowableTags = '',
        $removeBreaks = true
    )
    {
        if ( empty($string) ) {
            return '';
        }
        //Remove headings
        $string = str_replace( array( '<h1><h2><h3><h4><h5><h6>' ), '<h3>', $string );
        $string = str_replace( array( '</h1></h2></h3></h4></h5></h6>' ), '</h3>', $string );
        $string = preg_replace( '/(<h3*?>).*?(<\\/h3>)/', '$1$2', $string );
        $string = self::stripAllTags( $string, $allowableTags, $removeBreaks );
        $hasHtml = strpos( $string, '<' ) !== false;
        
        if ( $hasHtml ) {
            // Remove attributes
            $string = preg_replace( "/<([a-z][a-z0-9]*)[^>]*?(\\/?)>/i", '<$1$2>', $string );
            $string = ( strpos( $allowableTags, '<p>' ) !== false ? wpautop( $string ) : $string );
            $string = force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( $string ), $numWords ) ) );
        } else {
            $string = html_entity_decode( wp_trim_words( htmlentities( $string ), $numWords ) );
        }
        
        return $string;
    }
    
    /**
     * Add CSS classes to autocomplete wrapper
     *
     * @param array $args
     *
     * @return string
     */
    public static function searchWrappClasses( $args = array() )
    {
        $classes = array();
        if ( DGWT_WCAS()->settings->getOption( 'show_details_box' ) === 'on' ) {
            $classes[] = 'dgwt-wcas-is-detail-box';
        }
        
        if ( DGWT_WCAS()->settings->getOption( 'show_submit_button' ) === 'on' ) {
            $classes[] = 'dgwt-wcas-has-submit';
        } else {
            $classes[] = 'dgwt-wcas-no-submit';
        }
        
        if ( !empty($args['class']) ) {
            $classes[] = esc_html( $args['class'] );
        }
        
        if ( !empty($args['layout']) ) {
            $type = esc_html( $args['layout'] );
            $classes[] = 'js-dgwt-wcas-layout-' . $type . ' dgwt-wcas-layout-' . $type;
        }
        
        
        if ( !empty($args['mobile_overlay']) && in_array( $args['mobile_overlay'], array( '1', 'on' ) ) ) {
            $classes[] = 'js-dgwt-wcas-mobile-overlay-enabled';
        } else {
            $classes[] = 'js-dgwt-wcas-mobile-overlay-disabled';
        }
        
        return implode( ' ', $classes );
    }
    
    /**
     * Get magnifier SVG ico
     *
     * @param string $class
     *
     * @return string
     */
    public static function getMagnifierIco( $class = 'dgwt-wcas-ico-magnifier' )
    {
        $svg = '';
        ob_start();
        ?>
		<svg version="1.1" class="<?php 
        echo  $class ;
        ?>" xmlns="http://www.w3.org/2000/svg"
		     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		     viewBox="0 0 51.539 51.361" enable-background="new 0 0 51.539 51.361" xml:space="preserve">
		<path d="M51.539,49.356L37.247,35.065c3.273-3.74,5.272-8.623,5.272-13.983c0-11.742-9.518-21.26-21.26-21.26
			  S0,9.339,0,21.082s9.518,21.26,21.26,21.26c5.361,0,10.244-1.999,13.983-5.272l14.292,14.292L51.539,49.356z M2.835,21.082
			  c0-10.176,8.249-18.425,18.425-18.425s18.425,8.249,18.425,18.425S31.436,39.507,21.26,39.507S2.835,31.258,2.835,21.082z"/>
	</svg>
		<?php 
        $svg .= ob_get_clean();
        return apply_filters( 'dgwt/wcas/form/magnifier_ico', $svg );
    }
    
    /**
     * Get search form action URL
     *
     * @return string
     */
    public static function searchFormAction()
    {
        $url = esc_url( home_url( '/' ) );
        if ( Multilingual::isPolylang() ) {
            $url = esc_url( pll_home_url() );
        }
        return apply_filters( 'dgwt/wcas/form/action', $url );
    }
    
    /**
     * Get name of the search input
     *
     * @return string
     */
    public static function getSearchInputName()
    {
        return apply_filters( 'dgwt/wcas/form/search_input/name', 's' );
    }
    
    /**
     * Return HTML for the setting section "How to use?"
     *
     * @return string HTML
     */
    public static function howToUseHtml()
    {
        $html = '';
        ob_start();
        include DGWT_WCAS_DIR . 'partials/admin/how-to-use.php';
        $html .= ob_get_clean();
        return $html;
    }
    
    /**
     * Return HTML for the setting section "Embedding in theme"
     *
     * @return string HTML
     */
    public static function embeddingInThemeHtml()
    {
        $html = '';
        ob_start();
        include DGWT_WCAS_DIR . 'partials/admin/embedding-in-theme.php';
        $html .= ob_get_clean();
        return $html;
    }
    
    /**
     * Minify JS
     *
     * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
     *
     * @param string
     *
     * @return string
     */
    public static function minifyJS( $input )
    {
        if ( trim( $input ) === "" ) {
            return $input;
        }
        return preg_replace( array(
            // Remove comment(s)
            '#\\s*("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\')\\s*|\\s*\\/\\*(?!\\!|@cc_on)(?>[\\s\\S]*?\\*\\/)\\s*|\\s*(?<![\\:\\=])\\/\\/.*(?=[\\n\\r]|$)|^\\s*|\\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\'|\\/\\*(?>.*?\\*\\/)|\\/(?!\\/)[^\\n\\r]*?\\/(?=[\\s.,;]|[gimuy]|$))|\\s*([!%&*\\(\\)\\-=+\\[\\]\\{\\}|;:,.<>?\\/])\\s*#s',
            // Remove the last semicolon
            '#;+\\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\\{,])([\'])(\\d+|[a-z_]\\w*)\\2(?=\\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([\\w\\)\\]])\\[([\'"])([a-z_]\\w*)\\2\\]#i',
            // Replace `true` with `!0`
            '#(?<=return |[=:,\\(\\[])true\\b#',
            // Replace `false` with `!1`
            '#(?<=return |[=:,\\(\\[])false\\b#',
            // Clean up ...
            '#\\s*(\\/\\*|\\*\\/)\\s*#',
        ), array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3',
            '!0',
            '!1',
            '$1'
        ), $input );
    }
    
    /**
     * Minify CSS
     *
     * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
     *
     * @param string
     *
     * @return string
     */
    public static function minifyCSS( $input )
    {
        if ( trim( $input ) === "" ) {
            return $input;
        }
        // Force white-space(s) in `calc()`
        if ( strpos( $input, 'calc(' ) !== false ) {
            $input = preg_replace_callback( '#(?<=[\\s:])calc\\(\\s*(.*?)\\s*\\)#', function ( $matches ) {
                return 'calc(' . preg_replace( '#\\s+#', "\32", $matches[1] ) . ')';
            }, $input );
        }
        return preg_replace( array(
            // Remove comment(s)
            '#("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\')|\\/\\*(?!\\!)(?>.*?\\*\\/)|^\\s*|\\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\'|\\/\\*(?>.*?\\*\\/))|\\s*+;\\s*+(})\\s*+|\\s*+([*$~^|]?+=|[{};,>~+]|\\s*+-(?![0-9\\.])|!important\\b)\\s*+|([[(:])\\s++|\\s++([])])|\\s++(:)\\s*+(?!(?>[^{}"\']++|"(?:[^"\\\\]++|\\\\.)*+"|\'(?:[^\'\\\\]++|\\\\.)*+\')*+{)|^\\s++|\\s++\\z|(\\s)\\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\\s+0|0\\s+0\\s+0\\s+0)(?=[;\\}]|\\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
            '#(?<=[\\s=:,\\(\\-]|&\\#32;)0+\\.(\\d+)#s',
            // Minify string value
            '#(\\/\\*(?>.*?\\*\\/))|(?<!content\\:)([\'"])([a-z_][-\\w]*?)\\2(?=[\\s\\{\\}\\];,])#si',
            '#(\\/\\*(?>.*?\\*\\/))|(\\burl\\()([\'"])([^\\s]+?)\\3(\\))#si',
            // Minify HEX color code
            '#(?<=[\\s=:,\\(]\\#)([a-f0-6]+)\\1([a-f0-6]+)\\2([a-f0-6]+)\\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\\{;])(border|outline):none(?=[;\\}\\!])#',
            // Remove empty selector(s)
            '#(\\/\\*(?>.*?\\*\\/))|(^|[\\{\\}])(?:[^\\s\\{\\}]+)\\{\\}#s',
            '#\\x1A#',
        ), array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2',
            ' '
        ), $input );
    }
    
    /**
     * Compare WooCommerce function
     *
     * @param $version
     * @param $op
     *
     * @return bool
     */
    public static function compareWcVersion( $version, $op )
    {
        if ( function_exists( 'WC' ) && version_compare( WC()->version, $version, $op ) ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if is settings page
     * @return bool
     */
    public static function isSettingsPage()
    {
        if ( is_admin() && !empty($_GET['page']) && $_GET['page'] === 'dgwt_wcas_settings' ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if is debug page
     * @return bool
     */
    public static function isDebugPage()
    {
        if ( is_admin() && !empty($_GET['page']) && $_GET['page'] === 'dgwt_wcas_debug' ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if is Freemius checkout page
     * @return bool
     */
    public static function isCheckoutPage()
    {
        if ( is_admin() && !empty($_GET['page']) && $_GET['page'] === 'dgwt_wcas_settings-pricing' ) {
            return true;
        }
        return false;
    }
    
    /**
     * Get settings URL
     *
     * @return string
     */
    public static function getSettingsUrl()
    {
        return admin_url( 'admin.php?page=dgwt_wcas_settings' );
    }
    
    /**
     * Get total products
     *
     * @return int
     */
    public static function getTotalProducts()
    {
        global  $wpdb ;
        $sql = "SELECT COUNT(ID) FROM {$wpdb->posts} WHERE  post_type = 'product' AND post_status = 'publish'";
        $total = $wpdb->get_var( $sql );
        return absint( $total );
    }
    
    /**
     * Get all products IDs
     * @return array
     */
    public static function getProductsForIndex()
    {
        global  $wpdb ;
        $sql = "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status = 'publish' ORDER BY ID ASC";
        $ids = $wpdb->get_col( $sql );
        if ( !is_array( $ids ) || empty($ids[0]) || !is_numeric( $ids[0] ) ) {
            $ids = array();
        }
        return $ids;
    }
    
    /**
     * Logging method.
     *
     * @param string $message Log message.
     * @param string $level Optional. Default 'info'. Possible values:
     *                      emergency|alert|critical|error|warning|notice|info|debug.
     */
    public static function log( $message, $level = 'info', $source = 'main' )
    {
        
        if ( defined( 'DGWT_WCAS_DEBUG' ) && DGWT_WCAS_DEBUG === true ) {
            if ( empty(self::$log) ) {
                self::$log = wc_get_logger();
            }
            self::$log->log( $level, $message, array(
                'source' => 'dgwt-wcas-' . $source,
            ) );
        }
    
    }
    
    /**
     * Get readable format of memory
     *
     * @param int $bytes
     *
     * @return string
     */
    public static function getReadableMemorySize( $bytes )
    {
        $unit = array(
            'b',
            'kb',
            'mb',
            'gb',
            'tb',
            'pb'
        );
        return @round( $bytes / pow( 1024, $i = floor( log( $bytes, 1024 ) ) ), 2 ) . ' ' . $unit[$i];
    }
    
    /**
     * Get pro icon/label
     *
     * @param string $label
     * @param string $type
     * @param string $headerSubtitle
     *
     * @return string
     */
    public static function getSettingsProLabel( $label, $type = 'header', $headerSubtitle = '' )
    {
        $html = '';
        switch ( $type ) {
            case 'header':
                if ( !empty($headerSubtitle) ) {
                    $label = '<span class="dgwt-wcas-pro-header__subtitle">' . $label . '</span><span class="dgwt-wcas-pro-header__subtitle--text">' . $headerSubtitle . '</span>';
                }
                $html .= '<div class="dgwt-wcas-row dgwt-wcas-pro-header"><span class="dgwt-wcas-pro-label">' . $label . '</span><span class="dgwt-wcas-pro-suffix">' . __( 'Pro', 'ajax-search-for-woocommerce' ) . '</span></div>';
                break;
            case 'option-label':
                $html .= '<div class="dgwt-wcas-row dgwt-wcas-pro-field"><span class="dgwt-wcas-pro-label">' . $label . '</span><span class="dgwt-wcas-pro-suffix">' . __( 'Pro', 'ajax-search-for-woocommerce' ) . '</span></div>';
                break;
        }
        return $html;
    }
    
    /**
     * Calc score for searched
     *
     * @param string $searched
     * @param string $string eg. product title
     * @param array $args
     *
     * @return int
     */
    public static function calcScore( $searched, $string, $args = array() )
    {
        $default = array(
            'check_similarity' => true,
            'check_position'   => true,
            'score_containing' => 50,
        );
        $args = array_merge( $default, $args );
        $score = 0;
        $searched = strtolower( $searched );
        $string = strtolower( $string );
        
        if ( $args['check_similarity'] ) {
            $m = similar_text( $searched, $string, $percent );
            $score = ($score + $percent) / 3;
        }
        
        $pos = strpos( $string, $searched );
        // Add score based on substring position
        
        if ( $pos !== false ) {
            $score += $args['score_containing'];
            // Bonus for contained substring
            // Bonus for substring position
            
            if ( $args['check_position'] ) {
                $posBonus = (100 - $pos * 100 / strlen( $string )) / 2;
                $score += $posBonus;
            }
            
            // Bonus for exact match
            if ( $string === $searched ) {
                $score += $args['score_containing'] * 5;
            }
        }
        
        return $score;
    }
    
    /**
     * Sorting by score
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    public static function cmpSimilarity( $a, $b )
    {
        $scoreA = 0;
        $scoreB = 0;
        
        if ( is_object( $a ) ) {
            $scoreA = $a->score;
            $scoreB = $b->score;
        }
        
        
        if ( is_array( $a ) ) {
            $scoreA = $a['score'];
            $scoreB = $b['score'];
        }
        
        if ( $scoreA == $scoreB ) {
            return 0;
        }
        return ( $scoreA < $scoreB ? 1 : -1 );
    }
    
    /**
     * Sorting by search resutls groups priority
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    public static function sortAjaxResutlsGroups( $a, $b )
    {
        if ( $a['order'] == $b['order'] ) {
            return 0;
        }
        return ( $a['order'] < $b['order'] ? -1 : 1 );
    }
    
    /**
     * Get taxonomy parents
     *
     * @param int $term_id
     * @param string $taxonomy
     *
     * @return string
     */
    public static function getTermBreadcrumbs(
        $termID,
        $taxonomy,
        $visited = array(),
        $lang = '',
        $exclude = array()
    )
    {
        $chain = '';
        $separator = ' > ';
        
        if ( Multilingual::isMultilingual() ) {
            $parent = Multilingual::getTerm( $termID, $taxonomy, $lang );
        } else {
            $parent = get_term( $termID, $taxonomy );
        }
        
        if ( empty($parent) || !isset( $parent->name ) ) {
            return '';
        }
        $name = $parent->name;
        
        if ( $parent->parent && $parent->parent != $parent->term_id && !in_array( $parent->parent, $visited ) ) {
            $visited[] = $parent->parent;
            $chain .= self::getTermBreadcrumbs(
                $parent->parent,
                $taxonomy,
                $visited,
                $lang
            );
        }
        
        if ( !in_array( $parent->term_id, $exclude ) ) {
            $chain .= $name . $separator;
        }
        return $chain;
    }
    
    /**
     * Get taxonomies of products attributes
     *
     * @return array
     *
     */
    public static function getAttributesTaxonomies()
    {
        $taxonomies = array();
        $attributeTaxonomies = wc_get_attribute_taxonomies();
        if ( !empty($attributeTaxonomies) ) {
            foreach ( $attributeTaxonomies as $taxonomy ) {
                $taxonomies[] = 'pa_' . $taxonomy->attribute_name;
            }
        }
        return apply_filters( 'dgwt/wcas/attribute_taxonomies', $taxonomies );
    }
    
    /**
     *
     */
    public static function canInstallPremium()
    {
    }
    
    /**
     * Get indexer demo HTML
     *
     * @return string
     */
    public static function indexerDemoHtml()
    {
        $html = '';
        ob_start();
        include DGWT_WCAS_DIR . 'partials/admin/indexer-header-demo.php';
        $html .= ob_get_clean();
        return $html;
    }
    
    /**
     * Get features HTML
     *
     * @return string
     */
    public static function featuresHtml()
    {
        $html = '';
        ob_start();
        include DGWT_WCAS_DIR . 'partials/admin/features.php';
        $html .= ob_get_clean();
        return $html;
    }
    
    /**
     * Log by WooCommerce logger
     *
     * @return void
     */
    public static function WCLog( $level = 'debug', $message = '' )
    {
        $logger = wc_get_logger();
        $context = array(
            'source' => 'ajax-search-for-woocommerce',
        );
        $logger->log( $level, $message, $context );
    }
    
    /**
     * Get searchable custom fields keys
     *
     * @return array
     */
    public static function getSearchableCustomFields()
    {
        global  $wpdb ;
        $customFields = array();
        $exludedMetaKeys = array(
            '_sku',
            '_wp_old_date',
            '_tax_status',
            '_stock_status',
            '_product_version',
            '_smooth_slider_style',
            'auctioninc_calc_method',
            'auctioninc_pack_method',
            '_thumbnail_id',
            '_product_image_gallery',
            'pdf_download',
            'slide_template',
            'cad_iframe',
            'dwnloads',
            'edrawings_file',
            '3d_pdf_download',
            '3d_pdf_render',
            '_original_id'
        );
        $exludedMetaKeys = apply_filters( 'dgwt/wcas/indexer/exluded_meta_keys', $exludedMetaKeys );
        $sql = "SELECT DISTINCT meta_key\n                FROM {$wpdb->postmeta} as pm\n                INNER JOIN {$wpdb->posts} as p ON p.ID = pm.post_id\n                WHERE p.post_type = 'product'\n                AND pm.meta_value NOT LIKE 'field_%'\n                AND pm.meta_value NOT LIKE 'a:%'\n                AND pm.meta_value NOT LIKE '%\\%\\%%'\n                AND pm.meta_value NOT LIKE '_oembed_%'\n                AND pm.meta_value NOT REGEXP '^1[0-9]{9}'\n                AND pm.meta_value NOT IN ('1','0','-1','no','yes','[]', '')\n               ";
        $metaKeys = $wpdb->get_col( $sql );
        if ( !empty($metaKeys) ) {
            foreach ( $metaKeys as $metaKey ) {
                
                if ( !in_array( $metaKey, $exludedMetaKeys ) && self::keyIsValid( $metaKey ) ) {
                    $label = $metaKey;
                    //@TODO Recognize labels based on meta key or publci known as Yoast SEO etc.
                    $customFields[] = array(
                        'label' => $label,
                        'key'   => $label,
                    );
                }
            
            }
        }
        $customFields = array_reverse( $customFields );
        return $customFields;
    }
    
    /**
     * Check if key is valid
     *
     * @param $key
     *
     * @return bool
     */
    public static function keyIsValid( $key )
    {
        return !preg_match( '/[^\\p{L}\\p{N}\\.\\_\\s\\-]+/u', $key );
    }
    
    /**
     * Check if table exist
     *
     * @return bool
     */
    public static function isTableExists( $tableName )
    {
        global  $wpdb ;
        $exist = false;
        $wpdb->hide_errors();
        $sql = $wpdb->prepare( "SHOW TABLES LIKE %s", $tableName );
        if ( !empty($wpdb->get_var( $sql )) ) {
            $exist = true;
        }
        return $exist;
    }
    
    /**
     * Check if the engine can search in variable products
     *
     * @return bool
     */
    public static function canSearchInVariableProducts()
    {
        global  $wpdb ;
        $allow = false;
        $el = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product_variation' LIMIT 1" );
        if ( !empty($el) && is_numeric( $el ) ) {
            $allow = true;
        }
        return apply_filters( 'dgwt/wcas/search_in_variable_products', $allow );
    }
    
    /**
     * Allow to remove method for an hook when, it's a class method used and class don't have variable, but you know the class name
     *
     * @link https://github.com/herewithme/wp-filters-extras
     * @return bool
     */
    public static function removeFiltersForAnonymousClass(
        $hook_name = '',
        $class_name = '',
        $method_name = '',
        $priority = 0
    )
    {
        global  $wp_filter ;
        // Take only filters on right hook name and priority
        if ( !isset( $wp_filter[$hook_name][$priority] ) || !is_array( $wp_filter[$hook_name][$priority] ) ) {
            return false;
        }
        // Loop on filters registered
        foreach ( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
            // Test if filter is an array ! (always for class/method)
            if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
                // Test if object is a class, class and method is equal to param !
                if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) == $class_name && $filter_array['function'][1] == $method_name ) {
                    // Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
                    
                    if ( is_a( $wp_filter[$hook_name], 'WP_Hook' ) ) {
                        unset( $wp_filter[$hook_name]->callbacks[$priority][$unique_id] );
                    } else {
                        unset( $wp_filter[$hook_name][$priority][$unique_id] );
                    }
                
                }
            }
        }
        return false;
    }
    
    /**
     * Create HTML question mark with tooltip
     *
     * @param string $id
     * @param string $content
     * @param string $template
     *
     * @return string
     */
    public static function createQuestionMark( $id, $content = '', $template = '' )
    {
        
        if ( !empty($template) ) {
            $file = DGWT_WCAS_DIR . 'partials/admin/tooltips/' . $template . '.php';
            
            if ( file_exists( $file ) ) {
                ob_start();
                require $file;
                $content = ob_get_contents();
                ob_end_clean();
            }
        
        }
        
        $id = 'js-dgwt-wcas-tooltip-id' . sanitize_key( $id );
        $html = '<div class="js-dgwt-wcas-tooltip dgwt-wcas-questio-mark dashicons dashicons-editor-help" data-tooltip-html-el="' . $id . '"></div>';
        $html .= '<div class="' . $id . '" style="display:none;"><div class="dgwt-wcas-tooltip-wrapper">' . $content . '</div></div>';
        return $html;
    }
    
    /**
     * Get list of 24 hours
     */
    public static function getHours()
    {
        $hours = array();
        $cycle12 = ( get_option( 'time_format' ) === 'H:i' ? false : true );
        for ( $i = 0 ;  $i < 24 ;  $i++ ) {
            $label = ( $cycle12 ? $i . ':00 am' : $i . ':00' );
            if ( $cycle12 && $i === 0 ) {
                $label = 12 . ':00 am';
            }
            if ( $cycle12 && $i > 11 ) {
                
                if ( $i === 12 ) {
                    $label = 12 . ':00 pm';
                } else {
                    $label = $i - 12 . ':00 pm';
                }
            
            }
            $hours[$i] = $label;
        }
        return $hours;
    }
    
    /**
     * Get local date including timezone
     *
     * @param $timestamp
     * @param string $format
     *
     * @return string
     * @throws \Exception
     */
    public static function localDate( $timestamp, $format = '' )
    {
        if ( empty($format) ) {
            $format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
        }
        $date = new \WC_DateTime( "@{$timestamp}" );
        $date->setTimezone( new \DateTimeZone( wc_timezone_string() ) );
        return $date->date_i18n( $format );
    }
    
    /**
     * Get labels
     *
     * @return array
     */
    public static function getLabels()
    {
        $labels = apply_filters( 'dgwt/wcas/labels', array(
            'category'           => __( 'Category', 'woocommerce' ),
            'tag'                => __( 'Tag' ),
            'brand'              => __( 'Brand', 'ajax-search-for-woocommerce' ),
            'post'               => __( 'Post' ),
            'page'               => __( 'Page' ),
            'product_cat_plu'    => __( 'Categories', 'woocommerce' ),
            'product_tag_plu'    => __( 'Tags' ),
            'product_plu'        => __( 'Products', 'woocommerce' ),
            'brand_plu'          => __( 'Brands', 'ajax-search-for-woocommerce' ),
            'post_plu'           => __( 'Posts' ),
            'page_plu'           => __( 'Pages' ),
            'sku_label'          => __( 'SKU', 'woocommerce' ) . ':',
            'sale_badge'         => __( 'Sale', 'woocommerce' ),
            'featured_badge'     => __( 'Featured', 'woocommerce' ),
            'in'                 => _x( 'in', 'in categories fe. in Books > Crime stories', 'ajax-search-for-woocommerce' ),
            'read_more'          => __( 'continue reading', 'ajax-search-for-woocommerce' ),
            'no_results'         => DGWT_WCAS()->settings->getOption( 'search_no_results_text', __( 'No results', 'ajax-search-for-woocommerce' ) ),
            'show_more'          => DGWT_WCAS()->settings->getOption( 'search_see_all_results_text', __( 'See all products...', 'ajax-search-for-woocommerce' ) ),
            'show_more_details'  => DGWT_WCAS()->settings->getOption( 'search_see_all_results_text', __( 'See all products...', 'ajax-search-for-woocommerce' ) ),
            'search_placeholder' => DGWT_WCAS()->settings->getOption( 'search_placeholder', __( 'Search for Products...', 'ajax-search-for-woocommerce' ) ),
            'submit'             => DGWT_WCAS()->settings->getOption( 'search_submit_text', '' ),
        ) );
        return $labels;
    }
    
    /**
     * Get labels
     *
     * @param string $key
     *
     * @return string
     */
    public static function getLabel( $key )
    {
        $label = '';
        $labels = self::getLabels();
        if ( array_key_exists( $key, $labels ) ) {
            $label = $labels[$key];
        }
        return $label;
    }
    
    /**
     * Remove all HTML tags including <script> and <style> and shortcodes
     *
     * @param string $string
     * @param string $allowed
     * @param bool $removeBreaks
     *
     * @return string
     */
    public static function stripAllTags( $string, $allowableTags = '', $removeBreaks = false )
    {
        $string = strip_shortcodes( $string );
        $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
        $string = strip_tags( $string, $allowableTags );
        if ( $removeBreaks ) {
            $string = preg_replace( '/[\\r\\n\\t ]+/', ' ', $string );
        }
        return trim( $string );
    }
    
    /**
     * Repair HTML. Close unclosed tags.
     *
     * @param $html
     *
     * @return string
     */
    public static function closeTags( $html )
    {
        preg_match_all( '#<(?!meta|img|br|hr|input\\b)\\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result );
        $openedTags = $result[1];
        preg_match_all( '#</([a-z]+)>#iU', $html, $result );
        $closedtags = $result[1];
        $lenOpened = count( $openedTags );
        if ( count( $closedtags ) == $lenOpened ) {
            return $html;
        }
        $openedTags = array_reverse( $openedTags );
        for ( $i = 0 ;  $i < $lenOpened ;  $i++ ) {
            
            if ( !in_array( $openedTags[$i], $closedtags ) ) {
                $html .= '</' . $openedTags[$i] . '>';
            } else {
                unset( $closedtags[array_search( $openedTags[$i], $closedtags )] );
            }
        
        }
        return $html;
    }
    
    /**
     * Check if we should override default search query
     *
     * @param \WP_Query $query The WP_Query instance
     *
     * @return bool
     */
    public static function isSearchQuery( $query )
    {
        $enabled = true;
        if ( !(!empty($query) && is_object( $query ) && is_a( $query, 'WP_Query' )) ) {
            return false;
        }
        if ( !$query->is_main_query() || isset( $query->query_vars['s'] ) && !isset( $_GET['dgwt_wcas'] ) || !isset( $query->query_vars['s'] ) || !$query->is_search() || $query->get( 'post_type' ) && is_string( $query->get( 'post_type' ) ) && $query->get( 'post_type' ) !== 'product' ) {
            $enabled = false;
        }
        return $enabled;
    }
    
    /**
     * Check if this is a product search page
     *
     * @return bool
     */
    public static function isProductSearchPage()
    {
        if ( isset( $_GET['dgwt_wcas'] ) && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'product' && isset( $_GET['s'] ) ) {
            return true;
        }
        return false;
    }
    
    /**
     * Restore the search phrase so that it can be used in the template.
     *
     * @param \WP_Post[] $posts Array of post objects.
     * @param \WP_Query $query The WP_Query instance (passed by reference).
     *
     * @return mixed
     */
    public static function rollbackSearchPhrase( $posts, $query )
    {
        if ( !$query->get( 'dgwt_wcas', false ) ) {
            return $posts;
        }
        $query->set( 's', $query->get( 'dgwt_wcas', '' ) );
        return $posts;
    }
    
    /**
     * Clear default search query if our engine is active
     *
     * @param string $search Search SQL for WHERE clause.
     * @param \WP_Query $query The current WP_Query object.
     *
     * @return string
     */
    public static function clearSearchQuery( $search, $query )
    {
        if ( !$query->get( 'dgwt_wcas', false ) ) {
            return $search;
        }
        return '';
    }
    
    /**
     * Get formatted search layout settings
     *
     * @return object
     */
    public static function getLayoutSettings()
    {
        $breakpoint = DGWT_WCAS()->settings->getOption( 'mobile_breakpoint', 992 );
        $layout = array(
            'layout'                 => DGWT_WCAS()->settings->getOption( 'search_layout', 'classic' ),
            'mobile_overlay'         => ( DGWT_WCAS()->settings->getOption( 'enable_mobile_overlay' ) === 'on' ? true : false ),
            'mobile_overlay_wrapper' => apply_filters( 'dgwt/wcas/scripts/mobile_overlay_wrapper', 'body' ),
            'breakpoint'             => apply_filters( 'dgwt/wcas/scripts/mobile_breakpoint', $breakpoint ),
        );
        if ( in_array( $layout['layout'], array( 'icon', 'icon-flexible' ) ) ) {
            $layout['mobile_overlay'] = true;
        }
        return (object) $layout;
    }
    
    /**
     * Checking the current code is run by the object of the given class
     *
     * @param string $class_name Class name
     * @param int $backtrace_limit The number of stack frames that is tested backwards.
     *
     * @return bool
     */
    public static function is_running_inside_class( $class_name, $backtrace_limit = 10 )
    {
        if ( empty($class_name) ) {
            return false;
        }
        if ( intval( $backtrace_limit ) <= 0 ) {
            $backtrace_limit = 10;
        }
        $result = false;
        $backtrace = debug_backtrace( 0, $backtrace_limit );
        if ( !empty($backtrace) ) {
            foreach ( $backtrace as $item ) {
                
                if ( isset( $item['class'] ) && $item['class'] === $class_name ) {
                    $result = true;
                    break;
                }
            
            }
        }
        return $result;
    }
    
    /**
     * Search products with native engine
     *
     * @param $phrase
     *
     * @return int[]
     */
    public static function searchProducts( $phrase )
    {
        $postIn = array();
        $baseUrl = home_url() . \WC_AJAX::get_endpoint( DGWT_WCAS_SEARCH_ACTION );
        $urlPhrase = str_replace( "\\'", "'", $phrase );
        $urlPhrase = str_replace( '\\"', '"', $urlPhrase );
        $args = array(
            's'      => urlencode( $urlPhrase ),
            'remote' => 1,
        );
        if ( Multilingual::isMultilingual() ) {
            $args['l'] = Multilingual::getCurrentLanguage();
        }
        $url = add_query_arg( $args, $baseUrl );
        $r = wp_remote_retrieve_body( wp_remote_get( $url, array(
            'timeout' => 120,
        ) ) );
        $decR = json_decode( $r );
        if ( json_last_error() == JSON_ERROR_NONE ) {
            if ( is_object( $decR ) && property_exists( $decR, 'suggestions' ) && is_array( $decR->suggestions ) ) {
                $postIn = wp_list_pluck( $decR->suggestions, 'ID' );
            }
        }
        return $postIn;
    }

}