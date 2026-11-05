<?php

use App\Filament\Resources\GalleryImageResource\Pages\CreateGalleryImage;
use App\Models\GalleryImage;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    Storage::fake('public');

    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();

    $this->actingAs(User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]));
});

test('administrator uploads and publishes a gallery photograph', function () {
    $photo = UploadedFile::fake()->image(
        'academy-orientation.jpg',
        800,
        600
    );

    Livewire::test(CreateGalleryImage::class)
        ->fillForm([
            'media_type' => 'photo',
            'image_path' => $photo,
            'title' => 'Academy Orientation Photograph',
            'caption' => 'Participants attending an AI orientation.',
            'alt_text' => 'Participants attending AI training.',
            'category' => 'AI Orientations',
            'display_order' => 1,
            'is_published' => true,
            'show_on_homepage' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $item = GalleryImage::query()
        ->where('title', 'Academy Orientation Photograph')
        ->firstOrFail();

    expect($item->media_type)->toBe('photo')
        ->and($item->image_path)->not->toBeNull()
        ->and($item->video_path)->toBeNull()
        ->and($item->youtube_url)->toBeNull()
        ->and($item->is_published)->toBeTrue()
        ->and($item->show_on_homepage)->toBeTrue();

    expect($item->image_path)->toStartWith('gallery/');

    Storage::disk('public')->assertExists($item->image_path);

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Academy Orientation Photograph');
});


test('administrator uploads and publishes an MP4 gallery video', function () {
    $thumbnail = UploadedFile::fake()->image(
        'workshop-thumbnail.jpg',
        800,
        600
    );

    $video = UploadedFile::fake()->createWithContent(
        'academy-workshop.mp4',
        file_get_contents(
            base_path('tests/Fixtures/gallery/valid-test.mp4')
        )
    );

    Livewire::test(CreateGalleryImage::class)
        ->fillForm([
            'media_type' => 'video_upload',
            'image_path' => $thumbnail,
            'video_path' => $video,
            'title' => 'Academy Workshop Video',
            'caption' => 'Highlights from our AI workshop.',
            'alt_text' => 'AI workshop video thumbnail.',
            'category' => 'Corporate Workshops',
            'display_order' => 2,
            'is_published' => true,
            'show_on_homepage' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $item = GalleryImage::query()
        ->where('title', 'Academy Workshop Video')
        ->firstOrFail();

    expect($item->media_type)->toBe('video_upload')
        ->and($item->image_path)->not->toBeNull()
        ->and($item->video_path)->not->toBeNull()
        ->and($item->youtube_url)->toBeNull()
        ->and($item->is_published)->toBeTrue()
        ->and($item->show_on_homepage)->toBeTrue();

    expect($item->image_path)->toStartWith('gallery/');
    expect($item->video_path)->toStartWith('gallery/videos/');

    Storage::disk('public')->assertExists($item->image_path);
    Storage::disk('public')->assertExists($item->video_path);

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Academy Workshop Video');
});
