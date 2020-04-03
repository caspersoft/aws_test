# aws_test
AWS Test

Добавление заданий не работает, но форма есть.
Остальное вроде все работает.

Нужно еще добавить .htaccess (не знаю чего не прицепился):
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php [QSA,L]

