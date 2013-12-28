<?php
/**
 * EnablementTest.php
 *
 * @copyright 2013 George D. Cooksey, III
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

    public function testConstructWithEnabledFalse()
    {
        $subject = new Enablement(false);
        $this->assertFalse($subject->isEnabled());
    }

    public function testConstructRequiresEndDateWithStartDate()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            Enablement::ERROR_MISSING_ENDDATE
        );
        $subject = new Enablement(true, new DateTime);
    }

    public function testConstructRequiresStartDateWithEndDate()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            Enablement::ERROR_MISSING_STARTDATE
        );
        $subject = new Enablement(true, null, new DateTime);
    }

    public function testConstructRequiresValidDates()
    {
        $this->setExpectedException(
            'DomainException',
            Enablement::ERROR_INVALID_DATES
        );
        $subject = new Enablement(true, new DateTime, new DateTime('-1 day'));
    }

    public function testConstructWithBothDates()
    {
        $startDate = new DateTime('-1 day');
        $endDate = new DateTime('+1 day');
        $subject = new Enablement(true, $startDate, $endDate);
        $this->assertEquals($startDate, $subject->getStartDate());
        $this->assertEquals($endDate, $subject->getEndDate());
    }

    public function testIsExpiredReturnsFalseWithoutDates()
    {
        $subject = new Enablement;
        $this->assertFalse($subject->isExpired());
    }

    public function testIsExpiredChecksDates()
    {
        $startDate = new DateTime('+1 day');
        $endDate = new DateTime('+2 days');
        $subject = new Enablement(true, $startDate, $endDate);
        $this->assertTrue($subject->isExpired());
    }

    public function testIsValidChecksDates()
    {
        $startDate = new DateTime('-2 days');
        $endDate = new DateTime('-1 day');
        $subject = new Enablement(true, $startDate, $endDate);
        $this->assertFalse($subject->isValid());
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
