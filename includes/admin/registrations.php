<?php
global $wpdb, $wpc_client; if ( isset( $_GET['action'] ) && 'delete' == $_GET['action'] ) { $id = $_GET['id']; $t_name = $wpdb->prefix . "wpc_client_login_redirects"; $user_data = get_userdata($id); $wpdb->query($wpdb->prepare("DELETE FROM $t_name WHERE rul_value=%s",$user_data->user_login)); wp_delete_user( $id, $reassign ); $_GET['msg'] = 'd'; } if ( !class_exists( 'pagination' ) ) include_once( $wpc_client->plugin_dir . 'includes/libs/pagination.php' ); $args = array( 'role' => 'wpc_client', 'meta_key' => 'wpc_need_pay', 'fields' => 'ID', ); $items = count( get_users( $args ) ); $p = new pagination; $p->items($items); $p->limit(25); $p->target("admin.php?page=wpclients_payments&tab=registrations"); $p->calculate(); $p->parameterName('p'); $p->adjacents(2); if(!isset($_GET['p'])) { $p->page = 1; } else { $p->page = $_GET['p']; } $args = array( 'role' => 'wpc_client', 'meta_key' => 'wpc_need_pay', 'offset' => ($p->page - 1) * $p->limit, 'number' => $p->limit, ); $clients = get_users( $args ); ?>

<div style="" class='wrap'>

    <script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery(".over").hover(function(){
                jQuery(this).css("background-color","#bcbcbc");
                },function(){
                jQuery(this).css("background-color","transparent");
            });

        });

    </script>

    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <h2><?php _e( 'Paid Registrations', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>

    <p><?php printf( __( 'Here you can see all the %s who have registered, but not yet completed the payment process.', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['p'] ) ?></p>
    <table class="widefat">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Order ID', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Email', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Action', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>&nbsp;</th>
                <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Order ID', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Email', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th><?php _e( 'Action', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
        </tfoot>
        <tbody>
    <?php
 foreach ( $clients as $client ) : $client = get_userdata( $client->ID ); $business_name = get_user_meta( $client->ID, 'wpc_cl_business_name', true ); ?>
        <tr class='over'>
            <td>
            </td>
            <td id="assign_name_block_<?php echo $client->ID ?>" >
                <?php echo $client->user_login ?>
            </td>
            <td>
                <?php
 $order_id = $wpdb->get_var( $wpdb->prepare( "SELECT order_id FROM {$wpdb->prefix}wpc_client_payments WHERE client_id = %d ", $client->ID ) ); echo ( '' != $order_id ) ? $order_id : ''; ?>
            </td>
            <td>
                <?php echo $client->display_name ?>
            </td>
            <td>
                <?php echo $business_name ?>
            </td>
            <td>
                <?php echo $client->user_email ?>
            </td>
            <td>
            </td>
        </tr>

    <?php
 endforeach; ?>
        </tbody>
    </table>

    <div class="tablenav">
        <div class='tablenav-pages'>
            <?php echo $p->show(); ?>
        </div>
    </div>

</div>