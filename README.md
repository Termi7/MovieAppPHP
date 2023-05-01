# MovieAppPHP

MovieAppPHP is a shopping cart website built using PHP, HTML/CSS, and Javascript. 

## Features

The application allows users to:
- Sign in and authenticate
- Search for movies by name through an API call to the IMBd API
- View search results
- Add movies to their cart
- Delete movies from their cart
- Checkout and receive a receipt through email

## Requirements
- PHP >= 7.4
- A web server (e.g., Apache)
- An email account for sending receipts (e.g., Gmail)

## Installation

1. Clone this repository into your web server's directory.
2. Register for an IMBd API key and update `api_key` value in `search.php`.
3. Update the email configurations in `checkout.php` with your email account information.
4. Import the database schema located in `db_schema.sql`.
5. Start your web server.

## Usage
1. Navigate to the `index.php` file.
2. Sign in to your account or create a new one.
3. Search for a movie by name using the search bar.
4. Add movies to your cart by clicking the "Add to cart" button.
5. View your cart and delete movies by clicking the "Remove" button.
6. Checkout by clicking the "Checkout" button and entering your payment details.
7. Receive your receipt via email.

## Credits
- The IMBd API
- Bootstrap (https://getbootstrap.com/)
- jQuery (https://jquery.com/)

