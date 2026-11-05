<?php

use App\Filament\Resources\GalleryImageResource\Pages\CreateGalleryImage;
use App\Filament\Resources\GalleryImageResource\Pages\EditGalleryImage;
use App\Models\GalleryImage;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
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

test('administrator creates and publishes a YouTube gallery item', function () {
    Livewire::test(CreateGalleryImage::class)
        ->fillForm([
            'media_type' => 'youtube',
            'youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'title' => 'AI Academy Orientation Video',
            'caption' => 'Highlights from our AI orientation.',
            'category' => 'AI Orientations',
            'display_order' => 3,
            'is_published' => true,
            'show_on_homepage' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $item = GalleryImage::query()
        ->where('title', 'AI Academy Orientation Video')
        ->firstOrFail();

    expect($item->media_type)->toBe('youtube')
        ->and($item->youtube_url)
            ->toBe('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
        ->and($item->category)->toBe('AI Orientations')
        ->and($item->display_order)->toBe(3)
        ->and($item->is_published)->toBeTrue()
        ->and($item->show_on_homepage)->toBeTrue()
        ->and($item->published_at)->not->toBeNull();
});


test('administrator edits gallery details and display order', function () {
    $item = GalleryImage::create([
        'title' => 'Original Gallery Title',
        'caption' => 'Original description.',
        'media_type' => 'youtube',
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'category' => 'Academy Events',
        'display_order' => 10,
        'is_published' => true,
        'show_on_homepage' => false,
        'published_at' => now()->subDay(),
    ]);

    Livewire::test(EditGalleryImage::class, [
        'record' => $item->getRouteKey(),
    ])
        ->fillForm([
            'title' => 'Updated Gallery Title',
            'caption' => 'Updated Gallery description.',
            'category' => 'AI Training',
            'display_order' => 2,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $item->refresh();

    expect($item->title)->toBe('Updated Gallery Title')
        ->and($item->caption)->toBe('Updated Gallery description.')
        ->and($item->category)->toBe('AI Training')
        ->and($item->display_order)->toBe(2)
        ->and($item->is_published)->toBeTrue();
});

test('administrator unpublishes gallery content', function () {
    $item = GalleryImage::create([
        'title' => 'Gallery Item To Unpublish',
        'caption' => 'Previously published.',
        'media_type' => 'youtube',
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'category' => 'Academy Events',
        'display_order' => 1,
        'is_published' => true,
        'show_on_homepage' => true,
        'published_at' => now()->subDay(),
    ]);

    $this->get('/gallery')
        ->assertOk()
        ->assertSee('Gallery Item To Unpublish');

    Livewire::test(EditGalleryImage::class, [
        'record' => $item->getRouteKey(),
    ])
        ->fillForm([
            'is_published' => false,
            'show_on_homepage' => false,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $item->refresh();

    expect($item->is_published)->toBeFalse()
        ->and($item->show_on_homepage)->toBeFalse()
        ->and($item->published_at)->toBeNull();

    $this->get('/gallery')
        ->assertOk()
        ->assertDontSee('Gallery Item To Unpublish');

    $this->get('/')
        ->assertOk()
        ->assertDontSee('Gallery Item To Unpublish');
});
