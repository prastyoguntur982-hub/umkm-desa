<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run()
    {
        StrukturOrganisasi::create([
            'nama' => 'Andi Setiawan',
            'jabatan' => 'Kepala Dinas',
            'nip' => '19700101 123456 1 001',
            'foto' => 'https://i.pravatar.cc/60?img=1',
            'parent_id' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Rina Dewi',
            'jabatan' => 'Sekretaris',
            'nip' => '19800202 123456 2 002',
            'foto' => 'https://i.pravatar.cc/60?img=2',
            'parent_id' => 1,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Budi Santoso',
            'jabatan' => 'Kabid Pasar',
            'nip' => '19850303 123456 3 003',
            'foto' => 'https://i.pravatar.cc/60?img=3',
            'parent_id' => 1,
        ]);

        // Tambahkan data lainnya...
    }
}
