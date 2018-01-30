<?php

namespace Tests\Unit;

use App\Weekdays;
use Carbon\Carbon;
use Tests\TestCase;

class WeekdaysTest extends TestCase
{
    /** @test */
    function if_the_start_day_is_on_a_weekend_the_next_weekday_is_returned()
    {
        // Saturday 27-01-2018
        $weekdays = new Weekdays('27-01-2018');

        // Expected Carbon instance of Monday 29-01-2018 as a result
        $this->assertEquals(Carbon::parse('29-01-2018'), $weekdays->getFirstWeekday());
    }

    /** @test */
    public function it_can_generate_the_full_week_array_from_the_input_date()
    {
        $weekdays = new Weekdays('29-01-2018');

        $weekdaysArray = $weekdays->getFullWeek();

        $expectedArray = [
            Carbon::parse('29-01-2018'),
            Carbon::parse('30-01-2018'),
            Carbon::parse('31-01-2018'),
            Carbon::parse('01-02-2018'),
            Carbon::parse('02-02-2018'),
            Carbon::parse('03-02-2018'),
            Carbon::parse('04-02-2018'),
        ];

        $this->assertEquals($expectedArray, $weekdaysArray);
    }

    /** @test */
    function it_can_filter_the_full_week_array_down_to_weekdays_only()
    {
        // Friday 02-02-2018
        $weekdays = new Weekdays('02-02-2018');

        $weekdaysArray = $weekdays->filterWeekdays();

        // Expected the array containing Friday, Monday, Tuesday, Wednesday, Thursday
        $expectedArray = [
            Carbon::parse('02-02-2018'),
            Carbon::parse('05-02-2018'),
            Carbon::parse('06-02-2018'),
            Carbon::parse('07-02-2018'),
            Carbon::parse('08-02-2018'),
        ];

        $this->assertEquals($expectedArray, $weekdaysArray);
    }

    /** @test */
    function it_can_format_the_weekday_array_to_days_and_dates()
    {
//        $weekdays = new Weekdays('02-02-2018');

        $weekdays = Weekdays::getWeekdaysFor('02-02-2018');

//        $weekdaysArray = $weekdays->formattedArray();

        $expected = [
          'Vrijdag'      => '02 feb',
          'Maandag'      => '05 feb',
          'Dinsdag'      => '06 feb',
          'Woensdag'     => '07 feb',
          'Donderdag'    => '08 feb',
        ];

        $this->assertEquals($expected, $weekdays);

    }

}
