<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Book;
use App\Repositories\BooksRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_book()
    {
        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        $repository = new BooksRepository();
        $data = [
            'title' => 'Sample Book',
            'description' => 'A test description',
            'isbn' => '123-456-789',
            'gender' => 'Fiction',
            'author_id' => $author->id,
            'status' => true,
        ];

        $book = $repository->create($data);

        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals('Sample Book', $book->title);
        $this->assertEquals($author->id, $book->author_id);
    }

    public function test_can_get_all_books()
    {
        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        Book::create(['title' => 'Book 1', 'description' => 'Desc 1', 'isbn' => '111-111-111', 'gender' => 'Fiction', 'author_id' => $author->id, 'status' => true]);
        Book::create(['title' => 'Book 2', 'description' => 'Desc 2', 'isbn' => '222-222-222', 'gender' => 'Non-fiction', 'author_id' => $author->id, 'status' => true]);

        $repository = new BooksRepository();
        $books = $repository->getAll();

        $this->assertCount(2, $books);
    }

    public function test_can_get_book_by_id()
    {
        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        $book = Book::create([
            'title' => 'Sample Book',
            'description' => 'A test description',
            'isbn' => '123-456-789',
            'gender' => 'Fiction',
            'author_id' => $author->id,
            'status' => true,
        ]);

        $repository = new BooksRepository();
        $foundBook = $repository->getById($book->id);

        $this->assertEquals($book->id, $foundBook->id);
        $this->assertEquals($author->id, $foundBook->author_id);
    }

    public function test_can_update_book()
    {
        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        $book = Book::create([
            'title' => 'Sample Book',
            'description' => 'A test description',
            'isbn' => '123-456-789',
            'gender' => 'Fiction',
            'author_id' => $author->id,
            'status' => true,
        ]);

        $repository = new BooksRepository();
        $repository->update($book->id, ['title' => 'Updated Book']);

        $updatedBook = $repository->getById($book->id);

        $this->assertEquals('Updated Book', $updatedBook->title);
    }

    public function test_can_delete_book()
    {
        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        $book = Book::create([
            'title' => 'Sample Book',
            'description' => 'A test description',
            'isbn' => '123-456-789',
            'gender' => 'Fiction',
            'author_id' => $author->id,
            'status' => true,
        ]);

        $repository = new BooksRepository();
        $this->assertTrue($repository->delete($book->id));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
