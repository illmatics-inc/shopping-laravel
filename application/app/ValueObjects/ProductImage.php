<?php

namespace App\ValueObjects;

use App\ValueObjects\Traits\Imagable;

/**
 * Class ProductImage
 * @package App\ValueObjects
 */
class ProductImage
{
    use Imagable;

    /** @var string */
    const DIRECTORY = 'product_images';
}
