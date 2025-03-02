<?php

namespace AsyncAws\MediaConvert\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\MediaConvert\Enum\OutputGroupType;

/**
 * Output Group settings, including type.
 */
final class OutputGroupSettings
{
    /**
     * Settings related to your CMAF output package. For more information, see
     * https://docs.aws.amazon.com/mediaconvert/latest/ug/outputs-file-ABR.html. When you work directly in your JSON job
     * specification, include this object and any required children when you set Type, under OutputGroupSettings, to
     * CMAF_GROUP_SETTINGS.
     */
    private $cmafGroupSettings;

    /**
     * Settings related to your DASH output package. For more information, see
     * https://docs.aws.amazon.com/mediaconvert/latest/ug/outputs-file-ABR.html. When you work directly in your JSON job
     * specification, include this object and any required children when you set Type, under OutputGroupSettings, to
     * DASH_ISO_GROUP_SETTINGS.
     */
    private $dashIsoGroupSettings;

    /**
     * Settings related to your File output group. MediaConvert uses this group of settings to generate a single standalone
     * file, rather than a streaming package. When you work directly in your JSON job specification, include this object and
     * any required children when you set Type, under OutputGroupSettings, to FILE_GROUP_SETTINGS.
     */
    private $fileGroupSettings;

    /**
     * Settings related to your HLS output package. For more information, see
     * https://docs.aws.amazon.com/mediaconvert/latest/ug/outputs-file-ABR.html. When you work directly in your JSON job
     * specification, include this object and any required children when you set Type, under OutputGroupSettings, to
     * HLS_GROUP_SETTINGS.
     */
    private $hlsGroupSettings;

    /**
     * Settings related to your Microsoft Smooth Streaming output package. For more information, see
     * https://docs.aws.amazon.com/mediaconvert/latest/ug/outputs-file-ABR.html. When you work directly in your JSON job
     * specification, include this object and any required children when you set Type, under OutputGroupSettings, to
     * MS_SMOOTH_GROUP_SETTINGS.
     */
    private $msSmoothGroupSettings;

    /**
     * Type of output group (File group, Apple HLS, DASH ISO, Microsoft Smooth Streaming, CMAF).
     */
    private $type;

    /**
     * @param array{
     *   CmafGroupSettings?: null|CmafGroupSettings|array,
     *   DashIsoGroupSettings?: null|DashIsoGroupSettings|array,
     *   FileGroupSettings?: null|FileGroupSettings|array,
     *   HlsGroupSettings?: null|HlsGroupSettings|array,
     *   MsSmoothGroupSettings?: null|MsSmoothGroupSettings|array,
     *   Type?: null|OutputGroupType::*,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->cmafGroupSettings = isset($input['CmafGroupSettings']) ? CmafGroupSettings::create($input['CmafGroupSettings']) : null;
        $this->dashIsoGroupSettings = isset($input['DashIsoGroupSettings']) ? DashIsoGroupSettings::create($input['DashIsoGroupSettings']) : null;
        $this->fileGroupSettings = isset($input['FileGroupSettings']) ? FileGroupSettings::create($input['FileGroupSettings']) : null;
        $this->hlsGroupSettings = isset($input['HlsGroupSettings']) ? HlsGroupSettings::create($input['HlsGroupSettings']) : null;
        $this->msSmoothGroupSettings = isset($input['MsSmoothGroupSettings']) ? MsSmoothGroupSettings::create($input['MsSmoothGroupSettings']) : null;
        $this->type = $input['Type'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getCmafGroupSettings(): ?CmafGroupSettings
    {
        return $this->cmafGroupSettings;
    }

    public function getDashIsoGroupSettings(): ?DashIsoGroupSettings
    {
        return $this->dashIsoGroupSettings;
    }

    public function getFileGroupSettings(): ?FileGroupSettings
    {
        return $this->fileGroupSettings;
    }

    public function getHlsGroupSettings(): ?HlsGroupSettings
    {
        return $this->hlsGroupSettings;
    }

    public function getMsSmoothGroupSettings(): ?MsSmoothGroupSettings
    {
        return $this->msSmoothGroupSettings;
    }

    /**
     * @return OutputGroupType::*|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        if (null !== $v = $this->cmafGroupSettings) {
            $payload['cmafGroupSettings'] = $v->requestBody();
        }
        if (null !== $v = $this->dashIsoGroupSettings) {
            $payload['dashIsoGroupSettings'] = $v->requestBody();
        }
        if (null !== $v = $this->fileGroupSettings) {
            $payload['fileGroupSettings'] = $v->requestBody();
        }
        if (null !== $v = $this->hlsGroupSettings) {
            $payload['hlsGroupSettings'] = $v->requestBody();
        }
        if (null !== $v = $this->msSmoothGroupSettings) {
            $payload['msSmoothGroupSettings'] = $v->requestBody();
        }
        if (null !== $v = $this->type) {
            if (!OutputGroupType::exists($v)) {
                throw new InvalidArgument(sprintf('Invalid parameter "type" for "%s". The value "%s" is not a valid "OutputGroupType".', __CLASS__, $v));
            }
            $payload['type'] = $v;
        }

        return $payload;
    }
}
