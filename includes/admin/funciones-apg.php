<?php
//Definimos las variables
$apg_sms = array( 	
	'plugin' 		=> 'SMSVio pro WooCommerce',
	'plugin_uri' 	=> 'smsvio-pro-woocommerce',
	'plugin_url' 	=> 'https://smsvio.cz',
	'ajustes' 		=> 'admin.php?page=apg_sms'
);

//Carga el idioma
load_plugin_textdomain( 'smsvio-pro-woocommerce', null, dirname( DIRECCION_apg_sms ) . '/languages' );

//Carga la configuración del plugin
$apg_sms_settings = get_option( 'apg_sms_settings' );

//Enlaces adicionales personalizados
function apg_sms_enlaces( $enlaces, $archivo ) {
	global $apg_sms;

	if ( $archivo == DIRECCION_apg_sms ) {;
		$enlaces[] = '<a href="mailto:info@smsvio.cz" title="' . __( 'Kontaktujte n&#xE1;s', 'smsvio-pro-woocommerce' ) . '"><span class="genericon genericon-mail"></span></a>';
	}

	return $enlaces;
}
add_filter( 'plugin_row_meta', 'apg_sms_enlaces', 10, 2 );

//Añade el botón de configuración
function apg_sms_enlace_de_ajustes( $enlaces ) { 
	global $apg_sms;

	$enlaces_de_ajustes = array( 
		'<a href="' . $apg_sms['ajustes'] . '" title="' . __( 'Nastaven&#xED;', 'smsvio-pro-woocommerce' ) . $apg_sms['plugin'] .'">' . __( 'Nastaven&#xED;', 'smsvio-pro-woocommerce' ) . '</a>',
	);
	foreach( $enlaces_de_ajustes as $enlace_de_ajustes )	{
		array_unshift( $enlaces, $enlace_de_ajustes );
	}

	return $enlaces; 
}
$plugin = DIRECCION_apg_sms; 
add_filter( "plugin_action_links_$plugin", 'apg_sms_enlace_de_ajustes' );

//Obtiene toda la información sobre el plugin
function apg_sms_plugin( $nombre ) {
	global $apg_sms;
	
	$argumentos	= ( object ) array( 
		'slug'		=> $nombre 
	);
	$consulta	= array( 
		'action'	=> 'plugin_information', 
		'timeout'	=> 15, 
		'request'	=> serialize( $argumentos )
	);
	$respuesta	= get_transient( 'apg_sms_plugin' );
	if ( false === $respuesta ) {
		$respuesta = wp_remote_post( 'https://api.wordpress.org/plugins/info/1.0/', array( 
			'body'	=> $consulta
		) );
		set_transient( 'apg_sms_plugin', $respuesta, 24 * HOUR_IN_SECONDS );
	}
	if ( !is_wp_error( $respuesta ) ) {
		$plugin = get_object_vars( unserialize( $respuesta['body'] ) );
	} else {
		$plugin['rating'] = 100;
	}

	$rating = array(
	   'rating'		=> $plugin['rating'],
	   'type'		=> 'percent',
	   'number'		=> $plugin['num_ratings'],
	);
	ob_start();
	wp_star_rating( $rating );
	$estrellas = ob_get_contents();
	ob_end_clean();

	return;
}

//Muestra el mensaje de actualización
function apg_sms_actualizacion() {
	global $apg_sms;
	
	echo '<div class="error fade" id="message"><h3>' . $apg_sms['plugin'] . '</h3><h4>' . sprintf( __( "Please, update your %s. It's very important!", 'smsvio-pro-woocommerce' ), '<a href="' . $apg_sms['ajustes'] . '" title="' . __( 'Nastaven&#xED;', 'smsvio-pro-woocommerce' ) . '">' . __( 'Nastaven&#xED;', 'smsvio-pro-woocommerce' ) . '</a>' ) . '</h4></div>';
}

//Carga las hojas de estilo
function apg_sms_muestra_mensaje() {
	global $apg_sms_settings;

	wp_register_style( 'apg_sms_hoja_de_estilo', plugins_url( 'assets/css/style.css', DIRECCION_apg_sms ) ); //Carga la hoja de estilo
	wp_enqueue_style( 'apg_sms_hoja_de_estilo' ); //Carga la hoja de estilo

	/*if ( !isset( $apg_sms_settings['mensaje_pedido'] ) || !isset( $apg_sms_settings['mensaje_nota'] ) ) { //Comprueba si hay que mostrar el mensaje de actualización
		add_action( 'admin_notices', 'apg_sms_actualizacion' );
	}*/
}
add_action( 'admin_init', 'apg_sms_muestra_mensaje' );

//Eliminamos todo rastro del plugin al desinstalarlo
function apg_sms_desinstalar() {
	delete_option( 'apg_sms_settings' );
	delete_transient( 'apg_sms_plugin' );
}
register_uninstall_hook( __FILE__, 'apg_sms_desinstalar' );
