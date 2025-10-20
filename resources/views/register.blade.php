<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] min-h-screen flex items-center justify-center text-[#1b1b18]">
<!-- Emoji container -->
<div class="emoji-container"></div>
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md relative overflow-hidden">
        <!-- Header -->
        <div class="text-center mb-8 relative z-10">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-[#F472B6] via-[#C084FC] to-[#60A5FA] rounded-full flex items-center justify-center mb-4 shadow-lg">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold bg-gradient-to-r from-[#F472B6] via-[#C084FC] to-[#60A5FA] bg-clip-text text-transparent">
                Create Account
            </h2>
            <p class="text-gray-600 mt-2">Join us today and get started</p>
        </div>

        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-user mr-2 text-[#F472B6]"></i>Full Name
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200"
                    placeholder="Enter your full name"
                    required
                >
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope mr-2 text-[#C084FC]"></i>Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2 text-[#60A5FA]"></i>Password
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200"
                        placeholder="Create a password"
                        required
                    >
                    <button 
                        type="button" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-pink-500"
                        onclick="togglePassword('password', 'toggleIcon1')"
                    >
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2 text-[#C084FC]"></i>Confirm Password
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200"
                        placeholder="Confirm your password"
                        required
                    >
                    <button 
                        type="button" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-pink-500"
                        onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                    >
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <!-- Terms -->
            <div class="flex items-start">
                <input 
                    type="checkbox" 
                    id="terms" 
                    name="terms" 
                    class="h-4 w-4 text-pink-500 focus:ring-pink-400 border-gray-300 rounded mt-1"
                    required
                >
                <label for="terms" class="ml-2 text-sm text-gray-700">
                    I agree to the 
                    <a href="#" class="text-[#F472B6] hover:text-[#C084FC] font-semibold">Terms and Conditions</a> 
                    and 
                    <a href="#" class="text-[#F472B6] hover:text-[#C084FC] font-semibold">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-[#F472B6] via-[#C084FC] to-[#60A5FA] text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-pink-300 focus:ring-offset-2 transition duration-200 transform hover:scale-105"
            >
                <i class="fas fa-user-plus mr-2"></i>Create Account
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-700">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#F472B6] hover:text-[#C084FC] font-semibold">
                    Sign in here
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.className = "fas fa-eye-slash";
            } else {
                input.type = "password";
                icon.className = "fas fa-eye";
            }
        }
    </script>
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
</body>
</html>
