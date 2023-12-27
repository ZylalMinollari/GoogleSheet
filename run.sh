!/bin/bash

# Install dependencies
echo "Installing Composer dependencies..."
composer install

# Copy the environment file
echo "Copying the environment file..."
cp .env.example .env

# Generate application key
echo "Generating application key..."
php artisan key:generate


# Run database migrations
echo "Running database migrations..."
php artisan migrate

# Add daily cron job for Laravel command
echo "Scheduling daily command..."
(crontab -l ; echo "0 0 * * * php /home/www/Google/google-sheets/artisan daily:google-sheets") | crontab -

echo "Setup complete!"