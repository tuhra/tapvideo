<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyanmarPhoneNumberController extends Controller
{
    /**
     * @var Phone Number Input
     */
    // public $number;

    /**
     * Clean White Space, Spacees and Dash
     *
     * Example TestCase
     * '   09978412345   ' to '09978412345'
     * '09 978 412 345' to '09978412345'
     * '09-978-412-34-5' to '09978412345'
     *
     * @return $this
     */

    private function clean_white_space_and_dash($number)
    {
        $number = preg_replace('/[- )(]/', '', trim( $number ));
        return $number;
    }

    /**
     * Clean Double Country Code
     *
     * Example TestCase
     * '+95959978412345' to '+959978412345'
     *
     * @return $this
     */
    private function clean_double_country_code($number)
    {
        // Prepare Replacer
        $replacer = "+959" . preg_replace('/^\+?95959/', '', $number);

        // if Double Country Code is found, then replace
        $number = preg_replace('/^\+?95950?9\d{7,9}$/', $replacer, $number);
        return $number;
    }

    /**
     * Clean Zero Before Country Code - 95
     *
     * Example TestCase
     * '+9509978412345' to '+959978412345'
     *
     * @return $this
     */
    private function clean_zero_before_country_code($number)
    {
        // Prepare Replacer
        $replacer = preg_replace('/9509/', '959', $number);

        $number = preg_replace('/^\+?9509\d{7,9}$/', $replacer, $number);
        return $number;
    }

    /**
     * @param $number Phone Number Input from User
     * @return integer Sanitized Phone Number
     */
    public function clean($number)
    {
        $this->clean_white_space_and_dash($number);
        $this->clean_zero_before_country_code($number);
        $this->clean_double_country_code($number);
        return $number;
    }

    /**
     * Validate for Phone Number
     *
     * @param $number "Phone Number Input"
     * @return bool
     */
    public function is_valid($number)
	{
		return preg_match(
			'/^(09|\+?950?9|\+?95950?9)\d{7,9}$/', $this->clean($number)
		) ? true : false;
	}

    /**
     * Validate for provided Phone Number is belongs to provided Telecom
     *
     * @param $telecom_name "Telecom Name"
     * @param $number "Phone Number Input"
     * @return bool
     */
    public function is_telecom($telecom_name, $number)
    {
        if ($this->is_valid($number) ) {

            switch ( strtolower($telecom_name) ) {

                case "mpt":
                    $telecom = new MPT();
                    break;

                default: 
                    die("Invalid Operator Name");
                    break;
            }

            return $telecom->check( $number );
        }
    }

    /**
     * Get Telecom Name with provided Phone Number
     *
     * @param $number "Phone Number"
     * @return string "Telecom Name"
     */
    public function telecom_name($number)
    {
        if ( $this->is_telecom('mpt', $number) ) {
            return "MPT";
        }

        return "Unknown";
    }
}

class MPT extends MyanmarPhoneNumberController
{
    /**
     * Check for Provided Phone Number is belongs to MPT Network
     *
     * @param $number Phone Number
     * @return bool
     */
    public function check($number)
    {
        return preg_match(
            '/^(09|\+?959)(2[0-4]\d{5}|5[0-6]\d{5}|8[13-7]\d{5}|4[1379]\d{6}|73\d{6}|91\d{6}|25\d{7}|26[0-8]\d{6}|40[0-9]\d{6}|42\d{7}|44[0-589]\d{6}|45\d{7}|87\d{7}|88\d{7}|89\d{7})$/',
            $number
        ) ? true : false;
    }
}
