<?php

namespace Tests\Unit;


use Samkaveh\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generated_6_digit_number()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code, 'generated code is not numeric');
        $this->assertLessThanOrEqual(999999, $code, 'Generated code is less than 999999');
        $this->assertGreaterThanOrEqual(10000, $code, 'Generated code is Greater than 100000');
    }


    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1,$code,now()->addMinutes(15));
        
        $this->assertEquals($code, cache()->get('verify_code_1'));
    }



}
