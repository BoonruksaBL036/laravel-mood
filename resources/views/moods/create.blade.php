<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Your Mood</title>
    <style>
        body { font-family: sans-serif; margin: 2em; }
        .container { max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; }
        select, textarea, button { width: 100%; padding: 0.5em; }
        .alert { padding: 1em; margin-bottom: 1em; border-radius: 5px; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>How are you feeling today?</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('moods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="mood">Select your mood:</label>
                <select name="mood" id="mood" required>
                    <option value="happy">😊 Happy</option>
                    <option value="sad">😢 Sad</option>
                    <option value="angry">😠 Angry</option>
                    <option value="calm">😌 Calm</option>
                    <option value="excited">🤩 Excited</option>
                    <option value="tired">😴 Tired</option>
                </select>
            </div>
            <div class="form-group">
                <label for="score">Happiness Score (1-10):</label>
                <input type="number" name="score" id="score" min="1" max="10" placeholder="Optional">
            </div>
            <div class="form-group">
                <label for="notes">Any notes? (optional)</label>
                <textarea name="notes" id="notes" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Attach an image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <button type="submit">Save Mood</button>
        </form>
    </div>
</body>
</html>
