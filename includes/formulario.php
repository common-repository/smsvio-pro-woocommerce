<?php global $apg_sms_settings, $apg_sms; ?>

<div class="wrap woocommerce">
	<h2>
		<?php _e( 'Nastaven&#xED; SMSVio', 'smsvio-pro-woocommerce' ); ?>
	</h2>
	<?php 
  ?>
	<h3><a href="<?php echo $apg_sms['plugin_url']; ?>" title="SMSVio" target="_blank"><img src="https://smsvio.cz/logodlouhe.png" width="25%" alt="<?php echo $apg_sms['plugin']; ?>"></a></h3>
    <h3><a href="https://admin.smsvio.cz/register.php" target="_blank">Registrace</a> | <a href="https://admin.smsvio.cz/" target="_blank">Přihlášení k vašemu účtu</a></h3>
	<p>
		<?php _e( 'Tento plugin umo&#x17E;n&#xED; odes&#xED;l&#xE1;n&#xED; SMS zpr&#xE1;v va&#x161;im z&#xE1;kazn&#xED;k&#x16F;m s informac&#xED; o aktu&#xE1;ln&#xED;m stavu jejich objedn&#xE1;vky. Rovn&#x11B;&#x17E; m&#x16F;&#x17E;ete funkci SMS vyu&#x17E;&#xED;t jako ozn&#xE1;men&#xED; provozovateli eshopu o vytvo&#x159;en&#xED; nov&#xE9; objedn&#xE1;vky.', 'smsvio-pro-woocommerce' ); ?>
	</p>
    <?php include( 'cuadro-informacion.php' ); ?>
	<form method="post" action="options.php">
		<?php settings_fields( 'apg_sms_settings_group' ); ?>
		<table class="form-table apg-table">
			<tr valign="top" hidden>
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[servicio]">
						<?php _e( 'SMS br&#xE1;na:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Vyberte SMS bránu', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number">
					<select class="wc-enhanced-select servicio" id="apg_sms_settings[servicio]" name="apg_sms_settings[servicio]" tabindex="<?php echo $tab++; ?>">
						<?php apg_sms_listado_de_proveedores( $listado_de_proveedores ); ?>
					</select>
				</td>
			</tr>
			<?php apg_sms_campos_de_proveedores( $listado_de_proveedores, $campos_de_proveedores, $opciones_de_proveedores ); ?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[telefono]">
						<?php _e( 'Va&#x161;e telefonn&#xED; &#x10D;&#xED;slo:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( '&#x10C;&#xED;slo mobiln&#xED;ho telefonu, na kter&#xE9; chcete dost&#xE1;vat SMS zpr&#xE1;vy ur&#x10D;en&#xE9; pro administr&#xE1;tora. M&#x16F;&#x17E;ete p&#x159;idat v&#xED;ce mobiln&#xED;ch &#x10D;&#xED;sel. P&#x159;&#xED;klad: XXXXXXXXX | YYYYYYYYY', 'smsvio-pro-woocommerce' ); ?>"></span> </label>
				</th>
				<td class="forminp forminp-number"><input type="text" id="apg_sms_settings[telefono]" name="apg_sms_settings[telefono]" size="50" value="<?php echo ( isset( $apg_sms_settings['telefono'] ) ) ? $apg_sms_settings['telefono'] : ''; ?>" tabindex="<?php echo $tab++; ?>"/>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[notificacion]">
						<?php _e( 'Ozn&#xE1;men&#xED; o nov&#xE9; objedn&#xE1;vce:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( "Za&#x161;krtn&#x11B;te, pokud chcete dost&#xE1;vat SMS zpr&#xE1;vu o p&#x159;ijet&#xED; nov&#xE9; objedn&#xE1;vky", 'smsvio-pro-woocommerce ' ); ?>"></span> </label> </th>
        <td class="forminp forminp-number"><input id="apg_sms_settings[notificacion]" name="apg_sms_settings[notificacion]" type="checkbox" value="1" <?php echo ( isset( $apg_sms_settings['notificacion'] ) && $apg_sms_settings['notificacion'] == "1" ) ? 'checked="checked" ' : ' '; ?> tabindex="<?php echo $tab++; ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row" class="titledesc"> <label for="apg_sms_settings[internacional]">
            <?php _e( 'Odes&#xED;lat tak&#xE9; SMS do zahrani&#x10D;&#xED;?', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Za&#x161;krtn&#x11B;te, pokud chcete pos&#xED;lat SMS tak&#xE9; do zahrani&#x10D;&#xED;.', 'smsvio-pro-woocommerce' ); ?>"></span> </label>
				</th>
				<td class="forminp forminp-number"><input id="apg_sms_settings[internacional]" name="apg_sms_settings[internacional]" type="checkbox" value="1" <?php echo ( isset( $apg_sms_settings['internacional'] ) && $apg_sms_settings['internacional'] == "1" ) ? 'checked="checked"' : ''; ?> tabindex="
					<?php echo $tab++; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[envio]">
						<?php _e( 'Odeslat SMS na tel. &#x10D;&#xED;slo doru&#x10D;en&#xED;?:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Za&#x161;krtn&#x11B;te, zda chcete pos&#xED;lat SMS zpr&#xE1;vy na &#x10D;&#xED;sla mobiln&#xED;ch telefon&#x16F;, pouze pokud se li&#x161;&#xED; od faktura&#x10D;n&#xED;ho &#x10D;&#xED;sla mobiln&#xED;ho telefonu', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><input id="apg_sms_settings[envio]" name="apg_sms_settings[envio]" type="checkbox" value="1" <?php echo ( isset( $apg_sms_settings['envio'] ) && $apg_sms_settings['envio'] == "1" ) ? 'checked="checked"' : ''; ?> tabindex="
					<?php echo $tab++; ?>" class="envio" /></td>
			</tr>
			<tr valign="top" class="campo_envio">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[campo_envio]">
						<?php _e( 'Telefon doru&#x10D;ovan&#xE9;ho:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Vyberte pole &#x10D;&#xED;slo doru&#x10D;ovan&#xE9;ho.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number">
					<select id="apg_sms_settings[campo_envio]" name="apg_sms_settings[campo_envio]" class="wc-enhanced-select" tabindex="<?php echo $tab++; ?>">
						<?php apg_sms_campos_de_envio(); ?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[productos]">
						<?php _e( 'Detaily o objednan&#xE9;m zbo&#x17E;&#xED;:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Za&#x161;krtn&#x11B;te, pokud chcete pos&#xED;lat SMS zpr&#xE1;vy s kompletn&#xED; objedn&#xE1;vkou', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><input id="apg_sms_settings[productos]" name="apg_sms_settings[productos]" type="checkbox" value="1" <?php echo ( isset( $apg_sms_settings['productos'] ) && $apg_sms_settings['productos'] == "1" ) ? 'checked="checked"' : ''; ?> tabindex="
					<?php echo $tab++; ?>" /></td>
			</tr>
			<?php if ( !empty( $listado_de_estados ) ) : //Comprueba la existencia de estados personalizados ?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[estados_personalizados]">
						<?php _e( 'Stav objedn&#xE1;vek:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Vyberte vlastn&#xED;', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number">
					<select multiple="multiple" class="wc-enhanced-select multiselect estados_personalizados" id="apg_sms_settings[estados_personalizados]" name="apg_sms_settings[estados_personalizados][]" tabindex="<?php echo $tab++; ?>">
						<?php apg_sms_listado_de_estados( $listado_de_estados ); ?>
					</select>
				</td>
			</tr>
			<?php foreach ( $listado_de_estados as $nombre_de_estado => $estado_personalizado ) : ?>
			<tr valign="top" class="<?php echo $estado_personalizado; ?>">
				<!-- <?php echo $nombre_de_estado; ?> -->
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[<?php echo $estado_personalizado; ?>]">
						<?php echo sprintf( __( '%s state custom message:', 'smsvio-pro-woocommerce' ), $nombre_de_estado ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu si m&#x16F;&#x17E;ete upravit, m&#x16F;&#x17E;ete pou&#x17E;&#xED;t tyto prom&#x11B;nn&#xE9;: %id%, %order_key%, %billing_first_name%, %billing_last_name%, %billing_company%, %billing_address_1%, %billing_address_2%, %billing_city%, %billing_postcode%, %billing_country%, %billing_state%, %billing_email%, %billing_phone%, %shipping_first_name%, %shipping_last_name%, %shipping_company%, %shipping_address_1%, %shipping_address_2%, %shipping_city%, %shipping_postcode%, %shipping_country%, %shipping_state%, %shipping_method%, %shipping_method_title%, %payment_method%, %payment_method_title%, %order_discount%, %cart_discount%, %order_tax%, %order_shipping%, %order_shipping_tax%, %order_total%, %status%, %prices_include_tax%, %tax_display_cart%, %display_totals_ex_tax%, %display_cart_ex_tax%, %order_date%, %modified_date%, %customer_message%, %customer_note%, %post_status%, %shop_name%, %order_product% and %note%.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[<?php echo $estado_personalizado; ?>]" name="apg_sms_settings[<?php echo $estado_personalizado; ?>]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $apg_sms_settings[$estado_personalizado] ) ? $apg_sms_settings[$estado_personalizado] : "" ); ?></textarea>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[variables]">
						<?php _e( 'Vlastní proměnné:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'M&#x16F;&#x17E;ete p&#x159;idat vlastn&#xED; prom&#x11B;nn&#xE9;. Ka&#x17E;d&#xE1; prom&#x11B;nn&#xE1; mus&#xED; b&#xFD;t zad&#xE1;na na nov&#xFD; &#x159;&#xE1;dek bez procentu&#xE1;ln&#xED;ho znaku (%). P&#x159;&#xED;klad: <code> _custom_variable_name </code><br /><code>_another_variable_name </code>.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[variables]" name="apg_sms_settings[variables]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( isset( $apg_sms_settings['variables'] ) ? $apg_sms_settings['variables'] : '' ); ?></textarea>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[productos]">
						<?php _e( 'Odeslat pouze tyto zpr&#xE1;vy:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Vyberte, jak&#xE9; zpr&#xE1;vy chcete odeslat', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number">
					<select multiple="multiple" class="wc-enhanced-select multiselect mensajes" id="apg_sms_settings[mensajes]" name="apg_sms_settings[mensajes][]" tabindex="<?php echo $tab++; ?>">
						<?php apg_sms_listado_de_mensajes( $listado_de_mensajes ); ?>
					</select>
			</tr>
			<tr valign="top" class="mensaje_pedido">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[mensaje_pedido]">
						<?php _e( 'Vlastn&#xED; zpr&#xE1;va vlastn&#xED;kovi', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu m&#x16F;&#x17E;ete upravit pou&#x17E;it&#xED;m prom&#x11B;nn&#xFD;ch uveden&#xFD;ch v postrann&#xED;m panelu.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[mensaje_pedido]" name="apg_sms_settings[mensaje_pedido]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( !empty( $mensaje_pedido ) ? $mensaje_pedido : sprintf( __( "Order No. %s received on ", 'smsvio-pro-woocommerce' ), "%id%" ) . "%shop_name%" . "." ); ?></textarea>
				</td>
			</tr>
			<tr valign="top" class="mensaje_recibido">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[mensaje_recibido]">
						<?php _e( 'Zpr&#xE1;va Objedn&#xE1;vka pozastavena', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu m&#x16F;&#x17E;ete upravit pou&#x17E;it&#xED;m prom&#x11B;nn&#xFD;ch uveden&#xFD;ch v postrann&#xED;m panelu.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[mensaje_recibido]" name="apg_sms_settings[mensaje_recibido]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( !empty( $mensaje_recibido ) ? $mensaje_recibido : sprintf( __( 'Vaše objednávka číslo %s byla eshopem %s v pořádku přijata. Děkujeme za váš nákup!', 'smsvio-pro-woocommerce' ), "%id%", "%shop_name%" ) ); ?></textarea>
				</td>
			</tr>
			<tr valign="top" class="mensaje_recibido">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[temporizador]">
						<?php _e( '&#x10C;asova&#x10D;', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Tuto zpr&#xE1;vu m&#x16F;&#x17E;ete &#x10D;asovat ka&#x17E;d&#xFD;ch X hodin. Ponechte pr&#xE1;zdn&#xE9;, chcete-li tuto funkci nechat neaktivn&#xED;.', 'smsvio-pro-woocommerce', 'smsvio-pro-woocommerce' ); ?>"/> </th>
				<td class="forminp forminp-number"><input type="text" id="apg_sms_settings[temporizador]" name="apg_sms_settings[temporizador]" size="50" value="<?php echo ( isset( $apg_sms_settings['temporizador'] ) ) ? $apg_sms_settings['temporizador'] : ''; ?>" tabindex="<?php echo $tab++; ?>"/>
				</td>
			</tr>
			<tr valign="top" class="mensaje_procesando">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[mensaje_procesando]">
						<?php _e( 'Zpr&#xE1;va Zpracov&#xE1;n&#xED; objedn&#xE1;vky', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu m&#x16F;&#x17E;ete upravit pou&#x17E;it&#xED;m prom&#x11B;nn&#xFD;ch uveden&#xFD;ch v postrann&#xED;m panelu.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[mensaje_procesando]" name="apg_sms_settings[mensaje_procesando]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( !empty( $mensaje_procesando ) ? $mensaje_procesando : sprintf( __( 'Děkujeme, že jse u nás nakoupili! Vaše objednávka číslo %s je nyní ve fázi ', 'smsvio-pro-woocommerce' ), "%id%" ) . __( 'zpracování.', 'smsvio-pro-woocommerce' ) . "." ); ?></textarea>
				</td>
			</tr>
			<tr valign="top" class="mensaje_completado">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[mensaje_completado]">
						<?php _e( 'Zpr&#xE1;va Objedn&#xE1;vka dokon&#x10D;ena', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu m&#x16F;&#x17E;ete upravit pou&#x17E;it&#xED;m prom&#x11B;nn&#xFD;ch uveden&#xFD;ch v postrann&#xED;m panelu.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[mensaje_completado]" name="apg_sms_settings[mensaje_completado]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( !empty( $mensaje_completado ) ? $mensaje_completado : sprintf( __( 'Děkujeme, že jse u nás nakoupili! Vaše objednávka číslo %s byla nyní ', 'smsvio-pro-woocommerce' ), "%id%" ) . __( 'dokončena.', 'smsvio-pro-woocommerce' ) . "." ); ?></textarea>
				</td>
			</tr>
			<tr valign="top" class="mensaje_nota">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[mensaje_nota]">
						<?php _e( 'Zpr&#xE1;va Pozn&#xE1;mky', 'smsvio-pro-woocommerce' ); ?>:
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zpr&#xE1;vu m&#x16F;&#x17E;ete upravit pou&#x17E;it&#xED;m prom&#x11B;nn&#xFD;ch uveden&#xFD;ch v postrann&#xED;m panelu.', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><textarea id="apg_sms_settings[mensaje_nota]" name="apg_sms_settings[mensaje_nota]" cols="50" rows="5" tabindex="<?php echo $tab++; ?>"><?php echo stripcslashes( !empty( $mensaje_nota ) ? $mensaje_nota : sprintf( __( 'K objednávce číslo %s byla právě přidána poznámka: ', 'smsvio-pro-woocommerce' ), "%id%" ) . "%note%" ); ?></textarea>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[debug]">
						<?php _e( 'Chcete odeslat zpr&#xE1;vu o lad&#x11B;n&#xED;?', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Za&#x161;krtn&#x11B;te, zda chcete p&#x159;ij&#xED;mat informace o lad&#x11B;n&#xED; z SMS br&#xE1;ny', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><input id="apg_sms_settings[debug]" name="apg_sms_settings[debug]" type="checkbox" class="debug" value="1" <?php echo ( isset( $apg_sms_settings['debug'] ) && $apg_sms_settings['debug'] == "1" ) ? 'checked="checked"' : ''; ?> tabindex="
					<?php echo $tab++; ?>" /></td>
			</tr>
			<tr valign="top" class="campo_debug">
				<th scope="row" class="titledesc">
					<label for="apg_sms_settings[campo_debug]">
						<?php _e( 'E-mail:', 'smsvio-pro-woocommerce' ); ?>
						<span class="woocommerce-help-tip" data-tip="<?php _e( 'Zadejte e-mailovou adresu, kam chcete zas&#xED;lat informace o lad&#x11B;n&#xED;', 'smsvio-pro-woocommerce' ); ?>"></span>
					</label>
				</th>
				<td class="forminp forminp-number"><input type="text" id="apg_sms_settings[campo_debug]" name="apg_sms_settings[campo_debug]" size="50" value="<?php echo ( isset( $apg_sms_settings['campo_debug'] ) ) ? $apg_sms_settings['campo_debug'] : ''; ?>" tabindex="<?php echo $tab++; ?>"/>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input class="button-primary" type="submit" value="<?php _e( 'Ulo&#x17E;it', 'smsvio-pro-woocommerce' ); ?>" name="submit" id="submit" tabindex="<?php echo $tab++; ?>"/>
		</p>
	</form>
</div>
<script type="text/javascript">
	jQuery( document ).ready( function ( $ ) {
		//Cambia los campos en función del proveedor de servicios SMS
		$( '.servicio' ).on( 'change', function () {
			control( $( this ).val() );
		} );
		var control = function ( capa ) {
			if ( capa == '' ) {
				capa = $( '.servicio option:selected' ).val();
			}
			var proveedores = new Array();
			<?php 
		foreach( $listado_de_proveedores as $indice => $valor ) {
			echo "proveedores['$indice'] = '$valor';" . PHP_EOL;
		}
		?>

			for ( var valor in proveedores ) {
				if ( valor == capa ) {
					$( '.' + capa ).show();
				} else {
					$( '.' + valor ).hide();
				}
			}
		};
		control( $( '.servicio' ).val() );

		//Cambia los campos en función de los mensajes seleccionados
		$( '.mensajes' ).on( 'change', function () {
			control_mensajes( $( this ).val() );
		} );
		var control_mensajes = function ( capa ) {
			if ( capa == '' ) {
				capa = $( '.mensajes option:selected' ).val();
			}

			var mensajes = new Array();
			<?php 
		foreach( $listado_de_mensajes as $indice => $valor ) {
			echo "mensajes['$indice'] = '$valor';" . PHP_EOL; 
		}
		?>

			for ( var valor in mensajes ) {
				$( '.' + valor ).hide();
				for ( var valor_capa in capa ) {
					if ( valor == capa[ valor_capa ] || capa[ valor_capa ] == 'todos' ) {
						$( '.' + valor ).show();
					}
				}
			}
		};

		$( '.mensajes' ).each( function ( i, selected ) {
			control_mensajes( $( selected ).val() );
		} );

		if ( typeof chosen !== 'undefined' && $.isFunction( chosen ) ) {
			jQuery( "select.chosen_select" ).chosen();
		}

		//Controla el campo de teléfono del formulario de envío
		$( '.campo_envio' ).hide();
		$( '.envio' ).on( 'change', function () {
			control_envio( '.envio' );
		} );
		var control_envio = function ( capa ) {
			if ( $( capa ).is( ':checked' ) ) {
				$( '.campo_envio' ).show();
			} else {
				$( '.campo_envio' ).hide();
			}
		};
		control_envio( '.envio' );

		//Controla el campo de correo electrónico del formulario de envío
		$( '.campo_debug' ).hide();
		$( '.debug' ).on( 'change', function () {
			control_debug( '.debug' );
		} );
		var control_debug = function ( capa ) {
			if ( $( capa ).is( ':checked' ) ) {
				$( '.campo_debug' ).show();
			} else {
				$( '.campo_debug' ).hide();
			}
		};
		control_debug( '.debug' );

		<?php if ( !empty( $listado_de_estados ) ) : //Comprueba la existencia de estados personalizados ?>
		//Cambia los campos en función de los estados personalizados seleccionados
		$( '.estados_personalizados' ).on( 'change', function () {
			control_personalizados( $( this ).val() );
		} );
		var control_personalizados = function ( capa ) {
			var estados = new Array();
			<?php 
		foreach( $listado_de_estados as $valor ) {
			echo "estados['$valor'] = '$valor';" . PHP_EOL; 
		}
		?>

			for ( var valor in estados ) {
				$( '.' + valor ).hide();
				for ( var valor_capa in capa ) {
					if ( valor == capa[ valor_capa ] ) {
						$( '.' + valor ).show();
					}
				}
			}
		};

		$( '.estados_personalizados' ).each( function ( i, selected ) {
			control_personalizados( $( selected ).val() );
		} );
		<?php endif; ?>
	} );
</script>