<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some predefined books
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'published_date' => '1925-04-10',
                'quantity' => 5,
                'category' => 'Fiction',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780446310789',
                'published_date' => '1960-07-11',
                'quantity' => 3,
                'category' => 'Fiction',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'published_date' => '1949-06-08',
                'quantity' => 4,
                'category' => 'Science Fiction',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Create additional random books
        Book::factory(10)->create();
    }
} 