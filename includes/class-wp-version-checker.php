<?php
/**
 * Class WP_Version_Checker
 *
 * @package wp-version-checker
 */
class WP_Version_Checker {
	/**
	 * Transient to store the stable check API response.
	 *
	 * @var string
	 */
	const WPVC_API_RESPONSE_OPTION = 'wpvc_api_response';

	/**
	 * URL to the WordPress' stable check API.
	 *
	 * @var string
	 */
	const STABLE_CHECK_API = 'http://api.wordpress.org/core/stable-check/1.0/';

	/**
	 * Constructor.
	 */
	public function init() {
		$this->version_check();
	}

	/**
	 * Check the current version status.
	 *
	 * @return mixed
	 */
	public function version_check() {
		$api_response = get_transient( self::WPVC_API_RESPONSE_OPTION );

		if ( false === $api_response ) {
			$api_response = json_decode( $this->request(), true );

			set_transient( self::WPVC_API_RESPONSE_OPTION, $api_response, DAY_IN_SECONDS );
		}

		require ABSPATH . WPINC . '/version.php';

		return $api_response[ $wp_version ];
	}

	/**
	 * Send a request to the WordPress' stable check API.
	 *
	 * @return false|string
	 */
	public function request() {
		$options = [
			'timeout'    => 20,
			'user-agent' => 'WP Version Checker/' . WPVC_VERSION,
		];

		$response = wp_remote_get( self::STABLE_CHECK_API, $options );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		return wp_remote_retrieve_body( $response );
	}
}
