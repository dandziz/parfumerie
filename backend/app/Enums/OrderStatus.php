<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Delivered()
 * @method static static Cancelled()
 */
final class OrderStatus extends Enum implements LocalizedEnum
{
    const Pending = 0;
    const Approved = 1;
    const Delivered = 2;
    const Cancelled = 3;
}
