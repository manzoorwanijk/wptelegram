<?php
/**
 * Check the current request details.
 *
 * @link       https://t.me/manzoorwanijk
 * @since      x.y.z
 *
 * @package    WPTelegram
 * @subpackage WPTelegram/modules
 */

namespace WPTelegram\Core\modules\p2tg;

use WP_Post;

/**
 * Class checking the current request details.
 *
 * @package    WPTelegram
 * @subpackage WPTelegram/modules
 * @author     Manzoor Wani
 */
class RequestCheck {

	const IS_GB_METABOX = 'is_gb_metabox';

	const WP_IMPORTING = 'wp_importing';

	const BULK_EDIT = 'bulk_edit';

	const QUICK_EDIT = 'quick_edit';

	const FROM_WEB = 'from_web';

	const DOING_AUTOSAVE = 'doing_autosave';

	const POST_REVISION = 'post_revision';

	const DOING_CRON = 'doing_cron';

	const WP_CLI = 'wp_cli';

	const REST_REQUEST = 'rest_request';

	/**
	 * If the request is a POST request
	 *
	 * @since   x.y.z
	 *
	 * @access  private
	 * @var     boolean  If the request is a POST request.
	 */
	private static $is_post_request = null;

	/**
	 * The prefix for meta data
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string  The prefix for meta data
	 */
	private static $prefix = '_wptg_p2tg_';

	/**
	 * If the request is a POST request
	 *
	 * @since    x.y.z
	 */
	public static function is_post_request() {

		if ( is_null( self::$is_post_request ) ) {
			self::$is_post_request = isset( $_SERVER['REQUEST_METHOD'] ) && 'post' === strtolower( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) );
		}
		return self::$is_post_request;
	}

	/**
	 * Get the taxonomy for rule types
	 *
	 * @since    x.y.z
	 *
	 * @param string  $type The type of request.
	 * @param WP_Post $post The to check against.
	 */
	public static function if_is( $type, $post = null ) {

		switch ( $type ) {
			case self::IS_GB_METABOX:
				return self::is_post_request() && isset( $_POST[ self::$prefix . 'is_gb_metabox' ] ); // phpcs:ignore

			case self::WP_IMPORTING:
				return defined( 'WP_IMPORTING' ) && WP_IMPORTING;

			case self::BULK_EDIT:
				return isset( $_GET['bulk_edit'] ); // phpcs:ignore

			case self::QUICK_EDIT:
				return defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && 'inline-save' === $_REQUEST['action']; // phpcs:ignore

			case self::FROM_WEB:
				return self::is_post_request() && isset( $_POST[ self::$prefix . 'from_web' ] ); // phpcs:ignore

			case self::DOING_AUTOSAVE:
				return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE;

			case self::POST_REVISION:
				return wp_is_post_revision( $post );

			case self::DOING_CRON:
				return defined( 'DOING_CRON' ) && DOING_CRON;

			case self::WP_CLI:
				return defined( 'WP_IMPORTING' ) && WP_CLI;

			case self::REST_REQUEST:
				return defined( 'REST_REQUEST' ) && REST_REQUEST;

			default:
				return false;
		}
	}
}