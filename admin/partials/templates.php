<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pro.notikumi.com
 * @since      1.0.0
 *
 * @package    Notikumi
 * @subpackage Notikumi/admin/partials
 */
?>
<?php
if (!current_user_can('manage_options')) {
    wp_die( __('You do not have sufficient permissions to access this page.') );
}
?>

<?php
//must check that the user has the required capability 
    

// variables for the field and option names 
$hidden_php_layout_name = 'ntk_php_layout_hidden';
$hidden_css_custom_name = 'ntk_css_custom_hidden';
$hidden_css_layout_name = 'ntk_css_layout_hidden';
$hidden_restore_name = 'hidden_restore_name';

$three_cols_css_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/css/three-cols.css';
$single_col_css_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/css/single-col.css';
$event_page_css_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/css/event-page.css';
$color_custom_css_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/css/color-custom.css';
$custom_styles_css_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/css/custom-styles.css';
$three_cols_php_original_filename = plugin_dir_path(__FILE__ ) .'../../templates/original/php/three-cols.php';
$single_col_php_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/php/single-col.php';
$event_page_php_original_filename = plugin_dir_path( __FILE__ ) .'../../templates/original/php/event-page.php';

$three_cols_css_custom_key = 'custom/css/three-cols.css';
$event_page_css_custom_key = 'custom/css/event-page.css';
$single_col_css_custom_key = 'custom/css/single-col.css';
$color_custom_css_custom_key = 'custom/css/color-custom.css';
$custom_styles_css_custom_key = 'custom/css/custom-styles.css';

/*
 * RESTORE
 */
if( isset($_POST[ $hidden_restore_name ]) && $_POST[ $hidden_restore_name ] == 'Y' && 
    wp_verify_nonce($_POST['nonce'], 'restore_5632124')) {

    $file = sanitize_text_field($_POST[ 'template_to_restore' ]);
    
    if($file == "color-custom-css") {
        $color_custom_original_css = file_get_contents($color_custom_css_original_filename);
        delete_option($color_custom_css_custom_key);
    }
    else if($file == "custom-styles-css") {
        $custom_styles_original_css = file_get_contents($custom_styles_css_original_filename);
        delete_option($custom_styles_css_custom_key);
    }
    else if($file == "event-page-css") {
        $event_page_original_css = file_get_contents($event_page_css_original_filename);
        delete_option($event_page_css_custom_key);
    }
    else if($file == "single-col-css") {
        $single_col_original_css = file_get_contents($single_col_css_original_filename);
        delete_option($single_col_css_custom_key);
    }
    else if($file == "three-cols-css") {
        $three_cols_original_css = file_get_contents($three_cols_css_original_filename);
        delete_option($three_cols_css_custom_key);
    }
?>
    <div class="updated"><p><strong><?php _e('CSS Template restored.', 'notikumi-ticketing' ); ?></strong></p></div>
<?php
}

/*
 * Edición de ficheros custom
 */
if( isset($_POST[ $hidden_css_custom_name ]) && $_POST[ $hidden_css_custom_name ] == 'Y'  && 
wp_verify_nonce($_POST['nonce'], 'hidden_css_custom_key_valid_567833')) {
    $colorCustomCss = sanitize_textarea_field($_POST[ 'color-custom-css' ]);
    $customStylesCss = sanitize_textarea_field($_POST[ 'custom-styles-css' ]);

    update_option($color_custom_css_custom_key, $colorCustomCss);
    update_option($custom_styles_css_custom_key, $customStylesCss);
?>
    <div class="updated"><p><strong><?php _e('CSS Custom Templates saved.', 'notikumi-ticketing' ); ?></strong></p></div>
<?php
}

/*
 * Edición de ficheros layout css
 */
if( isset($_POST[ $hidden_css_layout_name ]) && $_POST[ $hidden_css_layout_name ] == 'Y'  && 
wp_verify_nonce($_POST['nonce'], 'hidden_css_layout_key_valid_2354945')) {
    $threeColsCss = wp_kses($_POST[ 'three-cols-css' ], array(), array());
    $threeColsCss = sanitize_textarea_field($threeColsCss);

    $singleColCss = wp_kses($_POST[ 'single-col-css' ], array(), array());
    $singleColCss = sanitize_textarea_field($singleColCss);

    $eventPageColCss = wp_kses($_POST[ 'event-page-css' ], array(), array());
    $eventPageColCss = sanitize_textarea_field($eventPageColCss);

    update_option($three_cols_css_custom_key, $threeColsCss);
    update_option($single_col_css_custom_key, $singleColCss);
    update_option($event_page_css_custom_key, $eventPageColCss);
?>
    <div class="updated"><p><strong><?php _e('CSS Layout Templates saved.', 'notikumi-ticketing' ); ?></strong></p></div>
<?php
}


