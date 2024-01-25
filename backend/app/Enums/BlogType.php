<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Blog()
 * @method static static Knowledge()
 */
final class BlogType extends Enum
{
    const Blog = 0;
    const Knowledge = 1;
}
