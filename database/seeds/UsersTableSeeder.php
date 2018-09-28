<?php

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // factory(App\Models\Users\User :: class, 20) -> create();
        // factory(App\Models\Users\User :: class, 'admin') -> create();

        DB::table('users')->delete();

        $users = [
            [
                'name' => 'Alex Chong',
                'email' => 'alex.chong@jobplus.sg',
                'password' => bcrypt('admin'),
                'profile_pic' => Gravatar::src('alex.chong@jobplus.sg'),
                'admin' => true,
            ],

            [
                'name' => 'Annie Tan',
                'email' => 'annie.tan@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('annie.tan@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Andy Tan',
                'email' => 'andy.tan@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('andy.tan@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Corine Tan',
                'email' => 'corine@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('corine@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Esther Koh',
                'email' => 'esther.koh@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('esther.koh@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Joan Tan',
                'email' => 'joan.tan@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('joan.tan@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Kelvin Lee',
                'email' => 'kelvin.lee@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('kelvin.lee@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Linda Lim',
                'email' => 'linda.lim@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('linda.lim@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Mavis Chia',
                'email' => 'mavis.chia@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('mavis.chia@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Elaine Ong',
                'email' => 'elaine.Ong@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('elaine.Ong@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Dave Maran',
                'email' => 'dave@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('dave@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Simmone Yeo',
                'email' => 'simmone.yeo@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('simmone.yeo@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Alex Chung',
                'email' => 'alexchung@jobplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('alexchung@jobplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Desmond Lee',
                'email' => 'desmond.lee@searchplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('desmond.lee@searchplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Ow Yew Wah',
                'email' => 'owyewwah@searchplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('owyewwah@searchplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Yvonne Chua',
                'email' => 'yvonne.chua@searchplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('yvonne.chua@searchplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Raji Nair',
                'email' => 'raji@searchplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('raji@searchplus.sg'),
                'admin' => false,
            ],

            [
                'name' => 'Daniel Pow',
                'email' => 'daniel.pow@searchplus.sg',
                'password' => bcrypt('123'),
                'profile_pic' => Gravatar::src('daniel.pow@searchplus.sg'),
                'admin' => false,
            ]

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
