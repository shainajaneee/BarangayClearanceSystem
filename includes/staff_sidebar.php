<aside class="w-64 bg-slate-900 flex flex-col h-full text-white">
    <div class="p-8">
        <h2 class="text-xs font-black text-blue-400 uppercase tracking-widest mb-1">Brgy. Old Poblacion</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Staff Operations</p>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Clearance Requests
        </a>

        <a href="records.php" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all <?php echo basename($_SERVER['PHP_SELF']) == 'records.php' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Digital Records
        </a>

        <a href="schedule.php" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all <?php echo basename($_SERVER['PHP_SELF']) == 'schedule.php' ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z" />
            </svg>
            Verification Schedule
        </a>
    </nav>

    <div class="p-6 border-t border-slate-800">
        <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-400 hover:bg-red-900/20 rounded-xl transition-all">
            Logout
        </a>
    </div>
</aside>