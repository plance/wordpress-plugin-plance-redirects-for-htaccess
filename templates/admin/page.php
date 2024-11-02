<?php
/**
 * Page.
 *
 * @package EC\Plugin\Manual_Fill_Cart
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="plance-redirects-for-htaccess wrap">
	<h2><?php esc_html_e( 'Htaccess Redirect', 'plance-redirects-for-htaccess' ); ?></h2>

	<form method="post">
		<table class="form-table">
			<tr>
				<th scope="row"><?php esc_html_e( 'Post types', 'plance-redirects-for-htaccess' ); ?></th>
				<td>

					<?php foreach ( $args['post_types'] as $loop_post_type ) : ?>
						<div>
							<label>
								<input
									type="checkbox"
									name="plance_redirects_for_htaccess__post_types[]"
									<?php echo ( in_array( $loop_post_type->name, $args['selected_post_types'], true ) ? 'checked' : '' ); ?>
									value="<?php echo esc_attr( $loop_post_type->name ); ?>">
								<?php echo esc_attr( $loop_post_type->label ); ?>
							</label>
						</div>
					<?php endforeach; ?>

				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Taxonomies', 'plance-redirects-for-htaccess' ); ?></th>
				<td>

					<?php foreach ( $args['taxonomies'] as $loop_taxonomy ) : ?>
						<div>
							<label>
								<input
									type="checkbox"
									name="plance_redirects_for_htaccess__taxonomies[]"
									<?php echo ( in_array( $loop_taxonomy->name, $args['selected_taxonomies'], true ) ? 'checked' : '' ); ?>
									value="<?php echo esc_attr( $loop_taxonomy->name ); ?>">
								<?php echo esc_attr( $loop_taxonomy->label ); ?>
							</label>
						</div>
					<?php endforeach; ?>

				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'New site domain', 'plance-redirects-for-htaccess' ); ?></th>
				<td>
					<input type="text" name="plance_redirects_for_htaccess__site_domain" value="<?php echo esc_attr( $args['site_domain'] ); ?>" class="plc-field-site-domain">
					<p class="description">
						<?php esc_html_e( 'Enter the site URL without the slash at the end.', 'plance-redirects-for-htaccess' ); ?>
					</p>
				</td>
			</tr>

			<?php if ( ! empty( $args['content_links'] ) ) : ?>
				<tr>
					<th scope="row"><?php esc_html_e( 'Redirects', 'plance-redirects-for-htaccess' ); ?></th>
					<td>
						<textarea onclick="this.select()" class="plc-field-content-links"><?php echo esc_attr( $args['content_links'] ); ?></textarea>
						<?php esc_html_e( 'Paste the code above into the beginning of your site\'s .htaccess file.', 'plance-redirects-for-htaccess' ); ?>
					</td>
				</tr>
			<?php endif; ?>

		</table>

		<?php submit_button( __( 'Generate', 'plance-redirects-for-htaccess' ) ); ?>
	</form>
</div>
