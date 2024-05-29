<?php

namespace Tests\Api;

use PHPUnit\Framework\TestCase;
use App\Controllers\HomeController;;

// Класс UtilsTest наследует класс TestCase
// Имя класса совпадает с именем файла
class Test extends TestCase
{
    // Метод (функция), определенный внутри класса,
    // Должен начинаться со слова test
    // Ключевое слово public нужно, чтобы PHPUnit мог вызвать этот тест снаружи
    public function testReverse(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $this->assertEquals('', '');
        $this->assertEquals('1', '1');
    }

    public function testHomeController(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $this->assertEquals('', '');
    }
}