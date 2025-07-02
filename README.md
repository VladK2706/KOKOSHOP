## Project Overview

KOKOSHOP is a ready-to-deploy e-commerce starter built on Laravel and Vite. It delivers a modern storefront with a dynamic product catalog, user accounts, purchase workflows, and an admin dashboard for managing inventory and sales.

### Key Features
- **Product Catalog**  
  Browse and filter featured items. Home page uses a full-screen video background and Blade templates to render the latest products.

- **User Accounts & Authentication**  
  Register, login, reset passwords. Protect routes via Laravel’s built-in auth middleware.

- **Purchase Flow**  
  Add to cart, checkout, order history. Sales resources handle CRUD operations and order management.

- **Admin Dashboard**  
  Manage users, products, and sales through resourceful controllers and Blade views.

### When to Use KOKOSHOP
- You need a Laravel-based e-commerce prototype with production-ready defaults.
- You prefer Blade views with minimal JavaScript overhead.
- You want a base you can extend—add payment gateways, search, or PWA support.

### Live Demo
Explore a live instance (login with demo@kokoshop.test / password):  
https://demo.kokoshop.example.com

### Technology Stack
- **Backend**: Laravel 10, PHP 8  
- **Frontend**: Vite, Bootstrap 5, Axios, Sass  
- **Routing**: routes/web.php defines public and resource routes for products, sales, users  
- **Build Tools**:  
  - composer.json for PHP dependencies and post-install scripts  
  - package.json for npm scripts, Vite, and frontend plugins  

#### Quick Start
```bash
# Clone and install PHP dependencies
git clone https://github.com/kevindluna/KOKOSHOP-Laravel.git
cd KOKOSHOP-Laravel
composer install

# Install JS dependencies and compile assets
npm install
npm run dev

# Configure environment
cp .env.example .env
php artisan key:generate
# Set database credentials in .env

# Run migrations and seed demo data
php artisan migrate --seed

# Serve locally
php artisan serve
```

Visit http://localhost:8000 to see your KOKOSHOP store in action.
## Getting Started

Follow these steps to get a local copy running.

### Prerequisites

- PHP ≥ 8.1  
- Composer  
- Node.js ≥ 16  
- MySQL or PostgreSQL  

### 1. Clone the Repository

```bash
git clone https://github.com/kevindluna/KOKOSHOP-Laravel.git
cd KOKOSHOP-Laravel
```

### 2. Install PHP & JS Dependencies

Install PHP packages via Composer:

```bash
composer install
```

Install frontend packages via npm:

```bash
npm install
```

### 3. Configure Environment

Copy and edit your `.env`:

```bash
cp .env.example .env
```

Update database settings in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kokoshop
DB_USERNAME=root
DB_PASSWORD=secret
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Run Migrations & Seeders

Create tables and default data (roles + admin user):

```bash
php artisan migrate
php artisan db:seed
```

To reset and re-seed in one command:

```bash
php artisan migrate:fresh --seed
```

### 5. Build Assets & Start Dev Server

Start the frontend dev server with Vite (auto-refresh):

```bash
npm run dev
```

Compile production assets:

```bash
npm run build
```

Serve the backend on port 8000:

```bash
php artisan serve
```

Visit http://127.0.0.1:8000 in your browser.

### 6. Common Artisan Commands

- `php artisan route:list`   List all registered routes  
- `php artisan config:cache`  Cache configuration files  
- `php artisan cache:clear`  Clear application cache  
- `php artisan migrate:rollback` Rollback last batch of migrations  
- `php artisan db:seed --class=AdminUserSeeder` Seed only the admin user  
- `php artisan make:controller MyController` Generate a new controller  
- `php artisan make:model MyModel -m` Generate model with migration  

Use these commands to manage and inspect your application during development.
## Domain Models & Database Schema

This section details core business entities and their database mappings. It covers key fields, foreign-key relationships, cascade rules, and common Eloquent usage patterns.

---

### Rol & User

#### Rol Model  
Maps to `roles` table. Grants mass assignment on the `rol` column and defines its users.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['rol'];

    /** Users assigned to this role */
    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
