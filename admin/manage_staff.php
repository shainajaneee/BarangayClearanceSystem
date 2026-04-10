<?php 
require_once('../includes/config.php'); 
checkRole('admin'); 
include('../includes/header.php'); 

// Handle Delete Logic (Secure check)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Prevent deleting the currently logged-in admin or the last remaining admin if necessary
    $conn->query("DELETE FROM users WHERE id = $id AND role != 'admin'"); 
    header("Location: manage_staff.php?msg=deleted");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Staff Management | BOP Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .heading { font-family: 'Montserrat', sans-serif; }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-900">

    <aside class="hidden lg:flex flex-col w-72 bg-[#001529] h-screen fixed left-0 top-0 text-white z-50">
        <div class="p-8 border-b border-white/10 flex items-center gap-3">
             <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-users-cog text-white text-xs"></i>
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
        <a href="manage_staff.php" class="flex flex-col items-center gap-1 text-blue-600">
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
            <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Staff Management</h2>
            <button onclick="openAddModal()" class="bg-blue-600 text-white p-3 lg:px-5 lg:py-2.5 rounded-2xl lg:rounded-xl shadow-lg shadow-blue-200 flex items-center gap-2 active:scale-95 transition-all">
                <i class="fas fa-plus text-xs"></i>
                <span class="hidden lg:block text-xs font-black uppercase tracking-widest">Add New Staff</span>
            </button>
        </header>

        <div class="p-5 md:p-10 max-w-7xl mx-auto w-full">
            
            <div class="hidden md:block bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Personnel Name</th>
                            <th class="px-8 py-5">Credential</th>
                            <th class="px-8 py-5">Role</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php
                        $users = $conn->query("SELECT * FROM users ORDER BY role ASC");
                        while($row = $users->fetch_assoc()):
                        ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-slate-800"><?php echo htmlspecialchars($row['full_name']); ?></p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-xs font-bold text-slate-500">@<?php echo htmlspecialchars($row['username']); ?></p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest <?php echo $row['role'] == 'admin' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600'; ?>">
                                    <?php echo $row['role']; ?>
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right space-x-3">
                                <button onclick="editStaff(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php if($row['username'] !== $_SESSION['username']): ?>
                                    <a href="?delete=<?php echo $row['id']; ?>" class="text-rose-400 hover:text-rose-600 transition" onclick="return confirm('Permanently remove this staff member?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="md:hidden space-y-4">
                <?php
                $users->data_seek(0); // Reset pointer
                while($row = $users->fetch_assoc()):
                ?>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100 font-black text-xs">
                            <?php echo strtoupper(substr($row['full_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800"><?php echo htmlspecialchars($row['full_name']); ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">@<?php echo $row['username']; ?> • <?php echo $row['role']; ?></p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick='editStaff(<?php echo json_encode($row); ?>)' class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            <i class="fas fa-pen"></i>
                        </button>
                        <?php if($row['username'] !== $_SESSION['username']): ?>
                        <a href="?delete=<?php echo $row['id']; ?>" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center text-xs">
                            <i class="fas fa-trash"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>

    <div id="staffModal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-end lg:items-center justify-center p-0 lg:p-4">
        <div class="bg-white rounded-t-[2.5rem] lg:rounded-[2.5rem] shadow-2xl max-w-md w-full p-8 transform transition-transform animate-slide-up">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="heading text-lg font-black text-slate-800 uppercase tracking-tight">Add Staff</h2>
                <button onclick="toggleModal('staffModal')" class="text-slate-300 hover:text-slate-600"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="user_actions.php" method="POST" class="space-y-4">
                <input type="hidden" name="user_id" id="edit_id">
                <input type="hidden" name="action" id="form_action" value="create">
                
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Full Name</label>
                    <input type="text" name="full_name" id="edit_name" placeholder="Juan Dela Cruz" required class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Username</label>
                    <input type="text" name="username" id="edit_user" placeholder="username123" required class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">Account Password</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                    <p id="pw_note" class="hidden text-[9px] text-slate-400 font-bold mt-2 italic">* Leave blank to keep existing password</p>
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 px-1">System Role</label>
                    <select name="role" id="edit_role" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none appearance-none">
                        <option value="staff">Staff Member</option>
                        <option value="admin">System Administrator</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl heading text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-100 active:scale-95 transition-all">
                        Save Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function toggleModal(id) { 
        document.getElementById(id).classList.toggle('hidden'); 
    }

    function openAddModal() {
        document.getElementById('modalTitle').innerText = "Register Staff";
        document.getElementById('form_action').value = "create";
        document.getElementById('edit_id').value = "";
        document.getElementById('edit_name').value = "";
        document.getElementById('edit_user').value = "";
        document.getElementById('pw_note').classList.add('hidden');
        toggleModal('staffModal');
    }

    function editStaff(data) {
        document.getElementById('modalTitle').innerText = "Modify Personnel";
        document.getElementById('form_action').value = "update";
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_name').value = data.full_name;
        document.getElementById('edit_user').value = data.username;
        document.getElementById('edit_role').value = data.role;
        document.getElementById('pw_note').classList.remove('hidden');
        toggleModal('staffModal');
    }
    </script>
</body>
</html>