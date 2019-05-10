<?php
foreach ( $services as $group => $service_group ):
?>
<tr valign="top">
	<th scope="row" class="titledesc">
		<label for="<?php echo $field_key ?>">
			<?php _e( $service_group['title'], 'bring-fraktguiden' ); ?>
		</label>
	</th>
	<td class="forminp">
		<?php if ( $service_group['description'] ): ?>
			<p><?php _e( $service_group['description'], 'bring-fraktguiden' ); ?></p>
		<?php endif; ?>
		<?php require __DIR__ .'/service-table.php'; ?>
	</td>
</tr>
<?php endforeach; ?>
<tr>
	<td colspan="2">
		<script>
			jQuery( function ( $ ) {
				<?php if ( ! Fraktguiden_Helper::pro_activated() ) : ?>
					var elem = $('#woocommerce_bring_fraktguiden_service_name [value="CustomName"]');
					var label = elem.text();
					label += " <?php esc_html_e( '(PRO only)' ); ?>";
					elem
						.text( label )
						.attr( 'disabled', 'disabled' );
				<?php endif; ?>
				function service_name_handler() {
					var val = this.value;
					if ('CustomName' == val) {
						// Show the input field for custom name.
						$( '.fraktguiden-service-custom-name' ).show();
						$( '.fraktguiden-service' ).hide();
					} else {
						// Show the label and change it to the selected type.
						$( '.fraktguiden-service-custom-name' ).hide();
						$( '.fraktguiden-service' ).show();
						$( '.fraktguiden-services-table' ).find( 'label.fraktguiden-service' ).each( function ( i, elem ) {
							var label = $( elem );
							label.text( label.attr( 'data-' + val ) );
						} );
					}
				}
				$( '#woocommerce_bring_fraktguiden_service_name' )
					.each( service_name_handler )
					.change( service_name_handler );
			} );
		</script>
	</td>
</tr>
