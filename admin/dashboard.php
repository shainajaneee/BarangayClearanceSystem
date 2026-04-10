<?php 
require_once('../includes/config.php'); 
checkRole('admin'); 

// Fetch Dynamic Stats
$total_residents = $conn->query("SELECT COUNT(*) as count FROM residents")->fetch_assoc()['count'];
$total_requests = $conn->query("SELECT COUNT(*) as count FROM clearance_requests")->fetch_assoc()['count'];
$pending_appointments = $conn->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'Scheduled' OR status = ''")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Executive Dashboard | BOP Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .heading { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-900">

    <aside class="hidden lg:flex flex-col w-72 bg-[#001529] h-screen fixed left-0 top-0 text-white z-50">
        <div class="p-8 border-b border-white/10 flex items-center gap-3">
             <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xs"></i>
             </div>
             <h1 class="heading text-lg font-black tracking-tighter uppercase">ADMIN</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/sidebar.php'); ?>
        </nav>
    </aside>

    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 flex justify-around items-center py-3 px-2 z-[60] shadow-[0_-10px_25px_rgba(0,0,0,0.03)]">
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-chart-pie text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Stats</span>
        </a>
        <a href="manage_staff.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-users-cog text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Staff</span>
        </a>
        <a href="manage_users.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-file-contract text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Users</span>
        </a>
         <a href="manage_residents.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-file-contract text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Residents</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Exit</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex justify-between items-center">
            <div>
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Executive Overview</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest hidden md:block">System Status: Optimal</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-xs font-black text-slate-800 uppercase"><?php echo date('l, F j'); ?></p>
                    <p class="text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">Authorized Admin</p>
                </div>
                <div class="h-10 w-10 rounded-2xl bg-slate-900 flex items-center justify-center text-white text-xs font-black">AD</div>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full space-y-8">
            
            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-tighter">Live</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Residents</p>
                    <h3 class="text-3xl font-black text-slate-900"><?php echo number_format($total_residents); ?></h3>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Clearance Requests</p>
                    <h3 class="text-3xl font-black text-slate-900"><?php echo number_format($total_requests); ?></h3>
                </div>

                <div class="bg-slate-900 p-6 rounded-[2.5rem] shadow-xl shadow-slate-200 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center text-xl">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Awaiting Verification</p>
                    <h3 class="text-3xl font-black text-white"><?php echo $pending_appointments; ?></h3>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight mb-6">Administrative Control</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="manage_staff.php" class="group flex items-center p-5 bg-slate-50 rounded-[2rem] border border-transparent hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-900 font-black shadow-sm group-hover:scale-90 transition-transform mr-4">01</div>
                                <div>
                                    <p class="font-black text-sm uppercase tracking-tight">Manage Staff</p>
                                    <p class="text-[10px] opacity-60 font-bold uppercase tracking-tighter">Personnel Access Control</p>
                                </div>
                            </a>

                            <a href="reports.php" class="group flex items-center p-5 bg-slate-50 rounded-[2rem] border border-transparent hover:bg-emerald-600 hover:text-white transition-all duration-300">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-900 font-black shadow-sm group-hover:scale-90 transition-transform mr-4">02</div>
                                <div>
                                    <p class="font-black text-sm uppercase tracking-tight">Analytics</p>
                                    <p class="text-[10px] opacity-60 font-bold uppercase tracking-tighter">Export Data & Reports</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="bg-blue-600 p-8 rounded-[2.5rem] text-white flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-center md:text-left">
                            <h3 class="heading text-sm font-black uppercase tracking-widest">System Integrity Check</h3>
                            <p class="text-blue-100 text-xs font-medium mt-1 uppercase tracking-tight">Cloud Database: Fully Operational</p>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest">Active</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm h-full">
                        <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight mb-6">Recent Enrollees</h2>
                        <div class="space-y-6">
                            <?php 
                            $latest = $conn->query("SELECT full_name, created_at FROM residents ORDER BY created_at DESC LIMIT 5");
                            while($row = $latest->fetch_assoc()):
                            ?>
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-black text-slate-800 leading-tight"><?php echo htmlspecialchars($row['full_name']); ?></p>
                                    <p class="text-[9px] text-slate-400 font-black uppercase tracking-tighter mt-1">Joined <?php echo date('M d', strtotime($row['created_at'])); ?></p>
                                </div>
                                <i class="fas fa-chevron-right text-slate-200 text-[10px]"></i>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <a href="manage_residents.php" class="block w-full text-center mt-10 py-4 bg-slate-50 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-slate-800 hover:bg-slate-100 transition-all">
                            Review All Records
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>