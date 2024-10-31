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

$_DEBUG = false;
?>

<?php

// variables for the field and option names 
$hidden_content_name = 'ntk_content_hidden';
$hidden_delete_name = 'ntk_delete_hidden';

$widget_pos_key = 'widget_pos';
$opt_id_key = 'ntk_id';
$opt_user_key = 'ntk_cred_user_key';
$opt_pass_key = 'ntk_cred_pass_key';
$opt_content_key = 'ntk_content_key';
$opt_content_temp_key = 'ntk_content_temp_key';
$opt_agenda_type_key = 'ntk_content_agenda_type_key';
$opt_artists_key = 'ntk_artists_key';
$opt_venues_key = 'ntk_venues_key';
$opt_organizations_key = 'ntk_organizations_key';
$opt_channels_key = 'ntk_channels_key';
$opt_sale_channels_key = 'ntk_sale_channels_key';
$opt_event_key = 'ntk_event_key';
$opt_current_template_key = 'ntk_current_template';
$opt_events_path_key = 'ntk_events_path_key';
$opt_checkout_css_key = 'ntk_checkout_custom_css_key';
$opt_events_title_key = 'ntk_events_title_key';
$opt_events_qt_key = 'ntk_events_qt_key';
$opt_action_call_purchase_tickets_key = 'ntk_action_call_purchase_tickets';
$opt_action_call_purchase_tickets_en_key = 'ntk_action_call_purchase_tickets_en';

$opt_id = get_option( $opt_id_key );
$opt_content = get_option( $opt_content_key );
$opt_content_temp = get_option( $opt_content_temp_key );
$opt_agenda = get_option( $opt_agenda_type_key );
$opt_artists = get_option( $opt_artists_key );
$opt_venues = get_option( $opt_venues_key );
$opt_organizations = get_option( $opt_organizations_key );
$opt_channels = get_option( $opt_channels_key );
$opt_sale_channels = get_option( $opt_sale_channels_key );
$opt_event = get_option( $opt_event_key );
$opt_template = get_option( $opt_current_template_key );
$opt_events_path = get_option( $opt_events_path_key );
$opt_checkout_css = get_option( $opt_checkout_css_key );
$opt_events_title = get_option( $opt_events_title_key );
$opt_events_qt = get_option( $opt_events_qt_key );
$opt_action_call_purchase_tickets = get_option( $opt_action_call_purchase_tickets_key );
$opt_action_call_purchase_tickets_en = get_option( $opt_action_call_purchase_tickets_en_key );

// Tab  that is shown atm
$currentPos = sanitize_text_field($_POST[ $widget_pos_key ]);

// check 
if(!is_array($opt_agenda)) {
    $opt_agenda = array();
    update_option( $opt_agenda_type_key, array());
}

