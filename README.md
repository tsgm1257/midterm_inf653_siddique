# midterm_inf653_siddique

# Quotes API

This is a REST API built with PHP and PostgreSQL for managing quotes, authors, and categories. It provides CRUD (Create, Read, Update, Delete) operations for each resource.

## Features

- **Quotes Management:**
  - Retrieve all quotes with author and category names.
  - Retrieve a single quote by ID.
  - Create, update, and delete quotes.
- **Authors Management:**
  - Retrieve all authors.
  - Retrieve a single author by ID.
  - Create, update, and delete authors.
- **Categories Management:**
  - Retrieve all categories.
  - Retrieve a single category by ID.
  - Create, update, and delete categories.
- **JSON Responses:** All API responses are in JSON format.
- **CORS Support:** Cross-Origin Resource Sharing (CORS) is enabled to allow requests from any origin.
- **Clean URLs:** Uses `.htaccess` for clean and user-friendly URLs.
- **Error Handling:** Provides appropriate error messages for missing parameters and not found resources.

## Technologies Used

- **PHP:** Backend logic.
- **PostgreSQL:** Database.
- **.htaccess:** URL rewriting.
- **JSON:** Data exchange format.

## Setup

1.  **Clone the repository:**

    ```bash
    git clone <repository_url>
    ```

2.  **Database Setup:**

    - Create a PostgreSQL database named `quotesdb`.
    - Update the database credentials in `Database.php` with your database username and password.

3.  **Database Tables:**

    - Run the SQL script provided below to create the necessary tables and populate initial data.

