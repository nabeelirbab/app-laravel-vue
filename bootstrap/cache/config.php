<?php return array (
  'app' => 
  array (
    'free_release_limit' => 1,
    'name' => 'Phase',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:2DBX3IiizBrRLP5rxqiCRMPXuVrppa+K2h3x1o0YVmI=',
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
      22 => 'Spatie\\Permission\\PermissionServiceProvider',
      23 => 'Intervention\\Image\\ImageServiceProvider',
      24 => 'Aws\\Laravel\\AwsServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\BroadcastServiceProvider',
      28 => 'App\\Providers\\EventServiceProvider',
      29 => 'App\\Providers\\HorizonServiceProvider',
      30 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
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
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'RedisManager' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'AWS' => 'Aws\\Laravel\\AwsFacade',
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
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
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
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'pusher',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '78b1ff505d3291374f06',
        'secret' => '0725692babfe39c82189',
        'app_id' => '1530532',
        'options' => 
        array (
          'cluster' => 'eu',
          'encrypted' => true,
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
        'path' => 'C:\\xampp\\htdocs\\phase\\storage\\framework/cache/data',
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
        'connection' => 'default',
      ),
    ),
    'prefix' => 'phase_cache',
  ),
  'chunk-upload' => 
  array (
    'storage' => 
    array (
      'chunks' => 'chunks',
      'disk' => 'local',
    ),
    'clear' => 
    array (
      'timestamp' => '-3 HOURS',
      'schedule' => 
      array (
        'enabled' => true,
        'cron' => '25 * * * *',
      ),
    ),
    'chunk' => 
    array (
      'name' => 
      array (
        'use' => 
        array (
          'session' => false,
          'browser' => true,
        ),
      ),
    ),
    'handlers' => 
    array (
      'custom' => 
      array (
      ),
      'override' => 
      array (
      ),
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'phase',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'phase',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'phase',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'phase',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 1,
      ),
      'music' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 2,
      ),
      'horizon' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 0,
        'options' => 
        array (
          'prefix' => 'horizon:',
        ),
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 's3',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\phase\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\phase\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'AKIAQVILN57ELI3T54FD',
        'secret' => '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',
        'region' => 'us-east-1',
        'bucket' => 'phase-bucket',
        'url' => 'https://phase-bucket.s3.es-east-1.amazonaws.com',
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
  ),
  'horizon' => 
  array (
    'domain' => NULL,
    'path' => 'horizon',
    'use' => 'default',
    'prefix' => 'horizon:',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'waits' => 
    array (
      'redis:default' => 60,
    ),
    'trim' => 
    array (
      'recent' => 60,
      'completed' => 60,
      'recent_failed' => 10080,
      'failed' => 10080,
      'monitored' => 10080,
    ),
    'metrics' => 
    array (
      'trim_snapshots' => 
      array (
        'job' => 24,
        'queue' => 24,
      ),
    ),
    'fast_termination' => false,
    'memory_limit' => 64,
    'environments' => 
    array (
      'production' => 
      array (
        'supervisor-1' => 
        array (
          'connection' => 'redis',
          'queue' => 
          array (
            0 => 'default',
          ),
          'balance' => 'simple',
          'processes' => 10,
          'tries' => 1,
        ),
        'mailcoach' => 
        array (
          'connection' => 'mailcoach-redis',
          'queue' => 
          array (
            0 => 'send-campaign',
            1 => 'send-mail',
            2 => 'mailcoach-feedback',
            3 => 'mailcoach',
          ),
          'balance' => 'auto',
          'processes' => 3,
          'tries' => 1,
          'timeout' => 600,
        ),
      ),
      'local' => 
      array (
        'supervisor-1' => 
        array (
          'connection' => 'redis',
          'queue' => 
          array (
            0 => 'default',
          ),
          'balance' => 'simple',
          'processes' => 3,
          'tries' => 1,
        ),
        'mailcoach' => 
        array (
          'connection' => 'mailcoach-redis',
          'queue' => 
          array (
            0 => 'send-campaign',
            1 => 'send-mail',
            2 => 'mailcoach-feedback',
            3 => 'mailcoach',
          ),
          'balance' => 'auto',
          'processes' => 3,
          'tries' => 1,
          'timeout' => 600,
        ),
      ),
    ),
  ),
  'ide-helper' => 
  array (
    'filename' => '_ide_helper',
    'meta_filename' => '.phpstorm.meta.php',
    'include_fluent' => true,
    'include_factory_builders' => true,
    'write_model_magic_where' => true,
    'write_model_external_builder_methods' => true,
    'write_model_relation_count_properties' => true,
    'write_eloquent_model_mixins' => false,
    'include_helpers' => true,
    'helper_files' => 
    array (
      0 => 'C:\\xampp\\htdocs\\phase/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ),
    'model_locations' => 
    array (
      0 => 'app',
    ),
    'ignored_models' => 
    array (
    ),
    'extra' => 
    array (
      'Eloquent' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'Illuminate\\Database\\Query\\Builder',
      ),
      'Session' => 
      array (
        0 => 'Illuminate\\Session\\Store',
      ),
    ),
    'magic' => 
    array (
    ),
    'interfaces' => 
    array (
    ),
    'custom_db_types' => 
    array (
    ),
    'model_camel_case_properties' => false,
    'type_overrides' => 
    array (
      'integer' => 'int',
      'boolean' => 'bool',
    ),
    'include_class_docblocks' => false,
    'force_fqn' => false,
    'additional_relation_types' => 
    array (
    ),
    'format' => 'php',
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
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\phase\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\phase\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
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
        'host' => 'smtp.mailtrap.io',
        'port' => '2525',
        'encryption' => 'tls',
        'username' => '5d0d7d9e12a9db',
        'password' => 'd2e3a509167a22',
        'timeout' => NULL,
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
      'address' => 'noreply@phase.co.uk',
      'name' => 'Phase',
    ),
    'markdown' => 
    array (
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\phase\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'mailcoach' => 
  array (
    'mailer' => NULL,
    'campaign_mailer' => NULL,
    'transactional_mailer' => NULL,
    'date_format' => 'Y-m-d H:i',
    'replacers' => 
    array (
      0 => 'Spatie\\Mailcoach\\Support\\Replacers\\WebviewReplacer',
      1 => 'Spatie\\Mailcoach\\Support\\Replacers\\SubscriberReplacer',
      2 => 'Spatie\\Mailcoach\\Support\\Replacers\\EmailListReplacer',
      3 => 'Spatie\\Mailcoach\\Support\\Replacers\\UnsubscribeUrlReplacer',
    ),
    'editor' => 'Spatie\\Mailcoach\\Support\\Editor\\TextEditor',
    'perform_on_queue' => 
    array (
      'calculate_statistics_job' => 'mailcoach',
      'send_campaign_job' => 'send-campaign',
      'send_mail_job' => 'send-mail',
      'send_test_mail_job' => 'mailcoach',
      'process_feedback_job' => 'mailcoach-feedback',
      'import_subscribers_job' => 'mailcoach',
    ),
    'queue_connection' => '',
    'throttling' => 
    array (
      'enabled' => true,
      'redis_connection_name' => 'default',
      'redis_key' => 'laravel-mailcoach',
      'allowed_number_of_jobs_in_timespan' => 10,
      'timespan_in_seconds' => 1,
      'release_in_seconds' => 5,
    ),
    'actions' => 
    array (
      'calculate_statistics' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\CalculateStatisticsAction',
      'prepare_email_html' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\PrepareEmailHtmlAction',
      'prepare_subject' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\PrepareSubjectAction',
      'prepare_webview_html' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\PrepareWebviewHtmlAction',
      'convert_html_to_text' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\ConvertHtmlToTextAction',
      'personalize_html' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\PersonalizeHtmlAction',
      'personalize_subject' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\PersonalizeSubjectAction',
      'retry_sending_failed_sends' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\RetrySendingFailedSendsAction',
      'send_campaign' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\SendCampaignAction',
      'send_mail' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\SendMailAction',
      'send_test_mail' => 'Spatie\\Mailcoach\\Actions\\Campaigns\\SendTestMailAction',
      'confirm_subscriber' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\ConfirmSubscriberAction',
      'create_subscriber' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\CreateSubscriberAction',
      'import_subscribers' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\ImportSubscribersAction',
      'send_confirm_subscriber_mail' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\SendConfirmSubscriberMailAction',
      'send_welcome_mail' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\SendWelcomeMailAction',
      'update_subscriber' => 'Spatie\\Mailcoach\\Actions\\Subscribers\\UpdateSubscriberAction',
    ),
    'redirect_unauthorized_users_to_route' => 'login',
    'guard' => NULL,
    'middleware' => 
    array (
      0 => 'web',
      1 => 'Spatie\\Mailcoach\\Http\\App\\Middleware\\Authenticate',
      2 => 'Spatie\\Mailcoach\\Http\\App\\Middleware\\Authorize',
      3 => 'Spatie\\Mailcoach\\Http\\App\\Middleware\\SetMailcoachDefaults',
    ),
    'import_subscribers_disk' => 'public',
    'models' => 
    array (
      'campaign' => 'Spatie\\Mailcoach\\Models\\Campaign',
      'email_list' => 'Spatie\\Mailcoach\\Models\\EmailList',
      'subscriber' => 'Spatie\\Mailcoach\\Models\\Subscriber',
      'template' => 'Spatie\\Mailcoach\\Models\\Template',
    ),
    'views' => 
    array (
      'use_blade_components' => true,
    ),
    'unlayer' => 
    array (
      'disk_name' => 'public',
      'max_width' => 1500,
      'max_height' => 1500,
    ),
  ),
  'newsletter' => 
  array (
    'driver' => 'api',
    'apiKey' => NULL,
    'defaultListName' => 'newsletter',
    'lists' => 
    array (
      'newsletter' => 
      array (
        'id' => NULL,
      ),
      'pro_standard' => 
      array (
        'id' => '',
      ),
      'pro_premium' => 
      array (
        'id' => '',
      ),
    ),
    'ssl' => true,
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'App\\Permission',
      'role' => 'App\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      DateInterval::__set_state(array(
         'y' => 0,
         'm' => 0,
         'd' => 0,
         'h' => 24,
         'i' => 0,
         's' => 0,
         'f' => 0.0,
         'weekday' => 0,
         'weekday_behavior' => 0,
         'first_last_day_of' => 0,
         'invert' => 0,
         'days' => false,
         'special_type' => 0,
         'special_amount' => 0,
         'have_weekday_relative' => 0,
         'have_special_relative' => 0,
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
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
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
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
      'mailcoach-redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 660,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'localhost',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => NULL,
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => 'pk_test_ninlTOODYEthl2rt6nylGiVf00OlRC8WmX',
      'secret' => 'sk_test_ZL9AP6u0o3Q4rPFWZc27KTVv00Yre3Q7Db',
    ),
    'braintree' => 
    array (
      'model' => 'App\\User',
      'environment' => NULL,
      'merchant_id' => NULL,
      'public_key' => NULL,
      'private_key' => NULL,
    ),
    'recaptcha' => 
    array (
      'key' => '6Ld-Xa8jAAAAAA2aqGOI5oeO8jnjP-OqbVZSx4GT',
      'secret' => '6Ld-Xa8jAAAAAH7_VgdIrCIurii58NKzMVxkoJz-',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\phase\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'phase_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'telescope' => 
  array (
    'domain' => NULL,
    'path' => 'telescope',
    'driver' => 'database',
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'mysql',
        'chunk' => 1000,
      ),
    ),
    'enabled' => true,
    'middleware' => 
    array (
      0 => 'web',
      1 => 'Laravel\\Telescope\\Http\\Middleware\\Authorize',
    ),
    'ignore_paths' => 
    array (
    ),
    'ignore_commands' => 
    array (
    ),
    'watchers' => 
    array (
      'Laravel\\Telescope\\Watchers\\CacheWatcher' => true,
      'Laravel\\Telescope\\Watchers\\CommandWatcher' => 
      array (
        'enabled' => true,
        'ignore' => 
        array (
        ),
      ),
      'Laravel\\Telescope\\Watchers\\DumpWatcher' => true,
      'Laravel\\Telescope\\Watchers\\EventWatcher' => true,
      'Laravel\\Telescope\\Watchers\\ExceptionWatcher' => true,
      'Laravel\\Telescope\\Watchers\\JobWatcher' => true,
      'Laravel\\Telescope\\Watchers\\LogWatcher' => true,
      'Laravel\\Telescope\\Watchers\\MailWatcher' => true,
      'Laravel\\Telescope\\Watchers\\ModelWatcher' => 
      array (
        'enabled' => true,
        'events' => 
        array (
          0 => 'eloquent.*',
        ),
      ),
      'Laravel\\Telescope\\Watchers\\NotificationWatcher' => true,
      'Laravel\\Telescope\\Watchers\\QueryWatcher' => 
      array (
        'enabled' => true,
        'ignore_packages' => true,
        'slow' => 100,
      ),
      'Laravel\\Telescope\\Watchers\\RedisWatcher' => true,
      'Laravel\\Telescope\\Watchers\\RequestWatcher' => 
      array (
        'enabled' => true,
        'size_limit' => 64,
      ),
      'Laravel\\Telescope\\Watchers\\GateWatcher' => 
      array (
        'enabled' => true,
        'ignore_abilities' => 
        array (
        ),
        'ignore_packages' => true,
      ),
      'Laravel\\Telescope\\Watchers\\ScheduleWatcher' => true,
      'Laravel\\Telescope\\Watchers\\ViewWatcher' => true,
    ),
  ),
  'unsplash' => 
  array (
    'ApplicationID' => '26beab0c0b6964005c3d312be519b447b72090312a760232c2c0d4423d2f7e15',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\phase\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\phase\\storage\\framework\\views',
  ),
  'aws' => 
  array (
    'region' => 'us-east-1',
    'version' => 'latest',
    'ua_append' => 
    array (
      0 => 'L5MOD/3.7.0',
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'C:\\xampp\\htdocs\\phase\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'editor' => 'phpstorm',
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'helo' => 
  array (
    'is_enabled' => true,
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'cashier' => 
  array (
    'key' => 'pk_test_ninlTOODYEthl2rt6nylGiVf00OlRC8WmX',
    'secret' => 'sk_test_ZL9AP6u0o3Q4rPFWZc27KTVv00Yre3Q7Db',
    'path' => 'stripe',
    'webhook' => 
    array (
      'secret' => NULL,
      'tolerance' => 300,
    ),
    'model' => 'App\\User',
    'currency' => 'usd',
    'currency_locale' => 'en',
    'payment_notification' => NULL,
    'paper' => 'letter',
    'logger' => NULL,
  ),
  'feed' => 
  array (
    'feeds' => 
    array (
      'main' => 
      array (
        'items' => '',
        'url' => '',
        'title' => 'My feed',
        'description' => 'The description of the feed.',
        'language' => 'en-US',
        'view' => 'feed::atom',
        'type' => 'application/atom+xml',
      ),
    ),
  ),
  'json-api-paginate' => 
  array (
    'max_results' => 30,
    'default_size' => 30,
    'number_parameter' => 'number',
    'size_parameter' => 'size',
    'cursor_parameter' => 'cursor',
    'method_name' => 'jsonPaginate',
    'use_simple_pagination' => false,
    'use_cursor_pagination' => false,
    'base_url' => NULL,
    'pagination_parameter' => 'page',
  ),
  'media-library' => 
  array (
    'disk_name' => 'public',
    'max_file_size' => 10485760,
    'queue_name' => '',
    'queue_conversions_by_default' => true,
    'media_model' => 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media',
    'remote' => 
    array (
      'extra_headers' => 
      array (
        'CacheControl' => 'max-age=604800',
      ),
    ),
    'responsive_images' => 
    array (
      'width_calculator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\WidthCalculator\\FileSizeOptimizedWidthCalculator',
      'use_tiny_placeholders' => true,
      'tiny_placeholder_generator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\TinyPlaceholderGenerator\\Blurred',
    ),
    'default_loading_attribute_value' => NULL,
    'conversion_file_namer' => 'Spatie\\MediaLibrary\\Conversions\\DefaultConversionFileNamer',
    'path_generator' => 'Spatie\\MediaLibrary\\Support\\PathGenerator\\DefaultPathGenerator',
    'url_generator' => 'Spatie\\MediaLibrary\\Support\\UrlGenerator\\DefaultUrlGenerator',
    'version_urls' => false,
    'image_optimizers' => 
    array (
      'Spatie\\ImageOptimizer\\Optimizers\\Jpegoptim' => 
      array (
        0 => '--strip-all',
        1 => '--all-progressive',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Pngquant' => 
      array (
        0 => '--force',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Optipng' => 
      array (
        0 => '-i0',
        1 => '-o2',
        2 => '-quiet',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Svgo' => 
      array (
        0 => '--disable=cleanupIDs',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Gifsicle' => 
      array (
        0 => '-b',
        1 => '-O3',
      ),
    ),
    'image_generators' => 
    array (
      0 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Image',
      1 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Webp',
      2 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Pdf',
      3 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Svg',
      4 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Video',
    ),
    'image_driver' => 'gd',
    'ffmpeg_path' => '/usr/bin/ffmpeg',
    'ffprobe_path' => '/usr/bin/ffprobe',
    'temporary_directory_path' => NULL,
    'jobs' => 
    array (
      'perform_conversions' => 'Spatie\\MediaLibrary\\Conversions\\Jobs\\PerformConversionsJob',
      'generate_responsive_images' => 'Spatie\\MediaLibrary\\ResponsiveImages\\Jobs\\GenerateResponsiveImagesJob',
    ),
    'media_downloader' => 'Spatie\\MediaLibrary\\Downloaders\\DefaultDownloader',
  ),
  'model-cleanup' => 
  array (
    'models' => 
    array (
    ),
  ),
  'webhook-client' => 
  array (
    'configs' => 
    array (
      0 => 
      array (
        'name' => 'default',
        'signing_secret' => NULL,
        'signature_header_name' => 'Signature',
        'signature_validator' => 'Spatie\\WebhookClient\\SignatureValidator\\DefaultSignatureValidator',
        'webhook_profile' => 'Spatie\\WebhookClient\\WebhookProfile\\ProcessEverythingWebhookProfile',
        'webhook_response' => 'Spatie\\WebhookClient\\WebhookResponse\\DefaultRespondsTo',
        'webhook_model' => 'Spatie\\WebhookClient\\Models\\WebhookCall',
        'process_webhook_job' => '',
      ),
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'query-builder' => 
  array (
    'parameters' => 
    array (
      'include' => 'include',
      'filter' => 'filter',
      'sort' => 'sort',
      'fields' => 'fields',
      'append' => 'append',
    ),
    'count_suffix' => 'Count',
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
  ),
);
