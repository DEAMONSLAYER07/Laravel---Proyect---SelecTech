<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importar DB para poder usar DB::table()

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        
        DB::table('usuarios')->insert([
            ['nombre'=>'Administrador','email'=>'admin@recluta.com','password'=>bcrypt('admin123'),'rol'=>'admin'],
            ['nombre'=>'Empresa Tech','email'=>'reclutador1@empresa.com','password'=>bcrypt('recluta123'),'rol'=>'reclutador'],
            ['nombre'=>'RH Consultores','email'=>'reclutador2@consultores.com','password'=>bcrypt('recluta123'),'rol'=>'reclutador'],
            ['nombre'=>'Carlos Pérez','email'=>'carlos@correo.com','password'=>bcrypt('candidato123'),'rol'=>'candidato'],
            ['nombre'=>'María López','email'=>'maria@correo.com','password'=>bcrypt('candidato123'),'rol'=>'candidato'],
            ['nombre'=>'Juan Torres','email'=>'juan@correo.com','password'=>bcrypt('candidato123'),'rol'=>'candidato'],
        ]);

        DB::table('vacantes')->insert([
            ['titulo'=>'Desarrollador Backend PHP','descripcion'=>'Se busca dev con experiencia en Laravel','empresa'=>'Empresa Tech','ubicacion'=>'CDMX','salario'=>25000,'id_reclutador'=>2],
            ['titulo'=>'Diseñador UX/UI','descripcion'=>'Creativo con Figma y Adobe XD','empresa'=>'Empresa Tech','ubicacion'=>'Guadalajara','salario'=>20000,'id_reclutador'=>2],
            ['titulo'=>'Administrador de Servidores Linux','descripcion'=>'Experiencia en Docker y redes','empresa'=>'RH Consultores','ubicacion'=>'Monterrey','salario'=>30000,'id_reclutador'=>3],
        ]);

        
        DB::table('perfiles')->insert([
            ['id_usuario'=>4,'telefono'=>'5512345678','direccion'=>'CDMX','experiencia'=>'2 años en desarrollo web','educacion'=>'Ing. Sistemas','habilidades'=>'PHP, Laravel, MySQL'],
            ['id_usuario'=>5,'telefono'=>'5534567890','direccion'=>'Guadalajara','experiencia'=>'1 año en diseño gráfico','educacion'=>'Lic. Diseño','habilidades'=>'Figma, Photoshop'],
            ['id_usuario'=>6,'telefono'=>'5545678901','direccion'=>'Monterrey','experiencia'=>'3 años en soporte','educacion'=>'TSU en Redes','habilidades'=>'Linux, Docker, Cisco'],
        ]);

        
        DB::table('postulaciones')->insert([
            ['id_usuario'=>4,'id_vacante'=>1,'cv'=>'cv_carlos.pdf','estado'=>'pendiente'],
            ['id_usuario'=>5,'id_vacante'=>2,'cv'=>'cv_maria.pdf','estado'=>'en revisión'],
            ['id_usuario'=>6,'id_vacante'=>3,'cv'=>'cv_juan.pdf','estado'=>'pendiente'],
        ]);
    }
}
