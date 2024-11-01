<?php
//Envía el mensaje SMS
function apg_sms_envia_sms( $apg_sms_settings, $mensajes ) {
	switch ( $apg_sms_settings['servicio'] ) {
        case "smsvio":
            $argumentos['body'] = array(
                'key' 					    => $apg_sms_settings['api_key_smsvio'],
                'messages' 					=> json_encode($mensajes)
            );
            if(!empty($apg_sms_settings['device_id_smsvio'])) {
                $argumentos['body']['devices'] = $apg_sms_settings['device_id_smsvio'];
            }
            $respuesta = wp_remote_post( "https://admin.smsvio.cz/services/send.php", $argumentos );
            break;
	}

	if ( isset( $apg_sms_settings['debug'] ) && $apg_sms_settings['debug'] == "1" && isset( $apg_sms_settings['campo_debug'] ) ) {
		$correo	= __( 'Odpov&#x11B;&#x10F; SMS br&#xE1;ny: ', 'smsvio-pro-woocommerce' ) . "\r\n" . print_r( $argumentos, true ) . "\r\n" . print_r( $respuesta, true );
		wp_mail( $apg_sms_settings['campo_debug'], 'SMSVio WordPress Debug Information', $correo, 'charset=UTF-8' . "\r\n" );
	}
}