// BORRAR
if( isset($_POST[ $hidden_delete_name ]) && $_POST[ $hidden_delete_name ] == 'Y' && 
    isset($_POST[ $widget_pos_key ]) && $_POST[ $widget_pos_key ] != "" &&
    wp_verify_nonce($_POST['nonce'], 'delete_nonce_seed_123461')) {

    $pos = sanitize_text_field($_POST[ $widget_pos_key ]);
    $id = $opt_id[$pos];

    array_splice($opt_id, $pos, 1);
    array_splice($opt_content, $pos, 1);
    array_splice($opt_content_temp, $pos, 1);
    array_splice($opt_agenda, $pos, 1);
    array_splice($opt_artists, $poss, 1);
    array_splice($opt_venues, $pos, 1);
    array_splice($opt_organizations, $pos, 1);
    array_splice($opt_channels, $pos, 1);
    array_splice($opt_sale_channels, $pos, 1);
    array_splice($opt_event, $pos, 1);
    array_splice($opt_template, $pos, 1);
    array_splice($opt_events_path, $pos, 1);
    array_splice($opt_checkout_css, $pos, 1);
    array_splice($opt_events_title, $pos, 1);
    array_splice($opt_events_qt, $pos, 1);
    array_splice($opt_action_call_purchase_tickets, $pos, 1);
    array_splice($opt_action_call_purchase_tickets_en, $pos, 1);
    

    update_option( $opt_id_key, $opt_id );
    update_option( $opt_content_key, $opt_content );
    update_option( $opt_content_temp_key, $opt_content_temp );
    update_option( $opt_agenda_type_key, $opt_agenda );
    update_option( $opt_artists_key, $opt_artists );
    update_option( $opt_venues_key, $opt_venues );
    update_option( $opt_organizations_key, $opt_organizations );
    update_option( $opt_channels_key, $opt_channels );
    update_option( $opt_sale_channels_key, $opt_sale_channels );
    update_option( $opt_event_key, $opt_event );
    update_option( $opt_current_template_key, $opt_template );
    update_option( $opt_events_path_key, $opt_events_path );
    update_option( $opt_checkout_css_key, $opt_checkout_css );
    update_option( $opt_events_title_key, $opt_events_title );
    update_option( $opt_events_qt_key, $opt_events_qt );
    update_option( $opt_action_call_purchase_tickets_key, $opt_action_call_purchase_tickets );
    update_option( $opt_action_call_purchase_tickets_en_key, $opt_action_call_purchase_tickets_en );
    ?>
    <div class="updated"><p><strong><?php _e('Shortcode #'.$id.' deleted.', 'notikumi-ticketing' ); ?></strong></p></div>
    <?php
}
// EDITAR o AÑADIR
else if( isset($_POST[ $hidden_content_name ]) && $_POST[ $hidden_content_name ] == 'Y' && 
    wp_verify_nonce($_POST['nonce'], 'add_edit_nonce_seed_9521461')) {
    // Read their posted value
    $pos = $_POST[ $widget_pos_key ];

    // Seteo la id
    if(!isset($_POST[ $opt_id_key ]) || $_POST[ $opt_id_key ] == "") {
        if(isset($opt_id) && count($opt_id) > 0) {
            $opt_id[$pos] = $opt_id[count($opt_id)-1] + 1;
        }
        else {
            $opt_id[$pos] = 1;
        }
    }
    else {
        $opt_id[$pos] = sanitize_text_field($_POST[ $opt_id_key ]);
    }

    $opt_content[$pos] = sanitize_text_field($_POST[ $opt_content_key ]);
    $opt_content_temp[$pos] = sanitize_text_field($_POST[ $opt_content_temp_key ]);
    $opt_agenda[$pos] = sanitize_text_field($_POST[ $opt_agenda_type_key ]);
    $opt_artists[$pos] = sanitize_text_field($_POST[ $opt_artists_key ]);
    $opt_venues[$pos] = sanitize_text_field($_POST[ $opt_venues_key ]);
    $opt_organizations[$pos] = sanitize_text_field($_POST[ $opt_organizations_key ]);
    $opt_channels[$pos] = sanitize_text_field($_POST[ $opt_channels_key ]);
    $opt_sale_channels[$pos] = sanitize_text_field($_POST[ $opt_sale_channels_key ]);
    $opt_event[$pos] = sanitize_text_field($_POST[ $opt_event_key ]);
    $opt_template[$pos] = sanitize_text_field($_POST[ $opt_current_template_key ]);
    $opt_events_title[$pos] = sanitize_text_field($_POST[ $opt_events_title_key ]);
    $opt_checkout_css[$pos] = sanitize_text_field($_POST[ $opt_checkout_css_key ]);
    $opt_events_path[$pos] = $_POST[ $opt_events_path_key ] != "" ? sanitize_text_field($_POST[ $opt_events_path_key ]) : "/events";
    $opt_events_qt[$pos] = $_POST[ $opt_events_qt_key ] != "" ? sanitize_text_field($_POST[ $opt_events_qt_key ]) : "20";
    $opt_action_call_purchase_tickets[$pos] = sanitize_text_field($_POST[ $opt_action_call_purchase_tickets_key ]);
    $opt_action_call_purchase_tickets_en[$pos] = sanitize_text_field($_POST[ $opt_action_call_purchase_tickets_en_key ]);

    // Save the posted value in the database
    update_option( $opt_id_key, $opt_id );
    update_option( $opt_content_key, $opt_content );
    update_option( $opt_content_temp_key, $opt_content_temp );
    update_option( $opt_agenda_type_key, $opt_agenda );
    update_option( $opt_artists_key, $opt_artists );
    update_option( $opt_venues_key, $opt_venues );
    update_option( $opt_organizations_key, $opt_organizations );
    update_option( $opt_channels_key, $opt_channels );
    update_option( $opt_sale_channels_key, $opt_sale_channels );
    update_option( $opt_event_key, $opt_event );
    update_option( $opt_current_template_key, $opt_template );
    update_option( $opt_events_path_key, $opt_events_path );
    update_option( $opt_events_title_key, $opt_events_title );
    update_option( $opt_checkout_css_key, $opt_checkout_css );
    update_option( $opt_events_qt_key, $opt_events_qt );
    update_option( $opt_action_call_purchase_tickets_key, $opt_action_call_purchase_tickets );
    update_option( $opt_action_call_purchase_tickets_en_key, $opt_action_call_purchase_tickets_en );

	flush_rewrite_rules();

?>
    <div class="updated"><p><strong><?php _e('settings #'.($opt_id[$pos]).' saved.', 'notikumi-ticketing' ); ?></strong></p></div>
<?php
}

