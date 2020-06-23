<?php

namespace App\ValueObjects\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Trait Imagable
 * @package App\ValueObjects\Traits
 */
trait Imagable
{
    /** @var string */
    private $path;

    /**
     * Imagable constructor.
     * @param  string  $path
     * @throws Exception
     */
    public function __construct(string $path)
    {
        if (!Storage::exists($path)) {
            throw new Exception('ファイルが存在しません');
        }

        if (self::DIRECTORY !== explode('/', $path)[0]) {
            throw new Exception('不正なディレクトリです');
        }

        $this->path = $path;
    }

    /**
     * @param  UploadedFile  $uploadedFile
     * @return static
     * @throws Exception
     */
    public static function fromUploadedFile(UploadedFile $uploadedFile)
    {
        $path = $uploadedFile->store(self::DIRECTORY);
        return new static($path);
    }

    public function deleteFile()
    {
        if (Storage::exists($this->path)) {
            Storage::delete($this->path);
        }
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function fullPath()
    {
        return url(Storage::url($this->path));
    }
}