```

#### User Model  
Maps to `users` table. Handles authentication fields, assigns a role, and links to sales as client or employee.

```php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'id_rol'
    ];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    /** Role assigned to the user */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    /** Sales where user is the client */
    public function ventasComoCliente()
    {
        return $this->hasMany(Venta::class, 'Id_cliente');
    }

    /** Sales where user is the employee */
    public function ventasComoEmpleado()
    {
        return $this->hasMany(Venta::class, 'Id_empleado');
    }
}
```

**Usage Example**  
Eager-load roles and sales to avoid N+1:

```php
$users = User::with(['rol', 'ventasComoCliente', 'ventasComoEmpleado'])->get();

foreach ($users as $user) {
    echo "{$user->name} ({$user->rol->rol}) has made {$user->ventasComoCliente->count()} purchases\n";
}
```

---

### Producto & CantidadTalla

#### Producto Model  
Represents the `productos` table. Manages one-to-many link to size quantities.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'Id_producto';
    protected $fillable = [
        'nombre', 'descripcion', 'precio', // add other fields as needed
    ];

    /** All size–quantity records for this product */
    public function tallas()
    {
        return $this->hasMany(CantidadTalla::class, 'Id_producto', 'Id_producto');
    }
}
```

#### CantidadTalla Model  
Represents the `cantidad_talla` table. Tracks inventory per size.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CantidadTalla extends Model
{
    use HasFactory;

    protected $table = 'cantidad_talla';
    public $timestamps = false;
    protected $fillable = ['Id_producto', 'talla', 'cantidad'];

    /** Associated product */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_producto', 'Id_producto');
    }
}
```

**Common Operations**  

1. Retrieve product with all sizes  
   ```php
   $product = Producto::with('tallas')->find($id);
   foreach ($product->tallas as $t) {
       echo "Size {$t->talla}: {$t->cantidad}\n";
   }
   ```

2. Add a new size  
   ```php
   $product->tallas()->create([
       'talla'    => 'XL',
       'cantidad' => 15,
   ]);
   ```

3. Update quantity  
   ```php
   $tallaM = $product->tallas()->where('talla', 'M')->first();
   $tallaM->increment('cantidad', 5);
   ```

4. Delete a size entry  
   ```php
   $product->tallas()->where('talla', 'XS')->delete();
   ```

*Cascade:* Deleting a `Producto` cascades to its `cantidad_talla` records via the `onDelete('cascade')` foreign key.

---

### Venta & ProductosVenta

#### Venta Model  
Maps to `ventas` table and connects clients, employees, and sold products.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'Id_venta';
    protected $fillable = [
        'Id_cliente', 'Id_empleado', 'fecha', 'total'
    ];

    /** Client who made the sale */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'Id_cliente');
    }

    /** Employee who handled the sale */
    public function empleado()
    {
        return $this->belongsTo(User::class, 'Id_empleado');
    }

    /** Pivot records linking products to this sale */
    public function productos()
    {
        return $this->hasMany(ProductosVenta::class, 'Id_venta', 'Id_venta');
    }
}
```

#### ProductosVenta Model  
Represents the `productos_venta` pivot table. Captures quantity and size per product sale.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductosVenta extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'productos_venta';
    protected $fillable = [
        'Id_venta', 'Id_producto', 'cantidad_producto', 'talla_producto'
    ];

    /** The sale this record belongs to */
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'Id_venta', 'Id_venta');
    }

    /** The product sold */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_producto', 'Id_producto');
    }
}
```

**Pivot Operations**  

1. Add product to a sale  
   ```php
   $venta = Venta::find($idVenta);
   $venta->productos()->create([
       'Id_producto'       => $idProducto,
       'cantidad_producto' => 2,
       'talla_producto'    => 'M',
   ]);
   ```

2. Retrieve sale with product details  
   ```php
   $venta = Venta::with('productos.producto')->find($idVenta);
   foreach ($venta->productos as $pv) {
       echo "{$pv->producto->nombre}: {$pv->cantidad_producto} × {$pv->talla_producto}\n";
   }
   ```

3. Update pivot record  
   ```php
   $pv = ProductosVenta::where([
       ['Id_venta', $idVenta],
       ['Id_producto', $idProducto],
   ])->first();
   $pv->update(['cantidad_producto' => 5, 'talla_producto' => 'L']);
   ```

4. Remove product from sale  
   ```php
   $venta->productos()->where('Id_producto', $idProducto)->delete();
   ```

*Schema Notes:*  
- `productos_venta` uses a composite primary key on (`Id_venta`, `Id_producto`).  
- Deleting a `Venta` cascades to its `productos_venta` entries.
## Application Workflows & Routing

Map user journeys from incoming URLs through route definitions, controller actions, model interactions, and view responses.

### 1. Authentication Flow

Routes (routes/web.php)  
```php
Auth::routes();  
// Expands to:
// GET    /login           → Auth\LoginController@showLoginForm
// POST   /login           → Auth\LoginController@login
// POST   /logout          → Auth\LoginController@logout
// GET    /register        → Auth\RegisterController@showRegistrationForm
// POST   /register        → Auth\RegisterController@register
// GET    /password/reset  → Auth\ForgotPasswordController@showLinkRequestForm
// …other password routes…
```

Request Flow  
1. User visits `/login`  
2. LoginController@showLoginForm returns `resources/views/auth/login.blade.php`  
3. On submit, LoginController@login validates credentials, issues session, and redirects to `/home`  

Example: guarding a route  
```php
Route::get('/dashboard', 'DashboardController@index')
     ->middleware('auth')
     ->name('dashboard');
