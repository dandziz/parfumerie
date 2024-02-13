<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NotShipped()
 * @method static static Shipped()
 * @method static static Delivered()
 * @method static static Cancelled()
 */
final class DeliveryStatus extends Enum implements LocalizedEnum
{
    const NotShipped = 0;
    const Shipped = 1;
    const Delivered = 2;
    const Cancelled = 3;
}
