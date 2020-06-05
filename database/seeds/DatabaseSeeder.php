<?php

use App\docente;
use App\estudiante;
use App\materia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        estudiante::truncate();
        docente::truncate();
        materia::truncate();
        factory(estudiante::class,50)->create();//200
        factory(docente::class,20)->create();//20
        factory(materia::class,30)->create()->each(//30
            function ($materia){
                $estudiantes = estudiante::all()->random(mt_rand(5,20))->pluck('id');//5,20
                $materia->rela_estudiante()->attach($estudiantes);
            }
        );
    }
}