```

### 2. User Management (CRUD)

Routes  
```php
Route::resource('users', 'UserController');
// Maps:
// GET      /users           → index
// GET      /users/create    → create
// POST     /users           → store
// GET      /users/{user}    → show
// GET      /users/{user}/edit → edit
// PUT/PATCH /users/{user}   → update
// DELETE   /users/{user}    → destroy
```

Flow Example: Viewing a user list  
1. GET `/users`  
2. UserController@index  
   • Fetches `$users = User::paginate(15);`  
   • Returns view `users.index` with compact('users')  
3. Blade renders table, links to edit/delete  

Code snippet (index):  
```php
public function index()
{
    $users = User::orderBy('created_at','desc')->paginate(15);
    return view('users.index', compact('users'));
}
```

### 3. Product Management (CRUD)

Routes  
```php
Route::resource('productos', 'ProductosController');
// Named routes: productos.index, productos.create, …
```

Flow Example: Creating a product  
1. GET `/productos/create` → ProductosController@create → view `productos.create`  
2. POST `/productos` → ProductosController@store  
   • Validates fields & tallas array  
   • Calculates total stock  
   • Persists Producto and CantidadTalla records  
   • Redirects to productos.show  

Key store logic:  
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'nombre'        => 'required|string|max:255',
        'precio'        => 'required|integer',
        'tipo_producto' => 'required|string',
        'tallas'        => 'required|array',
        'tallas.*.talla'    => 'required|string',
        'tallas.*.cantidad' => 'required|integer',
    ]);
    // sum quantities
    $cantidadTotal = array_sum(array_column($validated['tallas'], 'cantidad'));
    $producto = Producto::create(array_merge($validated, ['cantidad_total' => $cantidadTotal]));
    foreach ($validated['tallas'] as $t) {
        CantidadTalla::create([
            'Id_producto' => $producto->Id_producto,
            'talla'       => $t['talla'],
            'cantidad'    => $t['cantidad'],
        ]);
    }
    return redirect()->route('productos.show', $producto);
}
```

### 4. Sales Workflow

Routes  
```php
Route::resource('ventas', 'VentaController');
// Additional form routes if needed:
Route::get('comprar/{producto}', 'CompraController@mostrarFormulario')->name('compra.form');
Route::post('comprar', 'CompraController@realizarCompra')->name('compra.submit');
```

Flow: “Comprar ahora”  
1. GET `/comprar/5` (producto ID) → CompraController@mostrarFormulario  
   • Loads product, tallas, returns `compraFormulario.blade.php`  
2. POST `/comprar` → CompraController@realizarCompra  
   • Validates client/employee IDs, fecha, productos array  
   • Wraps in DB::transaction():  
     – Calculates total  
     – Creates Venta record  
     – Inserts ProductosVenta  
     – Updates CantidadTalla stock  
   • Commits and returns view `compraRealizada`  

