<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Unactivated()
 * @method static static Activated()
 */
final class UserStatus extends Enum
{
    const Unactivated = 0;
    const Activated = 1;
}
