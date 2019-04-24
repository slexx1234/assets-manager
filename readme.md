# Assets manager 

Пакет для управления скриптами и стилями, он сохраняет порядок загрузки зависимостей,
не позволяет несколько раз загрузить один скрипт.

## Установка

```
composer require slexx/assets-manager
``` 

## Использование

```php
$manager = Slexx\AssetsManager\Manager::getInstance();

$head = $manager->head;
$head->style('app-css', 'https://exmaple.com/assets/css/app.css', ['nunito']);
$head->style('nunito', 'https://fonts.googleapis.com/css?family=Nunito');
echo $head;

$foot = $manager->foot;
$foot->script('app-js', 'https://exmaple.com/assets/js/app.js');
echo $foot;
```

## Интеграция

### Laravel

#### Установка

В файл `config/app.php` в секцию `providers` нужно добавить:

```php
Slexx\AssetsManager\Laravel\AssetsServiceProvider::class,
```

В секцию `aliases`:

```php
'Assets' => Slexx\AssetsManager\Laravel\Assets::class,
```

#### Фасад 

Пример использования фасада:

```php
$head = Assets::location('head');
$head->style('app-css', 'https://exmaple.com/assets/css/app.css', ['nunito']);
$head->style('nunito', 'https://fonts.googleapis.com/css?family=Nunito');
echo $head;

$foot = Assets::location('foot');
$foot->script('app-js', 'https://exmaple.com/assets/js/app.js');
echo $foot;
```

### Директивы

Есть директивы `script`, `endscript`, `style`, `endstyle` для добовления рессурсов и `assets` для
указания места их вывода.

Пример взял из одного проекта:

```blade
@style('app-css', asset('css/app.css'))
@style('toastr-css', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')
@style('open-iconic', 'https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic.min.css')
@script('app-js', asset('js/app.js'))
@script('toastr-js', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js')
@style('highlight-css', asset('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css'))
@script('highlight-js', asset('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js'))
@script('highlight-setup', ['highlight-js'])
    hljs.initHighlightingOnLoad();
@endscript
@script('ajax-setup', ['app-js'])
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    });
@endscript
@script('notifications', ['app-js', 'toastr-js'])
    $(document).ready(function() {
        @foreach(['warning', 'success', 'error', 'info'] as $type)
            @if(session()->has($type))
                toastr.{{ $type }}('', '{{ strip_tags(session()->get($type)) }}', {
                    timeOut: 5000,
                    positionClass: 'toast-bottom-right',
                });
                @php
                    session()->remove($type);
                @endphp
            @endif
        @endforeach
    });
@endscript
@stack('assets')
@assets
```

