<?php 
require_once('../includes/config.php'); 
checkRole('staff'); 
include('../includes/header.php'); 

$query = "SELECT a.id AS app_id, a.appointment_date, a.appointment_time, a.status, 
                 r.full_name, r.email, r.contact_no 
          FROM appointments a 
          JOIN residents r ON a.resident_id = r.id 
          WHERE a.appointment_date >= CURDATE()
          ORDER BY a.appointment_date ASC, a.appointment_time ASC";
$schedule = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verification Schedule | Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
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
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-chart-line text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Stats</span>
        </a>
        <a href="records.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-file-signature text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Requests</span>
        </a>
        <a href="schedule.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-calendar-check text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Visits</span>
        </a>
      <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500 active:scale-90 transition-transform">
    <i class="fas fa-power-off text-lg"></i>
    <span class="text-[9px] font-black uppercase tracking-widest">Logout</span>
</a>
    </nav>

    <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[70] bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="mobileMenu = false">
        <div class="absolute bottom-0 w-full bg-white rounded-t-[2.5rem] p-8 space-y-4 shadow-2xl" @click.stop>
            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-6"></div>
            <?php include('../includes/staff_sidebar.php'); ?>
            <button @click="mobileMenu = false" class="w-full py-4 text-slate-400 font-bold uppercase text-xs tracking-widest">Close Menu</button>
        </div>
    </div>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex justify-between items-center">
            <div>
                <h2 class="heading text-lg font-black text-slate-800 lg:block hidden tracking-tight uppercase">Verification Schedule</h2>
                <div class="lg:hidden flex items-center gap-2">
                    <span class="bg-blue-600 text-white p-1.5 rounded-lg text-[10px]"><i class="fas fa-calendar-day"></i></span>
                    <h1 class="heading font-black text-slate-800 text-sm uppercase tracking-tight">Visit Schedule</h1>
                </div>
            </div>
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">
                <?php echo $schedule->num_rows; ?> Upcoming
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'StatusUpdated'): ?>
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-[11px] font-black uppercase tracking-widest flex items-center gap-3">
                    <i class="fas fa-check-circle"></i> Schedule Updated Successfully
                </div>
            <?php endif; ?>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <div class="md:col-span-2 bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-slate-200">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-60 mb-2">Current Focus</p>
                        <h2 class="heading text-4xl font-black tracking-tighter"><?php echo date('l'); ?></h2>
                        <p class="text-blue-400 font-bold text-sm uppercase tracking-widest mt-1"><?php echo date('F d, Y'); ?></p>
                    </div>
                    <i class="fas fa-calendar-alt absolute right-[-10%] bottom-[-20%] text-white opacity-5 text-[12rem]"></i>
                </div>
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 flex flex-col justify-center shadow-sm">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-1">Morning Peak</span>
                    <p class="heading text-xl font-black text-slate-800 tracking-tight leading-none">8:00 AM - 12:00 PM</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-50 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 w-1/2"></div>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                
                <div class="hidden md:block">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Time Slot</th>
                                <th class="px-8 py-5">Resident</th>
                                <th class="px-8 py-5 text-center">Status</th>
                                <th class="px-8 py-5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php if($schedule->num_rows > 0): while($row = $schedule->fetch_assoc()): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6">
                                    <span class="block font-black text-slate-800 text-lg leading-none"><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter"><?php echo date('M d, Y', strtotime($row['appointment_date'])); ?></span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-800 text-sm leading-tight"><?php echo htmlspecialchars($row['full_name']); ?></p>
                                    <p class="text-[10px] text-blue-600 font-bold uppercase"><?php echo htmlspecialchars($row['contact_no']) ?: 'No Phone'; ?></p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <?php 
                                        $s = (!empty($row['status'])) ? $row['status'] : 'Pending';
                                        $color = ($s == 'Completed') ? 'bg-emerald-100 text-emerald-700' : 
                                                 (($s == 'Cancelled') ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700');
                                    ?>
                                    <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase <?php echo $color; ?>"><?php echo $s; ?></span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <?php if($row['status'] == 'Scheduled' || empty($row['status'])): ?>
                                            <a href="update_appointment.php?id=<?php echo $row['app_id']; ?>&status=Completed" class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-700">Complete</a>
                                            <a href="update_appointment.php?id=<?php echo $row['app_id']; ?>&status=Cancelled" class="bg-slate-100 text-slate-400 px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-red-50 hover:text-red-600">Cancel</a>
                                        <?php else: ?>
                                            <span class="text-slate-300 text-[9px] font-black uppercase italic">Processed</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; else: ?>
                                <tr><td colspan="4" class="p-20 text-center text-slate-400 italic font-medium">No appointments found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-slate-100">
                    <?php if($schedule->num_rows > 0): $schedule->data_seek(0); while($row = $schedule->fetch_assoc()): ?>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div class="bg-slate-50 p-3 rounded-2xl text-center min-w-[70px]">
                                <span class="block font-black text-slate-900 text-xs leading-none"><?php echo date('h:i', strtotime($row['appointment_time'])); ?></span>
                                <span class="text-[9px] font-black text-slate-400 uppercase"><?php echo date('A', strtotime($row['appointment_time'])); ?></span>
                            </div>
                            <div class="flex-1 px-4">
                                <h4 class="font-black text-slate-900 text-sm leading-tight"><?php echo htmlspecialchars($row['full_name']); ?></h4>
                                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase"><?php echo date('M d', strtotime($row['appointment_date'])); ?></p>
                            </div>
                            <?php 
                                $s = (!empty($row['status'])) ? $row['status'] : 'Pending';
                                $color = ($s == 'Completed') ? 'text-emerald-600' : (($s == 'Cancelled') ? 'text-red-600' : 'text-amber-600');
                            ?>
                            <span class="text-[9px] font-black uppercase <?php echo $color; ?>"><?php echo $s; ?></span>
                        </div>

                        <?php if($row['status'] == 'Scheduled' || empty($row['status'])): ?>
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <a href="update_appointment.php?id=<?php echo $row['app_id']; ?>&status=Completed" 
                               class="bg-emerald-600 text-white py-4 rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest text-center shadow-lg shadow-emerald-100">
                                Complete
                            </a>
                            <a href="update_appointment.php?id=<?php echo $row['app_id']; ?>&status=Cancelled" 
                               class="bg-white border-2 border-slate-100 text-slate-400 py-4 rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest text-center">
                                Cancel
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="w-full bg-slate-50 py-4 rounded-[1.2rem] text-center">
                             <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Archived Schedule</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; else: ?>
                        <div class="p-20 text-center text-slate-400 italic text-sm">No upcoming visits.</div>
                    <?php endif; ?>
                </div>

            </section>
        </div>
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>