<?php 
require_once('../includes/config.php'); 
checkRole('resident'); 
include('../includes/header.php'); 
$rid = $_SESSION['resident_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resident Dashboard | e-Barangay</title>
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
        <div class="p-8 border-b border-white/10 flex items-center gap-3">
             <img src="../assets/img/logo.png" class="h-8 w-auto">
             <h1 class="heading text-lg font-black tracking-tighter uppercase">RESIDENT</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/resident_sidebar.php'); ?>
        </nav>
    </aside>

    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 flex justify-around items-center py-3 px-2 z-[60] shadow-[0_-10px_25px_rgba(0,0,0,0.03)]">
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-th-large text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Home</span>
        </a>
        <a href="apply.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-plus-circle text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Apply</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-user text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Profile</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500 active:scale-90 transition-transform">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Logout</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex justify-between items-center">
            <div>
                <h2 class="heading text-lg font-black text-slate-800 lg:block hidden tracking-tight uppercase">Resident Dashboard</h2>
                
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <section class="mb-10">
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-1">Total Requests</p>
                        <h3 class="text-4xl font-black text-slate-900 leading-none">
                            <?php echo $conn->query("SELECT id FROM clearance_requests WHERE resident_id = $rid")->num_rows; ?>
                        </h3>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">My Applications</h2>
                    <a href="apply.php" class="bg-blue-600 text-white px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-100 active:scale-95 transition-all">
                        + New
                    </a>
                </div>

                <div class="hidden md:block">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Tracking No</th>
                                <th class="px-8 py-5">Document</th>
                                <th class="px-8 py-5">Date</th>
                                <th class="px-8 py-5 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php
                            $requests = $conn->query("SELECT * FROM clearance_requests WHERE resident_id = $rid ORDER BY applied_at DESC");
                            if($requests->num_rows > 0):
                                while($row = $requests->fetch_assoc()):
                                    $status = $row['status'];
                                    $color = ($status == 'Pending') ? 'bg-amber-100 text-amber-700' : 
                                             (($status == 'Processing') ? 'bg-blue-100 text-blue-700' : 
                                             (($status == 'Ready for Pickup') ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-800 text-white'));
                            ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6 font-mono text-xs font-bold text-blue-600"><?php echo $row['tracking_no']; ?></td>
                                <td class="px-8 py-6 font-bold text-slate-800 text-sm"><?php echo $row['document_type']; ?></td>
                                <td class="px-8 py-6 text-slate-400 text-xs font-bold"><?php echo date('M d, Y', strtotime($row['applied_at'])); ?></td>
                                <td class="px-8 py-6 text-right">
                                    <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase <?php echo $color; ?>"><?php echo $status; ?></span>
                                </td>
                            </tr>
                            <?php endwhile; endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-slate-100">
                    <?php 
                    if($requests->num_rows > 0):
                        $requests->data_seek(0);
                        while($row = $requests->fetch_assoc()): 
                            $status = $row['status'];
                            $color = ($status == 'Pending') ? 'text-amber-600' : 
                                     (($status == 'Processing') ? 'text-blue-600' : 
                                     (($status == 'Ready for Pickup') ? 'text-emerald-600' : 'text-slate-900'));
                    ?>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-black text-slate-900 text-sm leading-tight"><?php echo $row['document_type']; ?></h4>
                                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tight"><?php echo date('F d, Y', strtotime($row['applied_at'])); ?></p>
                            </div>
                            <span class="text-[10px] font-black uppercase <?php echo $color; ?> tracking-widest"><?php echo $status; ?></span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl flex justify-between items-center">
                            <div>
                                <span class="text-[9px] font-black text-slate-400 uppercase block leading-none mb-1">Tracking ID</span>
                                <code class="text-xs font-bold text-blue-600"><?php echo $row['tracking_no']; ?></code>
                            </div>
                            <i class="fas fa-chevron-right text-slate-200"></i>
                        </div>
                    </div>
                    <?php endwhile; else: ?>
                    <div class="p-20 text-center">
                        <i class="fas fa-folder-open text-slate-100 text-6xl mb-4"></i>
                        <p class="text-slate-400 font-bold text-sm italic">No history found.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>