Core transaction snippet:  
```php
DB::transaction(function() use ($validated) {
    $total = collect($validated['productos'])
        ->reduce(function($sum, $item) {
            $p = Producto::findOrFail($item['Id_producto']);
            return $sum + ($p->precio * $item['cantidad_producto']);
        }, ($validated['tipo_venta']==='Virtual'?17000:0));
    $venta = Venta::create([...,'precio_Total'=>$total]);
    foreach ($validated['productos'] as $item) {
        ProductosVenta::create([...]);
        CantidadTalla::where('Id_producto',$item['Id_producto'])
            ->where('talla',$item['talla_producto'])
            ->decrement('cantidad',$item['cantidad_producto']);
    }
});
```

### 5. Public Pages

Routes  
```php
Route::get('/catalogo', 'CatalogController@index')->name('catalogo');
Route::get('/producto/{Id_producto}', 'CatalogController@show')->name('producto.show');
Route::get('/nosotros', 'PublicController@about')->name('about');
Route::get('/asesoramiento', 'PublicController@advisoryForm')->name('advisory.form');
Route::post('/asesoramiento/enviar', 'PublicController@sendAdvisory')->name('advisory.send');
```

Catalog flow:  
1. GET `/catalogo` → CatalogController@index  
   • Fetches `Producto::with('tallas')->paginate(12)`  
   • Returns `catalogo.blade.php`  
2. GET `/producto/7` → CatalogController@show  
   • Loads single Producto + stock per talla  
   • Returns `interfazProducto.blade.php`  

Advisory form:  
```php
public function sendAdvisory(Request $req)
{
    $data = $req->validate([
        'nombre'  => 'required',
        'email'   => 'required|email',
        'consulta'=> 'required|string',
    ]);
    Advisory::create($data);
    return back()->with('status','Consulta enviada con éxito');
}
```

This mapping ensures clear, maintainable user journeys from URL to final response.
## Frontend & UI Customization

Customize global styles, the main Blade layout, and the Vite build to shape your storefront’s look and feel.

### SCSS Variable Overrides & Global Styles

Override Bootstrap’s defaults, import fonts and define global rules in `resources/sass/app.scss`.

1. Create your overrides partial at `resources/sass/_variables.scss`  
```scss
// resources/sass/_variables.scss

// Colors
$primary: #1d4ed8;
$secondary: #9333ea;
$body-bg: #f3f4f6;

// Typography
$font-family-sans-serif: 'Nunito', sans-serif;
$font-size-base: 0.95rem;
$line-height-base: 1.6;
```

2. Update `resources/sass/app.scss`  
```scss
// Load Nunito from BunnyCDN
@import url('https://fonts.bunny.net/css?family=Nunito:400,600,700');

// Apply your overrides before Bootstrap
@import 'variables';
@import 'bootstrap/scss/bootstrap';

// Global styles
body {
  font-family: $font-family-sans-serif;
  background-color: $body-bg;
  color: $gray-800;
}

// Example: custom button
.btn-custom {
  @include button-variant($primary, #fff);
  border-radius: .5rem;
  padding: .75rem 1.5rem;
  &:hover { background-color: darken($primary, 8%); }
}
```

3. Rebuild your CSS  
```bash
npm run dev    # or npm run build
```

Practical Tips  
- Always import `_variables.scss` before Bootstrap.  
- Use partials (`_mixins.scss`, `_components.scss`) for organization.  
- Enable source maps in Vite (default) to trace variable values.

---

### Blade Layout Modification

Tailor `resources/views/layouts/app.blade.php` to inject your branding, navigation links and social footer.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'KOKOSHOP')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
  <nav class="bg-white shadow">
    <div class="container mx-auto px-4 flex justify-between h-16">
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        <span class="font-semibold text-xl">KOKOSHOP</span>
      </a>
      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="text-gray-700">Login</a>
          <a href="{{ route('register') }}" class="text-gray-700">Register</a>
        @else
          <x-dropdown align="right">
            <x-slot name="trigger">
              <button class="text-gray-700">{{ Auth::user()->name }}</button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link href="{{ route('profile') }}">Profile</x-dropdown-link>
              <x-dropdown-link href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout').submit();">
                Logout
              </x-dropdown-link>
              <form id="logout" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </x-slot>
          </x-dropdown>
        @endguest
      </div>
    </div>
  </nav>

  <main class="flex-grow container mx-auto px-4 py-6">
    @yield('content')
  </main>

  <footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-4 flex justify-between text-gray-600">
      <span>© {{ date('Y') }} KOKOSHOP</span>
      <div class="space-x-4">
        <a href="/contact" class="underline">Contact</a>
        <a href="https://github.com/kevindluna/KOKOSHOP-Laravel" target="_blank">GitHub</a>
      </div>
    </div>
  </footer>
