<?php
/**
 * MathJax3
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kinerity\mathjax\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Fancybox listener
 */
class main_listener implements EventSubscriberInterface
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		// Nothing to do
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup' => 'add_lang',
		);
	}

	public function add_lang($event)
	{
		/* Add language file */
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'kinerity/mathjax',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
}
