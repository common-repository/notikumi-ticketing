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
$hidden_credentials_name = 'ntk_credentials_hidden';



if( isset($_POST[ $hidden_credentials_name ]) && $_POST[ $hidden_credentials_name ] == 'Y' && 
    wp_verify_nonce($_POST['nonce'], 'credentials_seed_745924')) {

    $opt_user = sanitize_email($_POST[ $opt_user_key ]);
    $opt_pass = sanitize_text_field($_POST[ $opt_pass_key ]);

    update_option( $opt_user_key, $opt_user );
    update_option( $opt_pass_key, $opt_pass );
?>
    <div class="updated"><p><strong><?php _e('settings saved.', 'notikumi-ticketing' ); ?></strong></p></div>
<?php
}

// Read in existing option value from database
$opt_user = get_option( $opt_user_key );
$opt_pass = get_option( $opt_pass_key );


?>
<div class="wrap">
    <h1><?=__( 'Configuration Notikumi Plugin', 'notikumi-ticketing' )?></h1>

    <form name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_credentials_name; ?>" value="Y">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('credentials_seed_745924')?>">
        <h2 class="title">Credenciales de notikumi</h2>

        <table class="form-table">
            <tr class=" ">
                <th scope="row"><?php _e("Email de acceso a notikumi", 'notikumi-ticketing' ); ?></th>
                <td>
                    <input type="text" name="<?=$opt_user_key?>" value="<?php echo esc_html($opt_user); ?>" size="20" autocomplete="off">
                </td>
            </tr>
            <tr class="">
                <th scope="row"><?php _e("Contraseña de notikumi", 'notikumi-ticketing' ); ?></th>
                <td>
                    <input type="password" name="<?=$ntk_pass_key?>" value="" size="20" autocomplete="off">
                </td>
            </tr>
            
        </table>

        <p class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
    </form>


</div>

