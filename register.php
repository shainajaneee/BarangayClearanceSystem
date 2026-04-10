<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resident Registration | Brgy. Old Poblacion</title>
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
        .reg-card { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body class="bg-[#F1F5F9] flex items-center justify-center min-h-screen p-4 sm:p-8">

    <div class="reg-card bg-white w-full max-w-md rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(0,70,139,0.15)] p-8 sm:p-12 border border-white">
        
        <div class="mb-10 text-center sm:text-left">
            <span class="text-brgy-gold text-[10px] font-black uppercase tracking-[0.3em] mb-2 block">Join our community</span>
            <h2 class="text-3xl font-black text-brgy-navy leading-none tracking-tighter uppercase">Create Account</h2>
            <p class="text-slate-400 text-sm mt-3 font-medium">Register to access digital barangay services.</p>
        </div>

        <form action="auth_logic.php" method="POST" class="space-y-5">
            <input type="hidden" name="action" value="register_resident">
            
            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Full Name</label>
                <input type="text" name="full_name" placeholder="e.g. Juan Dela Cruz" required 
                       class="w-full p-4 bg-slate-50 border-2 border-slate-50 rounded-2xl outline-none focus:border-brgy-navy focus:bg-white transition-all font-semibold text-slate-700">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Email Address</label>
                <input type="email" name="email" placeholder="juan@example.com" required 
                       class="w-full p-4 bg-slate-50 border-2 border-slate-50 rounded-2xl outline-none focus:border-brgy-navy focus:bg-white transition-all font-semibold text-slate-700">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Create Password</label>
                <input type="password" name="password" placeholder="••••••••" required 
                       class="w-full p-4 bg-slate-50 border-2 border-slate-50 rounded-2xl outline-none focus:border-brgy-navy focus:bg-white transition-all font-semibold text-slate-700">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-brgy-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-blue-900/20 active:scale-[0.98]">
                    Register Now
                </button>
            </div>
        </form>

        <div class="mt-10 pt-8 border-t border-slate-50 text-center">
            <p class="text-sm text-slate-500 font-medium">Already have an account?</p>
            <a href="login.php" class="text-brgy-navy font-black text-sm uppercase tracking-tighter hover:text-blue-800 transition-colors">
                Login to Portal
            </a>
        </div>
        
        <div class="mt-8 text-center">
            <a href="index.php" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-300 hover:text-brgy-navy transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7" />
                </svg>
                Return Home
            </a>
        </div>
    </div>

</body>
</html>