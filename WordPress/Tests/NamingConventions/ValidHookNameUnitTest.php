<?php
/**
 * Unit test class for WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\WordPress\Tests\NamingConventions;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the ValidHookName sniff.
 *
 * @package WPCS\WordPressCodingStandards
 *
 * @since   0.10.0
 * @since   0.13.0 Class name changed: this class is now namespaced.
 */
class ValidHookNameUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @param string $testFile The name of the file being tested.
	 * @return array <int line number> => <int number of errors>
	 */
	public function getErrorList( $testFile = 'ValidHookNameUnitTest.1.inc' ) {

		switch ( $testFile ) {
			case 'ValidHookNameUnitTest.1.inc':
				return array(
					14  => 1,
					15  => 1,
					16  => 1,
					17  => 1,
					28  => 1,
					29  => 1,
					30  => 1,
					33  => 1,
					53  => 1,
					54  => 1,
					55  => 1,
					56  => 1,
					57  => 1,
					58  => 1,
					59  => 1,
					60  => 1,
					61  => 1,
					62  => 1,
					63  => 1,
					64  => 1,
					65  => 1,
					66  => 1,
					68  => 1,
					69  => 1,
					70  => 1,
					71  => 1,
					72  => 1,
					73  => 1,
					74  => 1,
					75  => 1,
					76  => 1,
					77  => 1,
					78  => 1,
					79  => 1,
					80  => 1,
					81  => 1,
					89  => 1,
					107 => 1,
				);

			case 'ValidHookNameUnitTest.2.inc':
			case 'ValidHookNameUnitTest.3.inc':
			default:
				return array();
		}
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @param string $testFile The name of the file being tested.
	 * @return array <int line number> => <int number of warnings>
	 */
	public function getWarningList( $testFile = 'ValidHookNameUnitTest.1.inc' ) {

		switch ( $testFile ) {
			case 'ValidHookNameUnitTest.1.inc':
				return array(
					8   => 1,
					9   => 1,
					10  => 1,
					11  => 1,
					68  => 1,
					72  => 1,
					77  => 1,
					95  => 1,
					107 => 1,
				);

			case 'ValidHookNameUnitTest.2.inc':
			case 'ValidHookNameUnitTest.3.inc':
				return array(
					12 => 1,
					13 => 1,
					14 => 1,
					15 => 1,
				);

			default:
				return array();
		}
	}

}
