<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Rol;

class UsersRepositoryTest extends TestCase {

    use DatabaseTransactions;

    public function test_can_create_user(){

        $repository = new UserRepository();

        $rol = Rol::create([
            'rol' => 1
        ]);

        $data = [
            'name' => "cristina",
            'email' => "cristina@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ];

        $user = $repository->create($data);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id, $user->id);
        $this->assertEquals($user->name, $user->name);
        $this->assertEquals($user->rol_id, $user->rol_id);
        $this->assertEquals($user->password, $user->password);
    }

    public function test_can_get_all_users(){
        $rol = Rol::create([
            'rol' => 1
        ]);
        $user = User::create([
            'name' => "angela",
            'email' => "angela@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => "ioana",
            'email' => "ioana@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => "ricardo",
            'email' => "ricardo@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => "alexa",
            'email' => "alexa@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);

        $repository = new UserRepository();
        $users = $repository->getAll();
        $this->assertCount(4, $users);

    }

    public function test_can_get_user_by_id(){
        $repository = new UserRepository();
        $rol = Rol::create([
            'rol' => 1
        ]);
        $user = User::create([
            'name' => "angela",
            'email' => "angela@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $Founduser = $repository->getById($user->id);

        $this->assertEquals($Founduser ->id, $user->id);
        $this->assertEquals($Founduser ->name, $user->name);
        $this->assertEquals($Founduser ->email, $user->email);
        $this->assertEquals($Founduser ->rol_id, $user->rol_id);
        $this->assertEquals($Founduser ->password, $user->password);
    }

    public function test_can_get_user_clients(){
        $rol = Rol::create([
            'rol' => 1
        ]);
        $rol2 = Rol::create([
            'rol' => 2
        ]);
        $user = User::create([
            'name' => "fernanada",
            'email' => "fernanda@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => "angela",
            'email' => "angela@gmail.com",
            'rol_id' => $rol2->id,
            'password'=>bcrypt('12345678')
        ]);
        $user = User::create([
            'name' => "ioana",
            'email' => "ioana@gmail.com",
            'rol_id' =>  $rol2->id,
            'password'=>bcrypt('12345678')
        ]);

        $repository = new UserRepository();
        $users = $repository->getClients();
        $this->assertCount(2, $users);
    }

    public function test_can_update_user(){
        $repository = new UserRepository();
        $rol = Rol::create([
            'rol' => 1
        ]);
        $rol2 = Rol::create([
            'rol' => 2
        ]);
        $user = User::create([
            'name' => "fernanada",
            'email' => "fernanda@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $repository->update($user->id,['rol_id' => 2]);
        $Founduser = $repository->getById($user->id);

        $this->assertEquals("2", $Founduser->rol_id);

    }

    public function test_can_delete_user(){
        $rol = Rol::create([
            'rol' => 1
        ]);
        $user = User::create([
            'name' => "fernanada",
            'email' => "fernanda@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);
        $repository = new UserRepository();
        $this->assertTrue($repository->delete($user->id));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }


}
