<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Samkaveh\User\Rules\ValidMobile;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_number_can_not_be_less_than_10_character()
    {
       $result = (new ValidMobile())->passes('','921145897');
       $this->assertEquals(0,$result);

    }
  

    public function test_mobile_number_can_not_be_more_than_10_character()
    {
        $result = (new ValidMobile())->passes('','9301239078');

        $this->assertEquals(1,$result);

    }


    public function test_first_character_in_mobile_number_must_be_9()
    {
        $result = (new ValidMobile())->passes('','9120980987');
        $this->assertEquals(1,$result);
    }




}
