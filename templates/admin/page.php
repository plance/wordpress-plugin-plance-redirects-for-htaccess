<?php
/**
 * Page.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

use const Plance\Plugin\Redirects_For_Htaccess\SECURITY;

defined( 'ABSPATH' ) || exit;
?>

<div class="redirects-for-htaccess wrap">
	<h2><?php esc_html_e( 'Htaccess Redirect', 'redirects-for-htaccess' ); ?></h2>

	<form method="post">
		<?php wp_nonce_field( SECURITY ); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><?php esc_html_e( 'Post types', 'redirects-for-htaccess' ); ?></th>
				<td>

					<?php foreach ( $args['post_types'] as $loop_post_type ) : ?>
						<div>
							<label>
								<input
									type="checkbox"
									name="redirects4htaccess[post_types][]"
									<?php echo esc_attr( in_array( $loop_post_type->name, $args['selected_post_types'], true ) ? 'checked' : '' ); ?>
									value="<?php echo esc_attr( $loop_post_type->name ); ?>">
								<?php echo esc_attr( $loop_post_type->label ); ?>
							</label>
						</div>
					<?php endforeach; ?>

				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Taxonomies', 'redirects-for-htaccess' ); ?></th>
				<td>

					<?php foreach ( $args['taxonomies'] as $loop_taxonomy ) : ?>
						<div>
							<label>
								<input
									type="checkbox"
									name="redirects4htaccess[taxonomies][]"
									<?php echo esc_attr( in_array( $loop_taxonomy->name, $args['selected_taxonomies'], true ) ? 'checked' : '' ); ?>
									value="<?php echo esc_attr( $loop_taxonomy->name ); ?>">
								<?php echo esc_attr( $loop_taxonomy->label ); ?>
							</label>
						</div>
					<?php endforeach; ?>

				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'New site domain', 'redirects-for-htaccess' ); ?></th>
				<td>
					<input
						type="text"
						name="redirects4htaccess[site_domain]"
						value="<?php echo esc_attr( $args['site_domain'] ); ?>"
						class="loc-field-site-domain<?php echo esc_attr( $args['is_submitted'] && empty( $args['site_domain'] ) ? ' loc-has-error' : '' ); ?>"
						>
					<p class="description">
						<?php esc_html_e( 'Enter the site URL without the slash at the end.', 'redirects-for-htaccess' ); ?>
					</p>
				</td>
			</tr>

			<?php if ( $args['is_submitted'] ) : ?>
				<tr>
					<th scope="row"><?php esc_html_e( 'Redirects', 'redirects-for-htaccess' ); ?></th>
					<td>
						<?php if ( ! empty( $args['content_links'] ) ) : ?>
							<textarea class="loc-field-content-links"><?php echo esc_attr( $args['content_links'] ); ?></textarea>
							<?php esc_html_e( 'Paste the code above into the beginning of your site\'s .htaccess file.', 'redirects-for-htaccess' ); ?>
						<?php else : ?>
							<?php esc_html_e( 'No data available.', 'redirects-for-htaccess' ); ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>

		</table>

		<?php submit_button( __( 'Generate', 'redirects-for-htaccess' ), 'primary', 'submit_redirects_for_htaccess' ); ?>
	</form>
</div>
