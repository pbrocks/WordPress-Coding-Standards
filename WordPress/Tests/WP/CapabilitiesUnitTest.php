<?php
/**
 * Unit test class for WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\WordPress\Tests\WP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the Capabilities sniff.
 *
 * @package WPCS\WordPressCodingStandards
 * @since   1.0.0
 */
class CapabilitiesUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array <int line number> => <int number of errors>
	 */
	public function getErrorList() {
		return array(
			3  => 1,
			4  => 1,
			5  => 1,
			6  => 1,
			7  => 1,
			8  => 1,
			9  => 1,
			10 => 1,
			11 => 1,
			12 => 1,
			13 => 1,
			17 => 1,
			24 => 1,
			60 => 1,
			64 => 1,
		);
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array <int line number> => <int number of warnings>
	 */
	public function getWarningList() {
		return array(
			2  => 1,
			31 => 1,
			32 => 1,
			33 => 1,
			34 => 1,
			35 => 1,
			36 => 1,
			37 => 1,
			42 => 1,
			46 => 1,
			54 => 1,
			55 => 1,
			61 => 1,
			69 => 1,
			72 => 1,
			75 => 1,
			77 => 1,
			79 => 1,
			82 => 1,
			87 => 1,
			88 => 1,
		);
	}

	/**
	 * Set warnings level to 3 to trigger suggestions as warnings.
	 *
	 * @param string                  $filename The name of the file being tested.
	 * @param \PHP_CodeSniffer\Config $config   The config data for the run.
	 *
	 * @return void
	 */
	public function setCliValues( $filename, $config ) {
		$config->warningSeverity = 3;
	}

}
