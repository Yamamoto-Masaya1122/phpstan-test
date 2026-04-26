#!/bin/sh

# PHP-FPMをバックグラウンドで起動
php-fpm -D

# Viteをフォアグラウンドで起動（コンテナを維持）
npm run dev