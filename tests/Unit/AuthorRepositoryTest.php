<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_author()
    {
        $repository = new AuthorRepository();
        $data = [
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ];

        $author = $repository->create($data);

        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals('John', $author->name);
    }

    public function test_can_get_all_authors()
    {
        // Crear autores manualmente
        Author::create(['name' => 'Author 1', 'lastname' => 'Lastname 1', 'address' => 'Address 1', 'city' => 'City 1']);
        Author::create(['name' => 'Author 2', 'lastname' => 'Lastname 2', 'address' => 'Address 2', 'city' => 'City 2']);
        Author::create(['name' => 'Author 3', 'lastname' => 'Lastname 3', 'address' => 'Address 3', 'city' => 'City 3']);

        $repository = new AuthorRepository();
        $authors = $repository->getAll();

        $this->assertCount(6, $authors);
    }

    public function test_can_get_author_by_id()
    {
        // Crear un autor manualmente
        $author = Author::create(['name' => 'John', 'lastname' => 'Doe', 'address' => '123 Main St', 'city' => 'New York']);
        $repository = new AuthorRepository();
        $foundAuthor = $repository->getById($author->id);

        $this->assertEquals($author->id, $foundAuthor->id);
    }

    public function test_can_update_author()
    {
        // Crear un autor manualmente
        $author = Author::create(['name' => 'John', 'lastname' => 'Doe', 'address' => '123 Main St', 'city' => 'New York']);
        $repository = new AuthorRepository();

        $repository->update($author->id, ['name' => 'Updated Name']);
        $updatedAuthor = $repository->getById($author->id);

        $this->assertEquals('Updated Name', $updatedAuthor->name);
    }

    public function test_can_delete_author()
    {
        // Crear un autor manualmente
        $author = Author::create(['name' => 'John', 'lastname' => 'Doe', 'address' => '123 Main St', 'city' => 'New York']);
        $repository = new AuthorRepository();

        $this->assertTrue($repository->delete($author->id));
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
