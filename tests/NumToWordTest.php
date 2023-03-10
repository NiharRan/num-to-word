<?php

namespace Bluesky\NumToWord\Tests;

use Bluesky\NumToWord\NumToWord;
use PHPUnit\Framework\TestCase;

final class NumToWordTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testNumToWordFirst()
    {
        $this->assertSame('Two Thousand', (new NumToWord())->convert(2000));
    }
    /**
     * @throws \Exception
     */
    public function testNumToWordSecond()
    {
        $this->assertSame('Two Thousand Five Hundred', (new NumToWord())->convert(2500));
    }
    /**
     * @throws \Exception
     */
    public function testNumToWordThird()
    {
        $this->assertSame('Two Thousand Five Hundred Sixteen', (new NumToWord())->convert(2516));
    }
    /**
     * @throws \Exception
     */
    public function testNumToWordForth()
    {
        $this->assertSame('Two Thousand Five Hundred Thirty', (new NumToWord())->convert(2530));
    }

    /**
     * @throws \Exception
     */
    public function testNumToWordFifth()
    {
        $this->assertSame('Two Thousand Five Hundred Thirty Nine', (new NumToWord())->convert(2539));
    }
}