<?php

namespace Tests\Unit;

use App\Services\FileService;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    private array $names = [
        "Mrs. Adell Bode MD.jpg",
        "owkwell.jpg",
        "33.33.33..png",
        "....webp",
        "okwell.",
        'okwell',
        'кириллица.jpg',
    ];

    public function test_file_name_without_extension()
    {
        $actual = [];

        foreach ($this->names as $name) {
            $actual[] = FileService::nameWithoutExtension($name);
        }

        $expected = [
            "Mrs. Adell Bode MD",
            "owkwell",
            "33.33.33.",
            "...",
            "okwell",
            'okwell',
            'кириллица',
        ];

        $this->assertEquals($expected, $actual);
    }

    public function test_file_extension()
    {
        $actual = [];

        foreach ($this->names as $name) {
            $actual[] = FileService::extension($name);
        }

        $expected = [
            "jpg",
            "jpg",
            "png",
            "webp",
            "",
            "",
            "jpg",
        ];

        $this->assertEquals($expected, $actual);
    }

    public function test_file_change_extension()
    {
        $actual = [];
        $expected = [];
        $formats = ['png', 'jpg', 'webp', 'jpeg', 'pdf', 'mp4', 'png'];

        foreach ($this->names as $key => $name) {
            $actual[] = FileService::changeExtension($name, $formats[$key]);
            $expected[] = FileService::nameWithoutExtension($name) . '.' . $formats[$key];
        }

        $this->assertEquals($expected, $actual);
    }

    public function test_calculate_file_size()
    {
        $sizesInByte = [
            1, 10, 155.666, 1000, 10000, 100000, 1000000, 1024000,
            1024 * 1024 * 2.697, 1024 * 1024 * 1000, 1024 * 1024 * 1024, 1024 * 1024 * 1024 * 2.664
        ];
        $expected = [
            '1 B', '10 B', '155.67 B', '1000 B', '9.77 KB', '97.66 KB', '976.56 KB', '1000 KB',
            '2.7 MB', '1000 MB', '1 GB', '2.66 GB'
        ];
        $actual = [];

        foreach ($sizesInByte as $size) {
            $actual[] = FileService::calculateSize($size);
        }

        $this->assertEquals($expected, $actual);
    }
}
