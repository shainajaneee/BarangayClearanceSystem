<?php 
require_once('../includes/config.php'); 
checkRole('staff'); 
include('../includes/header.php'); 

// Stats fetching
$pending = $conn->query("SELECT id FROM clearance_requests WHERE status='Pending'")->num_rows;
$processing = $conn->query("SELECT id FROM clearance_requests WHERE status='Processing'")->num_rows;
$today_apts = $conn->query("SELECT id FROM appointments WHERE appointment_date = CURDATE()")->num_rows;

$query = "SELECT c.*, r.full_name AS resident_name, r.email AS resident_email 
          FROM clearance_requests c 
          JOIN residents r ON c.resident_id = r.id 
          ORDER BY c.applied_at DESC LIMIT 10";
$res = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Staff Dashboard | e-Barangay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; }
        .heading { font-family: 'Montserrat', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-900" x-data="{ mobileMenu: false }">

    <aside class="hidden lg:flex flex-col w-72 bg-[#001529] h-screen fixed left-0 top-0 text-white z-50">
        <div class="p-8 border-b border-white/10">
            <h1 class="heading text-xl font-black tracking-tighter uppercase">STAFF PORTAL</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/staff_sidebar.php'); ?>
        </nav>
    </aside>

    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 flex justify-around items-center py-3 px-2 z-[60] shadow-[0_-10px_25px_rgba(0,0,0,0.03)]">
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-chart-line text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Stats</span>
        </a>
        <a href="records.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-file-signature text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Requests</span>
        </a>
        <a href="schedule.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-calendar-check text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Visits</span>
        </a>
         <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500 active:scale-90 transition-transform">
    <i class="fas fa-power-off text-lg"></i>
    <span class="text-[9px] font-black uppercase tracking-widest">Logout</span>
</a>
    </nav>

    <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[70] bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="mobileMenu = false">
        <div class="absolute bottom-0 w-full bg-white rounded-t-[2.5rem] p-8 space-y-4" @click.stop>
            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-6"></div>
            <?php include('../includes/staff_sidebar.php'); ?>
            <button @click="mobileMenu = false" class="w-full py-4 text-slate-400 font-bold uppercase text-xs tracking-widest">Close Menu</button>
        </div>
    </div>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex justify-between items-center">
            <div>
                <h2 class="heading text-lg font-black text-slate-800 lg:block hidden tracking-tight uppercase">Operations Dashboard</h2>
                <div class="lg:hidden flex items-center gap-2">
                    <span class="bg-blue-600 text-white p-1.5 rounded-lg text-[10px]"><i class="fas fa-shield-alt"></i></span>
                    <h1 class="heading font-black text-slate-800 text-sm uppercase">STAFF CONTROL</h1>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">System Date</p>
                    <p class="text-xs font-bold text-slate-700"><?php echo date('F d, Y'); ?></p>
                </div>
                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 border border-slate-200">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <section class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-10">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black uppercase text-amber-500 tracking-[0.2em] mb-2">Pending</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-slate-900 leading-none"><?php echo $pending; ?></h3>
                        <i class="fas fa-hourglass-half text-slate-100 text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black uppercase text-blue-500 tracking-[0.2em] mb-2">Processing</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-slate-900 leading-none"><?php echo $processing; ?></h3>
                        <i class="fas fa-sync text-slate-100 text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm col-span-2 lg:col-span-1">
                    <p class="text-[10px] font-black uppercase text-emerald-500 tracking-[0.2em] mb-2">Today's Visits</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-slate-900 leading-none"><?php echo $today_apts; ?></h3>
                        <i class="fas fa-calendar-day text-slate-100 text-2xl"></i>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                

                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Resident Info</th>
                                <th class="px-8 py-5">Tracking ID</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5 text-right">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php if($res->num_rows > 0): while($row = $res->fetch_assoc()): ?>
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-800 text-sm"><?php echo htmlspecialchars($row['resident_name']); ?></p>
                                    <p class="text-[10px] text-slate-400 font-bold"><?php echo htmlspecialchars($row['resident_email']); ?></p>
                                </td>
                                <td class="px-8 py-6 font-mono text-xs font-bold text-blue-600"><?php echo $row['tracking_no']; ?></td>
                                <td class="px-8 py-6">
                                    <?php 
                                        $s = $row['status'];
                                        $c = ($s == 'Pending') ? 'bg-amber-100 text-amber-600' : (($s == 'Processing') ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600');
                                    ?>
                                    <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase <?php echo $c; ?>"><?php echo $s; ?></span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="update_status.php?id=<?php echo $row['id']; ?>" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">Manage</a>
                                </td>
                            </tr>
                            <?php endwhile; endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-slate-100">
                    <?php $res->data_seek(0); while($row = $res->fetch_assoc()): ?>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-black text-slate-900 text-sm"><?php echo htmlspecialchars($row['resident_name']); ?></h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase"><?php echo $row['tracking_no']; ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase <?php echo $c; ?>"><?php echo $row['status']; ?></span>
                        </div>
                        <a href="update_status.php?id=<?php echo $row['id']; ?>" class="block w-full text-center bg-slate-900 text-white py-4 rounded-[1.2rem] text-[10px] font-black uppercase tracking-[0.2em]">Open Controls</a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </div>
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>