// Read in existing option value from database
$opt_id = get_option( $opt_id_key );
$opt_content = get_option( $opt_content_key );
$opt_content_temp = get_option( $opt_content_temp_key );
$opt_agenda = get_option( $opt_agenda_type_key );
$opt_artists = get_option( $opt_artists_key );
$opt_venues = get_option( $opt_venues_key );
$opt_organizations = get_option( $opt_organizations_key );
$opt_channels = get_option( $opt_channels_key );
$opt_sale_channels = get_option( $opt_sale_channels_key );
$opt_event = get_option( $opt_event_key );
$opt_template = get_option( $opt_current_template_key );
$opt_events_path = get_option( $opt_events_path_key );
$opt_events_title = get_option( $opt_events_title_key );
$opt_checkout_css = get_option( $opt_checkout_css_key );
$opt_events_qt = get_option( $opt_events_qt_key );
$opt_action_call_purchase_tickets = get_option( $opt_action_call_purchase_tickets_key );
$opt_action_call_purchase_tickets_en = get_option( $opt_action_call_purchase_tickets_en_key );

if(!$opt_content) $opt_content=[];

if($_DEBUG) {
    var_dump($opt_id);
    echo "<br />";
    var_dump($opt_content);
    echo "<br />";
    var_dump($opt_content_temp);
    echo "<br />";
    var_dump($opt_agenda);
    echo "<br />";
    var_dump($opt_artists);
    echo "<br />";
    var_dump($opt_venues);
    echo "<br />";
    var_dump($opt_organizations);
    echo "<br />";
    var_dump($opt_channels);
    echo "<br />";
    var_dump($opt_sale_channels);
    echo "<br />";
    var_dump($opt_events_title);
}


?>


