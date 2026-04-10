<?php 
require_once('../includes/config.php'); 
checkRole('resident'); 
include('../includes/header.php'); 

if(!isset($_SESSION['resident_id'])) {
    header("Location: ../login.php?error=SessionExpired");
    exit();
}

$rid = $_SESSION['resident_id'];

// Handle Form Submission
if(isset($_POST['schedule_apt'])) {
    $req_id = $_POST['request_id'];
    $apt_date = $_POST['apt_date'];
    $apt_time = $_POST['apt_time'];
    $default_status = 'Scheduled'; 

    $stmt = $conn->prepare("INSERT INTO appointments (resident_id, request_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $rid, $req_id, $apt_date, $apt_time, $default_status);
    
    if($stmt->execute()) {
        echo "<script>alert('Appointment Scheduled successfully!'); window.location.href='appointments.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verification Schedule | BOP Online</title>
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
             <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-xs"></i>
             </div>
             <h1 class="heading text-lg font-black tracking-tighter uppercase">RESIDENT</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/resident_sidebar.php'); ?>
        </nav>
    </aside>

    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 flex justify-around items-center py-3 px-2 z-[60] shadow-[0_-10px_25px_rgba(0,0,0,0.03)]">
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-th-large text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Home</span>
        </a>
        <a href="apply.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-plus-circle text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Apply</span>
        </a>
        <a href="appointments.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-calendar-check text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Visits</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Logout</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6">
            <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Verification Schedule</h2>
        </header>

        <div class="p-5 md:p-10 max-w-6xl mx-auto w-full">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4 order-2 lg:order-1">
                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm sticky top-24">
                        <div class="mb-6">
                            <h3 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Book a Visit</h3>
                            <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-tight">Choose your preference</p>
                        </div>
                        
                        <form action="" method="POST" class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Select Request</label>
                                <select name="request_id" required class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                                    <?php 
                                    $reqs = $conn->query("SELECT id, tracking_no FROM clearance_requests WHERE resident_id = $rid AND status != 'Completed'");
                                    if($reqs->num_rows > 0):
                                        while($r = $reqs->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['tracking_no']; ?></option>
                                    <?php endwhile; else: ?>
                                    <option disabled>No active requests</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Visit Date</label>
                                <input type="date" name="apt_date" min="<?php echo date('Y-m-d'); ?>" required 
                                       class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Arrival Time</label>
                                <select name="apt_time" required class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                                    <option value="09:00:00">09:00 AM</option>
                                    <option value="10:30:00">10:30 AM</option>
                                    <option value="14:00:00">02:00 PM</option>
                                    <option value="15:30:00">03:30 PM</option>
                                </select>
                            </div>

                            <button type="submit" name="schedule_apt" class="w-full bg-blue-600 text-white py-5 rounded-[2rem] heading text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-100 active:scale-95 transition-all">
                                Confirm Schedule
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-8 order-1 lg:order-2">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-50">
                            <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Your Schedules</h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                                    <tr>
                                        <th class="px-8 py-5">Request ID</th>
                                        <th class="px-8 py-5">Schedule</th>
                                        <th class="px-8 py-5 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <?php 
                                    $apts = $conn->query("SELECT a.*, c.tracking_no FROM appointments a JOIN clearance_requests c ON a.request_id = c.id WHERE a.resident_id = $rid ORDER BY a.appointment_date ASC");
                                    if($apts->num_rows > 0):
                                        while($row = $apts->fetch_assoc()):
                                    ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-8 py-6 font-mono text-xs font-bold text-blue-600"><?php echo $row['tracking_no']; ?></td>
                                        <td class="px-8 py-6">
                                            <span class="block text-sm font-bold text-slate-800"><?php echo date('M d, Y', strtotime($row['appointment_date'])); ?></span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight"><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-blue-50 text-blue-600">
                                                <?php echo $row['status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr>
                                        <td colspan="3" class="px-8 py-20 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-calendar-times text-slate-100 text-6xl mb-4"></i>
                                                <p class="text-slate-400 font-bold text-sm italic uppercase tracking-widest">No active visits found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include('../includes/footer.php'); ?>
</body>
</html>