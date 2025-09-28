<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mood-board - Laravel App</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
/* Dark mode styles */
.dark, .dark body { background-color: #1a202c; color: #a0aec0; }
.dark .bg-white { background-color: #2d3748; }
.dark .text-gray-800, .dark .text-gray-900 { color: #e2e8f0; }
.dark .text-gray-600 { color: #a0aec0; }
.dark .border-gray-200 { border-color: #4a5568; }
.dark .bg-gray-50 { background-color: #4a5568; }
.dark .hover\:bg-gray-100:hover { background-color: #4a5568; }
.dark .bg-gray-200 { background-color: #4a5568; }

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
</style>
</head>
<body class="bg-gray-100 min-h-screen relative">

<!-- Emoji container -->
<div class="emoji-container"></div>

<!-- Navigation -->
<nav class="bg-white shadow-lg relative z-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-tachometer-alt mr-2 text-blue-600"></i>
                    Moodboard
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <button id="theme-toggle" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-moon"></i>
                </button>
                <span class="text-gray-600">Welcome, {{ Auth::user()->name ?? Auth::user()->email }}!</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="max-w-7xl mx-auto py-8 px-4 relative z-10">
    <!-- Welcome Message -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Mood Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Post::count() }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Online Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Online Now</p>
                    <p class="text-3xl font-bold text-gray-900">1</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- System Status Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">System Status</p>
                    <p class="text-xl font-bold text-green-600">Online</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-server text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-bolt mr-2 text-yellow-500"></i>
            Quick Actions
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('moods.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition duration-200">
                <i class="fas fa-plus-circle text-2xl mb-2"></i>
                <p class="font-semibold">Log Your Mood</p>
            </a>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition duration-200">
                <i class="fas fa-list text-2xl mb-2"></i>
                <p class="font-semibold">View All Posts</p>
            </a>
            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition duration-200">
                <i class="fas fa-cog text-2xl mb-2"></i>
                <p class="font-semibold">Settings</p>
            </a>
        </div>
    </div>

    <!-- Recent Moods -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-clock mr-2 text-blue-500"></i>
            Recent Moods
        </h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/6 py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        <th class="w-1/6 py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mood</th>
                        <th class="w-1/6 py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Score</th>
                        <th class="w-1/3 py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Notes</th>
                        <th class="w-1/6 py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($moods as $mood)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($mood->date)->format('M d, Y') }}</td>
                            <td class="py-3 px-4">{{ ucfirst($mood->mood) }}</td>
                            <td class="py-3 px-4">{{ $mood->score ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $mood->notes ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if ($mood->image_path)
                                    <img src="{{ asset('storage/' . $mood->image_path) }}" alt="Mood Image" class="h-16 w-16 object-cover rounded">
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">You haven't logged any moods yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-white border-t mt-12 relative z-10">
    <div class="max-w-7xl mx-auto py-4 px-4 text-center text-gray-600">
        <p>&copy; {{ date('Y') }} Laravel App. All rights reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script>
    // Theme toggle
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = themeToggle.querySelector('i');
    const htmlEl = document.documentElement;

    const setTheme = (theme) => {
        if (theme === 'dark') {
            htmlEl.classList.add('dark');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            htmlEl.classList.remove('dark');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
        localStorage.setItem('theme', theme);
    };

    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlEl.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });

    // Emoji floating & interactive
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

        // interactive: fade + scale when hover
        e.addEventListener('mouseenter', ()=>{
            e.style.transition = 'transform 0.5s, opacity 0.5s';
            e.style.opacity = 0;
            e.style.transform = 'scale(2) rotate(360deg)';
        });
        // optionally remove element after fade
        e.addEventListener('transitionend', ()=>{
            if(parseFloat(e.style.opacity)===0) e.remove();
        });
    }
</script>

</body>
</html>
