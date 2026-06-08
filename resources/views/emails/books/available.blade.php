<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"></head>
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: auto; padding: 24px;">

    <h2>¡El libro que esperabas ya está disponible!</h2>

    <p>Hola, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>.</p>
    <p>Nos alegra informarte que el libro que tenías reservado ya tiene stock disponible.</p>

    <table style="width:100%; border-collapse: collapse; margin-top: 16px;">
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Libro</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $book->title }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Editorial</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $book->publisher }}</td>
        </tr>
        <tr style="background:#f5f5f5;">
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>ISBN</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $book->isbn }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;"><strong>Stock disponible</strong></td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $book->stock }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        ¡Date prisa antes de que se agote!
    </p>

    <p style="margin-top: 24px; color: #888; font-size: 13px;">
        Este correo fue generado automáticamente, por favor no respondas a este mensaje.
    </p>

</body>
</html>
