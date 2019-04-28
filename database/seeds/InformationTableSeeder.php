<?php

use App\Models\User;
use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = $this->getUsersInRandomOrder();
        foreach($users as $user) {
            factory(Information::class)->create([
                'user_id' => $user->id
            ]);
        }
        
    }

    public function getUsersInRandomOrder()
    {
        $users = User::inRandomOrder()->get();
        return $users;
    }
}
