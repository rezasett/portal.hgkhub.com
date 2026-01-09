<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PYearFiles;
use App\Models\User;

echo "=== Testing CRUD PYearFiles ===\n\n";

// Test 1: Count records
echo "1. Total records: " . PYearFiles::count() . "\n\n";

// Test 2: List all years
echo "2. All years:\n";
PYearFiles::with('creator')->get()->each(function($year) {
    echo sprintf(
        "   - %d | %s | Created by: %s | Locked: %s\n",
        $year->year,
        strtoupper($year->status),
        $year->creator->name ?? 'N/A',
        $year->locked_at ? $year->locked_at->format('Y-m-d') : 'No'
    );
});
echo "\n";

// Test 3: Check active years
echo "3. Active years: " . PYearFiles::active()->count() . "\n";
echo "   Locked years: " . PYearFiles::locked()->count() . "\n";
echo "   Revise years: " . PYearFiles::revise()->count() . "\n\n";

// Test 4: Create test (if no 2026 exists)
if (!PYearFiles::where('year', 2026)->exists()) {
    $user = User::first();
    if ($user) {
        $newYear = PYearFiles::create([
            'year' => 2026,
            'status' => 'active',
            'created_by' => $user->id
        ]);
        echo "4. Created new year: {$newYear->year} ✓\n";
    } else {
        echo "4. Cannot create: No user found\n";
    }
} else {
    echo "4. Year 2026 already exists\n";
}

echo "\n=== Test Complete ===\n";
