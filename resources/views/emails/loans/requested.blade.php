<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"></head>
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: auto; padding: 24px;">

    <h2>¡Tu solicitud fue recibida!</h2>

    <p>Hola, <strong>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</strong>.</p>
    <p>Tu solicitud de préstamo ha sido registrada con éxito. Pásate por la biblioteca para recoger el libro una vez que sea aprobado.</p>

    <table style="width:100%; border-collapse: collapse; margin-top: 16px;">
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Libro</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->book->title }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>ISBN</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->book->isbn }}</td>
        </tr>
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Fecha de solicitud</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->created_at_formatted }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Fecha límite de devolución</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->due_date_formatted }}</td>
        </tr>
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Cantidad</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan->quantity }}</td>
        </tr>
    </table>

    <p style="margin-top: 24px; color: #888; font-size: 13px;">Este correo fue generado automáticamente, por favor no respondas a este mensaje.</p>

</body>
</html>
