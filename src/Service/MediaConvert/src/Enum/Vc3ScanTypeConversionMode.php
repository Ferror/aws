<?php

namespace AsyncAws\MediaConvert\Enum;

/**
 * Use this setting for interlaced outputs, when your output frame rate is half of your input frame rate. In this
 * situation, choose Optimized interlacing (INTERLACED_OPTIMIZE) to create a better quality interlaced output. In this
 * case, each progressive frame from the input corresponds to an interlaced field in the output. Keep the default value,
 * Basic interlacing (INTERLACED), for all other output frame rates. With basic interlacing, MediaConvert performs any
 * frame rate conversion first and then interlaces the frames. When you choose Optimized interlacing and you set your
 * output frame rate to a value that isn't suitable for optimized interlacing, MediaConvert automatically falls back to
 * basic interlacing. Required settings: To use optimized interlacing, you must set Telecine (telecine) to None (NONE)
 * or Soft (SOFT). You can't use optimized interlacing for hard telecine outputs. You must also set Interlace mode
 * (interlaceMode) to a value other than Progressive (PROGRESSIVE).
 */
final class Vc3ScanTypeConversionMode
{
    public const INTERLACED = 'INTERLACED';
    public const INTERLACED_OPTIMIZE = 'INTERLACED_OPTIMIZE';

    public static function exists(string $value): bool
    {
        return isset([
            self::INTERLACED => true,
            self::INTERLACED_OPTIMIZE => true,
        ][$value]);
    }
}
