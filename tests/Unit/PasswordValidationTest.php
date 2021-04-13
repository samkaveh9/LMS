<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Samkaveh\User\Rules\ValidPassword;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_must_more_or_equal_than_8_character()
    {
        $result = (new ValidPassword)->passes('','Password@1');
        $this->assertEquals(1,$result);
    }

    public function test_password_have_digit_character()
    {
        $result = (new ValidPassword)->passes('','Password@p');
        $this->assertEquals(0,$result);
    }

    public function test_password_have_sign_character()
    {
        $result = (new ValidPassword)->passes('','Password01');
        $this->assertEquals(0,$result);
    }


    public function test_password_have_capital_character()
    {
        $result = (new ValidPassword)->passes('','password@1');
        $this->assertEquals(0,$result);
    }


    public function test_password_have_small_character()
    {
        $result = (new ValidPassword)->passes('','PASSWORD@1');
        $this->assertEquals(0,$result);
    }




}
