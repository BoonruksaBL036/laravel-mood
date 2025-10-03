<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Your Mood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #F472B6, #C084FC, #60A5FA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Emoji falling animation */
        .emoji {
            position: absolute;
            font-size: 2rem;
            top: -2rem;
            /* เริ่มจากด้านบน */
            animation-name: fall;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Floating Emojis -->
    <script>
        function createFallingEmoji() {
            const emojis = ["😊", "😢", "😠", "😌", "🤩", "😴", "😎"];
            const emoji = document.createElement("div");
            emoji.className = "emoji";
            emoji.innerText = emojis[Math.floor(Math.random() * emojis.length)];
            emoji.style.left = Math.random() * 100 + "vw";
            emoji.style.animationDuration = (3 + Math.random() * 3) + "s";
            document.body.appendChild(emoji);

            setTimeout(() => emoji.remove(), 6000);
        }

        setInterval(createFallingEmoji, 500); // ทุก 0.5 วินาที
    </script>

    <!-- Mood Form -->
    <div class="w-full max-w-lg bg-white dark:bg-gray-900 rounded-3xl shadow-2xl p-8 relative z-10">
        <h1 class="text-3xl font-extrabold text-center gradient-text">Log Your Mood</h1>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-8">บันทึกอารมณ์ของคุณวันนี้</p>

        <!-- Errors -->
        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('moods.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="date" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Date:</label>
                <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100">
            </div>

            <div>
                <label for="mood" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Select your mood:</label>
                <select name="mood" id="mood" required
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100">
                    <option value="happy">😊 Happy</option>
                    <option value="sad">😢 Sad</option>
                    <option value="angry">😠 Angry</option>
                    <option value="calm">😌 Calm</option>
                    <option value="excited">🤩 Excited</option>
                    <option value="tired">😴 Tired</option>
                </select>
            </div>

            <div>
                <label for="score" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Happiness Score (1-10):</label>
                <input type="number" name="score" id="score" min="1" max="10" placeholder="Optional"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100">
            </div>

            <div>
                <label for="notes" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Any notes? (optional)</label>
                <textarea name="notes" id="notes" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100"></textarea>
            </div>

            <div>
                <label for="image" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Attach an image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full text-gray-700 dark:text-gray-100">
            </div>

            <button type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                Save Mood
            </button>
        </form>
    </div>

</body>

</html>