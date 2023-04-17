<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //esto es para gernerar usuarios desde la biblioteca de datos falsos de laravel 
        //primero crear el seeder config con los campos añadidos en la tabla user , importar el modelo user y configurar para que se creen 10 usualarios aleatoriamente configuardo en el seeder
        // Crear un usuario predeterminado QUE SERA ADMIN para acceder a la base de datos 
         User::create([
           
            'name' => 'Usuariouno',
            'email' => 'usuariouno@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('usuariouno'), // password
            'cedula'=>'27121985',
            'address' => 'calle Orense Madrid',
            //PHONE VIENE DE LA LIBRERIA DE DATOS FALSOS DE LARAVEL
            'phone' => '123456789',
            'role' => 'admin',

         ]);


        User::factory()
        ->count(10)
        ->create();

    }
}
