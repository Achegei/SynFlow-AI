<?php

uses(Tests\TestCase::class);

test('Pest uses the isolated enrollment MariaDB database', function () {
    $expected = 'ai_platform_enrollment_phpunit_test';

    $connection = config('database.default');
    $database = \Illuminate\Support\Facades\DB::connection()
        ->getDatabaseName();

    expect(app()->environment())->toBe('testing');
    expect($connection)->toBe('mysql');
    expect($database)->toBe($expected);
    expect(config('mail.default'))->toBe('array');

    $tables = \Illuminate\Support\Facades\DB::select(
        'SELECT COUNT(*) AS total
         FROM information_schema.TABLES
         WHERE TABLE_SCHEMA = ?',
        [$expected]
    );

    expect((int) $tables[0]->total)->toBe(0);
});
