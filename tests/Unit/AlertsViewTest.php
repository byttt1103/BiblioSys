<?php

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

uses(TestCase::class);

test('layouts.alerts muestra success de sesión con markup consistente', function () {
    session()->flash('success', 'Operación exitosa');

    $html = view('layouts.alerts')->render();

    expect($html)->toContain('alert alert-success');
    expect($html)->toContain('role="status"');
    expect($html)->toContain('Operación exitosa');
});

test('layouts.alerts muestra error de sesión con markup consistente', function () {
    session()->flash('error', 'Ocurrió un error');

    $html = view('layouts.alerts')->render();

    expect($html)->toContain('alert alert-error');
    expect($html)->toContain('role="alert"');
    expect($html)->toContain('Ocurrió un error');
});

test('layouts.alerts muestra errores de validación cuando existen', function () {
    $errors = new ViewErrorBag();
    $errors->put('default', new MessageBag(['El campo es obligatorio.']));

    $html = view('layouts.alerts', ['errors' => $errors])->render();

    expect($html)->toContain('Se encontraron errores en el formulario:');
    expect($html)->toContain('El campo es obligatorio.');
});
