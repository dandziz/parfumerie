<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Normal()
 * @method static static Default()
 * @method static static ML()
 * @method static static FullBox()
 */
final class PerfumeImage extends Enum
{
    const Normal = 0;
    const Default = 1;
    const ML = 2;
    const FullBox = 2;
}
