<?php
namespace Phpjerk\GenderNeutral;

class GenderNeutral {

	protected $nono_words;
	protected $good_word;

	public function __construct()
	{
		$this->nono_words = ['he', 'him', 'her', 'she', 'ladies', 'himself', 'gents', 'herself'];
		$this->good_word  = 'Fuckface';
	}

	/**
	 * Make it Neutral
	 *
	 * @param  string $text
	 * @return string
	 */
	public function neutralize($text = NULL)
	{
		if (is_null($text)) return 'Nothing to neutralize';
		$pat = '/\b(?:' . join('|', $this->nono_words) . ')\b/i';
		return preg_replace_callback(
			$pat,
			function($match)
			{
				return str_replace($match[0], $this->good_word, $match[0]);
			},
			$text
		);
	}

	/**
	 * Add your own naughty, bad words!!!
	 *
	 * @param array $words
	 * @return this
	 */
	public function setNonoWords($words = [])
	{
		$this->nono_words = $words;
		return $this;
	}

	/**
	 * Add your own nice word to replace the bad ones with!!
	 *
	 * @param string $word
	 * @return this
	 */
	public function setGoodWord($word = '')
	{
		$this->good_word = $word;
		return $this;
	}
}
