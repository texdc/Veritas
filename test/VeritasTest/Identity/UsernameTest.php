<?php
/**
 * UsernameTest.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity;

use PHPUnit_Framework_TestCase as TestCase;
use Veritas\Identity\Username;

class UsernameTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Veritas\Identity\Username'));
    }

    public function testClassImplementsCredential()
    {
        $this->assertInstanceOf('Veritas\Identity\Credential', new Username('username'));
    }

    public function testConstructSetsValue()
    {
        $subject = new Username('username');
        $this->assertTrue($subject->verify('username'));
    }

    public function testConstructChecksMinimumLength()
    {
        $this->setExpectedException('Veritas\Identity\Exception\UsernameLengthException');
        new Username('bad');
    }

    public function testConstructChecksMaximumLength()
    {
        $this->setExpectedException('Veritas\Identity\Exception\UsernameLengthException');
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
