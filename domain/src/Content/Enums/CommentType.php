<?php

namespace Domain\Content\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static COMMENT()
 * @method static static REVIEW()
 */
final class CommentType extends Enum
{
    const COMMENT = 0;
    const REVIEW = 1;
}
