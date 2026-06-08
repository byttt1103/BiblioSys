<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"></head>
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: auto; padding: 24px;">

    <h2>Actualización de tu préstamo</h2>

    <p>Hola, <strong>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</strong>.</p>
    <p>El estado de tu préstamo ha cambiado:</p>

    @php
        $colors = [
            'approved' => '#2e7d32',
            'rejected' => '#c62828',
            'returned' => '#1565c0',
        ];
        $color = $colors[$loan->status] ?? '#555';
    @endphp

    <p style="font-size: 18px; font-weight: bold; color: {{ $color }};">
        {{ $loan->display_status }}
    </p>

    <table style="width:100%; border-collapse: collapse; margin-top: 16px;">
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Libro</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->book->title }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Fecha límite de devolución</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->due_date_formatted }}</td>
        </tr>
        @if($loan->status === 'returned')
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Fecha de devolución</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->returned_at_formatted }}</td>
        </tr>
        @endif
    </table>

    <p style="margin-top: 24px; color: #888; font-size: 13px;">Este correo fue generado automáticamente, por favor no respondas a este mensaje.</p>

</body>
</html>
