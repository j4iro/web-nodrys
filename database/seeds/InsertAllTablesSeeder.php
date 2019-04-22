<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\District;
use App\Restaurant;
use App\Category;
use App\Category_dish;
use App\User;
use App\Asigned_role;

class InsertAllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::truncate();
        User::truncate();
        Role::truncate();
        District::truncate();
        Category::truncate();
        Category_dish::truncate();
        Asigned_role::truncate();

        Role::create([
            'name' => 'admin',
            'display_name' => 'admin',
            'description' => 'Administrador general de todo el sistema',
        ]);
        Role::create([
            'name' => 'admin-restaurant',
            'display_name' => 'Administrador del restaurante',
            'description' => 'Solo Administrador del restaurante',
        ]);
        Role::create([
            'name' => 'vendedor',
            'display_name' => 'Vendedor del restaurante',
            'description' => 'Persona que confirma pedidos en el restaurante',
        ]);

        District::create([
            'name' => 'Lince',
            'description' => 'Lima Norte',
        ]);
        District::create([
            'name' => 'Cercado de Lima',
            'description' => 'Lima Norte',
        ]);
        District::create([
            'name' => 'Miraflores',
            'description' => 'Lima Norte',
        ]);


        Category::create([
            'name' => 'Tradicional',
            'description' => 'Tradicional',
        ]);
        Category::create([
            'name' => 'Vegetariano',
            'description' => 'Vegetariano',
        ]);
        Category::create([
            'name' => 'Restaurante Bar',
            'description' => 'Restaurante Bar',
        ]);


        Category_dish::create([
            'name' => 'Entrada',
            'description' => 'Entrada',
        ]);
        Category_dish::create([
            'name' => 'Segundo',
            'description' => 'Segundo',
        ]);
        Category_dish::create([
            'name' => 'Bebida',
            'description' => 'Bebida',
        ]);


        User::create([
            'name' => 'Esmith',
            'surname' => 'Alama Ramos',
            'email' => 'noe@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '95816381',
            'address' => 'Lince - Manuel Candamo 854',
            'image' => 'default_avatar.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 1
        ]);

        User::create([
            'name' => 'Beimer',
            'surname' => 'Rodriguez Campos',
            'email' => 'beimer@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '95816815',
            'address' => 'Cercado - Manuel Candamo 541',
            'image' => 'default_avatar.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 2
        ]);

        Restaurant::create([
            'name' => 'Embarcadero 41',
            'descripction' => 'Restaurante Criollo',
            'slogan' => 'Slogan',
            'address' => 'Lince - Manuel Candamo',
            'telephone' => '95816815',
            'assessment' => 0,
            'points' => 10,
            'district_id' => 1,
            'category_id' => 1,
            'image' => 'embarcadero41.jpg',
        ]);

        Asigned_role::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        Asigned_role::create([
            'user_id' => 2,
            'role_id' => 2,
        ]);



    }
}
