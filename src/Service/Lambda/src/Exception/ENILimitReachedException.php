<?php

namespace AsyncAws\Lambda\Exception;

use AsyncAws\Core\Exception\Http\ServerException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Lambda couldn't create an elastic network interface in the VPC, specified as part of Lambda function configuration,
 * because the limit for network interfaces has been reached. For more information, see Lambda quotas [^1].
 *
 * [^1]: https://docs.aws.amazon.com/lambda/latest/dg/gettingstarted-limits.html
 */
final class ENILimitReachedException extends ServerException
{
    private $type;

    public function getType(): ?string
    {
        return $this->type;
    }

    protected function populateResult(ResponseInterface $response): void
    {
        $data = $response->toArray(false);

        $this->type = isset($data['Type']) ? (string) $data['Type'] : null;
        if (null !== $v = (isset($data['message']) ? (string) $data['message'] : null)) {
            $this->message = $v;
        }
    }
}
