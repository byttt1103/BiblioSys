<footer>
    <div class="footer-content left">
        <p class="bold">&copy;{{ date('Y') }} {{ $library->name }}</p>
        <p>Contacto: {{ $library->phone_number}} | {{ $library->email }}</p>
        <p>{{ $library->address }}</p>
    </div>
    <div class="footer-content right">
        <p class="bold">Horarios</p>
        <p>Lunes a Viernes: {{ $library->opening_hour_weekday }} - {{ $library->closing_hour_weekday }}</p>
        <p>Sábado: {{ $library->opening_hour_weekend }} - {{ $library->closing_hour_weekend }}</p>
    </div>
</footer>
