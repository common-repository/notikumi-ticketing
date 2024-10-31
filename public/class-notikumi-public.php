<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://notikumi.com
 * @since      1.0.0
 *
 * @package    Notikumi
 * @subpackage Notikumi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Notikumi
 * @subpackage Notikumi/public
 * @author     notikumi <hola@notikumi.com>
 */
class Notikumi_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	private $_DEBUG = false;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// stage|local|production para servidor de pruebas
		$this->ntk_api = new NotikumiClient("production"); 

		date_default_timezone_set('Europe/Madrid');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notikumi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notikumi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name."-bootstrap", plugin_dir_url( __FILE__ ) . 'css/bootstrap/bootstrap.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name."-bootstrap-theme", plugin_dir_url( __FILE__ ) . 'css/bootstrap/bootstrap-theme.css', array(), $this->version, 'all' );
		
		// Load custom css if created or load the default css provided
		if(!get_option('custom/css/three-cols.css')) {
			wp_register_style( $this->plugin_name."-template-three-cols", plugin_dir_url( __FILE__ ) . '../templates/original/css/three-cols.css', array(), $this->version, 'all' );
		}
		else {
			wp_register_style( $this->plugin_name."-template-three-cols", plugin_dir_url( __FILE__ ) . '../templates/custom/css/three-cols.css', array(), $this->version, 'all' );
			$threeColsCustomCss = get_option('custom/css/three-cols.css');
			wp_add_inline_style( $this->plugin_name."-template-three-cols", $threeColsCustomCss);
		}

		if(!get_option('custom/css/single-col.css')) {
			wp_register_style( $this->plugin_name."-template-single-col", plugin_dir_url( __FILE__ ) . '../templates/original/css/single-col.css', array(), $this->version, 'all' );
		}
		else {
			wp_register_style( $this->plugin_name."-template-single-col", plugin_dir_url( __FILE__ ) . '../templates/custom/css/single-col.css', array(), $this->version, 'all' );
			$singlecolCustomCss = get_option('custom/css/single-col.css');
			wp_add_inline_style( $this->plugin_name."-template-single-col", $singlecolCustomCss);
		}

		if(!get_option('custom/css/event-page.css')) {
			wp_register_style( $this->plugin_name."-template-event-page", plugin_dir_url( __FILE__ ) . '../templates/original/css/event-page.css', array(), $this->version, 'all' );
		}
		else {
			wp_register_style( $this->plugin_name."-template-event-page", plugin_dir_url( __FILE__ ) . '../templates/custom/css/event-page.css', array(), $this->version, 'all' );
			$eventPageCustomCss = get_option('custom/css/event-page.css');
			wp_add_inline_style( $this->plugin_name."-template-event-page", $eventPageCustomCss);
		}

		if(!get_option('custom/css/color-custom.css')) {
			wp_enqueue_style( $this->plugin_name."-color-custom", plugin_dir_url( __FILE__ ) . '../templates/original/css/color-custom.css', array(), $this->version, 'all' );
		}
		else {
			wp_enqueue_style( $this->plugin_name."-color-custom", plugin_dir_url( __FILE__ ) . '../templates/custom/css/color-custom.css', array(), $this->version, 'all' );
			$colorCustomCss = get_option('custom/css/color-custom.css');
			wp_add_inline_style( $this->plugin_name."-color-custom", $colorCustomCss);
		}

		if(!get_option('custom/css/custom-styles.css')) {
			wp_enqueue_style( $this->plugin_name."-custom-styles", plugin_dir_url( __FILE__ ) . '../templates/original/css/custom-styles.css', array(), $this->version, 'all' );
		}
		else {
			wp_enqueue_style( $this->plugin_name."-custom-styles", plugin_dir_url( __FILE__ ) . '../templates/custom/css/custom-styles.css', array(), $this->version, 'all' );
			$customStylesCss = get_option('custom/css/custom-styles.css');
			wp_add_inline_style( $this->plugin_name."-custom-styles", $customStylesCss);
		}
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notikumi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notikumi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name."-widget-px-tracking", 
			plugin_dir_url( __FILE__ ) . 'js/ntk-px-tracking.js', 
			array( ), $this->version, false );

		wp_enqueue_script( $this->plugin_name."-widget", 
			"https://media.notikumi.com/js/widget/current/widget.min.js", 
			array( $this->plugin_name."-widget-px-tracking"), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/notikumi-public.js', 
			array( 'jquery' ), $this->version, false );

		
		wp_register_script( $this->plugin_name."-script-event-page", plugin_dir_url( __FILE__ ) . '../public/js/event-page.js', array(), $this->version, 'all' );
		wp_register_script( $this->plugin_name."-script-grid", plugin_dir_url( __FILE__ ) . '../public/js/grid.js', array(), $this->version, 'all' );
	}

	function add_data_attribute($tag, $handle) {
		//echo "handle:".$handle;
		if ('notikumi-widget-px-tracking' !== $handle ) {
			return $tag;
		}
		 
		return str_replace( ' src', ' class="___ntk-widget" src', $tag );
	}

	/**
	 * Shortcode can be: List events, sell-grid or single-event-page
	 * The other rendering, via virtual page, is not handled here
	 */
	public function render_shortcode($atts, $content = null) {
		$attr = shortcode_atts( array(
			'id' => 0,
		), $atts );

		$shortcode_id = $attr['id'] == 0 ? 0 : $attr['id'];
		$shortcode_position = $this->get_shortcode_position_from_id($shortcode_id);

		$ntk_template_key = get_option( 'ntk_current_template' )[$shortcode_position];
		$ntk_content = get_option( 'ntk_content_key' )[$shortcode_position];
		$slug = get_option( 'ntk_event_key' )[$shortcode_position];
		$channel = get_option( 'ntk_sale_channels_key' )[$shortcode_position];
		$show_title = get_option( 'ntk_events_title_key' )[$shortcode_position];
		$checkout_custom_css = get_option('ntk_checkout_custom_css_key')[$shortcode_position];
		$ntk_action_call_purchase_tickets = get_option('ntk_action_call_purchase_tickets')[$shortcode_position];
		$ntk_action_call_purchase_tickets_en = get_option('ntk_action_call_purchase_tickets_en')[$shortcode_position];

		$template_notikumi_name = $this->get_notikumi_template($ntk_template_key);

		$this->enqueue_ntk_styles($ntk_template_key);
		$this->enqueue_ntk_scripts($ntk_template_key);

		// print
		ob_start();
		// List
		if($ntk_content == "multiple_events") {
			echo $this->list_content_html($shortcode_position, $template_notikumi_name);
		}
		// Sell-grid or widget
		else if($ntk_content == "single_event") {
			$event = $this->notikumi_client_get_event($slug, $channel);
			$active_channel = $this->get_active_channel_from_event($event);

			echo NotikumiRenderHelper::get_event_form_to_grid($slug, $active_channel, $checkout_custom_css);
			echo $this->event_detail_content_html($event, $template_notikumi_name);
		}
		return ob_get_clean();
	}

	/**
	 * Event page via virtual page
	 */
	public function redirect_to_event_page() {
		if($this->_DEBUG) {
			echo "<pre>";
			echo "REDIRECT TO EVENT PAGE";
			echo "</pre>";
		}
		
		$session_slug = get_query_var( 'ntk_slug' );
		$channel = get_query_var( 'ntk_channel' );
		$shortcode_id = intval(get_query_var( 'ntk_pos' ));
		$shortcode_position = $this->get_shortcode_position_from_id($shortcode_id);

		if ( !$session_slug ) {
			return;
		}


		// API
		$event = $this->notikumi_client_get_event($session_slug, $channel);
		$active_channel = $this->get_active_channel_from_event($event);

		$checkout_custom_css = get_option('ntk_checkout_custom_css_key')[$shortcode_position];
		$show_title = get_option('ntk_events_title_key')[$shortcode_position];

		if($this->_DEBUG) {
			echo "<pre>";

			echo "<br />id del shortcode:" ;
			var_dump($shortcode_id);
			echo "<br />shortcode_position:";
			var_dump($shortcode_position);
			echo "<br />show_title:"; 
			var_dump($show_title);
			echo "<br />checkout_custom_css:"; 
			var_dump($checkout_custom_css);
			echo "</pre>";
		}

		$template_notikumi_name = $this->get_notikumi_template('event-page');

		$content = ($show_title == "true") ? '
			<header class="entry-header '.(($event->sessions[0]->status == 5) ? 'event-cancel' : '').'">
				<h1 class="entry-title">'.NotikumiRenderHelper::getTitle($event)."</h1>
			</header>" : '';

		$content .= $this->event_detail_content_html($event, $template_notikumi_name);
		$content .= NotikumiRenderHelper::get_event_form_to_grid($session_slug, $active_channel, $checkout_custom_css);

		global $wp, $wp_styles;
		$url_post = str_replace(get_home_url(), "", home_url( $wp->request ));


		//add_filter( 'wpseo_title',  'filter_title_name_event_page', 20, 1 );	
		//add_filter( 'wp_title', 'wpse_258323_title', 20 );
		//add_filter( 'pre_get_document_title', 'wpse_event_page_pretitle', 19 );	
		add_filter( 'pre_get_document_title', array( $this, 'wpse_event_page_pretitle' ), 20 );


		$this->enqueue_styles();
		$this->enqueue_scripts();
		wp_enqueue_style($this->plugin_name."-template-event-page"); 
		wp_enqueue_script($this->plugin_name."-script-event-page");
		
		// No automatic <p> wrapping
		remove_filter('term_description','wpautop');
		remove_filter('the_content', 'wpautop');
		

		$page = new VirtualPage($url_post, 'page', NotikumiRenderHelper::getTitle($event) );
		$content = preg_replace( "/\r|\n/", "", $content );
		$content = str_replace(array("\r", "\n"), '', $content);

		$page->setContent($content);
		$page->createPage();
	}

	public function wpse_event_page_pretitle() {
		return get_the_title()." | ".get_bloginfo( 'name' );
	}

	private function get_active_channel_from_event($event) {
		$slug = "";
		foreach($event->sessions as $session) {
			if(isset($session->sales)) {
				$slug = $session->sales->channel->slug;
			}
		}
		return $slug;
	}

	private function list_content_html($shortcode_position, $template_notikumi) {
		$request = $this->build_event_list_request($shortcode_position);
		$events = $this->ntk_api->getEvents($request);
		// echo "<pre>";
		// var_dump($events);
		// echo "</pre>";

		global $ntk_path, $ntk_action_call_purchase_tickets, $ntk_action_call_purchase_tickets_en;

		$ntk_path = get_option( 'ntk_events_path_key' )[$shortcode_position];

		$ntk_action_call_purchase_tickets = get_option('ntk_action_call_purchase_tickets')[$shortcode_position];
		$ntk_action_call_purchase_tickets_en = get_option('ntk_action_call_purchase_tickets_en')[$shortcode_position];
		
		ob_start();
		include $template_notikumi;
		$html = ob_get_clean();
		return $html;
	}

	
	/*
	 * Event page
	 * Creamos una redirección de todas las páginas que comiencen tal y como estén configuradas
	 */
	public function rewrite_event_page($wp_rewrite) {

		$paths = get_option( 'ntk_events_path_key' );
		$channels = get_option( 'ntk_sale_channels_key' );
		$shortcode_id = get_option( 'ntk_id' );
		
		$dynamic_rules = array(); 
		for($i = 0; $i < count($paths); $i++) {
			$path = $paths[$i];

			// eliminamos la primera y la última barra
			$path = $this->cleanPathBeforeRewriting($path);
			$originRegExp = $path.'/(\d+)/(\d+)/(\d+)/([a-zA-Z0-9-_]+)?$';
			$target = 'index.php?ntk_slug=$matches[1]/$matches[2]/$matches[3]/$matches[4]&ntk_channel='.$channels[$i].'&ntk_pos='.$shortcode_id[$i]; 
			
			$dynamic_rules[$originRegExp] = $target;
		}

		// $static_rules = array(
		// 	'events/(\d+)/(\d+)/(\d+)/([a-zA-Z0-9-_]+)?$' => 'index.php?ntk_slug=$matches[1]/$matches[2]/$matches[3]/$matches[4]', 
		// );

		//var_dump($dynamic_rules);

		$wp_rewrite->rules = $dynamic_rules + $wp_rewrite->rules;
		return $wp_rewrite->rules;
	}

	/**
	 * Common
	 */
	private function get_notikumi_template($ntk_template) {
		if($ntk_template == 'three-cols') {
			$template = dirname(__FILE__) . '/../templates/original/php/three-cols.php';
		}
		else if($ntk_template == 'single-col') {
			$template = dirname(__FILE__) . '/../templates/original/php/single-col.php';
		}
		else if($ntk_template == 'event-page') {			
			$template = dirname(__FILE__) . '/../templates/original/php/event-page.php';
		}
		else if($ntk_template == 'grid') {
			$template = dirname(__FILE__) . '/../templates/original/php/grid.php';
		}
		return $template;
	}

	public function query_vars_event_page($query_vars) {
		$query_vars[] = 'ntk_slug';
		$query_vars[] = 'ntk_channel';
		$query_vars[] = 'ntk_pos';
		return $query_vars;
	}


	private function enqueue_ntk_styles($ntk_template) {
		if($ntk_template == "three-cols") {
			wp_enqueue_style( $this->plugin_name."-template-three-cols" );
		}
		else if($ntk_template == "single-col") {
			wp_enqueue_style( $this->plugin_name."-template-single-col" );
		}
		else if($ntk_template == "event-page") {
			wp_enqueue_style( $this->plugin_name."-template-event-page" );
		}
	}

	private function enqueue_ntk_scripts($ntk_template) {
		if($ntk_template == "event-page") {
			wp_enqueue_script( $this->plugin_name."-script-event-page" );
		}
		else if($ntk_template == "grid") {
			wp_enqueue_script( $this->plugin_name."-script-grid" );
		}
	}

	private function event_detail_content_html($event, $template_notikumi) {
		ob_start();
		include $template_notikumi;
		$html = ob_get_clean();
		return $html;
	}

	private function build_event_list_request($i) {
		$request = [];
		
		$ntk_content = get_option( 'ntk_content_key' )[$i];

		$ntk_qt = get_option( 'ntk_events_qt_key' )[$i];
		if($ntk_qt) {
			$request['qt'] = $ntk_qt;
		}

		$ntk_venues = get_option( 'ntk_venues_key' )[$i];
		if($ntk_venues) {
			$request['venues'] = $ntk_venues;
		}

		$channel = get_option( 'ntk_channels_key' )[$i];
		if($channel) {
			$request['channelsSlugs'] = $channel;
		}

		$channel = get_option( 'ntk_sale_channels_key' )[$i];
		if($channel) {
			$request['saleChannelSlugs'] = $channel;
		}

		$organizations = get_option( 'ntk_organizations_key' )[$i];
		if($channel) {
			$request['organizations'] = $organizations;
		}

		$users = get_option( 'ntk_users_key' )[$i];
		if($channel) {
			$request['users'] = $users;
		}

		$temporality = get_option( 'ntk_content_temp_key' )[$i];
		if($temporality == "future_events") {
			$request['endGreaterThan'] = time() * 1000;
		}
		else if($temporality == "past_events") {
			$request['endBeforeThan'] = time() * 1000;
		}
		//$request['venuesSlug']="centro-cultural-la-rambleta";
		//$request['organizations']="402";
		//$request['channels']="1";
		return $request;
	} 



	private function cleanPathBeforeRewriting($path) {
		if(substr($path,0,1) == "/") {
			$path = substr($path,1);
		}
		if(substr($path,strlen($path) -1 ,strlen($path)) == "/") {
			$path = substr($path,0,strlen($path)-1);
		}

		return $path;
	}

	private function get_shortcode_position_from_id($shortcode_id) {
		$ids = get_option( 'ntk_id' );
		//var_dump($ids);
		//echo "vs ".$shortcode_id;

		for($i = 0; $i < count($ids); $i++) {
			if($ids[$i] == $shortcode_id) {
				return $i;
			}
		}
		return null;
	}

	private function notikumi_client_get_event($slug, $channel) {
		$request['session_slug'] = $slug;
		$request['saleChannelSlugs'] = $channel;
		return $this->ntk_api->getEvent($request);
	}
}
