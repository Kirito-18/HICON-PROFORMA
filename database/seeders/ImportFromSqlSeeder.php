<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proforma;
use App\Models\ProformaItem;

class ImportFromSqlSeeder extends Seeder
{
    public function run(): void
    {
        $possiblePaths = [
            'C:/Users/GAMER/Downloads/hicon_proformas.sql',
            base_path('database/hicon_proformas.sql'),
            base_path('../hicon_proformas.sql'),
        ];

        $filePath = null;
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                $filePath = $path;
                break;
            }
        }

        if (!$filePath) {
            $this->command?->error("No se encontró el archivo hicon_proformas.sql");
            return;
        }

        $sql = file_get_contents($filePath);

        // Desactivar temporalmente foreign keys
        $driver = config('database.default');
        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        }

        // Importar proformas
        if (preg_match('/INSERT INTO `proformas` \(([^)]+)\) VALUES\s*([\s\S]+?);/i', $sql, $matches)) {
            $columns = str_replace('`', '"', $matches[1]);
            $rawValues = trim($matches[2]);
            
            DB::statement("DELETE FROM proformas");
            DB::statement("INSERT INTO proformas ({$columns}) VALUES {$rawValues}");
            $this->command?->info("Proformas importadas: " . Proforma::count());
        }

        // Importar proforma_items
        if (preg_match('/INSERT INTO `proforma_items` \(([^)]+)\) VALUES\s*([\s\S]+?);/i', $sql, $matches)) {
            $columns = str_replace('`', '"', $matches[1]);
            $rawValues = trim($matches[2]);
            
            DB::statement("DELETE FROM proforma_items");
            DB::statement("INSERT INTO proforma_items ({$columns}) VALUES {$rawValues}");
            $this->command?->info("Ítems importados: " . ProformaItem::count());
        }

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        }
    }
}
