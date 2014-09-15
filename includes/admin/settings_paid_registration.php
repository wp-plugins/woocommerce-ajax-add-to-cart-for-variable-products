<?php
global $wpc_gateway_plugins, $wpc_client; $error = ''; if ( isset( $_POST['registration'] ) ) { $cost = str_replace( ',', '.', $_POST['registration']['cost'] ); if ( empty( $cost ) ) { $error .= __( 'You should set Cost of registration.<br/>', WPC_CLIENT_TEXT_DOMAIN ); } elseif ( !is_numeric( $cost ) ) { $error .= __( 'Cost should be numeric .<br/>', WPC_CLIENT_TEXT_DOMAIN ); } elseif ( 0 >= $cost ) { $error .= __( 'Cost of registration should be more than 0<br/>', WPC_CLIENT_TEXT_DOMAIN ); } $_POST['registration']['cost'] = $cost; if ( empty( $error ) ) { do_action( 'wp_client_settings_update', $_POST['registration'], 'paid_registration' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=paid_registration&msg=u' ); exit; do_action('wp_client_redirect', 'admin.php?page=wpclients_payments&tab=registration_settings'); exit; } $wpc_paid_registration = $_POST['registration']; } else { $wpc_paid_registration = $wpc_client->cc_get_settings( 'paid_registration' ); } $wpc_gateways = $wpc_client->cc_get_settings( 'gateways' ); if ( isset( $wpc_paid_registration['enable'] ) && 'yes' == $wpc_paid_registration['enable'] && ( !isset( $wpc_paid_registration['gateways'] ) || 0 == count( $wpc_paid_registration['gateways'] ) ) ) { $error .= __( 'Note: The registration will not work until you select "Payment Gateways". Clients will see a message that "Registration temporarily unavailable".', WPC_CLIENT_TEXT_DOMAIN ); } ?>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >
    <div class="postbox">
        <h3 class='hndle'><span><?php  _e( 'Registration Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <span class="description"><?php _e( 'From here, you can manage settings for paid registration.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
            <hr />
            <br>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th>
                            <label for="enable"><?php _e( 'Enable Paid Registration', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </th>
                        <td>
                            <select name="registration[enable]" id="enable" >
                                <option value="no" <?php echo ( isset( $wpc_paid_registration['enable'] ) && 'no' == $wpc_paid_registration['enable'] ) ? 'selected' : '' ?> ><?php _e( 'Disable', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_paid_registration['enable'] ) && 'yes' == $wpc_paid_registration['enable'] ) ? 'selected' : '' ?> ><?php _e( 'Enable', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label><?php _e( 'Payment Gateways', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </th>
                        <td>
                            <?php
 foreach ( (array)$wpc_gateway_plugins as $code => $plugin ) { if ( isset( $wpc_gateways['allowed'] ) && in_array( $code, (array) $wpc_gateways['allowed'] ) ) { $checked = ''; if ( isset( $wpc_paid_registration['gateways'] ) && in_array( $code, $wpc_paid_registration['gateways'] ) ) { $checked = 'checked'; } echo '<label><input type="checkbox" name="registration[gateways][]" value="' . $code .'" ' . $checked .' /> ' . esc_attr( $plugin[1] ) . '</label><br>'; } } ?>
                            <span class="description"><?php echo sprintf( __( 'To add or change payments gateway settings, please look in "%s"', WPC_CLIENT_TEXT_DOMAIN ), '<a href="admin.php?page=wpclients_settings&tab=payment_gateways" >' . __( 'Payment Gateways Settings', WPC_CLIENT_TEXT_DOMAIN ) . '</a>' ) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="cost"><?php _e( 'Registration Cost', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </th>
                        <td>
                            <input type="text" name="registration[cost]" style="width: 50px;" id="cost" value="<?php echo ( isset( $wpc_paid_registration['cost'] ) && '' != $wpc_paid_registration['cost'] ) ? $wpc_paid_registration['cost'] : '' ?>" />
                            <span class="description"><?php  printf( __( 'Cost to register as %s', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] ) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="cost"><?php _e( 'Payment Description', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </th>
                        <td>
                            <textarea cols="90" rows="2" name="registration[description]" id="description" ><?php echo ( isset( $wpc_paid_registration['description'] ) && '' != $wpc_paid_registration['description'] ) ? $wpc_paid_registration['description'] : '' ?></textarea>
                            <br />
                            <span class="description"><?php _e( 'Will be displayed on the payment page.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="cost"><?php _e( 'Custom Auto-Return URL', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </th>
                        <td>
                            <input type="text" name="registration[autoreturn]" style="width: 500px;" id="autoreturn" value="<?php echo ( isset( $wpc_paid_registration['autoreturn'] ) && '' != $wpc_paid_registration['autoreturn'] ) ? $wpc_paid_registration['autoreturn'] : '' ?>" />
                            <br />
                            <span class="description"><?php printf( __( '%s will be redirected here after payment. Example: %s', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'], '<b>' . get_home_url() . '</b>' ) ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type='submit' name='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>