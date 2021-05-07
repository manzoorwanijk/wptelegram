<?php
/**
 * The base class of the module.
 *
 * @link       https://manzoorwani.dev
 * @since      3.0.0
 *
 * @package    WPTelegram\Core
 * @subpackage WPTelegram\Core\includes
 */

namespace WPTelegram\Core\modules;

/**
 * The base class of the module.
 *
 * The base class of the module.
 *
 * @package    WPTelegram\Core
 * @subpackage WPTelegram\Core\includes
 * @author     Manzoor Wani <@manzoorwanijk>
 */
abstract class BaseClass {

	/**
	 * The module class instance.
	 *
	 * @since    3.0.0
	 * @access   protected
	 * @var      BaseModule $module The module class instance.
	 */
	protected $module;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 3.0.0
	 * @param BaseModule $module The module class instance.
	 */
	public function __construct( $module ) {

		$this->module = $module;
	}

	/**
	 * Get the instance of the module.
	 *
	 * @since     3.0.11
	 * @return    BaseModule    The module class instance.
	 */
	protected function module() {
		return $this->module;
	}
}
