<?php
/**
 * MathJax3
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Thorsten Ahlers
 * @copyright (c) 2018, Kailey
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kinerity\mathjax\migrations\v12x;

class v_1_2_1_update_bbcode extends \phpbb\db\migration\migration
{
	protected static $bbcodes_installer;

	protected $bbcode_data = [
			'LaTeX' => [
				'bbcode_helpline'	 => 'KMJ_LATEX',
				'bbcode_match'		 => '[latex #ignoreTags=true]{TEXT}[/latex]',
				'bbcode_tpl'		 => '<span>\({TEXT}\)</span>',
			],
			'LaTeXinline' => [
				'bbcode_helpline'	 => 'KMJ_LATEX_INLINE',
				'bbcode_match'		 => '[latex_inline #ignoreTags=true]{TEXT}[/latex_inline]',
				'bbcode_tpl'		 => '<span>\({TEXT}\)</span>',
			],
			'LaTeXparagraph' => [
				'bbcode_helpline'	 => 'KMJ_LATEX_PARAGRAPH',
				'bbcode_match'		 => '[latex_para #ignoreTags=true]{TEXT}[/latex_para]',
				'bbcode_tpl'		 => '<span>\[{TEXT}\]</span>',
			],
		];

	public static function depends_on()
	{
		return ['\kinerity\mathjax\migrations\v12x\v_1_2_0_update_bbcode',];
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
			$this->bbcodes_installer = new \kinerity\mathjax\core\bbcodes_installer($this->db, $this->phpbb_root_path, $this->php_ext);
		}

		$this->bbcodes_installer->install_bbcodes($this->bbcode_data);
	}

	public function delete_bbcodes()
	{
		if (!isset($this->bbcodes_installer))
		{
			$this->bbcodes_installer = new \kinerity\mathjax\core\bbcodes_installer($this->db, $this->phpbb_root_path, $this->php_ext);
		}

		$this->bbcodes_installer->delete_bbcodes($this->bbcode_data);
	}
}
