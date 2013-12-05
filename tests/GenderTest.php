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
		$this->assertEquals('Nothing to neutralize', $this->gender->neutralize());
	}

	public function testNeutralizeHe()
	{
		$this->assertEquals('Fuckface is a total skee-boney', $this->gender->neutralize('He is a total skee-boney'));
	}

	public function testNeutralizeHim()
	{
		$this->assertEquals('Get Fuckface a slim jim sucka', $this->gender->neutralize('Get him a slim jim sucka'));
	}

	public function testNeutralizeHer()
	{
		$this->assertEquals('I gave Fuckface a nice cup-a sizzle', $this->gender->neutralize('I gave her a nice cup-a sizzle'));
	}

	public function testNeutralizeShe()
	{
		$this->assertEquals('Did Fuckface eat that bagel?', $this->gender->neutralize('Did she eat that bagel?'));
	}

	public function testNeutralizeHeHimself()
	{
		$this->assertEquals('I would punch that turkey but Fuckface already did it Fuckface.', $this->gender->neutralize('I would punch that turkey but he already did it himself.'));
	}

	public function testNeutralizeSheHerself()
	{
		$this->assertEquals('I do not think Fuckface knows how to pop-a-lock Fuckface.', $this->gender->neutralize('I do not think she knows how to pop-a-lock herself.'));
	}

	public function testReplaceGoodWord()
	{
		$this->gender->setGoodWord('Winnie The Pooh');
		$this->assertEquals('I did not see Winnie The Pooh slap that sombrero.', $this->gender->neutralize('I did not see him slap that sombrero.'));
		$this->gender->setGoodWord();
		$this->assertEquals(' a beatboxer', $this->gender->neutralize('He a beatboxer'));
	}

	public function testReplaceNonoWords()
	{
		$this->gender->setNonoWords(['pretzel', 'discoball']);
		$this->assertEquals('I ripped off that Fuckface and straightup ate it like a Fuckface.', $this->gender->neutralize('I ripped off that discoball and straightup ate it like a pretzel.'));
	}

	public function testReplaceGoodWordAndNonoWords()
	{
		$this->gender->setGoodWord('President Taft')->setNonoWords(['mama', 'ring-a-ding']);
		$this->assertEquals('Yo President Taft so loopy, she got a President Taft on the ding-dong.', $this->gender->neutralize('Yo mama so loopy, she got a ring-a-ding on the ding-dong.'));
	}
}
