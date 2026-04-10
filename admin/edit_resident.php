<?php 
require_once('../includes/config.php'); 
checkRole('admin'); 
include('../includes/header.php'); 

// Securely fetch ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$resident_query = $conn->prepare("SELECT * FROM residents WHERE id = ?");
$resident_query->bind_param("i", $id);
$resident_query->execute();
$resident = $resident_query->get_result()->fetch_assoc();

if (!$resident) {
    header("Location: manage_residents.php");
    exit();
}

if(isset($_POST['update_resident'])) {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE residents SET full_name=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $hashed, $id);
    } else {
        $stmt = $conn->prepare("UPDATE residents SET full_name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    if($stmt->execute()) {
        header("Location: manage_residents.php?msg=updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Resident | BOP Admin</title>
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
                <i class="fas fa-user-edit text-white text-xs"></i>
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
        <a href="manage_residents.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-user-friends text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Residents</span>
        </a>
        <a href="manage_staff.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-users-cog text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Staff</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Exit</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex items-center gap-4">
            <a href="manage_residents.php" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-slate-900 transition-colors">
                <i class="fas fa-chevron-left text-sm"></i>
            </a>
            <div>
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Edit Resident</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Account Security Overhaul</p>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-2xl mx-auto w-full">
            
            <div class="mb-8 text-center md:text-left">
                <h1 class="heading text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Modify Account</h1>
                <p class="text-sm text-slate-500 font-medium">Updating details for <span class="text-blue-600 font-bold"><?php echo htmlspecialchars($resident['full_name']); ?></span></p>
            </div>
            
            <form action="" method="POST" class="bg-white p-6 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-3 px-1">Full Legal Name</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                            <input type="text" name="full_name" value="<?php echo htmlspecialchars($resident['full_name']); ?>" required 
                                   class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-3 px-1">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($resident['email']); ?>" required 
                                   class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-amber-50/50 rounded-[2rem] border border-amber-100/50">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                            <i class="fas fa-key text-xs"></i>
                        </div>
                        <label class="block text-[10px] font-black uppercase text-amber-700 tracking-[0.2em]">Administrative Reset</label>
                    </div>
                    
                    <input type="password" name="password" placeholder="Enter new password" 
                           class="w-full p-4 bg-white border border-amber-200 rounded-2xl focus:ring-4 focus:ring-amber-500/10 outline-none text-sm font-bold placeholder:text-amber-200">
                    
                    <p class="text-[9px] text-amber-500 mt-3 font-black uppercase tracking-widest leading-relaxed">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Warning: This will immediately overwrite the resident's current password.
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-3 pt-4">
                    <button type="submit" name="update_resident" class="flex-[2] bg-slate-900 text-white py-5 rounded-2xl heading text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-slate-200 active:scale-95 transition-all">
                        Update Account
                    </button>
                    <a href="manage_residents.php" class="flex-1 bg-slate-100 text-slate-400 py-5 rounded-2xl heading text-[10px] font-black uppercase tracking-[0.2em] text-center hover:bg-slate-200 transition-all">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </main>

</body>
</html>