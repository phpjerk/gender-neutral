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
	public function neuter($text = NULL)
	{
		if (is_null($text)) return 'Nothing to neuter';
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
		if (!is_array($words)) throw new \InvalidArgumentException('NoNo Words needs to be an array. Stop sucking.');

		// Escape or @SaraMG will punch my face
		$this->nono_words = array_map(function($var) {
				return preg_quote($var);
			}, $words);

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
		if (!is_string($word)) throw new \InvalidArgumentException('Good Word needs to be a string. RTFM.');
		$this->good_word = $word;
		return $this;
	}

	/**
	 * Allow for neutralize method.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return void
	 */
	public function __call($method, $parameters)
	{
		if ($method == 'neutralize')
		{
			return $this->neuter($parameters[0]);
		}

		throw new \BadMethodCallException("'$method' method does not exist. WTF are you trying to do?!");
	}
}
