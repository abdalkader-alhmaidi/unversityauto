<?php
use App\Category;
use App\Room;
use App\Matrial;
use App\User;
use App\Role;
use App\Booking;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $cat= factory(Category::class,15)->create();
         
         factory(Room::class,10)->create();
         factory(Matrial::class,5)->create();
         factory(Role::class,1)->create();
         factory(Role::class)->create(['name'=>'doctor']);
         factory(Role::class)->create(['name'=>'admin']);
         factory(Role::class)->create(['name'=>'Group admin']);
        factory(User::class,20)->create();
        
          factory(Booking::class,4)->create();


          $users = factory(App\User::class, 3)
           ->create()
           ->each(function ($user) {
                $user->matrials()->save(factory(App\Matrial::class)->make());
            });
        // dd($cat);

    }
}
