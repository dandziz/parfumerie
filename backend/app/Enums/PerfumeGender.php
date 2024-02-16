<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Female()
 * @method static static Male()
 * @method static static Unisex()
 */
final class PerfumeGender extends Enum
{
    const Female = 0;
    const Male = 1;
    const Unisex = 2;
}
