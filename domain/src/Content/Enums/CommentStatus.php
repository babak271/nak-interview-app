<?php

namespace Domain\Content\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PENDING()
 * @method static static ACCEPTED()
 * @method static static REJECTED()
 */
final class CommentStatus extends Enum
{
    const PENDING = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;
}
