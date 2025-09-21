<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Create a New Post</h1>
        <form action="{{ route('store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="posted_by">Posted By:</label>
                <input type="text" name="posted_by" id="posted_by" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
    </div>
</body>

</html>