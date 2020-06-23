## セットアップ

```bash
git clone --recurse-submodules https://github.com/illmatics-inc/shopping-laravel.git

shopping/init.sh

cd shopping/laradock

docker-compose up -d nginx mysql

docker-compose exec workspace bash

composer install

cp .env.example .env

php artisan key:generate

# ↓に画像ファイルを配置する
# application/database/seeds/product_images/
# application/database/seeds/user_images/

php artisan migrate --seed

php artisan storage:link

npm install

npm run dev

exit
```

## サイトマップ

### フロントサイド

http://localhost

| メールアドレス | パスワード |
|---|---|
| user@a.com | pass |

### 管理サイド

http://localhost/admin

| メールアドレス | パスワード | 権限 |
|---|---|---|
| owner@a.com | pass | オーナー権限 |
| admin@a.com | pass | 管理権限 |
