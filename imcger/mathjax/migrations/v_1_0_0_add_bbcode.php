<?php
/**
 * MathJax
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\mathjax\migrations;

class v_1_0_0_add_bbcode extends \phpbb\db\migration\migration
{
	protected static $bbcodes_installer;

	protected $bbcode_data = [
			'LaTeXinline' => [
				'bbcode_helpline'	 => 'Shows the LaTeX formula inline',
				'bbcode_match'		 => '[latex_inline #ignoreTags=true]{TEXT}[/latex_inline]',
				'bbcode_tpl'		 => '<span>\({TEXT}\)</span>',
				'display_on_posting' => 1,
			],
			'LaTeX' => [
				'bbcode_helpline'	 => 'Insert the LaTeX formula as a paragraph',
				'bbcode_match'		 => '[latex #ignoreTags=true]{TEXT}[/latex]',
				'bbcode_tpl'		 => '<span>\[{TEXT}\]</span>',
				'display_on_posting' => 1,
			],
		];

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330',];
	}

	public function update_data()
	{
		return [
			['custom', [[$this, 'update_bbcodes_table']]],
		];
	}

	public function revert_data()
	{
		return [
			['custom', [[$this, 'delete_bbcodes']]],
		];
	}

	public function update_bbcodes_table()
	{
		if (!isset($this->bbcodes_installer))
		{
			$this->bbcodes_installer = new \imcger\mathjax\core\bbcodes_installer($this->db, $this->phpbb_root_path, $this->php_ext);
		}

		$this->bbcodes_installer->install_bbcodes($this->bbcode_data);
	}

	public function delete_bbcodes()
	{
		if (!isset($this->bbcodes_installer))
		{
			$this->bbcodes_installer = new \imcger\mathjax\core\bbcodes_installer($this->db, $this->phpbb_root_path, $this->php_ext);
		}

		$this->bbcodes_installer->delete_bbcodes($this->bbcode_data);
	}
}
