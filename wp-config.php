<?php
# Database Configuration
define( 'DB_NAME', 'wp_envirotronics' );
define( 'DB_USER', 'envirotronics' );
define( 'DB_PASSWORD', 'GbdrR8lkzZzx7wovGr6R' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         't|`nZ|^@/n`6!nN{k/gSl^;GA;[&i<~&b,sK+7sDaYS/tp5>s|hF%NjLbJ]X-<7U');
define('SECURE_AUTH_KEY',  'A`Tf{63)xx>j.Ir>,%x`PNL-bXWNhM7|dtV?Nci~M(|0-2-KG2m %%R{y2W<%RWw');
define('LOGGED_IN_KEY',    'F{K%-++;`~+]iS{nmwqXG;TK-h0oGq2Z,062x&=1cZ6O%QjjO7Gy)tHTMUO5cE,g');
define('NONCE_KEY',        'yGmoBhL`RXWmv7dCI.;@reCmYNe1h)WTqB-wd *j_LyIgx^]i?&gcY`G-o@^,~]6');
define('AUTH_SALT',        '`[0BP[GE$hcmF|oj`|~=lb0-Tf5#6}w3Q*eV_Jcz[%Ga=F9gk1J51*?X;KZ{bdW)');
define('SECURE_AUTH_SALT', '<UH,j`+.gDzST+zLKU]/J]e%DBkl`|B*j&z7o9NW2<`B3EZ|sp% Idp6#es*P-Wp');
define('LOGGED_IN_SALT',   '.T1Pc1+i(b0LMe%(+r6_1 OxfVI,Lz{|+M7I{msjFivRhjtDXQe1hV-wYPcl-=(b');
define('NONCE_SALT',       '9V6SO6f`[GD+`^]b9pauWi.=%cxs=y(M<xb0vlq%+Z#Dwd<l[.}I/]6F,<xb?$XW');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'envirotronics' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '4df9fecdc2f5611faa85a47d0472516e330131e3' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '41163' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '45.79.136.153' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'envirotronics.com', 1 => 'envirotronics.wpengine.com', 2 => 'ns1.envirotronics.com', 3 => 'ns2.envirotronics.com', 4 => 'staging.envirotronics.com', 5 => 'www.envirotronics.com', );

$wpe_varnish_servers=array ( 0 => 'pod-41163', );

$wpe_special_ips=array ( 0 => '45.79.136.153', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );

define( 'WP_SITEURL', 'http://envirotronics.com' );

define( 'WP_HOME', 'http://envirotronics.com' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
