<?php

namespace AsyncAws\DynamoDb\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;

/**
 * Represents a request to perform a `PutItem` operation on an item.
 */
final class PutRequest
{
    /**
     * A map of attribute name to attribute values, representing the primary key of an item to be processed by `PutItem`.
     * All of the table's primary key attributes must be specified, and their data types must match those of the table's key
     * schema. If any attributes are present in the item that are part of an index key schema for the table, their types
     * must match the index key schema.
     */
    private $item;

    /**
     * @param array{
     *   Item: array<string, AttributeValue>,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->item = isset($input['Item']) ? array_map([AttributeValue::class, 'create'], $input['Item']) : null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    /**
     * @return array<string, AttributeValue>
     */
    public function getItem(): array
    {
        return $this->item ?? [];
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        if (null === $v = $this->item) {
            throw new InvalidArgument(sprintf('Missing parameter "Item" for "%s". The value cannot be null.', __CLASS__));
        }

        if (empty($v)) {
            $payload['Item'] = new \stdClass();
        } else {
            $payload['Item'] = [];
            foreach ($v as $name => $mv) {
                $payload['Item'][$name] = $mv->requestBody();
            }
        }

        return $payload;
    }
}
