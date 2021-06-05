<?php

namespace Domain\Content\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static INACTIVE()
 * @method static static ACTIVE()
 */
final class PostStatus extends Enum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
}
