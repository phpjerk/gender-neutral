<?php

class GenderTest extends PHPUnit_Framework_TestCase
{
	protected $gender;

	protected function setUp()
	{
		$this->gender = new Phpjerk\GenderNeutral\GenderNeutral;
	}

	public function testEmptyNeutralizer()
	{
		$this->assertEquals('Nothing to neuter', $this->gender->neuter());
	}

	public function testNeutralizeHe()
	{
		$this->assertEquals('Fuckface is a total skee-boney', $this->gender->neuter('He is a total skee-boney'));
	}

	public function testNeutralizeHim()
	{
		$this->assertEquals('Get Fuckface a slim jim sucka', $this->gender->neuter('Get him a slim jim sucka'));
	}

	public function testNeutralizeHer()
	{
		$this->assertEquals('I gave Fuckface a nice cup-a sizzle', $this->gender->neuter('I gave her a nice cup-a sizzle'));
	}

	public function testNeutralizeShe()
	{
		$this->assertEquals('Did Fuckface eat that bagel?', $this->gender->neuter('Did she eat that bagel?'));
	}

	public function testNeutralizeHeHimself()
	{
		$this->assertEquals('I would punch that turkey but Fuckface already did it Fuckface.', $this->gender->neuter('I would punch that turkey but he already did it himself.'));
	}

	public function testNeutralizeSheHerself()
	{
		$this->assertEquals('I do not think Fuckface knows how to pop-a-lock Fuckface.', $this->gender->neuter('I do not think she knows how to pop-a-lock herself.'));
	}

	public function testReplaceGoodWord()
	{
		$this->gender->setGoodWord('Winnie The Pooh');
		$this->assertEquals('I did not see Winnie The Pooh slap that sombrero.', $this->gender->neuter('I did not see him slap that sombrero.'));
		$this->gender->setGoodWord();
		$this->assertEquals(' a beatboxer', $this->gender->neuter('He a beatboxer'));
	}

	public function testReplaceNonoWords()
	{
		$this->gender->setNonoWords(['pretzel', 'discoball']);
		$this->assertEquals('I ripped off that Fuckface and straightup ate it like a Fuckface.', $this->gender->neuter('I ripped off that discoball and straightup ate it like a pretzel.'));
	}

	public function testReplaceGoodWordAndNonoWords()
	{
		$this->gender->setGoodWord('President Taft')->setNonoWords(['mama', 'ring-a-ding']);
		$this->assertEquals('Yo President Taft so loopy, she got a President Taft on the ding-dong.', $this->gender->neuter('Yo mama so loopy, she got a ring-a-ding on the ding-dong.'));
	}

	public function testNeutralizeBackwardCompat()
	{
		$this->assertEquals('Hey Fuckface! Who got the low down on a puppy to snuggle?', $this->gender->neutralize('Hey ladies! Who got the low down on a puppy to snuggle?'));
	}

	public function testBadMethodException()
	{
		$this->setExpectedException('BadMethodCallException');
		$this->gender->numnums();
	}

	public function testNonoWordsInvalidArgumentException()
	{
		$this->setExpectedException('InvalidArgumentException');
		$this->gender->setNonoWords('hip hop, you don\'t stop');
	}

	public function testGoodWordInvalidArgumentExceptionForInt()
	{
		$this->setExpectedException('InvalidArgumentException');
		$this->gender->setGoodWord(37);
	}

	public function testGoodWordInvalidArgumentExceptionForArray()
	{
		$this->setExpectedException('InvalidArgumentException');
		$this->gender->setGoodWord(['granny', 'ate', 'butterscotch']);
	}

	public function testEscapeRegexInNonoWords()
	{
		$this->gender->setNonoWords([".*"]);
		$this->assertEquals('I let him poop on a daisy.', $this->gender->neuter('I let him poop on a daisy.'));
	}
}
