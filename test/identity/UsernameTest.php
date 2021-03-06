<?php
/**
 * UsernameTest.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\test\identity;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\veritas\identity\Username;

class UsernameTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\veritas\identity\Username'));
    }

    public function testClassImplementsCredential()
    {
        $this->assertInstanceOf('texdc\veritas\identity\CredentialInterface', new Username('username'));
    }

    public function testConstructSetsValue()
    {
        $subject = new Username('username');
        $this->assertTrue($subject->verify('username'));
    }

    public function testConstructChecksMinimumLength()
    {
        $this->setExpectedException('texdc\veritas\identity\exception\UsernameLengthException');
        new Username('bad');
    }

    public function testConstructChecksMaximumLength()
    {
        $this->setExpectedException('texdc\veritas\identity\exception\UsernameLengthException');
        new Username(
            'asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf'
            . 'asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf'
        );
    }

    public function testToStringReturnsValue()
    {
        $subject = new Username('username');
        $this->assertEquals('username', (string) $subject);
    }

    public function testEqualsReturnsBool()
    {
        $subject = new Username('username');
        $this->assertFalse($subject->equals(new Username('test failure')));
    }
}
