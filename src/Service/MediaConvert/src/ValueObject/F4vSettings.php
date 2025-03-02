<?php

namespace AsyncAws\MediaConvert\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\MediaConvert\Enum\F4vMoovPlacement;

/**
 * Settings for F4v container.
 */
final class F4vSettings
{
    /**
     * If set to PROGRESSIVE_DOWNLOAD, the MOOV atom is relocated to the beginning of the archive as required for
     * progressive downloading. Otherwise it is placed normally at the end.
     */
    private $moovPlacement;

    /**
     * @param array{
     *   MoovPlacement?: null|F4vMoovPlacement::*,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->moovPlacement = $input['MoovPlacement'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    /**
     * @return F4vMoovPlacement::*|null
     */
    public function getMoovPlacement(): ?string
    {
        return $this->moovPlacement;
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        if (null !== $v = $this->moovPlacement) {
            if (!F4vMoovPlacement::exists($v)) {
                throw new InvalidArgument(sprintf('Invalid parameter "moovPlacement" for "%s". The value "%s" is not a valid "F4vMoovPlacement".', __CLASS__, $v));
            }
            $payload['moovPlacement'] = $v;
        }

        return $payload;
    }
}