4.  **SQL for Table Creation and Population:**

    ```sql
    -- Create the authors table
    CREATE TABLE authors (
        id SERIAL PRIMARY KEY,
        author VARCHAR NOT NULL
    );

    -- Create the categories table
    CREATE TABLE categories (
        id SERIAL PRIMARY KEY,
        category VARCHAR NOT NULL
    );

    -- Create the quotes table
    CREATE TABLE quotes (
        id SERIAL PRIMARY KEY,
        quote TEXT NOT NULL,
        author_id INTEGER NOT NULL REFERENCES authors(id),
        category_id INTEGER NOT NULL REFERENCES categories(id)
    );

    -- Insert Categories
    INSERT INTO categories (category) VALUES
    ('Inspirational'), ('Motivational'), ('Philosophical'), ('Humorous'), ('Love'), ('Wisdom'), ('Life'), ('Success');

    -- Insert Authors
    INSERT INTO authors (author) VALUES
    ('Albert Einstein'), ('Oscar Wilde'), ('Mark Twain'), ('Friedrich Nietzsche'), ('Jane Austen'), ('Maya Angelou'), ('Confucius'), ('Nelson Mandela');

    -- Insert Quotes
    INSERT INTO quotes (quote, author_id, category_id) VALUES
    ('The only way to do great work is to love what you do.',
    (SELECT id FROM authors WHERE author = 'Albert Einstein'),
    (SELECT id FROM categories WHERE category = 'Motivational')),

    ('Be yourself; everyone else is already taken.',
    (SELECT id FROM authors WHERE author = 'Oscar Wilde'),
    (SELECT id FROM categories WHERE category = 'Philosophical')),

    ('The truth is rarely pure and never simple.',
    (SELECT id FROM authors WHERE author = 'Oscar Wilde'),
    (SELECT id FROM categories WHERE category = 'Wisdom')),

    ('If you tell the truth, you don''t have to remember anything.',
    (SELECT id FROM authors WHERE author = 'Mark Twain'),
    (SELECT id FROM categories WHERE category = 'Humorous')),

    ('That which does not kill us makes us stronger.',
    (SELECT id FROM authors WHERE author = 'Friedrich Nietzsche'),
    (SELECT id FROM categories WHERE category = 'Motivational')),

    ('There is no charm equal to tenderness of heart.',
    (SELECT id FROM authors WHERE author = 'Jane Austen'),
    (SELECT id FROM categories WHERE category = 'Love')),

    ('The journey of a thousand miles begins with a single step.',
    (SELECT id FROM authors WHERE author = 'Confucius'),
    (SELECT id FROM categories WHERE category = 'Inspirational')),

    ('The greatest glory in living lies not in never falling, but in rising every time we fall.',
    (SELECT id FROM authors WHERE author = 'Nelson Mandela'),
    (SELECT id FROM categories WHERE category = 'Success')),

    ('Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world.',
    (SELECT id FROM authors WHERE author = 'Albert Einstein'),
    (SELECT id FROM categories WHERE category = 'Wisdom')),

    ('To live is the rarest thing in the world. Most people exist, that is all.',
    (SELECT id FROM authors WHERE author = 'Oscar Wilde'),
    (SELECT id FROM categories WHERE category = 'Life')),

    ('The secret of getting ahead is getting started.',
    (SELECT id FROM authors WHERE author = 'Mark Twain'),
    (SELECT id FROM categories WHERE category = 'Motivational')),

    ('He who has a why to live can bear almost any how.',
    (SELECT id FROM authors WHERE author = 'Friedrich Nietzsche'),
    (SELECT id FROM categories WHERE category = 'Philosophical')),

    ('One half of knowing what you want is knowing what you must give up before you get it.',
    (SELECT id FROM authors WHERE author = 'Jane Austen'),
    (SELECT id FROM categories WHERE category = 'Wisdom')),

    ('You may encounter many defeats, but you must not be defeated.',
    (SELECT id FROM authors WHERE author = 'Maya Angelou'),
    (SELECT id FROM categories WHERE category = 'Inspirational')),

    ('Wherever you go, go with all your heart.',
    (SELECT id FROM authors WHERE author = 'Confucius'),
    (SELECT id FROM categories WHERE category = 'Love')),

    ('It always seems impossible until it''s done.',
    (SELECT id FROM authors WHERE author = 'Nelson Mandela'),
    (SELECT id FROM categories WHERE category = 'Success')),

    ('Try not to become a man of success. Rather become a man of value.',
    (SELECT id FROM authors WHERE author = 'Albert Einstein'),
    (SELECT id FROM categories WHERE category = 'Life')),

    ('We are all in the gutter, but some of us are looking at the stars.',
    (SELECT id FROM authors WHERE author = 'Oscar Wilde'),
    (SELECT id FROM categories WHERE category = 'Philosophical')),

    ('Good friends, good books, and a sleepy conscience: this is the ideal life.',
    (SELECT id FROM authors WHERE author = 'Mark Twain'),
    (SELECT id FROM categories WHERE category = 'Humorous')),

    ('That which is done from love always occurs beyond good and evil.',
    (SELECT id FROM authors WHERE author = 'Friedrich Nietzsche'),
    (SELECT id FROM categories WHERE category = 'Love')),

    ('There is nothing like staying at home for real comfort.',
    (SELECT id FROM authors WHERE author = 'Jane Austen'),
    (SELECT id FROM categories WHERE category = 'Life')),

    ('Nothing will work unless you do.',
    (SELECT id FROM authors WHERE author = 'Maya Angelou'),
    (SELECT id FROM categories WHERE category = 'Motivational')),

    ('What the superior man seeks is in himself; what the small man seeks is in others.',
    (SELECT id FROM authors WHERE author = 'Confucius'),
    (SELECT id FROM categories WHERE category = 'Wisdom')),

    ('Education is the most powerful weapon which you can use to change the world.',
    (SELECT id FROM authors WHERE author = 'Nelson Mandela'),
    (SELECT id FROM categories WHERE category = 'Success')),

    ('Logic will get you from A to B. Imagination will take you everywhere.',
    (SELECT id FROM authors WHERE author = 'Albert Einstein'),
    (SELECT id FROM categories WHERE category = 'Inspirational')),

    ('A person, who no matter how desperate the situation, gives others a feeling of hope, is a true leader.',
    (SELECT id FROM authors WHERE id = 5),
    (SELECT id FROM categories WHERE id = 4)),

    ('Silly things do cease to be silly if they are done by people in high places.',
    (SELECT id FROM authors WHERE id = 5),
    (SELECT id FROM categories WHERE id = 4));
    ```

5.  **Web Server Configuration:**
    - Ensure that your web server has the `.htaccess` file enabled.
    - Place the API files in your web server's document root or a subdirectory.

## API Endpoints

- **Quotes:**
  - `GET /quotes/`: Retrieve all quotes.
  - `GET /quotes/?id={id}`: Retrieve a single quote.
  - `POST /quotes/`: Create a new quote (requires `quote`, `author_id`, `category_id`).
  - `PUT /quotes/`: Update a quote (requires `id`, `quote`, `author_id`, `category_id`).
  - `DELETE /quotes/`: Delete a quote (requires `id`).
- **Authors:**
  - `GET /authors/`: Retrieve all authors.
  - `GET /authors/?id={id}`: Retrieve a single author.
  - `POST /authors/`: Create a new author (requires `author`).
  - `PUT /authors/`: Update an author (requires `id`, `author`).
  - `DELETE /authors/`: Delete an author (requires `id`).
- **Categories:**
  - `GET /categories/`: Retrieve all categories.
  - `GET /categories/?id={id}`: Retrieve a single category.
  - `POST /categories/`: Create a new category (requires `category`).
  - `PUT /categories/`: Update a category (requires `id`, `category`).
  - `DELETE /categories/`: Delete a category (requires `id`).