$three_cols_original_css = file_get_contents($three_cols_css_original_filename);
$single_col_original_css = file_get_contents($single_col_css_original_filename);
$event_page_original_css = file_get_contents($event_page_css_original_filename);
$color_custom_original_css = file_get_contents($color_custom_css_original_filename);
$custom_styles_original_css = file_get_contents($custom_styles_css_original_filename );

$three_cols_custom_css = @get_option($three_cols_css_custom_key);
$event_page_custom_css = @get_option($event_page_css_custom_key);
$single_col_custom_css = @get_option($single_col_css_custom_key);

$color_custom_custom_css = @get_option($color_custom_css_custom_key);
$custom_styles_custom_css = @get_option($custom_styles_css_custom_key);


if(!get_option($three_cols_php_custom_key)) {
    $three_cols_custom_php = $three_cols_original_php;
}

if(!get_option($single_col_php_custom_key)) {
    $single_col_custom_php = $single_col_original_php;
}
if(!get_option($event_page_php_custom_key)) {
    $event_page_custom_php = $event_page_original_php;
}

if(!get_option($three_cols_css_custom_key)) {
    $three_cols_custom_css = $three_cols_original_css;
}

if(!get_option($single_col_css_custom_key)) {
    $single_col_custom_css = $single_col_original_css;
}

if(!get_option($event_page_css_custom_key)) {
    $event_page_custom_css = $event_page_original_css;
}

if(!get_option($color_custom_css_custom_key)) {
    $color_custom_custom_css = $color_custom_original_css;
}

if(!get_option($custom_styles_css_custom_key)) {
    $custom_styles_custom_css = $custom_styles_original_css;
}

?>
<div class="wrap">
    <h1><?=__( 'Customizing Design', 'notikumi-ticketing' )?></h1>

    <hr />

    <form class="template_form" name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_css_custom_name; ?>" value="Y">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('hidden_css_custom_key_valid_567833')?>">

        <h2 class="title">Global CSS </h2>
    
        <p>Customize these styles freely (these stylesheets are always loaded)</p>
        <div class="file-edit-group">
            <label>
                Color custom (color-custom.css)
                <button class="button-secondary restore-file-button" id="restore-color-custom-css">Restaurar</button>
            </label>
            <textarea class="file-edit-control" name="color-custom-css"><?=$color_custom_custom_css?></textarea>
        </div>
        <div class="file-edit-group">
            <label>
                Custom styles (custom-styles.css)
                <button class="button-secondary restore-file-button" id="restore-custom-styles-css">Restaurar</button>
            </label>
            <textarea class="file-edit-control" name="custom-styles-css"><?=$custom_styles_custom_css?></textarea>
        </div>

        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
    </form>

    <hr />

    <form class="template_form" name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_css_layout_name; ?>" value="Y">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('hidden_css_layout_key_valid_2354945')?>">
        
        <h2 class="title">CSS per page</h2>

        <p>This styles are loaded depending on the Layout you choose in the "content section".</p>
        <div class="file-edit-group">
            <label>
                3 eventos por fila (three-cols.css)
                <button class="button-secondary restore-file-button" id="restore-three-cols-css">Restaurar</button>
            </label>
            <textarea class="file-edit-control" name="three-cols-css"><?=$three_cols_custom_css?></textarea>
        </div>
        <div class="file-edit-group">
            <label>
                1 evento por fila (single-col.css)
                <button class="button-secondary restore-file-button" id="restore-single-col-css">Restaurar</button>
            </label>
            <textarea class="file-edit-control" name="single-col-css"><?=$single_col_custom_css?></textarea>
        </div>
        <div class="file-edit-group">
            <label>
                Página de evento (event-page.css)
                <button class="button-secondary restore-file-button" id="restore-event-page-css">Restaurar</button>
            </label>
            <textarea class="file-edit-control" name="event-page-css"><?=$event_page_custom_css?></textarea>
        </div>


        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
    </form>

    <form name="form_restore" id="form_restore" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_restore_name; ?>" value="Y">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('restore_5632124')?>">
        <input type="hidden" name="template_to_restore" value="">
    </form>
</div>

