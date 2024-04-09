<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Normal()
 * @method static static All()
 */
final class VoucherType extends Enum
{
    const Normal = 0;
    const All = 1;
}
