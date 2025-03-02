<?php

namespace AsyncAws\MediaConvert\Enum;

/**
 * Only use this setting when you change the default value, AUTO, for the setting H264AdaptiveQuantization. When you
 * keep all defaults, excluding H264AdaptiveQuantization and all other adaptive quantization from your JSON job
 * specification, MediaConvert automatically applies the best types of quantization for your video content. When you set
 * H264AdaptiveQuantization to a value other than AUTO, the default value for H264TemporalAdaptiveQuantization is
 * Enabled (ENABLED). Keep this default value to adjust quantization within each frame based on temporal variation of
 * content complexity. When you enable this feature, the encoder uses fewer bits on areas of the frame that aren't
 * moving and uses more bits on complex objects with sharp edges that move a lot. For example, this feature improves the
 * readability of text tickers on newscasts and scoreboards on sports matches. Enabling this feature will almost always
 * improve your video quality. Note, though, that this feature doesn't take into account where the viewer's attention is
 * likely to be. If viewers are likely to be focusing their attention on a part of the screen that doesn't have moving
 * objects with sharp edges, such as sports athletes' faces, you might choose to set H264TemporalAdaptiveQuantization to
 * Disabled (DISABLED). Related setting: When you enable temporal quantization, adjust the strength of the filter with
 * the setting Adaptive quantization (adaptiveQuantization). To manually enable or disable
 * H264TemporalAdaptiveQuantization, you must set Adaptive quantization (H264AdaptiveQuantization) to a value other than
 * AUTO.
 */
final class H264TemporalAdaptiveQuantization
{
    public const DISABLED = 'DISABLED';
    public const ENABLED = 'ENABLED';

    public static function exists(string $value): bool
    {
        return isset([
            self::DISABLED => true,
            self::ENABLED => true,
        ][$value]);
    }
}
