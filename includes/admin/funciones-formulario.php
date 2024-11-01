<?php
global $apg_sms_settings, $wpml_activo;

//Control de tabulación
$tab = 1;

//WPML
if ( function_exists( 'icl_register_string' ) || !$wpml_activo ) { //Versión anterior a la 3.2
	$mensaje_pedido		= ( $wpml_activo ) ? icl_translate( 'apg_sms', 'mensaje_pedido', $apg_sms_settings['mensaje_pedido'] ) : $apg_sms_settings['mensaje_pedido'];
	$mensaje_recibido	= ( $wpml_activo ) ? icl_translate( 'apg_sms', 'mensaje_recibido', $apg_sms_settings['mensaje_recibido'] ) : $apg_sms_settings['mensaje_recibido'];
	$mensaje_procesando	= ( $wpml_activo ) ? icl_translate( 'apg_sms', 'mensaje_procesando', $apg_sms_settings['mensaje_procesando'] ) : $apg_sms_settings['mensaje_procesando'];
	$mensaje_completado	= ( $wpml_activo ) ? icl_translate( 'apg_sms', 'mensaje_completado', $apg_sms_settings['mensaje_completado'] ) : $apg_sms_settings['mensaje_completado'];
	$mensaje_nota		= ( $wpml_activo ) ? icl_translate( 'apg_sms', 'mensaje_nota', $apg_sms_settings['mensaje_nota'] ) : $apg_sms_settings['mensaje_nota'];
} else if ( $wpml_activo ) { //Versión 3.2 o superior
	$mensaje_pedido		= apply_filters( 'wpml_translate_single_string', $apg_sms_settings['mensaje_pedido'], 'apg_sms', 'mensaje_pedido' );
	$mensaje_recibido	= apply_filters( 'wpml_translate_single_string', $apg_sms_settings['mensaje_recibido'], 'apg_sms', 'mensaje_recibido' );
	$mensaje_procesando	= apply_filters( 'wpml_translate_single_string', $apg_sms_settings['mensaje_procesando'], 'apg_sms', 'mensaje_procesando' );
	$mensaje_completado	= apply_filters( 'wpml_translate_single_string', $apg_sms_settings['mensaje_completado'], 'apg_sms', 'mensaje_completado' );
	$mensaje_nota		= apply_filters( 'wpml_translate_single_string', $apg_sms_settings['mensaje_nota'], 'apg_sms', 'mensaje_nota' );
}

//Listado de proveedores SMS
$listado_de_proveedores = array(
    "smsvio"            => "SMSVio"
);
asort( $listado_de_proveedores, SORT_NATURAL | SORT_FLAG_CASE ); //Ordena alfabeticamente los proveedores

//Campos necesarios para cada proveedor
$campos_de_proveedores = array(
    "smsvio" 			=> array(
        "api_key_smsvio" 					=> __( 'API kl&#xED;&#x10D;', 'smsvio-pro-woocommerce' ),
        "device_id_smsvio"					=> __( '&#x10C;&#xED;slo za&#x159;&#xED;zen&#xED; (ID)', 'smsvio-pro-woocommerce' ),
    )
);

//Opciones de campos de selección de los proveedores
$opciones_de_proveedores = [];

//Listado de estados de pedidos
$listado_de_estados				= wc_get_order_statuses();
$listado_de_estados_temporal	= array();
$estados_originales				= array( 
	'pending',
	'failed',
	'on-hold',
	'processing',
	'completed',
	'refunded',
	'cancelled',
);
foreach( $listado_de_estados as $clave => $estado ) {
	$nombre_de_estado = str_replace( "wc-", "", $clave );
	if ( !in_array( $nombre_de_estado, $estados_originales ) ) {
		$listado_de_estados_temporal[$estado] = $nombre_de_estado;
	}
}
$listado_de_estados = $listado_de_estados_temporal;

//Listado de mensajes personalizados
$listado_de_mensajes = array(
	'todos'					=> __( 'V&#x161;echny zpr&#xE1;vy', 'smsvio-pro-woocommerce' ),
	'mensaje_pedido'		=> __( 'Vlastn&#xED; zpr&#xE1;va vlastn&#xED;ka', 'smsvio-pro-woocommerce' ),
	'mensaje_recibido'		=> __( 'Zpr&#xE1;va Objedn&#xE1;vka pozastavena', 'smsvio-pro-woocommerce' ),
	'mensaje_procesando'	=> __( 'Zpr&#xE1;va Zpracov&#xE1;n&#xED; objedn&#xE1;vky', 'smsvio-pro-woocommerce' ),
	'mensaje_completado'	=> __( 'Zpr&#xE1;va Objedn&#xE1;vka dokon&#x10D;ena', 'smsvio-pro-woocommerce' ),
	'mensaje_nota'			=> __( 'Zpr&#xE1;va Pozn&#xE1;mky', 'smsvio-pro-woocommerce' ),
);

/*
Pinta el campo select con el listado de proveedores
*/
function apg_sms_listado_de_proveedores( $listado_de_proveedores ) {
	global $apg_sms_settings;
	
	foreach ( $listado_de_proveedores as $valor => $proveedor ) {
		$chequea = ( isset( $apg_sms_settings['servicio'] ) && $apg_sms_settings['servicio'] == $valor ) ? ' selected="selected"' : '';
		echo '<option value="' . $valor . '"' . $chequea . '>' . $proveedor . '</option>' . PHP_EOL;
	}
}

