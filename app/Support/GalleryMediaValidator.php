<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GalleryMediaValidator
{
    public static function prepare(
        array $data,
        ?array $existing = null
    ): array {
        $type = $data['media_type'] ?? 'photo';

        if (! in_array(
            $type,
            ['photo', 'video_upload', 'youtube'],
            true
        )) {
            throw ValidationException::withMessages([
                'data.media_type' => 'Select a valid media type.',
            ]);
        }

        $previousType = $existing['media_type'] ?? null;
        $sameType = $previousType === $type;

        foreach (['image_path', 'video_path', 'youtube_url'] as $field) {
            if (! array_key_exists($field, $data)) {
                $data[$field] = $sameType
                    ? ($existing[$field] ?? null)
                    : null;
            }
        }

        if ($type === 'photo') {
            $data['video_path'] = null;
            $data['youtube_url'] = null;
        } elseif ($type === 'video_upload') {
            $data['youtube_url'] = null;
        } else {
            $data['image_path'] = null;
            $data['video_path'] = null;
        }

        $rules = [
            'media_type' => [
                'required',
                'in:photo,video_upload,youtube',
            ],
            'image_path' => ['nullable', 'string', 'max:2048'],
            'video_path' => ['nullable', 'string', 'max:2048'],
            'youtube_url' => ['nullable', 'string', 'max:500'],
        ];

        if ($type === 'photo') {
            $rules['image_path'][0] = 'required';
        } elseif ($type === 'video_upload') {
            $rules['image_path'][0] = 'required';
            $rules['video_path'][0] = 'required';
        } else {
            $rules['youtube_url'] = [
                'required',
                'url',
                'max:500',
            ];
        }

        Validator::make($data, $rules)->validate();

        if (in_array($type, ['photo', 'video_upload'], true)) {
            self::validateStoredFile(
                'image_path',
                $data['image_path'],
                'gallery/',
                ['jpg', 'jpeg', 'png', 'webp', 'gif'],
                ['image/jpeg', 'image/png', 'image/webp', 'image/gif']
            );
        }

        if ($type === 'video_upload') {
            self::validateStoredFile(
                'video_path',
                $data['video_path'],
                'gallery/videos/',
                ['mp4'],
                ['video/mp4', 'application/mp4']
            );
        }

        if ($type === 'youtube') {
            $videoId = self::youtubeVideoId(
                $data['youtube_url']
            );

            if ($videoId === null) {
                throw ValidationException::withMessages([
                    'data.youtube_url' =>
                        'Enter a valid YouTube video URL.',
                ]);
            }

            $data['youtube_url'] =
                'https://www.youtube.com/watch?v=' . $videoId;
        }

        $published = (bool) ($data['is_published'] ?? false);

        $data['is_published'] = $published;

        $data['show_on_homepage'] = $published
            && (bool) ($data['show_on_homepage'] ?? false);

        return $data;
    }

    private static function validateStoredFile(
        string $field,
        string $path,
        string $directory,
        array $extensions,
        array $mimeTypes
    ): void {
        $disk = Storage::disk('public');

        if (
            ! str_starts_with($path, $directory)
            || str_contains($path, '..')
            || str_contains($path, '\\')
            || ! $disk->exists($path)
        ) {
            throw ValidationException::withMessages([
                'data.' . $field =>
                    'The selected media file could not be found.',
            ]);
        }

        $extension = strtolower(pathinfo(
            $path,
            PATHINFO_EXTENSION
        ));

        if (! in_array($extension, $extensions, true)) {
            throw ValidationException::withMessages([
                'data.' . $field =>
                    'The selected file format is not supported.',
            ]);
        }

        $mime = $disk->mimeType($path);

        if (! in_array($mime, $mimeTypes, true)) {
            throw ValidationException::withMessages([
                'data.' . $field =>
                    'The selected file has an invalid media type.',
            ]);
        }

        if ($field === 'video_path') {
            $absolutePath = $disk->path($path);

            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $detectedMime = $finfo->file($absolutePath);

            $handle = fopen($absolutePath, 'rb');

            $header = $handle !== false
                ? fread($handle, 12)
                : false;

            if ($handle !== false) {
                fclose($handle);
            }

            $hasMp4Header = is_string($header)
                && strlen($header) === 12
                && substr($header, 4, 4) === 'ftyp'
                && unpack('N', substr($header, 0, 4))[1] >= 16;

            if (
                ! in_array(
                    $detectedMime,
                    ['video/mp4', 'application/mp4'],
                    true
                )
                || ! $hasMp4Header
            ) {
                throw ValidationException::withMessages([
                    'data.video_path' =>
                        'The uploaded file is not a valid MP4 video.',
                ]);
            }
        }
    }

    public static function youtubeVideoId(string $url): ?string
    {
        $parts = parse_url(trim($url));

        if (! is_array($parts)) {
            return null;
        }

        if (($parts['scheme'] ?? '') !== 'https') {
            return null;
        }

        if (
            isset($parts['user'])
            || isset($parts['pass'])
            || isset($parts['port'])
        ) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';

        $id = null;

        if (in_array(
            $host,
            ['youtube.com', 'www.youtube.com', 'm.youtube.com'],
            true
        )) {
            if ($path === '/watch') {
                parse_str($parts['query'] ?? '', $query);
                $id = $query['v'] ?? null;
            } elseif (preg_match(
                '~^/(?:shorts|embed)/([A-Za-z0-9_-]{11})/?$~',
                $path,
                $matches
            )) {
                $id = $matches[1];
            }
        } elseif (
            in_array($host, ['youtu.be', 'www.youtu.be'], true)
            && preg_match(
                '~^/([A-Za-z0-9_-]{11})/?$~',
                $path,
                $matches
            )
        ) {
            $id = $matches[1];
        }

        return is_string($id)
            && preg_match('/^[A-Za-z0-9_-]{11}$/', $id)
                ? $id
                : null;
    }
}
