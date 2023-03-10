<?php

namespace Bluesky\NumToWord;

/**
 *
 */
class NumToWord
{
    /**
     * @var string[]
     */
    private array $ones;
    /**
     * @var string[]
     */
    private array $tens;

    /**
     *
     */
    public function __construct()
    {
        $this->ones = [
            "",
            "One",
            "Two",
            "Three",
            "Four",
            "Five",
            "Six",
            "Seven",
            "Eight",
            "Nine",
            "Ten",
            "Eleven",
            "Twelve",
            "Thirteen",
            "Fourteen",
            "Fifteen",
            "Sixteen",
            "Seventeen",
            "Eightteen",
            "Nineteen"
        ];

        $this->tens = [
            "",
            "",
            "Twenty",
            "Thirty",
            "Fourty",
            "Fifty",
            "Sixty",
            "Seventy",
            "Eigthy",
            "Ninety"
        ];
    }

    /**
     * Convert the number into a string & return it
     *
     * @param $number
     * @return string
     * @throws \Exception
     */
    public function convert($number): string
    {
        if ($this->isOutOfRange($number)) {
            throw new \Exception("Number is out of range");
        }

        if (!$this->isValidNumber($number)) {
            throw new \Exception("Number is not valid");
        }

        $ktPart = $this->getPositionalData($number, 10000000);
        $number -= $this->reduceAmount($ktPart, 10000000);

        $lkPart = $this->getPositionalData($number, 100000);
        $number -= $this->reduceAmount($lkPart, 100000);

        $tsPart = $this->getPositionalData($number, 1000);
        $number -= $this->reduceAmount($tsPart, 1000);

        $hdPart = $this->getPositionalData($number, 100);
        $number -= $this->reduceAmount($hdPart, 100);

        $dmPart = $this->getPositionalData($number, 10);
        $n = $number % 10;

        $str = "";

        if ($ktPart) {
            $str .= $this->convert($ktPart) . " Koti ";
        }
        if ($lkPart) {
            $str .= $this->convert($lkPart) . " Lakh";
        }
        if ($tsPart) {
            $str .= (empty($str) ? "" : " ") .
                $this->convert($tsPart) . " Thousand";
        }
        if ($hdPart) {
            $str .= (empty($str) ? "" : " ") .
                $this->convert($hdPart) . " Hundred";
        }
        if ($dmPart || $n) {
            if (!empty($str)) {
                $str .= " ";
            }
            if ($dmPart < 2) {
                $str .= $this->ones[$dmPart * 10 + $n];
            } else {
                $str .= $this->tens[$dmPart];

                if ($n) {
                    $str .= " " . $this->ones[$n];
                }
            }
        }

        if (empty($str)) {
            $str = "Zero";
        }

        return $str;
    }

    /**
     * Check the number is valid or not
     *
     * @param $number
     * @return bool
     */
    private function isValidNumber($number): bool
    {
        return is_numeric($number);
    }

    /**
     * Check the number is out of range or not
     *
     * @param $number
     * @return bool
     */
    private function isOutOfRange($number): bool
    {
        return ($number < 0) || ($number > 999999999);
    }

    /**
     * Calculate the readable amount
     *
     * @param $number
     * @param $multiplier
     * @return float|int
     */
    private function reduceAmount($number, $multiplier)
    {
        return $number * $multiplier;
    }

    /**
     * Calculate the positional data
     *
     * @param $number
     * @param $divisor
     * @return false|float
     */
    private function getPositionalData($number, $divisor)
    {
        return floor($number / $divisor);
    }
}