/*
Pinta los campos de los proveedores
*/
function apg_sms_campos_de_proveedores( $listado_de_proveedores, $campos_de_proveedores, $opciones_de_proveedores ) {
	global $apg_sms_settings, $tab;
	
	foreach ( $listado_de_proveedores as $valor => $proveedor ) {
		foreach ( $campos_de_proveedores[$valor] as $valor_campo => $campo ) {
			if ( array_key_exists( $valor_campo, $opciones_de_proveedores ) ) { //Campo select
				echo '
  <tr valign="top" class="' . $valor . '"><!-- ' . $proveedor . ' -->
	<th scope="row" class="titledesc"> <label for="apg_sms_settings[' . $valor_campo . ']">' .ucfirst( $campo ) . ':' . '
	  <span class="woocommerce-help-tip" data-tip="' . sprintf( __( '%s pro v&#xE1;&#x161; &#xFA;&#x10D;et v %s', 'smsvio-pro-woocommerce' ), $campo, $proveedor ) . '"></span></label></th>
	<td class="forminp forminp-number"><select class="wc-enhanced-select" id="apg_sms_settings[' . $valor_campo . ']" name="apg_sms_settings[' . $valor_campo . ']" tabindex="' . $tab++ . '">
				';
				foreach ( $opciones_de_proveedores[$valor_campo] as $valor_opcion => $opcion ) {
					$chequea = ( isset( $apg_sms_settings[$valor_campo] ) && $apg_sms_settings[$valor_campo] == $valor_opcion ) ? ' selected="selected"' : '';
					echo '<option value="' . $valor_opcion . '"' . $chequea . '>' . $opcion . '</option>' . PHP_EOL;
				}
				echo '          </select></td>
  </tr>
				';
			} else { //Campo input
				echo '
  <tr valign="top" class="' . $valor . '"><!-- ' . $proveedor . ' -->
	<th scope="row" class="titledesc"> <label for="apg_sms_settings[' . $valor_campo . ']">' . ucfirst( $campo ) . ':' . '
	  <span class="woocommerce-help-tip" data-tip="' . sprintf( __( '%s pro v&#xE1;&#x161; &#xFA;&#x10D;et v %s', 'smsvio-pro-woocommerce' ), $campo, $proveedor ) . '"></span></label></th>
	<td class="forminp forminp-number"><input type="text" id="apg_sms_settings[' . $valor_campo . ']" name="apg_sms_settings[' . $valor_campo . ']" size="50" value="' . ( isset( $apg_sms_settings[$valor_campo] ) ? $apg_sms_settings[$valor_campo] : '' ) . '" tabindex="' . $tab++ . '" /></td>
  </tr>
				';
			}
		}
	}
}

/*
Pinta los campos del formulario de envío
*/
function apg_sms_campos_de_envio() {
	global $apg_sms_settings;

	$pais					= new WC_Countries();
	$campos					= $pais->get_address_fields( $pais->get_base_country(), 'shipping_' ); //Campos ordinarios
	$campos_personalizados	= apply_filters( 'woocommerce_checkout_fields', array() );
	if ( isset( $campos_personalizados['shipping'] ) ) {
		$campos += $campos_personalizados['shipping'];
	}
	foreach ( $campos as $valor => $campo ) {
		$chequea = ( isset( $apg_sms_settings['campo_envio'] ) && $apg_sms_settings['campo_envio'] == $valor ) ? ' selected="selected"' : '';
		if ( isset( $campo['label'] ) ) {
			echo '<option value="' . $valor . '"' . $chequea . '>' . $campo['label'] . '</option>' . PHP_EOL;
		}
	}
}

/*
Pinta el campo select con el listado de estados de pedido
*/
function apg_sms_listado_de_estados( $listado_de_estados ) {
	global $apg_sms_settings;

	foreach( $listado_de_estados as $nombre_de_estado => $estado ) {
		$chequea = '';
		if ( isset( $apg_sms_settings['estados_personalizados'] ) ) {
			foreach ( $apg_sms_settings['estados_personalizados'] as $estado_personalizado ) {
				if ( $estado_personalizado == $estado ) {
					$chequea = ' selected="selected"';
				}
			}
		}
		echo '<option value="' . $estado . '"' . $chequea . '>' . $nombre_de_estado . '</option>' . PHP_EOL;
	}
}

/*
Pinta el campo select con el listado de mensajes personalizados
*/
function apg_sms_listado_de_mensajes( $listado_de_mensajes ) {
	global $apg_sms_settings;
	
	$chequeado = false;
	foreach ( $listado_de_mensajes as $valor => $mensaje ) {
		if ( isset( $apg_sms_settings['mensajes'] ) && in_array( $valor, $apg_sms_settings['mensajes'] ) ) {
			$chequea	= ' selected="selected"';
			$chequeado	= true;
		} else {
			$chequea	= '';
		}
		$texto = ( !isset( $apg_sms_settings['mensajes'] ) && $valor == 'todos' && !$chequeado ) ? ' selected="selected"' : '';
		echo '<option value="' . $valor . '"' . $chequea . $texto . '>' . $mensaje . '</option>' . PHP_EOL;
	}
}
