<?php

use Illuminate\Support\Facades\DB;

test('after commit callback runs only after transaction commits', function () {
    $events = [];

    DB::transaction(function () use (&$events) {
        DB::afterCommit(function () use (&$events) {
            $events[] = 'email_dispatched';
        });

        $events[] = 'transaction_work';

        expect($events)->toBe(['transaction_work']);
    });

    expect($events)->toBe([
        'transaction_work',
        'email_dispatched',
    ]);
});

test('after commit callback is discarded when transaction rolls back', function () {
    $events = [];

    try {
        DB::transaction(function () use (&$events) {
            DB::afterCommit(function () use (&$events) {
                $events[] = 'email_dispatched';
            });

            $events[] = 'transaction_work';

            throw new RuntimeException('Simulated transaction failure');
        });
    } catch (RuntimeException $exception) {
        expect($exception->getMessage())
            ->toBe('Simulated transaction failure');
    }

    expect($events)->toBe(['transaction_work']);
});
