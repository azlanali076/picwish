# Picwish Laravel Wrapper

## Installation
```
composer require azlanali076/picwish
```

## Config
```
php artisan vendor:publish --provider="Azlanali076\Picwish\Providers\PicwishServiceProvider" --tag="config"
```
ADD to `.env`

`PICWISH_API_KEY=your_key_here`

## Usage
### Scale the image
```php
use Azlanali076\Picwish\Facades\Picwish;
use Azlanali076\Picwish\Models\PicwishScale;

// Using Uploaded File
$picwishScale = new PicwishScale($request->file('image_key'));

// Using Image Link
$picwishScale = new PicwishScale(null,'https://link-to-image');

// Using Base 64
$picwishScale = new PicwishScale(null,null, 'data:image/jpeg;adsadsadsadsadas')

// Scale the image
$response = Picwish::scale($picwishScale);

// Get Converted Image URL
echo $response->getImage();
```
### Check Progress
```php
use Azlanali076\Picwish\Facades\Picwish;
use Azlanali076\Picwish\Models\PicwishScale;

$taskId = 'your_task_id_here';

// Check Progress
$response = Picwish::checkProgress($taskId);

// Get Progress
echo $response->getProgress();
```