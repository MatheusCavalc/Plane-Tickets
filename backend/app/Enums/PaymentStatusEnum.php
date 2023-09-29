<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case Pending = 'PENDING';
    case Paid = 'PAID';
    case Failed = 'FAILED';

    public function getName(): string
    {
        return match ($this) {
            self::Pending => 'PENDING',
            self::Paid => 'PAID',
            self::Failed => 'FAILED',
            default => 'PENDING'
        };
    }

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $key) {
            $values[$key->value] = $key->name;
        }

        return $values;
    }
}
