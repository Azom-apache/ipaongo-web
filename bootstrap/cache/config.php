<?php return array (
  'app' => 
  array (
    'name' => 'ipaongo',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://demo.ipaongo.org',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:P5FFG3g3MNW6FhBWv0cruotGyLe9yEZU8QG3wNq/gxM=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'App\\Providers\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'App\\Facades\\ImageFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/ipaongoo/demo.ipaongo.org/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'ipaongo_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'ipaongoo_ipaong',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ipaongoo_ipaong',
        'username' => 'ipaongoo_new',
        'password' => 'vrg{aZ)X]U15',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ipaongoo_ipaong',
        'username' => 'ipaongoo_new',
        'password' => 'vrg{aZ)X]U15',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ipaongoo_ipaong',
        'username' => 'ipaongoo_new',
        'password' => 'vrg{aZ)X]U15',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'ipaongo_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/ipaongoo/demo.ipaongo.org/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/ipaongoo/demo.ipaongo.org/storage/app/public',
        'url' => 'http://demo.ipaongo.org/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
      ),
    ),
    'links' => 
    array (
      '/home/ipaongoo/demo.ipaongo.org/public/storage' => '/home/ipaongoo/demo.ipaongo.org/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'lfm' => 
  array (
    'use_package_routes' => true,
    'middlewares' => 
    array (
      0 => 'web',
      1 => 'auth',
    ),
    'url_prefix' => 'laravel-filemanager',
    'allow_multi_user' => true,
    'allow_share_folder' => true,
    'user_field' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'base_directory' => 'public',
    'images_folder_name' => 'photos',
    'files_folder_name' => 'files',
    'shared_folder_name' => 'shares',
    'thumb_folder_name' => 'thumbs',
    'images_startup_view' => 'grid',
    'files_startup_view' => 'list',
    'rename_file' => false,
    'alphanumeric_filename' => true,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'max_image_size' => 50000,
    'max_file_size' => 50000,
    'should_validate_mime' => false,
    'valid_image_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
      3 => 'image/gif',
      4 => 'image/svg+xml',
    ),
    'should_create_thumbnails' => true,
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'create_folder_mode' => 493,
    'create_file_mode' => 420,
    'should_change_file_mode' => true,
    'valid_file_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
      3 => 'image/gif',
      4 => 'image/svg+xml',
      5 => 'application/pdf',
      6 => 'text/plain',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'file_icon_array' => 
    array (
      'pdf' => 'fa-file-pdf-o',
      'doc' => 'fa-file-word-o',
      'docx' => 'fa-file-word-o',
      'xls' => 'fa-file-excel-o',
      'xlsx' => 'fa-file-excel-o',
      'zip' => 'fa-file-archive-o',
      'gif' => 'fa-file-image-o',
      'jpg' => 'fa-file-image-o',
      'jpeg' => 'fa-file-image-o',
      'png' => 'fa-file-image-o',
      'ppt' => 'fa-file-powerpoint-o',
      'pptx' => 'fa-file-powerpoint-o',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/ipaongoo/demo.ipaongo.org/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/ipaongoo/demo.ipaongo.org/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/ipaongoo/demo.ipaongo.org/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'ipaongo.org',
        'port' => '465',
        'encryption' => 'ssl',
        'username' => 'noreplay@ipaongo.org',
        'password' => 'noreplay@2024',
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/ipaongoo/demo.ipaongo.org/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'suffix' => NULL,
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/ipaongoo/demo.ipaongo.org/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'ipaongo_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'tailwind_theme' => 
  array (
    'accent_schemes' => 
    array (
      0 => 
      array (
        'border' => 'border-green-500',
        'hover_bg' => 'hover:bg-green-500',
        'hover_border' => 'hover:border-green-50',
        'title_hover' => 'hover:text-green-600',
        'read_more' => 'text-green-600 border-green-600 hover:bg-green-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-green-600 hover:bg-green-700',
        'sidebar_row' => 'hover:bg-green-50 border-gray-200 hover:border-green-300',
        'sidebar_title' => 'group-hover:text-green-600',
        'sidebar_link' => 'text-green-600 group-hover:text-green-700',
        'project_card_body' => 'group-hover:bg-green-500',
        'gallery_image_border' => 'border-green-300',
        'gallery_view_link' => 'text-green-600 hover:text-green-800',
        'sidebar_header' => 'bg-green-800',
        'section_underline' => 'bg-green-600',
        'accent_badge' => 'bg-green-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-green-400',
      ),
      1 => 
      array (
        'border' => 'border-blue-500',
        'hover_bg' => 'hover:bg-blue-500',
        'hover_border' => 'hover:border-blue-50',
        'title_hover' => 'hover:text-blue-600',
        'read_more' => 'text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-blue-600 hover:bg-blue-700',
        'sidebar_row' => 'hover:bg-blue-50 border-gray-200 hover:border-blue-300',
        'sidebar_title' => 'group-hover:text-blue-600',
        'sidebar_link' => 'text-blue-600 group-hover:text-blue-700',
        'project_card_body' => 'group-hover:bg-blue-500',
        'gallery_image_border' => 'border-blue-300',
        'gallery_view_link' => 'text-blue-600 hover:text-blue-800',
        'sidebar_header' => 'bg-blue-800',
        'section_underline' => 'bg-blue-600',
        'accent_badge' => 'bg-blue-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-blue-400',
      ),
      2 => 
      array (
        'border' => 'border-red-500',
        'hover_bg' => 'hover:bg-red-500',
        'hover_border' => 'hover:border-red-50',
        'title_hover' => 'hover:text-red-600',
        'read_more' => 'text-red-600 border-red-600 hover:bg-red-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-red-600 hover:bg-red-700',
        'sidebar_row' => 'hover:bg-red-50 border-gray-200 hover:border-red-300',
        'sidebar_title' => 'group-hover:text-red-600',
        'sidebar_link' => 'text-red-600 group-hover:text-red-700',
        'project_card_body' => 'group-hover:bg-red-500',
        'gallery_image_border' => 'border-red-300',
        'gallery_view_link' => 'text-red-600 hover:text-red-800',
        'sidebar_header' => 'bg-red-800',
        'section_underline' => 'bg-red-600',
        'accent_badge' => 'bg-red-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-red-400',
      ),
      3 => 
      array (
        'border' => 'border-pink-500',
        'hover_bg' => 'hover:bg-pink-500',
        'hover_border' => 'hover:border-pink-50',
        'title_hover' => 'hover:text-pink-600',
        'read_more' => 'text-pink-600 border-pink-600 hover:bg-pink-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-pink-600 hover:bg-pink-700',
        'sidebar_row' => 'hover:bg-pink-50 border-gray-200 hover:border-pink-300',
        'sidebar_title' => 'group-hover:text-pink-600',
        'sidebar_link' => 'text-pink-600 group-hover:text-pink-700',
        'project_card_body' => 'group-hover:bg-pink-500',
        'gallery_image_border' => 'border-pink-300',
        'gallery_view_link' => 'text-pink-600 hover:text-pink-800',
        'sidebar_header' => 'bg-pink-800',
        'section_underline' => 'bg-pink-600',
        'accent_badge' => 'bg-pink-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-pink-400',
      ),
      4 => 
      array (
        'border' => 'border-yellow-500',
        'hover_bg' => 'hover:bg-yellow-500',
        'hover_border' => 'hover:border-yellow-50',
        'title_hover' => 'hover:text-yellow-600',
        'read_more' => 'text-yellow-600 border-yellow-600 hover:bg-yellow-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-yellow-600 hover:bg-yellow-700',
        'sidebar_row' => 'hover:bg-yellow-50 border-gray-200 hover:border-yellow-300',
        'sidebar_title' => 'group-hover:text-yellow-600',
        'sidebar_link' => 'text-yellow-600 group-hover:text-yellow-700',
        'project_card_body' => 'group-hover:bg-yellow-500',
        'gallery_image_border' => 'border-yellow-300',
        'gallery_view_link' => 'text-yellow-600 hover:text-yellow-800',
        'sidebar_header' => 'bg-yellow-700',
        'section_underline' => 'bg-yellow-600',
        'accent_badge' => 'bg-yellow-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-yellow-400',
      ),
      5 => 
      array (
        'border' => 'border-purple-500',
        'hover_bg' => 'hover:bg-purple-500',
        'hover_border' => 'hover:border-purple-50',
        'title_hover' => 'hover:text-purple-600',
        'read_more' => 'text-purple-600 border-purple-600 hover:bg-purple-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-purple-600 hover:bg-purple-700',
        'sidebar_row' => 'hover:bg-purple-50 border-gray-200 hover:border-purple-300',
        'sidebar_title' => 'group-hover:text-purple-600',
        'sidebar_link' => 'text-purple-600 group-hover:text-purple-700',
        'project_card_body' => 'group-hover:bg-purple-500',
        'gallery_image_border' => 'border-purple-300',
        'gallery_view_link' => 'text-purple-600 hover:text-purple-800',
        'sidebar_header' => 'bg-purple-800',
        'section_underline' => 'bg-purple-600',
        'accent_badge' => 'bg-purple-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-purple-400',
      ),
      6 => 
      array (
        'border' => 'border-indigo-500',
        'hover_bg' => 'hover:bg-indigo-500',
        'hover_border' => 'hover:border-indigo-50',
        'title_hover' => 'hover:text-indigo-600',
        'read_more' => 'text-indigo-600 border-indigo-600 hover:bg-indigo-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-indigo-600 hover:bg-indigo-700',
        'sidebar_row' => 'hover:bg-indigo-50 border-gray-200 hover:border-indigo-300',
        'sidebar_title' => 'group-hover:text-indigo-600',
        'sidebar_link' => 'text-indigo-600 group-hover:text-indigo-700',
        'project_card_body' => 'group-hover:bg-indigo-500',
        'gallery_image_border' => 'border-indigo-300',
        'gallery_view_link' => 'text-indigo-600 hover:text-indigo-800',
        'sidebar_header' => 'bg-indigo-800',
        'section_underline' => 'bg-indigo-600',
        'accent_badge' => 'bg-indigo-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-indigo-400',
      ),
      7 => 
      array (
        'border' => 'border-teal-500',
        'hover_bg' => 'hover:bg-teal-500',
        'hover_border' => 'hover:border-teal-50',
        'title_hover' => 'hover:text-teal-600',
        'read_more' => 'text-teal-600 border-teal-600 hover:bg-teal-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-teal-600 hover:bg-teal-700',
        'sidebar_row' => 'hover:bg-teal-50 border-gray-200 hover:border-teal-300',
        'sidebar_title' => 'group-hover:text-teal-600',
        'sidebar_link' => 'text-teal-600 group-hover:text-teal-700',
        'project_card_body' => 'group-hover:bg-teal-500',
        'gallery_image_border' => 'border-teal-300',
        'gallery_view_link' => 'text-teal-600 hover:text-teal-800',
        'sidebar_header' => 'bg-teal-800',
        'section_underline' => 'bg-teal-600',
        'accent_badge' => 'bg-teal-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-teal-400',
      ),
      8 => 
      array (
        'border' => 'border-orange-500',
        'hover_bg' => 'hover:bg-orange-500',
        'hover_border' => 'hover:border-orange-50',
        'title_hover' => 'hover:text-orange-600',
        'read_more' => 'text-orange-600 border-orange-600 hover:bg-orange-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-orange-600 hover:bg-orange-700',
        'sidebar_row' => 'hover:bg-orange-50 border-gray-200 hover:border-orange-300',
        'sidebar_title' => 'group-hover:text-orange-600',
        'sidebar_link' => 'text-orange-600 group-hover:text-orange-700',
        'project_card_body' => 'group-hover:bg-orange-500',
        'gallery_image_border' => 'border-orange-300',
        'gallery_view_link' => 'text-orange-600 hover:text-orange-800',
        'sidebar_header' => 'bg-orange-800',
        'section_underline' => 'bg-orange-600',
        'accent_badge' => 'bg-orange-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-orange-400',
      ),
      9 => 
      array (
        'border' => 'border-cyan-500',
        'hover_bg' => 'hover:bg-cyan-500',
        'hover_border' => 'hover:border-cyan-50',
        'title_hover' => 'hover:text-cyan-600',
        'read_more' => 'text-cyan-600 border-cyan-600 hover:bg-cyan-600 hover:text-white group-hover:text-white group-hover:border-white group-hover:bg-transparent',
        'donate' => 'bg-cyan-600 hover:bg-cyan-700',
        'sidebar_row' => 'hover:bg-cyan-50 border-gray-200 hover:border-cyan-300',
        'sidebar_title' => 'group-hover:text-cyan-600',
        'sidebar_link' => 'text-cyan-600 group-hover:text-cyan-700',
        'project_card_body' => 'group-hover:bg-cyan-500',
        'gallery_image_border' => 'border-cyan-300',
        'gallery_view_link' => 'text-cyan-600 hover:text-cyan-800',
        'sidebar_header' => 'bg-cyan-800',
        'section_underline' => 'bg-cyan-600',
        'accent_badge' => 'bg-cyan-600',
        'media_card_hover' => 'border-2 border-gray-100 hover:border-cyan-400',
      ),
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/ipaongoo/demo.ipaongo.org/resources/views',
    ),
    'compiled' => '/home/ipaongoo/demo.ipaongo.org/storage/framework/views',
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
    'trust_project' => 'always',
  ),
);