<div class="wrap">
    <h1><?=__( 'Configuration Notikumi Plugin', 'notikumi-ticketing' )?></h1>

    <p>Puedes tener múltiples agendas o eventos instalados en distintas páginas.
        <br />
        Actualmente tienes <?=($opt_content) ? count($opt_content) : 0 ?> configuración.</p> 

    <h2 class="nav-tab-wrapper">
        <?php
        for($i = 0; $i < count($opt_content); $i++) {
        ?>
        <a href="#" class="nav-tab nav-tab-<?=$i?> <?php echo ($currentPos == $i || (!isset($currentPos) && $i == 0)) ? "nav-tab-active" : ""?>" data-pos="<?=$i?>">
            Configuración #<?=$opt_id[$i]?> 
            <?php if($i > 0 && $i == count($opt_content)-1 ) { ?><?php } ?>
        </a>
        <?php
        }
        ?>
        <a href="#" class="nav-tab create-new-config">
            <span class="dashicons dashicons-plus"></span> Nueva configuración
        </a>
    </h2>

    <?php
    for($i = 0; $i < count($opt_content); $i++) {
    ?>
    <form id="form<?=($i+1)?>" name="form<?=($i+1)?>" method="post" action="" class="tab-pane tab-pane-<?=$i?> <?php echo ($currentPos == $i || (!isset($currentPos) && $i == 0)) ? "tab-pane-active" : "" ?>" data-pos="<?=$i?>">
        <input type="hidden" name="<?php echo $hidden_content_name; ?>" value="Y">
        <input type="hidden" name="<?php echo $widget_pos_key; ?>" value="<?=$i?>">
        <input type="hidden" name="<?php echo $opt_id_key; ?>" value="<?=$opt_id[$i]?>">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('add_edit_nonce_seed_9521461')?>">

        <section>
            <h2 class="title">Configuración del contenido</h2>

            <table class="form-table">
                <tr class="form_agenda_content_row">
                    <th scope="row"><?php _e("Contenido", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <select name="<?=$opt_content_key?>" class="form_agenda_content_control">
                            <option value="-1"  <?php echo ($opt_content[$i] == "-1") ? "selected" : "" ?>>Tipo de contenido</option>
                            <option value="multiple_events" <?php echo ($opt_content[$i] == "multiple_events") ? "selected" : "" ?>>Conjunto de eventos</option>
                            <option value="single_event" <?php echo ($opt_content[$i] == "single_event") ? "selected" : "" ?>>Un único evento</option>
                        </select>
                    </td>
                </tr>

                <tr class="form_agenda_content_temp_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Temporalidad", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <select name="<?=$opt_content_temp_key?>" class="form_agenda_content_control">
                            <option value="future_events" <?php echo ($opt_content_temp[$i] == "future_events") ? "selected" : "" ?>>Mostrar Futuros</option>
                            <option value="past_events" <?php echo ($opt_content_temp[$i] == "past_events") ? "selected" : "" ?>>Mostrar Pasados</option>
                        </select>
                    </td>
                </tr>

                <tr class="form_agenda_type_row form_content_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Tipo de agenda", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <select name="<?=$opt_agenda_type_key?>" class="form_agenda_type_control">
                            <option value="-1" <?php echo ($opt_agenda[$i] == "-1") ? "selected" : "" ?>>Seleccionar</option>
                            <option value="artists" <?php echo ($opt_agenda[$i] == "artists") ? "selected" : "" ?>>Artistas</option>
                            <option value="venues" <?php echo ($opt_agenda[$i] == "venues") ? "selected" : "" ?>>Salas</option>
                            <option value="organizations" <?php echo ($opt_agenda[$i] == "organizations") ? "selected" : "" ?>>Organización</option>
                            <option value="channels" <?php echo ($opt_agenda[$i] == "channels") ? "selected" : "" ?>>Canales</option>
                            <option value="users" <?php echo ($opt_agenda[$i] == "users") ? "selected" : "" ?>>Usuario</option>
                        </select>
                    </td>
                </tr>
                <tr class="form_agenda_artists_row form_agenda_row" <?php echo ($opt_agenda[$i] == "artists") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Artists", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_artists_key?>" value="<?php echo esc_html($opt_artists[$i]); ?>" size="20">
                    </td>
                </tr>
                <tr class="form_agenda_venues_row form_agenda_row" <?php echo ($opt_agenda[$i] == "venues") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Venues", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_venues_key?>" value="<?php echo esc_html($opt_venues[$i]); ?>" size="20">
                    </td>
                </tr>
                <tr class="form_agenda_organizations_row form_agenda_row" <?php echo ($opt_agenda[$i] == "organizations") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Organizations", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_organizations_key?>" value="<?php echo esc_html($opt_organizations[$i]); ?>" size="20">
                    </td>
                </tr>
                <tr class="form_agenda_users_row form_agenda_row" <?php echo ($opt_agenda[$i] == "users") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Users", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="ntk_users" value="<?php echo esc_html($opt_users[$i]); ?>" size="20">
                    </td>
                </tr>
                <tr class="form_agenda_event_row form_agenda_row" <?php echo ($opt_content[$i] == "single_event") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Evento", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_event_key?>" value="<?php echo esc_html($opt_event[$i]); ?>" size="20">
                    </td>
                </tr>
                <tr class="form_agenda_channels_row form_agenda_row" <?php echo ($opt_agenda[$i] == "channels") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Canal contenido:", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_channels_key?>" value="<?php echo esc_html($opt_channels[$i]); ?>" size="20">
                    </td>
                </tr>
            </table>
        </section>

        <section class="section-config-ticketing">
            <h2 class="">Configuración de la venta de entradas</h2>
            <table class="form-table">
                <tr class="form_agenda_sale_channels_row">
                    <th scope="row"><?php _e("Canal de venta de entradas", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <input type="text" name="<?=$opt_sale_channels_key?>" value="<?php echo esc_html($opt_sale_channels[$i]); ?>" size="20">
                    </td>
                </tr>
            </table>
        </section>

        <section>
            <h2 class="">Configuración del aspecto</h2>
            <table class="form-table">
                <tr class="form_agenda_template_row">
                    <th scope="row"><?php _e("Layout", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <select name="<?=$opt_current_template_key?>">
                            <option class="events-template-option" value="three-cols" <?php echo ($opt_template[$i] == 'three-cols') ? "selected" : "" ?> <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:block"' : 'style="display:none"'?>>3 eventos por fila</option>
                            <option class="events-template-option" value="single-col" <?php echo ($opt_template[$i] == 'single-col') ? "selected" : "" ?> <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:block"' : 'style="display:none"'?>>1 evento por fila</option>
                            <option class="single-event-template-option" value="grid" <?php echo ($opt_template[$i] == 'grid') ? "selected" : "" ?> <?php echo ($opt_content[$i] == "single_event") ? 'style="display:block"' : 'style="display:none"'?>>Parrilla de venta</option>
                            <option class="single-event-template-option" value="event-page" <?php echo ($opt_template[$i] == 'event-page') ? "selected" : "" ?> <?php echo ($opt_content[$i] == "single_event") ? 'style="display:block"' : 'style="display:none"'?>>Evento</option>
                        </select>
                    </td>
                </tr>
            </table>
        </section>

        <section>
            <h2 class="">Configuración del listado</h2>
            <table class="form-table">
                <tr class="form_events_qt_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Cantidad en listado", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type=text name="<?=$opt_events_qt_key?>" value="<?=esc_html($opt_events_qt[$i])?>">
                        </div>
                    </td>
                </tr>
            </table>
        </section>

        <section>
            <h2 class="">Configuración página de evento</h2>
            <table class="form-table">
                <tr class="form_events_title_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Mostrar título en página de evento", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type="checkbox" name="<?=$opt_events_title_key?>" <?=($opt_events_title[$i] == "true") ? 'checked="checked"' : '' ?> value="true" />
                        </div>
                    </td>
                </tr>
                <tr class="form_events_path_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Ruta de página los eventos", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type=text name="<?=$opt_events_path_key?>" value="<?=$opt_events_path[$i]?>">
                        </div>
                    </td>
                </tr>
                <tr class="form_events_path_row form-row-helper-text" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <td colspan=2>
                        La ruta cuando se visite un evento será parecida a: <br />
                        <?=get_site_url().$opt_events_path[$i]?>/2019/12/31/nochevieja-en-la-puerta-del-sol
                    </td>
                </tr>
                <tr class="form_checkout_css_row">
                    <th scope="row"><?php _e("Custom CSS para checkout", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type=text name="<?=$opt_checkout_css_key?>" value="<?=$opt_checkout_css[$i]?>">
                        </div>
                    </td>
                </tr>
                <tr class="form_checkout_css_row form-row-helper-text">
                    <td colspan=2>
                        CSS que cargará el proceso de compra <br />
                        Debe alojarse en un servidor seguro HTTPS y CORS libre o en media.notikumi.com.
                    </td>
                </tr>
            </table>
        </section>

        <section>
            <h2 class="">Configuración textos</h2>
            <table class="form-table">
                <tr class="form_events_title_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Texto botón 'comprar entradas' ES", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type="text" name="<?= $opt_action_call_purchase_tickets_key ?>" value="<?= $opt_action_call_purchase_tickets[$i] ?>" 
                                placeholder="Comprar entradas" />
                        </div>
                    </td>
                </tr>
                <tr class="form_events_title_row" <?php echo ($opt_content[$i] == "multiple_events") ? 'style="display:table-row"' : 'style="display:none"'?>>
                    <th scope="row"><?php _e("Texto botón 'comprar entradas' EN", 'notikumi-ticketing' ); ?></th>
                    <td>
                        <div>
                            <input type="text" name="<?= $opt_action_call_purchase_tickets_en_key ?>" value="<?= $opt_action_call_purchase_tickets_en[$i] ?>" 
                            placeholder="Buy tickets"/>
                        </div>
                    </td>
                </tr>

                <tr class="form_checkout_css_row form-row-helper-text">
                    <td colspan=2>
                        Si lo dejas en blanco, pondrá el texto por defecto (Comprar entradas / Buy tickets)
                    </td>
                </tr>
            </table>
        </section>


        <section>
            <h2 class="title">Short Code</h2>
            <p>Pega este código donde quieras que se muestre el contenido. <br />
            Si usas un gestor de bloques, usa la opción añadir bloque de tipo shortcode. </p>
            <textarea readonly="readonly" class="shortcode_code">[notikumi id="<?=$opt_id[$i]?>"]</textarea>
        </section>


        <p class="submit">
            <button type="button" class="button-secondary delete-shortcode" data-pos="<?=$i?>">
                <span class="dashicons dashicons-trash"></span> <?php esc_attr_e('Delete') ?>
            </button>

            <input  type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>

    </form>

    <?php
    }

    ?>


    <form id="new_form" method="post" action="">  
        <input type="hidden" name="<?php echo $hidden_content_name; ?>" value="Y">
        <input type="hidden" name="<?php echo $widget_pos_key; ?>" value="<?=count($opt_content)?>">
        <input type="hidden" name="<?=$opt_content_key?>" value="-1">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('add_edit_nonce_seed_9521461')?>">
    </form>

    <?php
    for($i = 0; $i < count($opt_content); $i++) {
    ?>
    <form id="delete_form_<?=$i?>" method="post" action="">  
        <input type="hidden" name="<?php echo $hidden_delete_name; ?>" value="Y">
        <input type="hidden" name="<?php echo $widget_pos_key; ?>" value="<?=$i?>">
        <input type="hidden" name="nonce" value="<?=wp_create_nonce('delete_nonce_seed_123461')?>">
    </form>
    <?php
    }
    ?>
</div>

