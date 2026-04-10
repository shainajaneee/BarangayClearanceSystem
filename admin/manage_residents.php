<?php 
require_once('../includes/config.php'); 
checkRole('admin'); 
include('../includes/header.php'); 

// Handle search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM residents WHERE full_name LIKE ? OR email LIKE ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Resident Records | BOP Admin</title>
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
             <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-id-card text-white text-xs"></i>
             </div>
             <h1 class="heading text-lg font-black tracking-tighter uppercase">ADMIN</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/sidebar.php'); ?>
        </nav>
    </aside>

    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 flex justify-around items-center py-3 px-2 z-[60] shadow-[0_-10px_25px_rgba(0,0,0,0.03)]">
        <a href="dashboard.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-chart-pie text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Stats</span>
        </a>
        <a href="manage_staff.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-users-cog text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Staff</span>
        </a>
        <a href="manage_users.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-users-cog text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Users</span>
        </a>
        <a href="manage_residents.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-user-friends text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Residents</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Exit</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Resident Records</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Database Audit</p>
            </div>
            
            <form method="GET" class="flex w-full md:w-auto gap-2">
                <div class="relative flex-1 md:w-64">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Name or Email..." 
                           class="w-full pl-10 pr-4 py-3 md:py-2.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                </div>
                <button type="submit" class="bg-slate-900 text-white px-6 rounded-2xl text-[10px] font-black uppercase tracking-widest active:scale-95 transition-all">
                    Search
                </button>
            </form>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-[1.5rem] text-[10px] font-black uppercase tracking-widest flex items-center gap-3">
                    <i class="fas fa-check-circle text-sm"></i>
                    Account security updated successfully
                </div>
            <?php endif; ?>

            <div class="hidden md:block bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Resident Profile</th>
                            <th class="px-8 py-5">Email Address</th>
                            <th class="px-8 py-5">Joined Date</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php while($row = $res->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <span class="block text-sm font-black text-slate-800"><?php echo htmlspecialchars($row['full_name']); ?></span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">ID: #<?php echo $row['id']; ?></span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-bold text-slate-600"><?php echo htmlspecialchars($row['email']); ?></span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-bold text-slate-500 uppercase"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="edit_resident.php?id=<?php echo $row['id']; ?>" 
                                   class="inline-block bg-slate-100 text-slate-700 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    Manage Profile
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="md:hidden space-y-4">
                <?php 
                $res->data_seek(0);
                while($row = $res->fetch_assoc()): 
                ?>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-black text-xs">
                                <?php echo strtoupper(substr($row['full_name'], 0, 1)); ?>
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-800 leading-tight"><?php echo htmlspecialchars($row['full_name']); ?></p>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mt-0.5">ID #<?php echo $row['id']; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-slate-300 text-[10px]"></i>
                            <span class="text-[11px] font-bold text-slate-600"><?php echo htmlspecialchars($row['email']); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-slate-300 text-[10px]"></i>
                            <span class="text-[11px] font-bold text-slate-500">Registered <?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                        </div>
                    </div>

                    <a href="edit_resident.php?id=<?php echo $row['id']; ?>" 
                       class="block w-full text-center bg-slate-900 text-white py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em]">
                        Edit Profile / Security
                    </a>
                </div>
                <?php endwhile; ?>
                
                <?php if($res->num_rows == 0): ?>
                    <div class="text-center py-20">
                        <i class="fas fa-search text-slate-200 text-4xl mb-4"></i>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">No matching residents</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

</body>
</html>