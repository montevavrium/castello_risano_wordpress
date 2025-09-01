<?php
/**
 * Пример локального wp-config.php для разработки
 * 
 * ВАЖНО: 
 * 1. Скопируйте этот файл как wp-config.php
 * 2. Измените настройки базы данных под ваши локальные
 * 3. НЕ коммитьте wp-config.php в Git!
 */

// ** Настройки MySQL - информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'castello_risano_local' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли аутентификации.
 * 
 * Смените значения на уникальные фразы. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 * 
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 */
define( 'AUTH_KEY',         'вставьте сюда уникальную фразу' );
define( 'SECURE_AUTH_KEY',  'вставьте сюда уникальную фразу' );
define( 'LOGGED_IN_KEY',    'вставьте сюда уникальную фразу' );
define( 'NONCE_KEY',        'вставьте сюда уникальную фразу' );
define( 'AUTH_SALT',        'вставьте сюда уникальную фразу' );
define( 'SECURE_AUTH_SALT', 'вставьте сюда уникальную фразу' );
define( 'LOGGED_IN_SALT',   'вставьте сюда уникальную фразу' );
define( 'NONCE_SALT',       'вставьте сюда уникальную фразу' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 * 
 * Измените это значение на true, чтобы включить отображение уведомлений
 * при разработке. Настоятельно рекомендуется, чтобы разработчики плагинов и
 * тем использовали WP_DEBUG в своих средах разработки.
 */

// Включить отладку для разработки
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG', true );

// Отключить автоматические обновления для локальной разработки
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Увеличить лимит памяти для разработки
define( 'WP_MEMORY_LIMIT', '512M' );

// Локальный домен (измените на ваш)
define( 'WP_HOME', 'http://localhost/castello-risano' );
define( 'WP_SITEURL', 'http://localhost/castello-risano' );

// Отключить редактирование файлов через админку
define( 'DISALLOW_FILE_EDIT', true );

// Настройки для локальной почты (опционально)
// define( 'SMTP_HOST', 'localhost' );
// define( 'SMTP_PORT', 1025 ); // Для MailHog или подобных

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';