<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = base_path('nbastats.csv');
        
        if (!File::exists($csvPath)) {
            $this->command->error('CSV file not found: ' . $csvPath);
            return;
        }

        $handle = fopen($csvPath, 'r');
        
        if ($handle === false) {
            $this->command->error('Could not open CSV file');
            return;
        }

        $header = fgetcsv($handle);
        
        $count = 0;
        while (($data = fgetcsv($handle)) !== false) {
            $playerData = [
                'Rk' => isset($data[0]) && $data[0] !== '' ? (int)$data[0] : null,
                'Player' => $data[1] ?? null,
                'Pos' => $data[2] ?? null,
                'Age' => isset($data[3]) && $data[3] !== '' ? (int)$data[3] : null,
                'Tm' => $data[4] ?? null,
                'G' => isset($data[5]) && $data[5] !== '' ? (int)$data[5] : null,
                'GS' => isset($data[6]) && $data[6] !== '' ? (int)$data[6] : null,
                'MP' => isset($data[7]) && $data[7] !== '' ? (float)$data[7] : null,
                'FG' => isset($data[8]) && $data[8] !== '' ? (float)$data[8] : null,
                'FGA' => isset($data[9]) && $data[9] !== '' ? (float)$data[9] : null,
                'FG_percent' => isset($data[10]) && $data[10] !== '' ? (float)$data[10] : null,
                'P3' => isset($data[11]) && $data[11] !== '' ? (float)$data[11] : null,
                'P3A' => isset($data[12]) && $data[12] !== '' ? (float)$data[12] : null,
                'P3_percent' => isset($data[13]) && $data[13] !== '' ? (float)$data[13] : null,
                'P2' => isset($data[14]) && $data[14] !== '' ? (float)$data[14] : null,
                'P2A' => isset($data[15]) && $data[15] !== '' ? (float)$data[15] : null,
                'P2_percent' => isset($data[16]) && $data[16] !== '' ? (float)$data[16] : null,
                'eFG_percent' => isset($data[17]) && $data[17] !== '' ? (float)$data[17] : null,
                'FT' => isset($data[18]) && $data[18] !== '' ? (float)$data[18] : null,
                'FTA' => isset($data[19]) && $data[19] !== '' ? (float)$data[19] : null,
                'FT_percent' => isset($data[20]) && $data[20] !== '' ? (float)$data[20] : null,
                'ORB' => isset($data[21]) && $data[21] !== '' ? (float)$data[21] : null,
                'DRB' => isset($data[22]) && $data[22] !== '' ? (float)$data[22] : null,
                'TRB' => isset($data[23]) && $data[23] !== '' ? (float)$data[23] : null,
                'AST' => isset($data[24]) && $data[24] !== '' ? (float)$data[24] : null,
                'STL' => isset($data[25]) && $data[25] !== '' ? (float)$data[25] : null,
                'BLK' => isset($data[26]) && $data[26] !== '' ? (float)$data[26] : null,
                'TOV' => isset($data[27]) && $data[27] !== '' ? (float)$data[27] : null,
                'PF' => isset($data[28]) && $data[28] !== '' ? (float)$data[28] : null,
                'PTS' => isset($data[29]) && $data[29] !== '' ? (float)$data[29] : null,
            ];

            if (!empty($playerData['Player'])) {
                $existing = Player::where('Player', $playerData['Player'])->first();
                
                if ($existing) {
                    if (($playerData['PTS'] ?? 0) > ($existing->PTS ?? 0)) {
                        $existing->update($playerData);
                    }
                } else {
                    Player::create($playerData);
                    $count++;
                }
            }
        }
        fclose($handle);
        $this->command->info("Imported {$count} players from CSV.");
    }
}

