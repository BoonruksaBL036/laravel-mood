<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
</head>

<body>
    <h1>Blog Posts</h1>
    <ul>
        @foreach ($posts as $post)
        <li>
            <h2>{{ $post['title'] }}</h2>
            <p>Posted by: {{ $post['posted_by'] }}</p>
        </li>
        @endforeach
    </ul>
</body>

</html>