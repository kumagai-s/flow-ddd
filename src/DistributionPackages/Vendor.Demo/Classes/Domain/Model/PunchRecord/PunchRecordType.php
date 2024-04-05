<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\PunchRecord;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class PunchRecordType
{
    public const PUNCH_IN = 'punchIn';

    public const PUNCH_OUT = 'punchOut';

    public static function punchIn(): PunchRecordType
    {
        return new PunchRecordType(self::PUNCH_IN);
    }

    public static function punchOut(): PunchRecordType
    {
        return new PunchRecordType(self::PUNCH_OUT);
    }

    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('Punch time date cannot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(PunchRecordType $other): bool
    {
        return $this->value === $other->value();
    }

    public function isPunchIn(): bool
    {
        return self::PUNCH_IN === $this->value;
    }
}
