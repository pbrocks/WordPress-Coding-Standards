<?php
/**
 * WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\WordPress\Sniffs\WP;

use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\MessageHelper;
use PHPCSUtils\Utils\PassedParameters;
use PHPCSUtils\Utils\TextStrings;
use WordPressCS\WordPress\AbstractFunctionParameterSniff;
use WordPressCS\WordPress\Helpers\MinimumWPVersionTrait;

/**
 * Check that capabilities are used correctly.
 *
 * User capabilities should be used not roles nor deprecated capabilities.
 *
 * @package WPCS\WordPressCodingStandards
 *
 * @since   3.0.0
 */
class CapabilitiesSniff extends AbstractFunctionParameterSniff {
	use MinimumWPVersionTrait;

	/**
	 * Only check for known capabilities.
	 *
	 * @since 3.0.0
	 *
	 * @var boolean
	 */
	public $check_only_known_caps = true;

	/**
	 * List of custom capabilities.
	 *
	 * @since 3.0.0
	 *
	 * @var array
	 */
	public $custom_capabilities = array();

	/**
	 * The group name for this group of functions.
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	protected $group_name = 'caps_not_roles';

	/**
	 * List of functions that accept roles and capabilities as an argument.
	 *
	 * The number represents the parameter position in the function call,
	 * where the capability is to be listed.
	 * The functions are defined in `wp-admin/includes/plugin.php` and
	 * `/wp-includes/capabilities.php`.
	 * The list is sorted alphabetically.
	 *
	 * @since 3.0.0
	 *
	 * @var array Function name with parameter position.
	 */
	protected $target_functions = array(
		'add_comments_page'         => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_dashboard_page'        => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_links_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_management_page'       => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_media_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_menu_page'             => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_object_page'           => array( // Deprecated.
			'position' => 3,
			'name'     => 'capability',
		),
		'add_options_page'          => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_pages_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_plugins_page'          => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_posts_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_submenu_page'          => array(
			'position' => 4,
			'name'     => 'capability',
		),
		'add_theme_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_users_page'            => array(
			'position' => 3,
			'name'     => 'capability',
		),
		'add_utility_page'          => array( // Deprecated.
			'position' => 3,
			'name'     => 'capability',
		),
		'author_can'                => array(
			'position' => 2,
			'name'     => 'capability',
		),
		'current_user_can'          => array(
			'position' => 1,
			'name'     => 'capability',
		),
		'current_user_can_for_blog' => array(
			'position' => 2,
			'name'     => 'capability',
		),
		'map_meta_cap'              => array(
			'position' => 1,
			'name'     => 'cap',
		),
		'user_can'                  => array(
			'position' => 2,
			'name'     => 'capability',
		),
	);

	/**
	 * Disallow-list of core roles which should not to be used directly.
	 *
	 * @since 3.0.0
	 *
	 * @var array Role available in core.
	 */
	protected $core_roles = array(
		'super_admin'   => true,
		'administrator' => true,
		'editor'        => true,
		'author'        => true,
		'contributor'   => true,
		'subscriber'    => true,
	);

	/**
	 * Whitelist of primitive and meta core capabilities.
	 *
	 * To be updated after every major release. Sorted as in capabilities tests.
	 * Last updated for WordPress 4.9.6.
	 *
	 * @link https://github.com/WordPress/wordpress-develop/blob/master/tests/phpunit/tests/user/capabilities.php
	 *
	 * @since 3.0.0
	 *
	 * @var array All capabilities available in core.
	 */
	protected $core_capabilities = array(
		'unfiltered_upload'           => true,
		'unfiltered_html'             => true,
		'activate_plugins'            => true,
		'create_users'                => true,
		'delete_plugins'              => true,
		'delete_themes'               => true,
		'delete_users'                => true,
		'edit_files'                  => true,
		'edit_plugins'                => true,
		'edit_themes'                 => true,
		'edit_users'                  => true,
		'install_plugins'             => true,
		'install_themes'              => true,
		'update_core'                 => true,
		'update_plugins'              => true,
		'update_themes'               => true,
		'edit_theme_options'          => true,
		'export'                      => true,
		'import'                      => true,
		'list_users'                  => true,
		'manage_options'              => true,
		'promote_users'               => true,
		'remove_users'                => true,
		'switch_themes'               => true,
		'edit_dashboard'              => true,
		'moderate_comments'           => true,
		'manage_categories'           => true,
		'edit_others_posts'           => true,
		'edit_pages'                  => true,
		'edit_others_pages'           => true,
		'edit_published_pages'        => true,
		'publish_pages'               => true,
		'delete_pages'                => true,
		'delete_others_pages'         => true,
		'delete_published_pages'      => true,
		'delete_others_posts'         => true,
		'delete_private_posts'        => true,
		'edit_private_posts'          => true,
		'read_private_posts'          => true,
		'delete_private_pages'        => true,
		'edit_private_pages'          => true,
		'read_private_pages'          => true,
		'edit_published_posts'        => true,
		'upload_files'                => true,
		'publish_posts'               => true,
		'delete_published_posts'      => true,
		'edit_posts'                  => true,
		'delete_posts'                => true,
		'read'                        => true,
		'create_sites'                => true,
		'delete_sites'                => true,
		'manage_network'              => true,
		'manage_sites'                => true,
		'manage_network_users'        => true,
		'manage_network_plugins'      => true,
		'manage_network_themes'       => true,
		'manage_network_options'      => true,
		'delete_site'                 => true,
		'upgrade_network'             => true,
		'setup_network'               => true,
		'upload_plugins'              => true,
		'upload_themes'               => true,
		'customize'                   => true,
		'add_users'                   => true,
		'install_languages'           => true,
		'update_languages'            => true,
		'deactivate_plugins'          => true,
		'upgrade_php'                 => true,
		'export_others_personal_data' => true,
		'erase_others_personal_data'  => true,
		'manage_privacy_options'      => true,
		'edit_categories'             => true,
		'delete_categories'           => true,
		'manage_post_tags'            => true,
		'edit_post_tags'              => true,
		'delete_post_tags'            => true,
		'edit_css'                    => true,
		'assign_categories'           => true,
		'assign_post_tags'            => true,
	);

