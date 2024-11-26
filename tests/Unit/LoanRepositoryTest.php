<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Repositories\LoanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoanRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_loan()
    {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);

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

        $repository = new LoanRepository();
        $data = [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Prestado',
        ];

        $loan = $repository->create($data);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertEquals($user->id, $loan->user_id);
        $this->assertEquals($book->id, $loan->book_id);
        $this->assertEquals($loan->status, $loan->status);
    }

    public function test_can_get_all_loans()
    {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);
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
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Prestado',
        ]);

        $book2 = Book::create([
            'title' => 'Sample Book 2',
            'description' => 'Another test description',
            'isbn' => '987-654-321',
            'gender' => 'Non-fiction',
            'author_id' => $author->id,
            'status' => true
        ]);

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book2->id,
            'status' => 'Disponible',
        ]);

        $repository = new LoanRepository();
        $loans = $repository->getAll();

        $this->assertCount(5, $loans);
    }

    public function test_can_get_loan_by_id()
    {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);

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

        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Prestado',
        ]);

        $repository = new LoanRepository();
        $foundLoan = $repository->getById($loan->id);

        $this->assertEquals($loan->id, $foundLoan->id);
        $this->assertEquals($user->id, $foundLoan->user_id);
        $this->assertEquals($book->id, $foundLoan->book_id);
    }

    public function test_can_book_exist() {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);

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
        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Prestado',
        ]);

        $repository = new LoanRepository();
        $exists = $repository->BookExist($book->id);
        $this->assertTrue($exists);
    }

    public function test_can_update_loan()
    {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);

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

        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Prestado',
        ]);

        $repository = new LoanRepository();
        $repository->update($loan->id, ['status' => 'Perdido']);

        $updatedLoan = $repository->getById($loan->id);

        $this->assertEquals('Perdido',$updatedLoan->status);
    }

    public function test_can_delete_loan()
    {
        $user = User::create([
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ]);

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
        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'Perdido',
        ]);

        $repository = new LoanRepository();
        $this->assertTrue($repository->delete($loan->id));
        $this->assertDatabaseMissing('loans', ['id' => $loan->id]);
    }
}
