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
            'InvalidArgumentException',
            Enablement::ERROR_MISSING_ENDDATE
        );
        new Enablement(false, new DateTime);
    }

    public function testConstructRequiresStartDateWithEndDate()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            Enablement::ERROR_MISSING_STARTDATE
        );
        new Enablement(true, null, new DateTime);
    }

    public function testConstructRequiresValidDates()
    {
        $this->setExpectedException(
            'DomainException',
            Enablement::ERROR_INVALID_DATES
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

    public function testValidateChecksEnabledState()
    {
        $subject = new Enablement(false);
        $this->assertFalse($subject->validate());
    }

    public function testValidateWithNullDate()
    {
        $startDate = new DateTime('-2 days');
        $endDate   = new DateTime('-1 day');
        $subject   = new Enablement(true, $startDate, $endDate);
        $this->assertFalse($subject->validate());
    }

    public function testValidateWithGivenDate()
    {
        $subject = new Enablement(true);
        $this->assertTrue($subject->validate(new DateTime('+3 days')));
    }

    public function testEqualsChecksProperties()
    {
        $startDate = new DateTime('-1 day');
        $endDate = new DateTime('+1 day');
        $subject = new Enablement(true, $startDate, $endDate);
        $this->assertFalse($subject->equals(new Enablement));
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
        $startDate = new DateTime('-1 day');
        $endDate = new DateTime('+1 day');
        $subject = new Enablement(true, $startDate, $endDate);
        $serialized = serialize($subject);
        $this->assertTrue($subject->equals(unserialize($serialized)));
    }
}
