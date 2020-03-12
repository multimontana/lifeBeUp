<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'lifebeup' );

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
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '1xc4?T iuevV>,CgU%HsK*gRUy#6Z;&<yC6IY{n V(~)GAY<c<;u8(Z+lH0-9LH}' );
define( 'SECURE_AUTH_KEY',  'akZ+0XMIeB5$F@>u#(Kt24&t,?DM.wO]K2I1!p=_[d5aO(=n<<(%A#:{2<uoW>.F' );
define( 'LOGGED_IN_KEY',    '(rV&7_,$vmC3xhBTLoSKQ0hwK[ wT=EoF0x6&yJcbpA2JP1$U&j@n.|qN/IObI//' );
define( 'NONCE_KEY',        '@ri$*(+n:q=!CoI;8rRV7:<#kmhq-SlU+6Z?o!&yf+( rDwsjm?r)a[7xtFd@t%9' );
define( 'AUTH_SALT',        'dnqooZp*!.2V@?bBc-FjJkQYv1H U#cYz66R2f3{.hWoXED0m0@:{-pR^v[hNE$B' );
define( 'SECURE_AUTH_SALT', '201mc#FzOfH@c3;wUexFWKPM{,wAV;fz?]Sf`K7>$}@cpURC~6TGDFtcK{=F$Ul_' );
define( 'LOGGED_IN_SALT',   'RweRu-0&b<fD76WOp<bq|%8~VTaVN6{Y`5:fz.J2pd_`D:?pCM`JpPrn-0@%:LfK' );
define( 'NONCE_SALT',       '?wI5sx5fWHEi3)%3}@,jyww.y{pCok2`q2ejpV(Z!Y@nz%.s/)o+?F_sZfT`>J:U' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