	/**
	 * List of deprecated core capabilities.
	 *
	 * User Levels were  deprecated in version 3.0.
	 * To be updated after every major release.
	 * Last updated for WordPress 4.9.6.
	 *
	 * @link https://github.com/WordPress/wordpress-develop/blob/master/tests/phpunit/tests/user/capabilities.php
	 *
	 * @since 3.0.0
	 *
	 * @var array All deprecated capabilities in core.
	 */
	protected $deprecated_capabilities = array(
		'level_10' => '3.0.0',
		'level_9'  => '3.0.0',
		'level_8'  => '3.0.0',
		'level_7'  => '3.0.0',
		'level_6'  => '3.0.0',
		'level_5'  => '3.0.0',
		'level_4'  => '3.0.0',
		'level_3'  => '3.0.0',
		'level_2'  => '3.0.0',
		'level_1'  => '3.0.0',
		'level_0'  => '3.0.0',
	);

	/**
	 * Process the parameters of a matched function.
	 *
	 * @since 3.0.0
	 *
	 * @param int    $stackPtr        The position of the current token in the stack.
	 * @param array  $group_name      The name of the group which was matched.
	 * @param string $matched_content The token content (function name) which was matched.
	 * @param array  $parameters      Array with information about the parameters.
	 *
	 * @return void
	 */
	public function process_parameters( $stackPtr, $group_name, $matched_content, $parameters ) {
		$function_name_lc = strtolower( $matched_content );
		$function_details = $this->target_functions[ $function_name_lc ];

		$parameter = PassedParameters::getParameterFromStack(
			$parameters,
			$function_details['position'],
			$function_details['name']
		);

		if ( $parameter === false ) {
			return;
		}

		// If the parameter is anything other than T_CONSTANT_ENCAPSED_STRING throw a warning and bow out.
		$first_non_empty = null;
		for ( $i = $parameter['start']; $i <= $parameter['end']; $i++ ) {
			if ( isset( Tokens::$emptyTokens[ $this->tokens[ $i ]['code'] ] ) ) {
				continue;
			}
			
			if ( $this->tokens[ $i ]['code'] !== \T_CONSTANT_ENCAPSED_STRING
				|| $first_non_empty !== null
			) {
				// Throw warning at low severity.
				$this->phpcsFile->addWarning(
					'',
					'NeedsManualCheck',
					$i,
					$data,
					3 // Message severity set to below default.
				);
				return;
			}

			$first_non_empty = $i;
		}

		$next_not_empty = $this->phpcsFile->findNext(
			Tokens::$emptyTokens,
			$parameter['start'],
			$parameter['end'] + 1,
			true
		);

		$matched_parameter = TextStrings::stripQuotes( $this->tokens[ $next_not_empty ]['content'] );
		if ( isset( $this->core_capabilities[ $matched_parameter ] ) ) {
			return;
		}

		$custom_capabilities = $this->merge_custom_array( $this->custom_capabilities, array(), true );
		if ( isset( $custom_capabilities[ $matched_parameter ] ) ) {
			return;
		}

		if ( isset( $this->deprecated_capabilities[ $matched_parameter ] ) ) {

			$this->get_wp_version_from_cli( $this->phpcsFile );
			MessageHelper::addMessage(
				$this->phpcsFile,
				'The capability "%s" found in function call "%s()" has been deprecated since WordPress version %s.',
				$next_not_empty,
				version_compare( $this->deprecated_capabilities[ $matched_parameter ], $this->minimum_supported_version, '<' ),
				'Deprecated',
				array(
					$matched_parameter,
					$matched_content,
					$this->deprecated_capabilities[ $matched_parameter ],
				)
			);
			return;
		}

		if ( isset( $this->core_roles[ $matched_parameter ] ) ) {
			$this->phpcsFile->addError(
				'Capabilities should be used instead of roles. Found "%s" in function call "%s()"',
				$next_not_empty,
				'RoleFound',
				array(
					$matched_parameter,
					$matched_content,
				)
			);
			return;
		}

		if ( false === $this->check_only_known_caps ) {
			$this->phpcsFile->addWarning(
				'"%s" is an unknown role or capability. Check the "%s()" function call to ensure it is a capability and not a role.',
				$next_not_empty,
				'Unknown',
				array(
					$matched_parameter,
					$matched_content,
				)
			);
		}
	}

}
