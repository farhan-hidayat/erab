# E-RAB

erab merupakan aplikasi E-RAB sederhana yang dibangun menggunakan Laravel 9.

-   https://lucid.app/lucidchart/3534e65e-7050-4318-97e8-8926487df5d1/edit?viewport_loc=171%2C-296%2C2468%2C1141%2C0_0&invitationId=inv_1dd179e9-d0a3-43d2-a6f4-dfd442766f50

## Installation

-   Siapkan [Composer](https://getcomposer.org/download/) & [NodeJs LTS](https://nodejs.org/id) bagi yang belum punya. kemudian jalankan

```bash
composer install
```

-   Load modules

```bash
npm install && npm run dev
```

-   Buat file .env dengan cara mengcopy file .env.example

```bash
cp .env.example .env
```

-   Buat Key

```bash
php artisan key:generate
```

-   Buat database dan sesuaikan nama database dengan setup pada .env lalu lakukan migrate

```bash
php artisan migrate:fresh --seed
```

-   Tambahkan config sweet alert pada file .env

```bash
SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT='Ya, Hapus!'
SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT='Tidak, Batalkan'
SWEET_ALERT_CONFIRM_DELETE_SHOW_CANCEL_BUTTON=true
SWEET_ALERT_CONFIRM_DELETE_SHOW_CLOSE_BUTTON=false
SWEET_ALERT_CONFIRM_DELETE_ICON='warning'
SWEET_ALERT_CONFIRM_DELETE_SHOW_LOADER_ON_CONFIRM=true
```

-   Jalankan program

```bash
php artisan serve
atau command di bawah agar program dapat diakses secara LAN
php artisan serve --host ip_device --port 8000
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
