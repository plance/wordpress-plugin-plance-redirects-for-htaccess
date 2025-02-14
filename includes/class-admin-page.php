<?php
/**
 * Admin_Page class.
 *
 * @package EC\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;

use const Plance\Plugin\Redirects_For_Htaccess\PATH;
use const Plance\Plugin\Redirects_For_Htaccess\SECURITY;
use Plance\Plugin\Redirects_For_Htaccess\Singleton;

/**
 * Admin_Page class.
 */
class Admin_Page {
	use Singleton;

	const SLUG = 'redirects-for-htaccess';

	/**
	 * Home url.
	 *
	 * @var string
	 */
	private $home_url;

	/**
	 * Site domain.
	 *
	 * @var string
	 */
	private $new_site_domain;

	/**
	 * Init.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_filter( 'plugin_action_links', array( $this, 'plugin_action_links' ), 10, 2 );
	}

	/**
	 * Hook: admin_menu.
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_management_page(
			__( 'Htaccess Redirect', 'redirects-for-htaccess' ),
			__( 'Htaccess Redirect', 'redirects-for-htaccess' ),
			'manage_options',
			self::SLUG,
			function () {
				wp_enqueue_style( 'redirects-for-htaccess' );

				$input_post_types  = array();
				$input_taxonomies  = array();
				$input_site_domain = '';
				$content_links     = '';

				if ( ! empty( $_POST['submit_redirects_for_htaccess'] ) ) {

					$input_wpnonce = filter_input( INPUT_POST, '_wpnonce', FILTER_CALLBACK, array( 'options' => 'sanitize_text_field' ) );
					if ( ! wp_verify_nonce( $input_wpnonce, SECURITY ) ) {
						wp_die( 'Wrong input data!' );
					}

					$input = filter_input( INPUT_POST, 'redirects4htaccess', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
					$input = filter_var_array(
						$input,
						array(
							'post_types'  => array(
								'filter'  => FILTER_CALLBACK,
								'options' => array( $this, 'deep_sanitize_text_field' ),
							),
							'taxonomies'  => array(
								'filter'  => FILTER_CALLBACK,
								'options' => array( $this, 'deep_sanitize_text_field' ),
							),
							'site_domain' => FILTER_SANITIZE_URL,
						)
					);

					$input_post_types  = array_filter( (array) $input['post_types'] );
					$input_taxonomies  = array_filter( (array) $input['taxonomies'] );
					$input_site_domain = rtrim( $input['site_domain'], '/' );

					$this->new_site_domain = $input_site_domain;
					$this->home_url        = rtrim( home_url(), '/' );

					$content_links = $this->get_content_links(
						$input_post_types,
						$input_taxonomies
					);
				}

				$args = array(
					'post_types'          => $this->get_post_types(),
					'taxonomies'          => $this->get_taxonomies(),
					'selected_post_types' => $input_post_types,
					'selected_taxonomies' => $input_taxonomies,
					'site_domain'         => $input_site_domain,
					'is_submitted'        => ! empty( $_POST['submit_redirects_for_htaccess'] ),
					'content_links'       => $content_links,
				);

				load_template( PATH . '/templates/admin/page.php', false, $args );
			}
		);
	}

	/**
	 * Return post types.
	 *
	 * @return array
	 */
	private function get_post_types() {
		$post_types = get_post_types(
			array(
				'public' => true,
			),
			'objects'
		);

		if ( isset( $post_types['attachment'] ) ) {
			unset( $post_types['attachment'] );
		}

		return $post_types;
	}

	/**
	 * Return taxonomies.
	 *
	 * @return array
	 */
	private function get_taxonomies() {
		$taxonomies = get_taxonomies(
			array(
				'public' => true,
			),
			'objects'
		);

		if ( isset( $taxonomies['post_format'] ) ) {
			unset( $taxonomies['post_format'] );
		}

		return $taxonomies;
	}

	/**
	 * Return content links.
	 *
	 * @param  array $post_types Post types.
	 * @param  array $taxonomies Taxonomies.
	 * @return string
	 */
	private function get_content_links( $post_types, $taxonomies ) {
		$content = '';

		if ( ! empty( $post_types ) ) {
			foreach ( $post_types as $post_type ) {
				$content .= '# Post Types (' . $post_type . '):';
				$content .= "\n";

				$posts_ids = get_posts(
					array(
						'post_type'   => $post_type,
						'numberposts' => -1,
						'orderby'     => 'ID',
						'order'       => 'DESC',
						'fields'      => 'ids',
					)
				);

				if ( empty( $posts_ids ) ) {
					continue;
				}

				foreach ( $posts_ids as $look_post_id ) {
					$content .= $this->create_redirect(
						get_permalink( $look_post_id )
					);
				}

				$content .= "\n";
			}
		}

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {
				$content .= '# Taxonomy (' . $taxonomy . '):';
				$content .= "\n";

				$terms_ids = get_terms(
					array(
						'taxonomy'   => $taxonomy,
						'hide_empty' => true,
						'orderby'    => 'id',
						'order'      => 'DESC',
						'fields'     => 'ids',
					)
				);

				if ( empty( $terms_ids ) ) {
					continue;
				}

				foreach ( $terms_ids as $look_term_id ) {
					$content .= $this->create_redirect(
						get_term_link( $look_term_id, $taxonomy )
					);
				}

				$content .= "\n";
			}
		}

		return $content;
	}

	/**
	 * Create redirect.
	 *
	 * @param  string $url URL.
	 * @return string
	 */
	private function create_redirect( $url ) {

		$url_from = '/' . ltrim( str_replace( $this->home_url, '', $url ), '/' );
		$url_to   = $this->new_site_domain . $url_from;

		return sprintf( 'Redirect 301 %s %s', $url_from, $url_to ) . "\n";
	}

	/**
	 * Add plugin links.
	 *
	 * @param array  $links Links.
	 * @param string $file File.
	 *
	 * @return mixed
	 */
	public function plugin_action_links( $links, $file ) {
		if ( strpos( $file, '/redirects-for-htaccess.php' ) === false ) {
			return $links;
		}

		$settings_link = '<a href="' . menu_page_url( self::SLUG, false ) . '">' . esc_html( __( 'Settings', 'redirects-for-htaccess' ) ) . '</a>';

		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * Deep sanitize text field.
	 *
	 * @param  mixed $value Input data.
	 * @return array|string
	 */
	private function deep_sanitize_text_field( $value ) {
		if ( is_array( $value ) ) {
			return array_map( 'sanitize_text_field', $value );
		}

		return sanitize_text_field( $value );
	}
}
