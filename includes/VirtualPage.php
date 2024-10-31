<?php 
class VirtualPage {

    private $query;
    private $title;
    private $content;
    private $template;
    private $wp_post;

    function __construct( $query = '/index2', $template = 'page', $title = 'Untitled' ) {
        $this->query = filter_var( $query, FILTER_SANITIZE_URL );
        $this->setTemplate( $template );
        $this->setTitle( $title );
    }

    function getQuery() {
        return $this->query;
    }

    function getTemplate() {
        return $this->template;
    }

    function getTitle() {
        return $this->title;
    }

    function setTitle( $title ) {
        $this->title = filter_var( $title, FILTER_SANITIZE_STRING );

        return $this;
    }

    function setContent( $content ) {
        $this->content = $content;

        return $this;
    }

    function setTemplate( $template ) {
        $this->template = $template;

        return $this;
    }

    public function updateWpQuery() {

        global $wp, $wp_query;

        // Update the main query
        $wp_query->post                 = $this->wp_post;
        $wp_query->posts                = array( $this->wp_post );
        $wp_query->queried_object       = $this->wp_post;
        $wp_query->queried_object_id    = $this->wp_post->ID;
        $wp_query->found_posts          = 1;
        $wp_query->post_count           = 1;
        $wp_query->max_num_pages        = 1;
        $wp_query->is_page              = true;//important part
        $wp_query->is_singular          = true;//important part
        $wp_query->is_single            = false;
        $wp_query->is_attachment        = false;
        $wp_query->is_archive           = false;
        $wp_query->is_category          = false;
        $wp_query->is_tag               = false;
        $wp_query->is_tax               = false;
        $wp_query->is_author            = false;
        $wp_query->is_date              = false;
        $wp_query->is_year              = false;
        $wp_query->is_month             = false;
        $wp_query->is_day               = false;
        $wp_query->is_time              = false;
        $wp_query->is_search            = false;
        $wp_query->is_feed              = false;
        $wp_query->is_comment_feed      = false;
        $wp_query->is_trackback         = false;
        $wp_query->is_home              = false;
        $wp_query->is_embed             = false;
        $wp_query->is_404               = false;
        $wp_query->is_paged             = false;
        $wp_query->is_admin             = false;
        $wp_query->is_preview           = false;
        $wp_query->is_robots            = false;
        $wp_query->is_posts_page        = false;
        $wp_query->is_post_type_archive = false;

        $GLOBALS['wp_query'] = $wp_query;
        $wp->register_globals();

    }

    public function createPage() {
        if ( is_null( $this->wp_post ) ) {
            $post                 = new stdClass();
            $post->ID             = - 99;
            $post->post_title     = $this->title;
            $post->post_name      = sanitize_title( $this->template ); // append random number to avoid clash
            $post->post_content   = $this->content ?: '';
            $post->post_excerpt   = '';
            $post->post_parent    = 0;
            $post->menu_order     = 0;
            $post->post_type      = 'page';
            $post->post_status    = 'publish';
            $post->comment_status = 'closed';
            $post->ping_status    = 'closed';
            $post->comment_count  = 0;
            $post->post_password  = '';
            $post->to_ping        = '';
            $post->pinged         = '';
            $post->guid           = home_url( $this->query );
            $post->post_date      = current_time( 'mysql' );
            $post->post_date_gmt  = current_time( 'mysql', 1 );
            $post->post_author    = is_user_logged_in() ? get_current_user_id() : 0;
            $post->is_virtual     = true;
            $post->filter         = 'raw';

            $this->wp_post = new WP_Post( $post );
            wp_cache_add( - 99, $this->wp_post, 'posts' );
            $this->updateWpQuery();
        }


        return $this->wp_post;
    }
 }
 ?>