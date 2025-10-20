<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log Your Mood</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
/* Emoji container & style */
.emoji-container { position: fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; overflow:hidden; z-index:0; }
.emoji {
    position: absolute;
    top: -50px;
    pointer-events: auto;
    cursor: pointer;
    user-select: none;
    transition: transform 0.5s, opacity 0.5s;
}
/* Scrollable table */
.scrollable-table {
    overflow-x: auto;
    max-height: 400px;
}
</style>
</head>
<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
<!-- Emoji container -->
<div class="emoji-container"></div>
    <!-- Emoji Scripts -->
<script>
const emojis = ['😀','😂','🥰','😎','🤩','😇','🙃','😜','😢','😡','🥳','😱','😴','🤔','😏','🥶','🥵','🤯','😳','😈','👻','💀','☠️','👽','🤖','🎃','🌞','🌜','⭐','💫'];
const container = document.querySelector('.emoji-container');

for(let i=0;i<30;i++){
    const e = document.createElement('div');
    e.textContent = emojis[Math.floor(Math.random()*emojis.length)];
    e.classList.add('emoji');
    e.style.left = Math.random()*window.innerWidth + 'px';
    e.style.fontSize = 12 + Math.random()*24 + 'px';
    e.style.opacity = Math.random()*0.7+0.3;
    e.style.transform = `rotate(${Math.random()*360}deg)`;
    container.appendChild(e);

    const duration = 5000 + Math.random()*5000;
    const delay = Math.random()*5000;
    const rotation = (Math.random()>0.5?1:-1)*(Math.random()*360);

    e.animate([
        { transform: `translateY(0px) rotate(0deg)`, opacity: e.style.opacity },
        { transform: `translateY(${window.innerHeight+50}px) rotate(${rotation}deg)`, opacity: 0 }
    ], {
        duration: duration,
        delay: delay,
        iterations: Infinity,
        easing: 'linear'
    });

    e.addEventListener('mouseenter', ()=>{
        e.style.transition = 'transform 0.5s, opacity 0.5s';
        e.style.opacity = 0;
        e.style.transform = 'scale(2) rotate(360deg)';
    });

    e.addEventListener('transitionend', ()=>{
        if(parseFloat(e.style.opacity)===0) e.remove();
    });
}
</script>

    <!-- Mood Form -->
    <div class="w-full max-w-lg bg-white dark:bg-gray-900 rounded-3xl shadow-2xl p-8 relative z-10">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 dark:text-gray-100 mb-6">Log Your Mood</h1>
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
                <label for="score" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Score (1-10):</label>
                <input type="number" name="score" id="score" min="1" max="10" placeholder="Optional"
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100">
            </div>

            <div>
                <label for="notes" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Any notes? (optional)</label>
                <textarea name="notes" id="notes" rows="4"
                          class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-400 focus:outline-none dark:bg-gray-800 dark:text-gray-100"></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                Save Mood
            </button>
        </form>
    </div>

</body>
</html>
