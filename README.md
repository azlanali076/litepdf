# LitePDF Laravel Wrapper

## Installation
```
composer require azlanali076/litepdf
```

## Config
```
php artisan vendor:publish --provider="Azlanali076\Litepdf\Providers\LitepdfServiceProvider" --tag="config"
```
ADD to `.env`

`LITEPDF_API_KEY=your_key_here`

## Usage
### Convert the Document

```php
use Azlanali076\Litepdf\Facades\Litepdf;
use Azlanali076\Litepdf\Models\LitepdfConversion;

// Using Uploaded File
$litepdfConversion = new LitepdfConversion($request->file('doc_key'));

// Using Image Link
$litepdfConversion = new LitepdfConversion(null,'https://link-to-doc');

// Convert the document
$response = Litepdf::convert($litepdfConversion);

// Get Converted Doc URL
echo $response->getFile();
```
### Check Progress

```php
use Azlanali076\Litepdf\Facades\Litepdf;
use Azlanali076\Litepdf\Models\LitepdfConversion;

$taskId = 'your_task_id_here';

// Check Progress
$response = Litepdf::checkProgress($taskId);

// Get Progress
echo $response->getProgress();
```