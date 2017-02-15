# Laravel

## Comandos con artisan

- Crear controlador: `php artisan make:controller <nombre>`
- Arrancar el servidor de desarrollo: `php artisan serve`

## Otras cosas a tener en cuenta:
- Cuando en un formulario tienes un checkbox el valor pasa así:
  - Si está marcado = `'on'`
  - Si no está marcado = `''`
- En el `action` de un formulario debes escribir siempre la ruta empezando por `/`
  porque si no lo que hará es concatenar la URL si hay más de una petición.

## Sesiones
  - Crear / asignar valores a una variable de sesión:

   `$request->session()->put('nombreVariable', 'valor');`
  - Leer una variable de sesión:

    `$valor = $request->session()->get('nombreVariable');`
  - Destruir una variable de sesión:

  `$request->session()->forget('nombreVariable'); // unset`

  `$request->session()->flush(); // las borra todas`
  - Comprobar si existe una variable de sesión o un valor:

  `if ($request->session()->has('nombreVariable')) {
  ...
  }`

## Bases de datos
  - Se configura en `config/database.php` y en la variable de entorno `env`
  - Forma de usar CRUD:
    - **Create:** `DB::insert('INSERT INTO tabla (campo1, campo2) VALUES(?,?)',[$valor1,$valor2]);`
    - **Read:** `$registros = DB::select('SELECT campos FROM tabla WHERE campo=?',[$valor]);
return view('vista',['valores'=>$registros]);`
    - **Update:** `DB::update('UPDATE tabla SET campo1=? WHERE campo2=?',[$valor1,$valor2]);`
    - **Delete:** `DB::delete('DELETE FROM tabla WHERE campo=?',[$valor]);`

## Dudas
  - ¿Puedo llegar a cambiar la url? Por ejemplo sesiones/logout que cuando muestre la vista la url pase a sesiones.
