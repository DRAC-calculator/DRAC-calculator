<?php
namespace Drac\Calculator;


class LookupTables {
    private static ?array $lt1 = null;
    private static ?array $lt2 = null;
    private static ?array $lt3 = null;
    private static ?array $lt4 = null;
    private static ?array $lt5 = null;
    private static ?array $lt6 = null;
    private static ?array $lt7 = null;

    public static function lt1(): array {
        if (self::$lt1 === null) {
            self::$lt1 = require __DIR__ . '/lookup_tables/lt1.php';
        }
        return self::$lt1;
    }

    public static function lt2(): array {
        if (self::$lt2 === null) {
            self::$lt2 = require __DIR__ . '/lookup_tables/lt2.php';
        }
        return self::$lt2;
    }

    public static function lt3(): array {
        if (self::$lt3 === null) {
            self::$lt3 = require __DIR__ . '/lookup_tables/lt3.php';
        }
        return self::$lt3;
    }

    public static function lt4(): array {
        if (self::$lt4 === null) {
            self::$lt4 = require __DIR__ . '/lookup_tables/lt4.php';
        }
        return self::$lt4;
    }

    public static function lt5(): array {
        if (self::$lt5 === null) {
            self::$lt5 = require __DIR__ . '/lookup_tables/lt5.php';
        }
        return self::$lt5;
    }

    public static function lt6(): array {
        if (self::$lt6 === null) {
            self::$lt6 = require __DIR__ . '/lookup_tables/lt6.php';
        }
        return self::$lt6;
    }

    public static function lt7(): array {
        if (self::$lt7 === null) {
            self::$lt7 = require __DIR__ . '/lookup_tables/lt7.php';
        }
        return self::$lt7;
    }
}
