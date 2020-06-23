<?php

namespace App\ValueObjects;

use App\ValueObjects\Traits\Imagable;

/**
 * Class UserImage
 * @package App\ValueObjects
 */
class UserImage
{
    use Imagable;

    /** @var string */
    const DIRECTORY = 'user_images';
}
