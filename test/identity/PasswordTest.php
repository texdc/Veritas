<?php
/**
 * PasswordTest.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\test\identity;

use PHPUnit_Framework_TestCase as TestCase;
use PHPUnit_Framework_MockObject_Matcher_Invocation as Matcher;
use texdc\veritas\identity\Password;

class PasswordTest extends TestCase
{

    const PLAIN_TEXT = 'test';
    const ENCRYPTED  = 'encrypted';

    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\veritas\identity\Password'));
    }

    public function testClassImplementsCredential()
    {
        $subject = new Password(static::PLAIN_TEXT, $this->getCryptoService($this->once()));
        $this->assertInstanceOf('texdc\veritas\identity\CredentialInterface', $subject);
    }

    public function testConstructEncryptsValue()
    {
        $subject = new Password(static::PLAIN_TEXT, $this->getCryptoService($this->once()));
        $this->assertEquals(static::ENCRYPTED, $subject->encryptedValue());
    }

    public function testCryptoServiceReturnsDefinedService()
    {
        $crypto = $this->getCryptoService($this->once());
        $subject = new Password(static::PLAIN_TEXT, $crypto);
        $this->assertSame($crypto, $subject->cryptoService());
    }

    public function testVerifyComparesEncryptedValue()
    {
        $subject = new Password(static::PLAIN_TEXT, $this->getCryptoService($this->exactly(2)));
        $this->assertTrue($subject->verify(static::PLAIN_TEXT));
    }

    public function testEqualsReturnsBoolean()
    {
        $crypto = $this->getCryptoService($this->exactly(2));
        $subject = new Password(static::PLAIN_TEXT, $crypto);
        $test = new Password(static::PLAIN_TEXT, $crypto);
        $this->assertTrue($subject->equals($test));
    }

    public function testToStringReturnsFormattedString()
    {
        $crypto = $this->getCryptoService($this->once());
        $format = 'Password [encryptedValue=%s, cryptoService=%s]';
        $expected = sprintf($format, static::ENCRYPTED, get_class($crypto));
        $subject = new Password(static::PLAIN_TEXT, $crypto);
        $this->assertEquals($expected, (string) $subject);
    }

    protected function getCryptoService(Matcher $matcher)
    {
        $crypto = $this->getMockForAbstractClass('texdc\veritas\identity\CryptoServiceInterface');
        $crypto
            ->expects($matcher)
            ->method('encrypt')
            ->with(static::PLAIN_TEXT)
            ->will($this->returnValue(static::ENCRYPTED));

        return $crypto;
    }
}
