<?php

use Illuminate\Database\Seeder;
use App\Dosen;
use App\Mahasiswa;
use App\Wali;
use App\Hobi;


class RelasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Menghapus semua sample data
        DB::table('dosens')->delete();
        DB::table('mahasiswas')->delete();
        DB::table('walis')->delete();
        DB::table('hobis')->delete();
        DB::table('mahasiswa_hobi')->delete();

        //membuat data Dosen
        $dosen = Dosen::create([
            'nama' => 'Abdul Musthafa',
            'nipd' => '1234567890'
        ]);
        $this->command->info('Data dosen Berhasil dibuat');

        //membuat data Mahasiswa
        $mamat = Mahasiswa::create([
            'nama' => 'Mamat Karbit',
            'nim' => '1011010',
            'id_dosen' => $dosen->id
        ]);
        
        $dadang = Mahasiswa::create([
            'nama' => 'Dadang peloy',
            'nim' => '1011011',
            'id_dosen' => $dosen->id
        ]);

        $feri = Mahasiswa::create([
            'nama' => 'Feri Ambyar Supriadi',
            'nim' => '1011022',
            'id_dosen' => $dosen->id
        ]);
        $this->command->info('Data Mahasiswa Berhasil dibuat');

        //Membuat data wali 
        $ahmad = Wali::create([
            'nama' => 'Ahmad',
            'id_mahasiswa' => $mamat->id
        ]);

        $dudung = Wali::create([
            'nama' => 'Dudung',
            'id_mahasiswa' => $dadang->id
        ]);

        $basit = Wali::create([
            'nama' => 'Basit',
            'id_mahasiswa' => $feri->id
        ]);
        $this->command->info('Data Wali Berhasil dibuat');

        //Membuat data Hobi
        $mancing = Hobi::create([
            'hobi' => 'Mancing Keributan'
        ]);

        $gaming = Hobi::create([
            'hobi' => 'Game Mobile'
        ]);

        $mengaji = Hobi::create([
            'hobi' => 'Mengaji Al Quran'
        ]);

        //Melampirkan hobi ke mahasiswa

        $mamat->hobi()->attach($mancing->id);
        $mamat->hobi()->attach($mengaji->id);
        $dadang->hobi()->attach($gaming->id);
        $feri->hobi()->attach($mengaji->id);
        $this->command->info('Data Hobi Mahasiswa Berhasil dibuat');
    }
}
