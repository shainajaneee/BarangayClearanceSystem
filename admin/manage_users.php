<?php 
require_once('../includes/config.php'); 
checkRole('admin'); 
include('../includes/header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Users Directory | BOP Admin</title>
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
             <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-address-book text-white text-xs"></i>
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
        <a href="manage_users.php" class="flex flex-col items-center gap-1 text-purple-600">
            <i class="fas fa-address-book text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Users</span>
        </a>
        <a href="manage_residents.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-users-cog text-lg"></i>
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
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Users Directory</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest hidden md:block">
                    Total Officials: <?php echo $conn->query("SELECT id FROM users")->num_rows; ?>
                </p>
            </div>
            <a href="manage_staff.php" class="bg-slate-900 text-white p-3 lg:px-5 lg:py-2.5 rounded-2xl lg:rounded-xl shadow-lg flex items-center gap-2 active:scale-95 transition-all">
                <i class="fas fa-cog text-xs"></i>
                <span class="hidden lg:block text-xs font-black uppercase tracking-widest">Settings</span>
            </a>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full space-y-6">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="heading text-2xl font-black text-slate-900">Official List</h2>
                    <p class="text-sm text-slate-500 font-medium">Registered personnel for Brgy. Old Poblacion.</p>
                </div>
            </div>

            <div class="hidden md:block bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Official Name</th>
                            <th class="px-8 py-5">System Username</th>
                            <th class="px-8 py-5">Designated Role</th>
                            <th class="px-8 py-5">Registration Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php
                        $users = $conn->query("SELECT * FROM users ORDER BY role ASC, full_name ASC");
                        if($users->num_rows > 0):
                            while($row = $users->fetch_assoc()):
                        ?>
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-8 py-6 font-bold text-slate-700"><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td class="px-8 py-6 font-mono text-xs text-blue-600 font-bold">@<?php echo htmlspecialchars($row['username']); ?></td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest <?php echo $row['role'] == 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-slate-100 text-slate-500'; ?>">
                                    <?php echo $row['role'] == 'admin' ? 'Administrator' : 'Staff / Clerk'; ?>
                                </span>
                            </td>
                            <td class="px-8 py-6 text-xs text-slate-400 font-bold uppercase tracking-tighter">
                                <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr><td colspan="4" class="p-20 text-center text-slate-300 italic font-bold uppercase tracking-widest">No Records Found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="md:hidden space-y-4">
                <?php
                $users->data_seek(0);
                while($row = $users->fetch_assoc()):
                ?>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden">
                    <?php if($row['role'] == 'admin'): ?>
                        <div class="absolute top-0 right-0 w-16 h-16 bg-purple-500/10 rounded-bl-[2rem] flex items-center justify-center text-purple-600">
                            <i class="fas fa-crown text-xs"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl <?php echo $row['role'] == 'admin' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-400'; ?> flex items-center justify-center text-sm font-black">
                            <?php echo strtoupper(substr($row['full_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800"><?php echo htmlspecialchars($row['full_name']); ?></p>
                            <p class="text-xs font-mono text-blue-500 font-bold">@<?php echo htmlspecialchars($row['username']); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-50 pt-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Designation</p>
                            <p class="text-[10px] font-black uppercase text-slate-600"><?php echo $row['role']; ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Registered</p>
                            <p class="text-[10px] font-black uppercase text-slate-600"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="p-5 bg-amber-50 border border-amber-100 rounded-[1.5rem] flex items-start gap-4">
                <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-xs"></i>
                </div>
                <p class="text-[11px] text-amber-700 font-bold uppercase leading-relaxed tracking-tight">
                    <strong>Note:</strong> Read-only directory. To modify permissions or add new officials, use 
                    <a href="manage_staff.php" class="text-amber-900 underline decoration-2">Management Settings</a>.
                </p>
            </div>
        </div>
    </main>

</body>
</html>