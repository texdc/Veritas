<?php
/**
 * EnablementTest.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity;

use DateTime;
use PHPUnit_Framework_TestCase as TestCase;
use Veritas\Identity\Enablement;

class EnablementTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Veritas\Identity\Enablement'));
    }

    public function testIsASerializable()
    {
        $this->assertInstanceOf('Serializable', new Enablement);
    }

    public function testIsAJsonSerializable()
    {
        $this->assertInstanceOf('JsonSerializable', new Enablement);
    }

    public function testConstructRequiresEndDateWithStartDate()
    {
        $this->setExpectedException(
            'Veritas\Identity\Exception\EnablementDateException',
            "The end date must be provided"
        );
        new Enablement(false, new DateTime);
    }

    public function testConstructRequiresStartDateWithEndDate()
    {
        $this->setExpectedException(
            'Veritas\Identity\Exception\EnablementDateException',
            "The start date must be provided"
        );
        new Enablement(true, null, new DateTime);
    }

    public function testConstructRequiresValidDates()
    {
        $this->setExpectedException(
            'Veritas\Identity\Exception\EnablementDateException',
            'The start date must preceed the end date'
        );
        new Enablement(false, new DateTime, new DateTime('-1 day'));
    }

    public function testConstructWithBothDates()
    {
        $startDate = new DateTime('-1 day');
        $endDate   = new DateTime('+1 day');
        $subject   = new Enablement(true, $startDate, $endDate);
        $this->assertInstanceOf('Veritas\Identity\Enablement', $subject);
    }

    public function testIsValidChecksEnabledState()
    {
        $subject = new Enablement(false);
        $this->assertFalse($subject->isValid());
    }

    public function testIsValidWithNullDate()
    {
        $startDate = new DateTime('-2 days');
        $endDate   = new DateTime('-1 day');
        $subject   = new Enablement(true, $startDate, $endDate);
        $this->assertFalse($subject->isValid());
    }

    public function testIsValidWithGivenDate()
    {
        $subject = new Enablement();
        $this->assertTrue($subject->isValid(new DateTime('+3 days')));
    }

    public function testIsEnabledReturnsEnabledState() {
        $subject = new Enablement();
        $this->assertTrue($subject->isEnabled());
    }

    public function testIsTemporalChecksDates() {
        $subject = new Enablement(false, new DateTime('-1 day'), new DateTime('+1 day'));
        $this->assertTrue($subject->isTemporal());
    }

    public function testStartDateReturnsDateTime() {
        $startDate = new DateTime('-1 day');
        $subject   = new Enablement(false, $startDate, new DateTime('+1 day'));
        $this->assertSame($startDate, $subject->startDate());
    }

    public function testEndDateReturnsDateTime() {
        $endDate = new DateTime('+1 day');
        $subject = new Enablement(false, new DateTime('-1 day'), $endDate);
        $this->assertSame($endDate, $subject->endDate());
    }

    public function testDurationWithDates() {
        $subject = new Enablement(false, new DateTime('-1 day'), new DateTime('+1 day'));
        $this->assertInstanceOf('DateInterval', $subject->duration());
    }

    public function testDurationWithoutDates() {
        $subject = new Enablement();
        $this->assertNull($subject->duration());
    }

    public function testToString()
    {
        $startDate = new DateTime('-1 day');
        $endDate = new DateTime('+1 day');
        $subject = new Enablement(true, $startDate, $endDate);
        $start = $startDate->format('Y-m-d H:i:s');
        $end = $endDate->format('Y-m-d H:i:s');
        $this->assertEquals(
            "Enablement [enabled=1, startDate=$start, endDate=$end]",
            (string) $subject
        );
    }

    public function testJsonSerializeReturnsArray()
    {
        $subject = new Enablement;
        $json = $subject->jsonSerialize();
        $this->assertInternalType('array', $json);
        $this->assertArrayHasKey('enabled', $json);
        $this->assertArrayHasKey('startDate', $json);
        $this->assertArrayHasKey('endDate', $json);
    }

    public function testSerializeReturnsString()
    {
        $subject = new Enablement;
        $this->assertInternalType('string', $subject->serialize());
    }

    public function testUnserializeEqualsOriginal()
    {
        $startDate  = new DateTime('-1 day');
        $endDate    = new DateTime('+1 day');
        $subject    = new Enablement(true, $startDate, $endDate);
        $serialized = serialize($subject);
        $this->assertEquals($subject, unserialize($serialized));
    }

    public function testUnserializeWithoutDates()
    {
        $subject    = new Enablement(false);
        $serialized = serialize($subject);
        $this->assertEquals($subject, unserialize($serialized));
    }
}
