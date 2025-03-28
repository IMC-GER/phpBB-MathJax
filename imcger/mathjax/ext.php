<?php
/**
 * MathJax
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Thorsten Ahlers
 * @copyright (c) 2018, kinerity, https://www.layer-3.org
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\mathjax;

/**
 * Extension class for custom enable/disable/purge actions
 */
class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$valid_phpbb = phpbb_version_compare(PHPBB_VERSION, '3.0.0', '>=') && phpbb_version_compare(PHPBB_VERSION, '4.0.0-dev', '<');
		$valid_php = phpbb_version_compare(PHP_VERSION, '7.1.3', '>=') && phpbb_version_compare(PHP_VERSION, '8.5.0-dev', '<');

		return ($valid_phpbb && $valid_php);
	}
}
