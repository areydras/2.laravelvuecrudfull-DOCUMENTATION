1. Install template adminLTE 3 = npm install admin-lte@v3.0.0-alpha.2 --save (tinggal liat versi terakhirnya di github)
   Install FontAwesome = npm install --save-dev @fortawesome/fontawesome-free
    -Buka resources/js/bootstrap.js kemudian require nya tamabhin admin-lte
    -Buka resources/sass/app.scss kemudian import adminLTE dan juga FontAwesome
	@import '~admin-lte/dist/css/adminlte.css';
	@import '~@fortawesome/fontawesome-free/scss/fontawesome.scss';
	@import '~@fortawesome/fontawesome-free/scss/solid.scss';
	@import '~@fortawesome/fontawesome-free/scss/brands.scss';

2. Instal NPM = npm install
3. Instal Auth = php artisan make:auth
4. Install Vue Router = https://router.vuejs.org/installation.html#npm
5. Lalu tambahkan mode: 'history' didalam const router
6. Tambahkan code di web.php = Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d\-\/_.]+)?' );
7. Install vform = liat dibagian bookmark laravel di chrome
8. Install ImageInvertion = liat dibagian bookmark laravel di chrome. baca dokumentasi biar tau fungsinya
9. Install Controller api = laravel artisan make:controller API/UserController --api
10. Install Moment js = momentjs.com buat ngubah format waktu
11. Install SweetAlert = liat dibagian bookmark laravel di chrome
12. Install VueProgressBar = liat dibagian bookmark laravel di chrome
13. Install VueProgressBar = liat dibagian bookmark laravel di chrome
14. Install LaravelVuePagination = liat dibagian bookmark laravel di chrome
15. Menggunakan debounce lodash untuk set ketika user ngetik = liat dibagian bookmark laravel di chrome (confignya di bootstrap.js)
16. Install Laravel Passport = cari di web laravel
17. Install Laravel Gate = cari di web laravel.
	NOTE : gunakan @can('nama dari gate yg sudah didefine pada authserviceprovider') didalam blade.php untuk menampilkan data sesuai syarat dari gate