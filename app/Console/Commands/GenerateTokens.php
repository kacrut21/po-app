<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\RegistrationToken;
use Illuminate\Support\Str;

#[Signature('cuanpilot:generate-tokens {count=10 : Jumlah token yang ingin dibuat}')]
#[Description('Men-generate kode lisensi pendaftaran untuk PO-Management by CuanPilot')]
class GenerateTokens extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');
        $this->info("Membuat {$count} kode lisensi baru...");

        $tokens = [];
        for ($i = 0; $i < $count; $i++) {
            $token = 'CUANPILOT-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
            
            RegistrationToken::create([
                'token' => $token,
                'is_used' => false,
            ]);

            $tokens[] = $token;
        }

        $this->table(['Kode Lisensi (Token)'], array_map(function($t) { return [$t]; }, $tokens));
        $this->info("Selesai! {$count} token berhasil disimpan ke database. Silakan copy kode di atas untuk dijual di Lynk.id.");
    }
}
