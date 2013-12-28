<?php
/**
 * UsernameTest.php
 *
 * @copyright 2013 George D. Cooksey, III
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
        $this->setExpectedException(
            'Veritas\Identity\Exception\UsernameLengthException',
            'Value must be a minimum of 8 characters'
        );
        new Username('bad');
    }

    public function testConstructChecksMaximumLength()
    {
        $this->setExpectedException(
            'Veritas\Identity\Exception\UsernameLengthException',
            'Value must be a maximum of 125 characters'
        );
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
}
