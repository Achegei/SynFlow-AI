<?php

namespace Tests\Unit;

use App\Support\GalleryMediaValidator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class GalleryMediaValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    private function image(string $path = 'gallery/photo.jpg'): string
    {
        Storage::disk('public')->put(
            $path,
            base64_decode(
                '/9j/4AAQSkZJRgABAQAAAQABAAD/2Q=='
            )
        );

        return $path;
    }

    private function video(string $path = 'gallery/videos/test.mp4'): string
    {
        Storage::disk('public')->put(
            $path,
            file_get_contents(
                base_path('tests/Fixtures/gallery/valid-test.mp4')
            )
        );

        return $path;
    }

    public function test_accepts_genuine_mp4_video(): void
    {
        $imagePath = $this->image();
        $videoPath = $this->video();

        $data = GalleryMediaValidator::prepare([
            'media_type' => 'video_upload',
            'image_path' => $imagePath,
            'video_path' => $videoPath,
            'is_published' => true,
        ]);

        $this->assertSame('video_upload', $data['media_type']);
        $this->assertSame($imagePath, $data['image_path']);
        $this->assertSame($videoPath, $data['video_path']);
        $this->assertTrue($data['is_published']);
    }

    public function test_valid_youtube_url_formats(): void
    {
        $id = 'dQw4w9WgXcQ';

        foreach ([
            "https://www.youtube.com/watch?v={$id}",
            "https://youtu.be/{$id}",
            "https://www.youtube.com/shorts/{$id}",
            "https://www.youtube.com/embed/{$id}",
        ] as $url) {
            $this->assertSame(
                $id,
                GalleryMediaValidator::youtubeVideoId($url)
            );
        }
    }

    public function test_rejects_untrusted_youtube_domains(): void
    {
        foreach ([
            'https://youtube.com.evil.example/watch?v=dQw4w9WgXcQ',
            'https://evil.example/watch?v=dQw4w9WgXcQ',
            'http://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'https://user@www.youtube.com/watch?v=dQw4w9WgXcQ',
        ] as $url) {
            $this->assertNull(
                GalleryMediaValidator::youtubeVideoId($url)
            );
        }
    }

    public function test_youtube_item_is_normalized(): void
    {
        $data = GalleryMediaValidator::prepare([
            'media_type' => 'youtube',
            'youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'is_published' => true,
            'show_on_homepage' => true,
        ]);

        $this->assertSame(
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            $data['youtube_url']
        );

        $this->assertNull($data['image_path']);
        $this->assertNull($data['video_path']);
        $this->assertTrue($data['is_published']);
        $this->assertTrue($data['show_on_homepage']);
    }

    public function test_unpublished_item_cannot_be_featured(): void
    {
        $data = GalleryMediaValidator::prepare([
            'media_type' => 'youtube',
            'youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'is_published' => false,
            'show_on_homepage' => true,
        ]);

        $this->assertFalse($data['is_published']);
        $this->assertFalse($data['show_on_homepage']);
    }

    public function test_missing_photo_is_rejected(): void
    {
        $this->expectException(ValidationException::class);

        GalleryMediaValidator::prepare([
            'media_type' => 'photo',
            'image_path' => 'gallery/missing.jpg',
        ]);
    }

    public function test_missing_video_is_rejected(): void
    {
        $this->expectException(ValidationException::class);

        GalleryMediaValidator::prepare([
            'media_type' => 'video_upload',
            'image_path' => 'gallery/missing.jpg',
            'video_path' => 'gallery/videos/missing.mp4',
        ]);
    }

    public function test_existing_photo_path_is_preserved_on_edit(): void
    {
        $path = $this->image();

        $data = GalleryMediaValidator::prepare(
            [
                'media_type' => 'photo',
                'is_published' => false,
            ],
            [
                'media_type' => 'photo',
                'image_path' => $path,
            ]
        );

        $this->assertSame($path, $data['image_path']);
    }

    public function test_switching_photo_to_youtube_clears_old_media(): void
    {
        $path = $this->image();

        $data = GalleryMediaValidator::prepare(
            [
                'media_type' => 'youtube',
                'youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
            ],
            [
                'media_type' => 'photo',
                'image_path' => $path,
            ]
        );

        $this->assertNull($data['image_path']);
        $this->assertNull($data['video_path']);
    }

    public function test_switching_photo_to_video_requires_new_files(): void
    {
        $this->image();

        $this->expectException(ValidationException::class);

        GalleryMediaValidator::prepare(
            [
                'media_type' => 'video_upload',
            ],
            [
                'media_type' => 'photo',
                'image_path' => 'gallery/photo.jpg',
            ]
        );
    }

    public function test_rejects_invalid_video_file(): void
    {
        $this->image();

        Storage::disk('public')->put(
            'gallery/videos/invalid.mp4',
            'This is not a real MP4 file.'
        );

        $this->expectException(ValidationException::class);

        GalleryMediaValidator::prepare([
            'media_type' => 'video_upload',
            'image_path' => 'gallery/photo.jpg',
            'video_path' => 'gallery/videos/invalid.mp4',
        ]);
    }
}
