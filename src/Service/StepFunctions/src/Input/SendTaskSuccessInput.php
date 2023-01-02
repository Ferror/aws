<?php

namespace AsyncAws\StepFunctions\Input;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class SendTaskSuccessInput extends Input
{
    /**
     * The token that represents this task. Task tokens are generated by Step Functions when tasks are assigned to a worker,
     * or in the context object when a workflow enters a task state. See GetActivityTaskOutput$taskToken.
     *
     * @see https://docs.aws.amazon.com/step-functions/latest/dg/input-output-contextobject.html
     *
     * @required
     *
     * @var string|null
     */
    private $taskToken;

    /**
     * The JSON output of the task. Length constraints apply to the payload size, and are expressed as bytes in UTF-8
     * encoding.
     *
     * @required
     *
     * @var string|null
     */
    private $output;

    /**
     * @param array{
     *   taskToken?: string,
     *   output?: string,
     *
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->taskToken = $input['taskToken'] ?? null;
        $this->output = $input['output'] ?? null;
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getOutput(): ?string
    {
        return $this->output;
    }

    public function getTaskToken(): ?string
    {
        return $this->taskToken;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = [
            'Content-Type' => 'application/x-amz-json-1.0',
            'X-Amz-Target' => 'AWSStepFunctions.SendTaskSuccess',
        ];

        // Prepare query
        $query = [];

        // Prepare URI
        $uriString = '/';

        // Prepare Body
        $bodyPayload = $this->requestBody();
        $body = empty($bodyPayload) ? '{}' : json_encode($bodyPayload, 4194304);

        // Return the Request
        return new Request('POST', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setOutput(?string $value): self
    {
        $this->output = $value;

        return $this;
    }

    public function setTaskToken(?string $value): self
    {
        $this->taskToken = $value;

        return $this;
    }

    private function requestBody(): array
    {
        $payload = [];
        if (null === $v = $this->taskToken) {
            throw new InvalidArgument(sprintf('Missing parameter "taskToken" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['taskToken'] = $v;
        if (null === $v = $this->output) {
            throw new InvalidArgument(sprintf('Missing parameter "output" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['output'] = $v;

        return $payload;
    }
}
