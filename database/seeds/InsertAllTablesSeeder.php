<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\District;
use App\Restaurant;
use App\Dish;
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
        Dish::truncate();
        User::truncate();
        Role::truncate();
        District::truncate();
        Category::truncate();
        Category_dish::truncate();
        Asigned_role::truncate();

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador general',
            'description' => 'El administrador general lo puede todo',
        ]);
        Role::create([
            'name' => 'admin-restaurant',
            'display_name' => 'Administrador del restaurante',
            'description' => 'Solo Administrador del restaurante',
        ]);
        Role::create([
            'name' => 'vendedor-restaurant',
            'display_name' => 'Vendedor del restaurante',
            'description' => 'Persona que confirma pedidos en el restaurante',
        ]);

        District::create([
            'name' => 'Lince'
        ]);
        District::create([
            'name' => 'Cercado de Lima'
        ]);
        District::create([
            'name' => 'Miraflores'
        ]);
        District::create([
            'name' => 'San Isidro'
        ]);
        District::create([
            'name' => 'Breña'
        ]);
        District::create([
            'name' => 'Comas'
        ]);
        District::create([
            'name' => 'Jesus Maria'
        ]);
        District::create([
            'name' => 'Los Olivos'
        ]);
        District::create([
            'name' => 'Rimac'
        ]);
        District::create([
            'name' => 'Otro'
        ]);

        //Categoria 1
        Category::create([
            'name' => 'Tradicional',
            'description' => 'Restaurantes tradicionales, comida criolla y nacional',
        ]);
        //Categoria 2
        Category::create([
            'name' => 'Vegetariano',
            'description' => 'Para personas veganas, los mejores restaurantes vegetarianos',
        ]);
        //Categoria 3
        Category::create([
            'name' => 'Japones',
            'description' => 'Restautantes de comida japonesa',
        ]);
        //Categoria 4
        Category::create([
            'name' => 'Restaurante Bar',
            'description' => 'Restaurantes Bar',
        ]);
        //Categoria 5
        Category::create([
            'name' => 'Buffet',
            'description' => 'Los mejores restaurantes buffets',
        ]);
        //Categoria 6
        Category::create([
            'name' => 'Restaurante Hotel',
            'description' => 'Restaurantes hotel elegantes y acojedores',
        ]);
        //Categoria 7
        Category::create([
            'name' => 'Museo Restaurante',
            'description' => 'Restaurantes museos muy elegantes',
        ]);
        //Categoria 8
        Category::create([
            'name' => 'Otro',
            'description' => 'Otro tipo de restaurantes',
        ]);


        Category_dish::create([
            'name' => 'Entrada',
            'description' => 'Plato de entrada',
        ]);
        Category_dish::create([
            'name' => 'Segundo',
            'description' => 'Plato principal',
        ]);
        Category_dish::create([
            'name' => 'Bebida',
            'description' => 'Bebida',
        ]);
        Category_dish::create([
            'name' => 'Postre',
            'description' => 'Postre',
        ]);
        Category_dish::create([
            'name' => 'Reserva',
            'description' => 'Reserva',
        ]);

        // Usuario N1
        User::create([
            'name' => 'admin',
            'surname' => 'Administrador general',
            'email' => 'admin@nodrys.com',
            'password' => bcrypt('adminvb00'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'avatar_default.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 10,
        ]);

        Asigned_role::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        // Usuario N2
        User::create([
            'name' => 'Beimer',
            'surname' => 'Rodriguez Campos',
            'email' => 'beimer@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '958632415',
            'address' => 'Jr Enrique Barrón 1038',
            'image' => 'avatar_default.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 1,
        ]);

        // Usuario N3
        User::create([
            'name' => 'Jairo',
            'surname' => 'Lachira Torres',
            'email' => 'jairo@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '958051477',
            'address' => 'Jr La Paz 874',
            'image' => 'avatar_default.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 1,
        ]);

        // Usuario N4
        User::create([
            'name' => 'Cristhian',
            'surname' => 'Huayanay',
            'email' => 'cristhian@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '975863241',
            'address' => 'Calle Torres Mz 8 Lte 95',
            'image' => 'avatar_default.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 2,
        ]);

        // Usuario N5
        User::create([
            'name' => 'Manuel',
            'surname' => 'Santos Chocano',
            'email' => 'manuel@gmail.com',
            'password' => bcrypt('123456'),
            'telephone' => '963852741',
            'address' => 'Calle Bolivar Mz 5 Lte 20',
            'image' => 'avatar_default.png',
            'points' => 0,
            'state' => 1,
            'district_id' => 2,
        ]);

        // Restaurante N1
        Restaurant::create([
            'name' => 'La Cucharita Tapas Bar',
            'description' => 'En Lima-Perú se encuentra La Cucharita Tapas Bar, un restaurante especializado en las tapas tradicionales españolas y en el que Don Santiago Sparrow Uranga da la bienvenida a todo aquel que quiera disfrutar de las delicias de la gastronomía de España',
            'slogan' => 'Comida peruana',
            'address' => 'Av. Mariscal la Mar 1200',
            'telephone' => '987678412',
            'assessment' => 0,
            'points' => 50,
            'district_id' => 1,
            'category_id' => 1,
            'image' => 'restaurante-la-cucharita-tapas-bar.jpg',
            'user_id' => 6,
            'ruc'=>'12345678910',
            'longitude'=>'-77.022294',
            'latitude'=>'-12.077509'
        ]);

        // Usuario N6
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'la-cucharita@nodrys.com',
            'password' => bcrypt('lacuchara123'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 1,
        ]);

        Asigned_role::create([
            'user_id' => 6,
            'role_id' => 2,
        ]);

        // Restaurante N2
        Restaurant::create([
            'name' => 'Akasuka',
            'description' => 'El restaurante de cocina japonesa Asakusa es un sushi bar situado en el barrio de San Borja en Lima. Asakusa ofrece una nueva opción para los amantes de la comida japonesa en una natural fusión con la cocina peruana.',
            'slogan' => 'Comida Japonesa',
            'address' => 'Av. Javier Prado Este 2994',
            'telephone' => '987452635',
            'assessment' => 0,
            'points' => 100,
            'district_id' => 2,
            'category_id' => 3,
            'image' => 'restaurante-akasuka.png',
            'user_id' => 7,
            'ruc'=>'12345678911',
            'longitude'=>'-77.02529',
            'latitude'=>'-12.074697'
        ]);

        // Usuario N7
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'akasuka@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 2,
        ]);

        Asigned_role::create([
            'user_id' => 7,
            'role_id' => 2,
        ]);

        // Restaurante N3
        Restaurant::create([
            'name' => 'Hotel B',
            'description' => 'En el barrio limeño de Barranco se halla el restaurante Hotel B. La cocina moderna, detallista y con variadas influencias es la carta de presentación de este restaurante.',
            'slogan' => 'Elegante Restaurante Hotel',
            'address' => 'Saenz Peña 204',
            'telephone' => '998752632',
            'assessment' => 0,
            'points' => 80,
            'district_id' => 3,
            'category_id' => 6,
            'image' => 'restaurante-hotel-b.png',
            'user_id' => 8,
            'ruc'=>'12345678912',
            'longitude'=>'-77.035799',
            'latitude'=>'-12.083637'
        ]);

        // Usuario N8
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'hotel-b@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 6,
        ]);

        Asigned_role::create([
            'user_id' => 8,
            'role_id' => 2,
        ]);

        // Restaurante N4
        Restaurant::create([
            'name' => 'Las Palmeras',
            'description' => 'El Restaurante” Las Palmeras”, ubicado en el hotel Sheraton, es un estupendo lugar para disfrutar de la gastronomía peruana, reconocida a nivel mundial.',
            'slogan' => 'Hotel Sheraton Lima',
            'address' => 'Av. Paseo de la República 170',
            'telephone' => '985632452',
            'assessment' => 0,
            'points' => 50,
            'district_id' => 5,
            'category_id' => 6,
            'image' => 'restaurante-las-palmeras.png',
            'user_id' => 9,

            'ruc'=>'12345678913',
            'longitude'=>'-77.035259',
            'latitude'=>'-12.086825'
        ]);

        // Usuario N9
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'las-palmeras@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 5,
        ]);

        Asigned_role::create([
            'user_id' =>9,
            'role_id' => 2,
        ]);

        // Restaurante N5
        Restaurant::create([
            'name' => 'La Piccolina',
            'description' => 'Instalado en el Parque de la Amistad Surco se encuentra el restaurante La Piccolina (Parque de la Amistad). Este local ofrece una selección de la cocina de Italia, aportando todo un abanico de diversos sabores y aromas que rememoran la clásica cocina de la nonna.',
            'slogan' => 'Parque de la Amistad',
            'address' => 'Av. Caminos del Inca, cuadra 21 S/N',
            'telephone' => '987521452',
            'assessment' => 0,
            'points' => 70,
            'district_id' => 6,
            'category_id' => 5,
            'image' => 'restaurante-la-piccolina.jpg',
            'user_id' => 10,
            'ruc'=>'12345678914',
            'longitude'=>'-77.027795',
            'latitude'=>'-12.084475'
        ]);

        // Usuario N10
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'piccolina@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 6,
        ]);

        Asigned_role::create([
            'user_id' =>10,
            'role_id' => 2,
        ]);

        // Restaurante N6
        Restaurant::create([
            'name' => '305 Sur',
            'description' => 'Ubicado en Barranco, el barrio culturalmente más rico de Lima, con una oferta gastronómica espectacular, y con hermosos malecones y callejuelas, se encuentra 305 Sur.',
            'slogan' => 'Restaurante Bar',
            'address' => 'Calle Felipe Pardo 147',
            'telephone' => '987412365',
            'assessment' => 0,
            'points' => 100,
            'district_id' => 7,
            'category_id' => 4,
            'image' => 'restaurante_305-sur_barranco.jpg',
            'user_id' => 11,

            'ruc'=>'12345678915',
            'longitude'=>'-77.031354',
            'latitude'=>'-12.084098'
        ]);

        // Usuario N11
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => '305-sur@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 7,
        ]);

        Asigned_role::create([
            'user_id' =>11,
            'role_id' => 2,
        ]);

        // Restaurante N7
        Restaurant::create([
            'name' => 'La Trastienda',
            'description' => 'La Trastienda está localizado en el sector de Barranco, exactamente sobre la Costa Verde. Sus platos son la excusa perfecta para que podamos disfrutar de su mágica vista al mar, una ubicación privilegiada que distingue aún más al restaurante.',
            'slogan' => 'Restaurante Elegante',
            'address' => 'Av. Costa Verde s/n Playa Las Cascadas',
            'telephone' => '987452630',
            'assessment' => 0,
            'points' => 90,
            'district_id' => 7,
            'category_id' => 4,
            'image' => 'restaurante_la-trastienda_barranco_jpg3.jpg',
            'user_id' => 12,
            'ruc'=>'12345678916',
            'longitude'=>'-77.023335',
            'latitude'=>'-12.082714'
        ]);

        // Usuario N12
        User::create([
            'name' => 'user',
            'surname' => 'restaurante',
            'email' => 'trastienda@nodrys.com',
            'password' => bcrypt('123456'),
            'telephone' => 'null',
            'address' => 'null',
            'image' => 'null',
            'points' => 0,
            'state' => 1,
            'district_id' => 7,
        ]);

        Asigned_role::create([
            'user_id' =>12,
            'role_id' => 2,
        ]);

        // Platos
        Dish::create([
            'name'=>'reserva',
            'price'=>'3.30',
            'time'=>'1',
            'image'=>'reserva-81818.png',
            'category_dish'=>5,
            'restaurant_id'=>1
        ]);

        // Platos
        Dish::create([
            'name'=>'Ceviche',
            'price'=>'20.30',
            'time'=>'10',
            'image'=>'1553978205ceviche-piura.jpg',
            'category_dish'=>1,
            'restaurant_id'=>1
        ]);

        //RESTAURANT LAS PALMERAS
         Dish::create([
            'name'=>'Arroz a la chiclayana',
            'price'=>'18.99',
            'time'=>'10',
            'image'=>'arrozAlaChiclayana.jpg',
            'category_dish'=>1,
            'restaurant_id'=>2
        ]);

        Dish::create([
            'name'=>'Arroz chaufa peruano',
            'price'=>'17.55',
            'time'=>'10',
            'image'=>'arrozChaufaPeruano.jpg',
            'category_dish'=>1,
            'restaurant_id'=>2
        ]);
       Dish::create([
            'name'=>'Cau - Cau',
            'price'=>'13.99',
            'time'=>'10',
            'image'=>'caucau.jpg',
            'category_dish'=>1,
            'restaurant_id'=>2
        ]);
         Dish::create([
            'name'=>'Causa a la limeña',
            'price'=>'6.88',
            'time'=>'10',
            'image'=>'causaLimena.jpg',
            'category_dish'=>1,
            'restaurant_id'=>4
        ]);
        Dish::create([
            'name'=>'Ceviche',
            'price'=>'20.30',
            'time'=>'10',
            'image'=>'1553978205ceviche-piura.jpg',
            'category_dish'=>1,
            'restaurant_id'=>4
        ]);

        Dish::create([
            'name'=>'Coliflor con sésamo',
            'price'=>'28.99',
            'time'=>'10',
            'image'=>'coliflorConSesamo.jpg',
            'category_dish'=>2,
            'restaurant_id'=>4
        ]);
        Dish::create([
            'name'=>'Espárragos trigueros con vinagre balsámico y tomate',
            'price'=>'35.55',
            'time'=>'10',
            'image'=>'esparragoTriguero.jpg',
            'category_dish'=>2,
            'restaurant_id'=>4
        ]);
        Dish::create([
            'name'=>'Tartaletas de queso de cabra con cebolla carmelizada',
            'price'=>'32.55',
            'time'=>'10',
            'image'=>'tartaletaQueso.jpg',
            'category_dish'=>2,
            'restaurant_id'=>1
        ]);
        Dish::create([
            'name'=>'Tabule de quinua',
            'price'=>'39',
            'time'=>'10',
            'image'=>'tabuleQuinua.jpg',
            'category_dish'=>2,
            'restaurant_id'=>1
        ]);
        Dish::create([
            'name'=>'Tostadas de champiñones al ajillo',
            'price'=>'28.99',
            'time'=>'10',
            'image'=>'tostadasChampinones.jpg',
            'category_dish'=>2,
            'restaurant_id'=>1
        ]);


        //Restaurante pil¿colina
         Dish::create([
            'name'=>'Chupe de camarones',
            'price'=>'37.00',
            'time'=>'10',
            'image'=>'chupeCamarones.jpg',
            'category_dish'=>1,
            'restaurant_id'=>5
        ]);

        Dish::create([
            'name'=>'Empanadas rellenas',
            'price'=>'15.99',
            'time'=>'10',
            'image'=>'empanadasRellenas.jpg',
            'category_dish'=>1,
            'restaurant_id'=>5
        ]);
       Dish::create([
            'name'=>'Escabeche',
            'price'=>'17.11',
            'time'=>'10',
            'image'=>'escabeche.jpg',
            'category_dish'=>1,
            'restaurant_id'=>5
        ]);
         Dish::create([
            'name'=>'Juane peruano',
            'price'=>'19.88',
            'time'=>'10',
            'image'=>'juanePeruano.jpg',
            'category_dish'=>1,
            'restaurant_id'=>5
        ]);
        Dish::create([
            'name'=>'Lomo saltado',
            'price'=>'18.30',
            'time'=>'10',
            'image'=>'lomoSaltso.jpg',
            'category_dish'=>1,
            'restaurant_id'=>5
        ]);




        Dish::create([
            'name'=>'Muffins de calabaza',
            'price'=>'19.99',
            'time'=>'10',
            'image'=>'muffinsCalabaza.jpg',
            'category_dish'=>2,
            'restaurant_id'=>5
        ]);
        Dish::create([
            'name'=>'Revuelto de boniatos	caramelizados con manzana',
            'price'=>'35.55',
            'time'=>'10',
            'image'=>'revueltoBoniatos.jpg',
            'category_dish'=>2,
            'restaurant_id'=>3
        ]);
        Dish::create([
            'name'=>'Ensalada caprese de melocotón',
            'price'=>'38.00',
            'time'=>'10',
            'image'=>'ensaladaCaprese.jpg',
            'category_dish'=>2,
            'restaurant_id'=>3
        ]);
        Dish::create([
            'name'=>'Hummus auténtico',
            'price'=>'16.98',
            'time'=>'10',
            'image'=>'ummus.jpg',
            'category_dish'=>2,
            'restaurant_id'=>3
        ]);
        Dish::create([
            'name'=>'Paella de verduras',
            'price'=>'30.99',
            'time'=>'10',
            'image'=>'paella.jpg',
            'category_dish'=>2,
            'restaurant_id'=>3
        ]);
        //platos 305 sur
        Dish::create([
            'name'=>'Tartare de carne',
            'price'=>'15.99',
            'time'=>'17',
            'image'=>'TARTARE DE CARNE.jpg',
            'category_dish'=>1,
            'restaurant_id'=>6
        ]);
        Dish::create([
            'name'=>'Pulpo a la brasa con yuca al carbon',
            'price'=>'26.99',
            'time'=>'21',
            'image'=>'PULPO A LAS BRASAS CON YUCA AL CARBÓN.jpg',
            'category_dish'=>2,
            'restaurant_id'=>6
        ]);
        Dish::create([
            'name'=>'Tiradito pesca del día y pulpo',
            'price'=>'18.99',
            'time'=>'19',
            'image'=>'TIRADITO PESCA DEL DÍA Y PULPO.jpg',
            'category_dish'=>2,
            'restaurant_id'=>6
        ]);
        Dish::create([
            'name'=>'Gyozas de coditos de cerdo',
            'price'=>'35.99',
            'time'=>'29',
            'image'=>'GYOZAS DE CODITOS DE CERDO.jpg',
            'category_dish'=>2,
            'restaurant_id'=>6
        ]);

        //La trasstienda
        Dish::create([
            'name'=>'Cebiche de lenguado clásico ',
            'price'=>'15.99',
            'time'=>'12',
            'image'=>'Cebiche de lenguado clásico.jpg',
            'category_dish'=>1,
            'restaurant_id'=>7
        ]);
        Dish::create([
            'name'=>'Arroz con pato a la sartén',
            'price'=>'22.99',
            'time'=>'17',
            'image'=>'Arroz con pato a la sartén.jpg',
            'category_dish'=>2,
            'restaurant_id'=>7
        ]);
        Dish::create([
            'name'=>'Lomo de novillo al jugo',
            'price'=>'18.99',
            'time'=>'16',
            'image'=>'Lomo de novillo al jugo.jpg',
            'category_dish'=>2,
            'restaurant_id'=>7
        ]);
        Dish::create([
            'name'=>'Arroz con conchas a la criolla',
            'price'=>'23.99',
            'time'=>'21',
            'image'=>'Arroz con conchas a la criolla.jpg',
            'category_dish'=>2,
            'restaurant_id'=>7
        ]);

    }
}
