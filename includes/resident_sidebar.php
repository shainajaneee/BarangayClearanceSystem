<?php 
$current_page = basename($_SERVER['PHP_SELF']); 
?>

<div class="hidden lg:block p-8 mb-4">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-home text-white text-xs"></i>
        </div>
        <h2 class="heading text-xs font-black text-white uppercase tracking-widest leading-none">Old Poblacion</h2>
    </div>
    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Resident Portal</p>
</div>

<nav class="space-y-2 lg:px-4">
    <a href="dashboard.php" 
       class="flex items-center gap-3 px-4 py-4 lg:py-3 text-sm font-bold rounded-2xl transition-all active-scale <?php echo $current_page == 'dashboard.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>">
        <i class="fas fa-th-large w-5"></i>
        <span>My Dashboard</span>
    </a>

    <a href="apply.php" 
       class="flex items-center gap-3 px-4 py-4 lg:py-3 text-sm font-bold rounded-2xl transition-all active-scale <?php echo $current_page == 'apply.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>">
        <i class="fas fa-file-alt w-5"></i>
        <span>Apply for Clearance</span>
    </a>

    <a href="appointments.php" 
       class="flex items-center gap-3 px-4 py-4 lg:py-3 text-sm font-bold rounded-2xl transition-all active-scale <?php echo $current_page == 'appointments.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>">
        <i class="fas fa-calendar-check w-5"></i>
        <span>Verification Schedule</span>
    </a>

    <div class="lg:hidden pt-4 mt-4 border-t border-slate-100">
        <a href="profile.php" class="flex items-center gap-3 px-4 py-4 text-sm font-bold text-slate-500 rounded-2xl">
            <i class="fas fa-user-circle w-5"></i>
            <span>Account Settings</span>
        </a>
    </div>
</nav>

<div class="hidden lg:block mt-auto p-6 border-t border-white/5">
    <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all">
        <i class="fas fa-sign-out-alt w-5"></i>
        Sign Out
    </a>
</div>