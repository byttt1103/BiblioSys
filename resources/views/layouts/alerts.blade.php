@if (session('success'))
    <div class="alert alert-success" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error" role="alert" aria-live="assertive">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error" role="alert" aria-live="assertive">
        <p>Se encontraron errores en el formulario:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
