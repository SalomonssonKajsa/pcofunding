<?php
// src/Test/PlatformBundle/Antispam/TestAntispam.php

namespace Test\PlatformBundle\Antispam;

class TestAntispam
{
	private $mailer;
	private $locale;
	private $minLength;

	public function _construct(\Swift_Mailer $mailer, $locale, $minLength){
		$this->mailer = $mailer;
		$this->locale = $locale;
		$this->minLength = (int) $minLength;
	}

	/**
	* Verifiera att texten inte är spam
	* @param string $text
	* @return bool
	*/
	public function isSpam($text){
		return strlen($text)< $this->minLength;
	}

}
