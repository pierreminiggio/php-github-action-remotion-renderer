Install using composer :
```
composer require pierreminiggio/github-action-remotion-renderer
```

```php
use PierreMiniggio\GithubActionRemotionRenderer\GithubActionRemotionRenderer;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$renderer = new GithubActionRemotionRenderer();
$videoPath = $renderer->render(
    'token',
    'pierreminiggio',
    'remotion-test-github-action',
    3,
    0,
    [
        'titleText' => 'Hello from PHP video renderer',
        'titleColor' => 'orange'
    ]
);

var_dump($videoPath);
```
