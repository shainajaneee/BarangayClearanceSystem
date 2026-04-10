<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resident Login | Brgy. Old Poblacion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brgy-navy': '#00468B',
                        'brgy-gold': '#FFCC00',
                    },
                    fontFamily: {
                        'heading': ['Montserrat', 'sans-serif'],
                        'body': ['Open Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Open Sans', sans-serif; }
        h2 { font-family: 'Montserrat', sans-serif; }
        .login-card { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8FAFC] flex items-center justify-center min-h-screen p-4 sm:p-6">

    <div class="login-card bg-white w-full max-w-md rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,70,139,0.1)] p-8 sm:p-10 border border-slate-100">
        
        <div class="text-center mb-10">
            <div class="w-12 h-12 bg-brgy-navy rounded-2xl mx-auto mb-4 flex items-center justify-center text-brgy-gold font-black shadow-lg">
                 <img src="assets/pictures/logo.jpg" alt="Logo" class="w-full h-full object-contain">

            </div>
            <h2 class="text-2xl font-black text-brgy-navy tracking-tight uppercase">Resident Portal</h2>
            <p class="text-slate-400 text-sm mt-2 font-medium">Manage your clearances and requests.</p>
        </div>

        <form action="auth_logic.php" method="POST" class="space-y-6">
            <input type="hidden" name="action" value="login_resident">
            
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-[0.15em] ml-1">Email Address</label>
                <input type="email" name="email" placeholder="juan@example.com" required 
                       class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:border-brgy-navy focus:bg-white transition-all font-semibold text-slate-700">
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-end px-1">
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-[0.15em]">Password</label>
                    <a href="#" class="text-[10px] font-bold text-brgy-navy hover:underline uppercase tracking-tighter">Forgot?</a>
                </div>
                <input type="password" name="password" placeholder="••••••••" required 
                       class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:border-brgy-navy focus:bg-white transition-all font-semibold text-slate-700">
            </div>

            <button type="submit" class="w-full bg-brgy-navy text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-blue-900/10 active:scale-[0.98] mt-2">
                Sign In
            </button>
        </form>

        <div class="mt-10 pt-8 border-t border-slate-50 text-center">
            <p class="text-sm text-slate-500 mb-1 font-medium">New to our digital service?</p>
            <a href="register.php" class="text-brgy-navy font-black text-sm uppercase tracking-tighter hover:text-blue-800 transition-colors">
                Create a Resident Account
            </a>
        </div>
        
        <div class="mt-8 text-center">
            <a href="index.php" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-300 hover:text-brgy-navy transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7" />
                </svg>
                Back to Site
            </a>
        </div>
    </div>

</body>
</html>