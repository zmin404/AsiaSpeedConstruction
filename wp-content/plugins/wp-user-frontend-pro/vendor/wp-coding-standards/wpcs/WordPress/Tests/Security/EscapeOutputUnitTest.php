<?php
/**
 * Unit test class for WordPress Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\WordPress\Tests\Security;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the EscapeOutput sniff.
 *
 * @package WPCS\WordPressCodingStandards
 *
 * @since   2013-06-11
 * @since   0.13.0     Class name changed: this class is now namespaced.
 * @since   1.0.0      This sniff has been moved from the `XSS` category to the `Security` category.
 */
class EscapeOutputUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array <int line number> => <int number of errors>
	 */
	public function getErrorList() {
		return array(
			17  => 1,
			19  => 1,
			36  => 1,
			39  => 1,
			40  => 1,
			41  => 1,
			43  => 1,
			46  => 1,
			53  => 1,
			59  => 1,
			60  => 1,
			65  => 1,
			68  => 1,
			71  => 1,
			73  => 1,
			75  => 1,
			101 => 1,
			103 => 1,
			111 => 1,
			112 => 1,
			113 => 1,
			114 => 1,
			125 => 1,
			131 => 1,
			135 => 1,
			138 => 1,
			145 => 1,
			147 => 1,
			149 => 1,
			152 => 2,
			159 => 1,
			162 => 1,
			169 => 1,
			172 => 1,
			173 => 1,
			182 => 3,
			190 => 1,
			191 => 2,
			205 => 1,
			206 => 1,
			207 => 1,
			223 => 1,
			225 => 1,
			226 => 1,
			252 => 1,
			253 => 1,
			263 => 1,
			264 => 1,
			266 => 1,
			289 => 1,
			294 => 1,
			297 => 1,
		);
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array <int line number> => <int number of warnings>
	 */
	public function getWarningList() {
		return array(
			126 => 1, // Whitelist comment deprecation warning.
			127 => 1, // Whitelist comment deprecation warning.
			128 => 1, // Whitelist comment deprecation warning.
			241 => 1, // Whitelist comment deprecation warning.
			243 => 1, // Whitelist comment deprecation warning.
			250 => 1, // Whitelist comment deprecation warning.
		);
	}

}
