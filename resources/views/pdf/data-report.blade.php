<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Dokumentas</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif !important;
            font-size: 8pt;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
        }
        table {
            font-size: 10pt;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:first-child {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div class="header">{{ $title }}</div>
<div class="content">
    <p>Sukūrimo data: <b>{{ $date }}</b></p>
    <p>Vartotojo lentelė:</p>
    <table style="max-width: fit-content">
        <tr>
            <th>ID</th>
            <th><b>{{ $user->id }}</b></th>
        </tr>
        <tr>
            <th>Vardas</th>
            <th>{{ $user->name }}</th>
        </tr>
        <tr>
            <th>El. paštas</th>
            <th>{{ $user->email }}</th>
        </tr>
        <tr>
            <th>Sekėjai</th>
            <th>{{ $user->followers_count }}</th>
        </tr>
        <tr>
            <th>Seka</th>
            <th>{{ $user->following_count }}</th>
        </tr>
        <tr>
            <th>Komentarai</th>
            <th>{{ $user->comments_count }}</th>
        </tr>
        <tr>
            <th>Patiktukai</th>
            <th>{{ $user->post_likes_count }}</th>
        </tr>
        <tr>
            <th>Miestas</th>
            <th>{{ $user->city->name }}</th>
        </tr>
    </table>
    <p>Sukurtų įrašų lentelė:</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Aprašas</th>
            <th>Nuotrauka</th>
            <th>Komentarai</th>
            <th>Patiktukai</th>
            <th>Sukūrimo data</th>
            <th>Redagavimo data</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td><b>{{ $post->id }}</b></td>
                <td>{{ $post->title }}</td>
                <td>{!! $post->content ? $post->content : '<em>Nėra.</em>' !!}</td>
                <td><a href="{{ asset('storage/' . $post->image_url) }}" target="_blank">Nuoroda</a></td>
                <td>{{ $post->comments_count }}</td>
                <td>{{ $post->likes_count }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->created_at == $post->updated_at ? '-' : $post->updated_at }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
