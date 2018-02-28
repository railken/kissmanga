# Kissmanga Scraper

Kissmanga Scraper is a php library that permits to search manga and download scans from [kissmanga.com](http://kissmanga.com/)

## Requirements

PHP 7.0.0 or later.

## Composer

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/kissmanga
```


## Dependencies

- [`curl`](https://secure.php.net/manual/en/book.curl.php)


## Getting Started

Simple usage looks like:

```php

# Creating a new instance of manager
$manager = new \Railken\Kissmanga\Kissmanga();

# Searching a manga
$results = $manager
    ->search()
    ->name(One Piece')
    ->author(Oda Eiichiro')
    ->genres('include', ['Action', 'Drama', 'Historical'])
    ->completed(0)
    ->get();

# Retrieving all info about a manga
$manga_uid = "One-Piece";
$manga = $manager
	->resource($manga_uid)
	->get();


# Retrieving all scans for a given manga, volume and chapter
$chapter_id = 1;
$manga_uid = "One-Piece";
$scans = $manager
	->scan($manga_uid, $chapter_id)
	->get();

# Retrieving last updates 
$results = $manager->releases()->page(1)->get();

```


## License

Open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Copyright

All the manga are copyrighted to their respective author. Please buy the manga if it's available in your country.