</body>
</html>
```

Practical Tips  
- Use `@vite` to include your compiled CSS/JS.  
- Leverage Blade components (`x-dropdown-link`) for reusable UI.  
- Keep nav and footer markup DRY by extracting into includes (`@include('layouts.nav')`).

---

### Vite Configuration for Asset Bundling

Manage your frontend build in `vite.config.js` via the `laravel-vite-plugin`.

```js
// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/sass/app.scss',
        'resources/js/app.js',
        // add new entries here:
        // 'resources/js/producto.js',
        // 'resources/sass/store.scss',
      ],
      refresh: true,
    }),
  ],
  server: {
    hmr: { host: 'localhost' }
  },
});
```

Extending Your Build  
- Add new JS/SCSS files to the `input` array.  
- For code splitting: dynamic `import('./path')` inside `app.js`.  
- Use `resolve.alias` in Vite for shorter import paths.

Rebuild & Watch  
```bash
npm run dev   # watches files, triggers live reload
npm run build # production-ready assets
## Contribution & Testing

This section covers running and writing tests, seeding demo data, enforcing code style, and submitting issues or pull requests.

### Running Tests

#### PHPUnit
Run the full test suite with environment settings from **phpunit.xml**:
```bash
# Run all tests
vendor/bin/phpunit

# Run only unit tests
vendor/bin/phpunit --testsuite="Unit"

# Run only feature tests
vendor/bin/phpunit --testsuite="Feature"
```
phpunit.xml defines:
```xml
<testsuites>
  <testsuite name="Unit">
    <directory>./tests/Unit</directory>
  </testsuite>
  <testsuite name="Feature">
    <directory>./tests/Feature</directory>
  </testsuite>
</testsuites>
<php>
  <env name="DB_CONNECTION" value="sqlite"/>
  <env name="CACHE_DRIVER"  value="array"/>
  <!-- other testing env -->
</php>
```

#### Pest
If you prefer Pest syntax:
```bash
# Run Pest tests
vendor/bin/pest
```
Pest uses the same test directories and bootstrap logic as PHPUnit.

### Writing Tests

#### Unit Tests
Place under **tests/Unit**. Focus on isolated class logic without HTTP or database.
```php
<?php
namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_name_is_mutated_correctly()
    {
        $user = new User();
        $user->name = 'john doe';
        $this->assertEquals('John Doe', $user->name);
    }
}
```

#### Feature Tests
Place under **tests/Feature**. Use Laravel’s HTTP and database helpers.
```php
<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {
        // Seed a verified user
        $user = User::factory()->create([
            'email'    => 'jane@example.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->postJson('/login', [
            'email'    => $user->email,
            'password' => 'secret',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }
}
```

### Seeding Demo Data

Use model factories to generate realistic demo data before manual testing or CI builds.

#### UserFactory Usage
```php
use App\Models\User;

// Create 10 verified users
User::factory()->count(10)->create();

// Create 3 unverified users
User::factory()->count(3)->unverified()->create();
```

#### Running Seeders
In `DatabaseSeeder.php`:
```php
public function run()
{
    \App\Models\User::factory()->count(20)->create();
}
```
Then:
```bash
php artisan migrate:fresh --seed
```

### Code Style

We follow PSR-12 and use PHP CS Fixer to enforce consistency.

#### Checking & Fixing
```bash
# Check coding style (no changes)
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --dry-run --diff

# Apply fixes
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php
```
Integrate into CI or pre-commit hooks to ensure compliance.

### Issue & PR Guidelines

1. Fork the repository and branch from `main`.
2. Reference an existing issue or open a new one using the template.
3. In your PR description:
   - Summarize changes
   - Link related issues (`Fixes #123`)
   - List added/updated tests
   - Confirm style checks and tests pass
4. Run:
   ```bash
   vendor/bin/phpunit && vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --dry-run
   ```
5. Submit your PR against the `main` branch. Maintain clear commit messages and follow PSR-12.
