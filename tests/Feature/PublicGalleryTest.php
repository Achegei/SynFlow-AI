<?php

use App\Models\GalleryImage;

function createPublicGalleryItem(
    string $title,
    array $overrides = []
): GalleryImage {
    return GalleryImage::create(array_merge([
        'title' => $title,
        'caption' => 'Gallery test description.',
        'media_type' => 'photo',
        'image_path' => 'gallery/test-photo.jpg',
        'category' => 'Academy Events',
        'display_order' => 0,
        'is_published' => true,
        'show_on_homepage' => false,
        'published_at' => now()->subDay(),
    ], $overrides));
}

test('published gallery items appear publicly', function () {
    createPublicGalleryItem('Published Workshop Photo');

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Published Workshop Photo');
});

test('draft and future gallery items remain hidden', function () {
    createPublicGalleryItem('Visible Gallery Photo');

    createPublicGalleryItem('Private Draft Photo', [
        'is_published' => false,
        'published_at' => null,
    ]);

    createPublicGalleryItem('Future Scheduled Photo', [
        'published_at' => now()->addDay(),
    ]);

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Visible Gallery Photo')
        ->assertDontSee('Private Draft Photo')
        ->assertDontSee('Future Scheduled Photo');
});

test('gallery photo filter excludes videos', function () {
    createPublicGalleryItem('Photo Filter Item');

    createPublicGalleryItem('Video Filter Item', [
        'media_type' => 'youtube',
        'image_path' => null,
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    ]);

    $this->get('/gallery?type=photos')
        ->assertOk()
        ->assertSee('Photo Filter Item')
        ->assertDontSee('Video Filter Item');
});

test('gallery video filter excludes photographs', function () {
    createPublicGalleryItem('Photo Excluded From Videos');

    createPublicGalleryItem('YouTube Included In Videos', [
        'media_type' => 'youtube',
        'image_path' => null,
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    ]);

    createPublicGalleryItem('MP4 Included In Videos', [
        'media_type' => 'video_upload',
        'video_path' => 'gallery/videos/test.mp4',
    ]);

    $this->get('/gallery?type=videos')
        ->assertOk()
        ->assertSee('YouTube Included In Videos')
        ->assertSee('MP4 Included In Videos')
        ->assertDontSee('Photo Excluded From Videos');
});

test('gallery follows administrator display order', function () {
    createPublicGalleryItem('Gallery Second Item', [
        'display_order' => 20,
    ]);

    createPublicGalleryItem('Gallery First Item', [
        'display_order' => 10,
    ]);

    $this->get('/gallery')
        ->assertOk()
        ->assertSeeInOrder([
            'Gallery First Item',
            'Gallery Second Item',
        ]);
});

test('homepage shows only published featured gallery items', function () {
    createPublicGalleryItem('Homepage Featured Gallery', [
        'show_on_homepage' => true,
    ]);

    createPublicGalleryItem('Not Featured Gallery', [
        'show_on_homepage' => false,
    ]);

    createPublicGalleryItem('Unpublished Featured Gallery', [
        'is_published' => false,
        'show_on_homepage' => true,
        'published_at' => null,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Homepage Featured Gallery')
        ->assertDontSee('Not Featured Gallery')
        ->assertDontSee('Unpublished Featured Gallery');
});

test('homepage displays no more than six gallery items', function () {
    foreach (range(1, 8) as $number) {
        createPublicGalleryItem(
            'Featured Gallery Item ' . $number,
            [
                'show_on_homepage' => true,
                'display_order' => $number,
            ]
        );
    }

    $this->get('/')
        ->assertOk()
        ->assertSee('Featured Gallery Item 1')
        ->assertSee('Featured Gallery Item 6')
        ->assertDontSee('Featured Gallery Item 7')
        ->assertDontSee('Featured Gallery Item 8');
});

test('gallery paginates published media', function () {
    foreach (range(1, 13) as $number) {
        createPublicGalleryItem(
            'Pagination Gallery Item ' . $number,
            ['display_order' => $number]
        );
    }

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Pagination Gallery Item 12')
        ->assertDontSee('Pagination Gallery Item 13');

    $this->get('/gallery?page=2')
        ->assertOk()
        ->assertSee('Pagination Gallery Item 13');
});
