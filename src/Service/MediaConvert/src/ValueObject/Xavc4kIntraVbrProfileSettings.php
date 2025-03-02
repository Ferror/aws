<?php

namespace AsyncAws\MediaConvert\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\MediaConvert\Enum\Xavc4kIntraVbrProfileClass;

/**
 * Required when you set (Profile) under (VideoDescription)>(CodecSettings)>(XavcSettings) to the value
 * XAVC_4K_INTRA_VBR.
 */
final class Xavc4kIntraVbrProfileSettings
{
    /**
     * Specify the XAVC Intra 4k (VBR) Class to set the bitrate of your output. Outputs of the same class have similar image
     * quality over the operating points that are valid for that class.
     */
    private $xavcClass;

    /**
     * @param array{
     *   XavcClass?: null|Xavc4kIntraVbrProfileClass::*,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->xavcClass = $input['XavcClass'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    /**
     * @return Xavc4kIntraVbrProfileClass::*|null
     */
    public function getXavcClass(): ?string
    {
        return $this->xavcClass;
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        if (null !== $v = $this->xavcClass) {
            if (!Xavc4kIntraVbrProfileClass::exists($v)) {
                throw new InvalidArgument(sprintf('Invalid parameter "xavcClass" for "%s". The value "%s" is not a valid "Xavc4kIntraVbrProfileClass".', __CLASS__, $v));
            }
            $payload['xavcClass'] = $v;
        }

        return $payload;
    }
}
