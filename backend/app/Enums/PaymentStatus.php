<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Unpaid()
 * @method static static Paid()
 * @method static static Cancelled()
 */
final class PaymentStatus extends Enum implements LocalizedEnum
{
    const Unpaid = 0;
    const Paid = 1;
    const Cancelled = 2;
}
