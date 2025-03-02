<?php

namespace AsyncAws\MediaConvert\Enum;

/**
 * Specify the color of the burned-in captions text. Leave Font color (FontColor) blank and set Style passthrough
 * (StylePassthrough) to enabled to use the font color data from your input captions, if present.
 */
final class BurninSubtitleFontColor
{
    public const AUTO = 'AUTO';
    public const BLACK = 'BLACK';
    public const BLUE = 'BLUE';
    public const GREEN = 'GREEN';
    public const HEX = 'HEX';
    public const RED = 'RED';
    public const WHITE = 'WHITE';
    public const YELLOW = 'YELLOW';

    public static function exists(string $value): bool
    {
        return isset([
            self::AUTO => true,
            self::BLACK => true,
            self::BLUE => true,
            self::GREEN => true,
            self::HEX => true,
            self::RED => true,
            self::WHITE => true,
            self::YELLOW => true,
        ][$value]);
    }
}
