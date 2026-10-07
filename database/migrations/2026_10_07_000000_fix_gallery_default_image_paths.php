<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $mappings = [
            'images/gallery/manasik.png' => 'images/gallery/gallery-1-6a33514f6d5d4.jpeg',
            'images/gallery/jemaah.png' => 'images/gallery/gallery-2-6a335142dbe24.jpeg',
            'images/gallery/pejabat.png' => 'images/gallery/gallery-3-6a335139d46a4.jpeg',
            'images/gallery/kabbah.png' => 'images/gallery/gallery-4-6a33509b1ee01.jpeg',
        ];

        foreach ($mappings as $old => $new) {
            DB::table('galleries')
                ->where('image', $old)
                ->update(['image' => $new]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reversal needed
    }
};
