<?php 
require_once('../includes/config.php'); 
checkRole('staff'); 
include('../includes/header.php'); 

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT * FROM clearance_requests WHERE 1=1";

if (!empty($search)) {
    $query .= " AND (resident_name LIKE '%$search%' OR tracking_no LIKE '%$search%')";
}

$query .= " ORDER BY updated_at DESC";
$records = $conn->query($query);

if (!$records) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Digital Records | Staff</title>
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
        <a href="records.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-file-signature text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Requests</span>
        </a>
        <a href="schedule.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-archive text-lg"></i>
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
                <h2 class="heading text-lg font-black text-slate-800 lg:block hidden tracking-tight uppercase">Digital Records</h2>
                <div class="lg:hidden flex items-center gap-2">
                    <span class="bg-slate-900 text-white p-1.5 rounded-lg text-[10px]"><i class="fas fa-archive"></i></span>
                    <h1 class="heading font-black text-slate-800 text-sm uppercase tracking-tight">System Archive</h1>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 border border-slate-200">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <div class="bg-white p-2 rounded-[2rem] shadow-sm border border-slate-100 mb-8">
                <form action="" method="GET" class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search name or tracking ID..." 
                           class="flex-1 bg-slate-50 border-none px-6 py-4 rounded-[1.5rem] outline-none focus:ring-2 focus:ring-blue-500 transition text-sm font-bold">
                    <button type="submit" class="bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] heading text-[10px] font-black uppercase tracking-widest hover:bg-blue-600">
                        Filter Results
                    </button>
                </form>
            </div>

            <section class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Release Date</th>
                                <th class="px-8 py-5">Resident</th>
                                <th class="px-8 py-5">Tracking No</th>
                                <th class="px-8 py-5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php while($row = $records->fetch_assoc()): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6 text-slate-500 font-bold text-xs"><?php echo date('M d, Y', strtotime($row['updated_at'])); ?></td>
                                <td class="px-8 py-6 font-bold text-slate-800 text-sm"><?php echo htmlspecialchars($row['resident_name']); ?></td>
                                <td class="px-8 py-6 font-mono text-xs font-bold text-blue-600"><?php echo $row['tracking_no']; ?></td>
                                <td class="px-8 py-6 text-right">
                                    <button onclick='openModal(<?php echo json_encode($row); ?>)' class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest">View</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-slate-100">
                    <?php 
                    $records->data_seek(0);
                    while($row = $records->fetch_assoc()): 
                    ?>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-black text-slate-900 text-sm leading-tight"><?php echo htmlspecialchars($row['resident_name']); ?></h4>
                                <p class="text-[10px] font-black text-blue-600 uppercase mt-1 tracking-tighter"><?php echo $row['tracking_no']; ?></p>
                            </div>
                            <p class="text-[9px] font-black text-slate-400 uppercase"><?php echo date('M d, Y', strtotime($row['updated_at'])); ?></p>
                        </div>
                        <button onclick='openModal(<?php echo json_encode($row); ?>)' class="block w-full text-center bg-slate-50 border border-slate-100 text-slate-700 py-4 rounded-[1.2rem] text-[10px] font-black uppercase tracking-[0.2em] shadow-sm active:scale-[0.98] transition-transform">
                            Archive Details
                        </button>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </div>
    </main>

    <div id="recordModal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="flex items-end sm:items-center justify-center min-h-screen">
            <div class="relative bg-white w-full max-w-lg rounded-t-[2.5rem] sm:rounded-[2.5rem] shadow-2xl p-8 space-y-6">
                <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-2 sm:hidden"></div>
                
                <header class="text-center border-b border-slate-50 pb-6">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1 block">Release Certificate</span>
                    <h3 id="m_name" class="heading text-xl font-black text-slate-900 uppercase tracking-tighter"></h3>
                </header>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <span class="text-[9px] font-black text-slate-400 uppercase block mb-1">Tracking ID</span>
                            <p id="m_tracking" class="font-mono font-bold text-slate-700 text-xs"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl">
                            <span class="text-[9px] font-black text-slate-400 uppercase block mb-1">Status</span>
                            <span id="m_status" class="text-[9px] font-black uppercase text-emerald-600">FINALIZED</span>
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 p-4 rounded-2xl">
                        <span class="text-[9px] font-black text-slate-400 uppercase block mb-1">Intended Purpose</span>
                        <p id="m_purpose" class="text-xs font-bold text-slate-700 leading-relaxed italic"></p>
                    </div>
                </div>

                <button onclick="closeModal()" class="w-full py-5 bg-slate-900 text-white rounded-[1.5rem] heading text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-slate-200 active:scale-95 transition-transform">
                    Close Archive
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal(data) {
            document.getElementById('m_name').innerText = data.resident_name;
            document.getElementById('m_tracking').innerText = data.tracking_no;
            document.getElementById('m_purpose').innerText = data.purpose;
            document.getElementById('recordModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('recordModal').classList.add('hidden');
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>