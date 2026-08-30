<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateResponsiveImages
{
    private const DETAIL_MAX = 1280;

    private const TILE_WIDTH = 640;

    private const TILE_HEIGHT = 480;

    public function handle(Jigsaw $jigsaw): void
    {
        if (!function_exists('imagewebp')) {
            echo("\nSkipping responsive images: PHP GD WebP support is unavailable.\n\n");
            return;
        }

        $sourceRoot = $jigsaw->getSourcePath() . '/assets/images';
        $outputRoot = $sourceRoot . '/responsive';

        foreach ($this->sourceImages($sourceRoot) as $source) {
            $relative = substr($source, strlen($sourceRoot) + 1);
            $directory = dirname($relative);
            $filename = pathinfo($relative, PATHINFO_FILENAME);
            $destinationDir = $outputRoot . ($directory === '.' ? '' : '/' . $directory);

            if (!is_dir($destinationDir) && !mkdir($destinationDir, 0755, true) && !is_dir($destinationDir)) {
                continue;
            }

            $detailPath = $destinationDir . "/{$filename}.detail-1280.webp";
            $this->writeVariant($source, $detailPath, 'detail');

            if (str_starts_with($relative, 'recipes' . DIRECTORY_SEPARATOR) || str_starts_with($relative, 'recipes/')) {
                $tilePath = $destinationDir . "/{$filename}.tile-640.webp";
                $this->writeVariant($source, $tilePath, 'tile');
            }
        }
    }

    /**
     * @return iterable<string>
     */
    private function sourceImages(string $sourceRoot): iterable
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceRoot, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $path = $file->getPathname();
            if (str_contains($path, DIRECTORY_SEPARATOR . 'responsive' . DIRECTORY_SEPARATOR)) {
                continue;
            }

            $extension = strtolower($file->getExtension());
            if (!in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
                continue;
            }

            yield $path;
        }
    }

    private function writeVariant(string $source, string $destination, string $kind): void
    {
        if (is_file($destination) && filemtime($destination) >= filemtime($source)) {
            return;
        }

        $image = $this->loadImage($source);
        if (!$image) {
            return;
        }

        $variant = $kind === 'tile'
            ? $this->cover($image, self::TILE_WIDTH, self::TILE_HEIGHT)
            : $this->contain($image, self::DETAIL_MAX);

        imagewebp($variant, $destination, $kind === 'tile' ? 76 : 78);
    }

    private function loadImage(string $path)
    {
        $info = @getimagesize($path);
        if (!$info) {
            return null;
        }

        $image = match ($info[2]) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($path),
            IMAGETYPE_PNG => imagecreatefrompng($path),
            default => false,
        };

        return $image ?: null;
    }

    private function contain($image, int $max)
    {
        $width = imagesx($image);
        $height = imagesy($image);
        $scale = min(1, $max / max($width, $height));
        $targetWidth = max(1, (int) round($width * $scale));
        $targetHeight = max(1, (int) round($height * $scale));

        return $this->resample($image, $targetWidth, $targetHeight, $width, $height);
    }

    private function cover($image, int $targetWidth, int $targetHeight)
    {
        $width = imagesx($image);
        $height = imagesy($image);
        $scale = max($targetWidth / $width, $targetHeight / $height);
        $resizedWidth = max($targetWidth, (int) round($width * $scale));
        $resizedHeight = max($targetHeight, (int) round($height * $scale));
        $resized = $this->resample($image, $resizedWidth, $resizedHeight, $width, $height);

        $cropped = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopy(
            $cropped,
            $resized,
            0,
            0,
            (int) (($resizedWidth - $targetWidth) / 2),
            (int) (($resizedHeight - $targetHeight) / 2),
            $targetWidth,
            $targetHeight
        );

        return $cropped;
    }

    private function resample($image, int $targetWidth, int $targetHeight, int $width, int $height)
    {
        $resized = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        return $resized;
    }
}
