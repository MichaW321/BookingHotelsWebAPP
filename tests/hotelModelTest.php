<?php

use PHPUnit\Framework\TestCase;

class hotelModelTest extends TestCase {
  private function isValidBookingDates($checkIn,$checkOut){
    $today=new DateTime('today');
    $dateIn=new DateTime($checkIn);
    $dateOut=new DateTime($checkOut);

    if ($dateOut <= $dateIn) {
            return false;
        }

    if ($dateIn < $today) {
            return false;
        }

    return true;
  }
  public function testCheckOutBeforeCheckInFails()
    {
        $result = $this->isValidBookingDates('2026-08-10', '2026-08-05');
        
        $this->assertFalse($result);
    }
}

?>