# CLI Cart

A command-line application in PHP using laravel framework.

## Installation

After the clone, install dependencies through composer.

```bash
composer install
```

Migrate the database.

```bash
php artisan migrate
```
Add csv file in (storage/app) folder.

## Usage

```python
# Load Inventory
php artisan load_inventory inventory.csv

# Add Item
php artisan add apple 5

# Bill
php artisan bill

# Add Offer
php artisan offer buy_2_get_1_free apple

# Bill
php artisan bill

# Add Item
php artisan add egg 8

# Add Offer
php artisan offer buy_1_get_half_off egg

# Bill
php artisan bill

# Checkout
php artisan checkout
