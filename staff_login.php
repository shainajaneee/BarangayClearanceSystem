<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Staff Portal | Brgy. Old Poblacion</title>
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
        /* Smooth fade-in for mobile */
        .fade-up {
            animation: fadeUp 0.5s ease-out forwards;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-brgy-navy flex items-center justify-center min-h-screen p-4 sm:p-6">

    <a href="index.php" class="absolute top-6 left-6 flex items-center gap-2 text-white/60 hover:text-white transition-all text-xs font-bold uppercase tracking-widest group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Site
    </a>

    <div class="fade-up bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 sm:p-12 overflow-hidden relative">
        
        <div class="absolute top-0 right-0 w-32 h-32 bg-brgy-gold/10 rounded-bl-full -mr-16 -mt-16"></div>

        <div class="text-center mb-10 relative">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-3xl mb-4 text-brgy-navy shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Staff Portal</h2>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="h-[1px] w-4 bg-slate-200"></span>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">Authorized Access</p>
                <span class="h-[1px] w-4 bg-slate-200"></span>
            </div>
        </div>

        <form action="auth_logic.php" method="POST" class="space-y-5">
            <input type="hidden" name="action" value="login_official">
            
            <div class="space-y-1.5">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Official Username</label>
                <input type="text" name="username" required placeholder="admin_poblacion"
                       class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:border-brgy-navy focus:ring-4 focus:ring-brgy-navy/5 transition-all font-semibold text-slate-700">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Security Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                       class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:border-brgy-navy focus:ring-4 focus:ring-brgy-navy/5 transition-all font-semibold text-slate-700">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-brgy-navy text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-brgy-navy/20 active:scale-[0.98]">
                    Enter Dashboard
                </button>
            </div>
        </form>

        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                © 2026 Brgy. Old Poblacion
            </p>
        </div>
    </div>

</body>
</html>