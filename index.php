<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Old Poblacion | Online Services Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brgy-navy': '#00468B',
                        'brgy-gold': '#FFCC00',
                        'brgy-dark': '#1a1a1a',
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
        body { font-family: 'Open Sans', sans-serif; scroll-behavior: smooth; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(0, 70, 139, 0.9), rgba(0, 0, 0, 0.7));
        }
        @media (min-width: 1024px) {
            .hero-overlay {
                background: linear-gradient(to right, rgba(0, 70, 139, 0.95) 30%, rgba(0, 0, 0, 0.3));
            }
        }
    </style>
</head>
<body class="bg-white text-brgy-dark">

    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 flex items-center justify-center overflow-hidden rounded-lg bg-brgy-navy p-1">
                    <img src="assets/pictures/logo.jpg" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-sm md:text-lg leading-none text-brgy-navy uppercase tracking-tighter">Old Poblacion</span>
                    <span class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Online Portal</span>
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-8 text-[11px] font-black uppercase tracking-widest text-slate-600">
                <a href="#home" class="hover:text-brgy-navy transition">Home</a>
                <a href="#services" class="hover:text-brgy-navy transition">Services</a>
                <a href="#about" class="hover:text-brgy-navy transition">About</a>
                <a href="#community" class="hover:text-brgy-navy transition">Community</a>
                <a href="track_request.php" class="text-brgy-navy border-b-2 border-brgy-gold pb-1">Track Request</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="staff_login.php" class="hidden sm:block bg-slate-100 text-brgy-navy px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-brgy-navy hover:text-white transition">Staff Login</a>
                <a href="login.php" class="hidden sm:block bg-brgy-navy text-white px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-blue-800 shadow-md transition">Resident Login</a>
                <button id="menu-btn" class="lg:hidden text-brgy-navy p-1">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 px-6 py-8 space-y-6 shadow-xl">
            <div class="grid grid-cols-2 gap-4">
                <a href="#home" class="font-black text-xs uppercase text-slate-600">Home</a>
                <a href="#services" class="font-black text-xs uppercase text-slate-600">Services</a>
                <a href="#about" class="font-black text-xs uppercase text-slate-600">About</a>
                <a href="#community" class="font-black text-xs uppercase text-slate-600">Community</a>
            </div>
            <hr class="border-slate-100">
            <a href="track_request.php" class="block font-black text-xs uppercase text-brgy-navy">Track Application</a>
            <div class="flex flex-col gap-3">
                <a href="login.php" class="block bg-brgy-navy text-white text-center py-4 rounded-xl font-black text-xs uppercase tracking-widest">Resident Login</a>
                <a href="staff_login.php" class="block bg-slate-100 text-brgy-navy text-center py-3 rounded-xl font-black text-[10px] uppercase tracking-widest">Staff Portal Login</a>
            </div>
        </div>
    </nav>

    <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline poster="assets/pictures/background.jpg" class="w-full h-full object-cover scale-105">
                <source src="assets/videos/background.mp4" type="video/mp4">
                <img src="assets/pictures/background.jpg" class="w-full h-full object-cover" alt="Background">
            </video>
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center lg:text-left">
            <span class="inline-block px-4 py-1 bg-brgy-gold/20 text-brgy-gold rounded-md text-[10px] font-black uppercase tracking-[0.3em] mb-6 backdrop-blur-md border border-brgy-gold/30">Official Online Portal</span>
            <h1 class="text-4xl md:text-7xl font-black text-white mb-6 leading-tight tracking-tighter">
                Modern Governance. <br><span class="text-brgy-gold">Better Service.</span>
            </h1>
            <p class="text-slate-200 text-lg md:text-xl mb-10 max-w-xl font-light leading-relaxed">
                Brgy. Old Poblacion's official digital gateway. Fast, secure, and hassle-free document processing for every resident.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="login.php" class="px-10 py-4 bg-brgy-gold text-brgy-navy rounded-full font-black uppercase tracking-widest hover:bg-white transition-all shadow-xl text-xs">Apply Now</a>
                <a href="track_request.php" class="px-10 py-4 bg-transparent border-2 border-white/40 text-white rounded-full font-black uppercase tracking-widest hover:bg-white/10 transition backdrop-blur-md text-xs">Track Status</a>
            </div>
        </div>
    </section>

    <section id="services" class="py-24 bg-slate-50 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-brgy-navy text-xs font-black uppercase tracking-[0.4em] mb-3">Our Services</h2>
                <h3 class="text-3xl md:text-4xl font-black text-brgy-dark uppercase">Available Online</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brgy-navy group-hover:text-white transition-colors">📄</div>
                    <h4 class="text-xl font-black mb-4 text-brgy-navy uppercase">Brgy. Clearance</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Apply for your official clearance for employment or personal use without the long wait.</p>
                    <a href="login.php" class="text-xs font-black uppercase text-brgy-gold hover:text-brgy-navy transition tracking-widest">Apply Online →</a>
                </div>
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brgy-navy group-hover:text-white transition-colors">📅</div>
                    <h4 class="text-xl font-black mb-4 text-brgy-navy uppercase">Appointments</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Schedule your visit to the Barangay Hall for notary or meeting with officials digitally.</p>
                    <a href="login.php" class="text-xs font-black uppercase text-brgy-gold hover:text-brgy-navy transition tracking-widest">Book Now →</a>
                </div>
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brgy-navy group-hover:text-white transition-colors">🔍</div>
                    <h4 class="text-xl font-black mb-4 text-brgy-navy uppercase">Track Requests</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Check the real-time progress of your existing application using your reference number.</p>
                    <a href="track_request.php" class="text-xs font-black uppercase text-brgy-gold hover:text-brgy-navy transition tracking-widest">Check Status →</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <img src="assets/pictures/background.jpg" class="rounded-[3rem] shadow-2xl aspect-[4/3] object-cover" alt="Community">
                <div class="absolute -bottom-6 -right-6 bg-brgy-gold p-8 rounded-2xl hidden md:block shadow-xl">
                    <span class="block text-4xl font-black text-brgy-navy">24/7</span>
                    <span class="text-xs font-black text-brgy-navy/70 uppercase tracking-widest">Public Access</span>
                </div>
            </div>
            <div>
                <h2 class="text-brgy-navy text-xs font-black uppercase tracking-[0.4em] mb-4">About the Portal</h2>
                <h3 class="text-3xl md:text-5xl font-black text-brgy-dark mb-6 leading-tight">Efficiency Meets Community Care.</h3>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    The Barangay Old Poblacion Online System is our commitment to modernization. We believe technology should bring government services closer to the people.
                </p>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-slate-600 font-bold text-sm">
                    <li class="flex items-center gap-3"><span class="w-6 h-6 bg-brgy-gold/20 text-brgy-navy rounded-full flex items-center justify-center text-xs">✔</span> Reduced Paperwork</li>
                    <li class="flex items-center gap-3"><span class="w-6 h-6 bg-brgy-gold/20 text-brgy-navy rounded-full flex items-center justify-center text-xs">✔</span> Email Notifications</li>
                    <li class="flex items-center gap-3"><span class="w-6 h-6 bg-brgy-gold/20 text-brgy-navy rounded-full flex items-center justify-center text-xs">✔</span> Secure Database</li>
                    <li class="flex items-center gap-3"><span class="w-6 h-6 bg-brgy-gold/20 text-brgy-navy rounded-full flex items-center justify-center text-xs">✔</span> Fast Processing</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="community" class="py-24 bg-brgy-dark text-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-brgy-gold text-xs font-black uppercase tracking-[0.4em] mb-3">Community Hub</h2>
                    <h3 class="text-3xl md:text-4xl font-black uppercase tracking-tighter">Life in Old Poblacion</h3>
                </div>
                <a href="#" class="bg-white/10 hover:bg-white/20 px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition">All Announcements</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-3xl mb-6">
                        <img src="assets/pictures/event1.jpg" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" alt="Fluvial Parade">
                    </div>
                    <span class="text-brgy-gold text-[10px] font-black uppercase tracking-widest">Religious Event</span>
                    <h4 class="text-xl font-bold mt-2 group-hover:text-brgy-gold transition">Fluvial Parade: Honor of Saint Francis</h4>
                </div>
                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-3xl mb-6">
                        <img src="assets/pictures/event2.jpg" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" alt="Sinumbaganay">
                    </div>
                    <span class="text-brgy-gold text-[10px] font-black uppercase tracking-widest">Festival 2025</span>
                    <h4 class="text-xl font-bold mt-2 group-hover:text-brgy-gold transition">Sinumbaganay sa Brgy. Old Poblacion</h4>
                </div>
                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-3xl mb-6">
                        <img src="assets/pictures/event3.jpg" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" alt="Race">
                    </div>
                    <span class="text-brgy-gold text-[10px] font-black uppercase tracking-widest">Sports & Tourism</span>
                    <h4 class="text-xl font-bold mt-2 group-hover:text-brgy-gold transition">First Annual Pumpboat Race</h4>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white pt-20 pb-10 border-t border-slate-100 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-center md:text-left">
                <div class="lg:col-span-1">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-6">
                        <div class="w-10 h-10 bg-brgy-navy rounded flex items-center justify-center text-brgy-gold font-black text-xs">OP</div>
                        <span class="font-black text-xl tracking-tighter text-brgy-navy uppercase">Old Poblacion</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto md:mx-0 font-medium">
                        Dedicated to serving the community of Escalante with modern, digital solutions.
                    </p>
                </div>

                <div>
                    <h5 class="font-black uppercase text-[11px] tracking-[0.2em] text-slate-400 mb-8">Navigation</h5>
                    <ul class="space-y-4 text-sm text-slate-700 font-bold">
                        <li><a href="#home" class="hover:text-brgy-navy transition-colors block">Home</a></li>
                        <li><a href="#services" class="hover:text-brgy-navy transition-colors block">Services</a></li>
                        <li><a href="track_request.php" class="hover:text-brgy-navy transition-colors block text-brgy-navy">Track Request</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-black uppercase text-[11px] tracking-[0.2em] text-slate-400 mb-8">Contact Us</h5>
                    <div class="space-y-4 text-sm text-slate-700 font-bold">
                        <p class="leading-relaxed">Old Poblacion, Escalante,<br>Negros Occidental, 6124</p>
                        <p>(012) 345-6789</p>
                    </div>
                </div>

                <div>
                    <h5 class="font-black uppercase text-[11px] tracking-[0.2em] text-slate-400 mb-8">System Access</h5>
                    <div class="flex flex-col gap-3">
                        <a href="login.php" class="bg-brgy-navy text-white py-3 rounded-xl text-center text-[10px] font-black uppercase tracking-widest shadow-lg">Resident Login</a>
                        <a href="login.php" class="bg-slate-100 text-slate-600 py-3 rounded-xl text-center text-[10px] font-black uppercase tracking-widest">Staff Portal</a>
                    </div>
                </div>
            </div>

            <div class="mt-20 pt-8 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">© 2026 Brgy. Old Poblacion Online. All Rights Reserved.</p>
                <div class="flex gap-4">
                   <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                   <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">System Operational</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Close menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => menu.classList.add('hidden'));
        });
    </script>
</body>
</html>