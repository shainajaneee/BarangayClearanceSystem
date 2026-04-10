<?php 
require_once('../includes/config.php'); 
require_once('../includes/mailer.php'); 
checkRole('staff');
include('../includes/header.php'); 

// Securely fetch and cast ID
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}
$id = intval($_GET['id']);

// Fetch current data and join with residents to get their email
$query = "SELECT r.*, res.email 
          FROM clearance_requests r 
          JOIN residents res ON r.resident_id = res.id 
          WHERE r.id = $id";
$request = $conn->query($query)->fetch_assoc();

if (!$request) {
    die("Request not found.");
}

if (isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    $old_status = $request['status']; 
    $tracking_no = $request['tracking_no'];
    $resident_name = $request['resident_name'];
    $resident_email = $request['email'];

    $update = $conn->prepare("UPDATE clearance_requests SET status = ? WHERE id = ?");
    $update->bind_param("si", $new_status, $id);

    if ($update->execute()) {
        // Trigger email notification only if status changed to 'Ready for Pickup'
        if ($new_status == 'Ready for Pickup' && $old_status != 'Ready for Pickup') {
            sendStatusEmail($resident_email, $resident_name, $new_status, $tracking_no);
        }
        
        header("Location: dashboard.php?msg=Updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Manage Application | Staff Portal</title>
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
                <i class="fas fa-file-signature text-white text-xs"></i>
             </div>
             <h1 class="heading text-lg font-black tracking-tighter uppercase tracking-tight">Staff</h1>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <?php include('../includes/staff_sidebar.php'); ?>
        </nav>
    </aside>

   

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex items-center gap-4">
            <a href="dashboard.php" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-slate-900 transition-colors">
                <i class="fas fa-chevron-left text-sm"></i>
            </a>
            <div>
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Manage Application</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest hidden md:block">Clearance Processing Unit</p>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-2xl mx-auto w-full">
            
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                
                <div class="p-6 md:p-10 bg-slate-50 border-b border-slate-100">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block tracking-[0.2em] mb-2">Resident Information</span>
                            <h3 class="text-xl md:text-2xl font-black text-slate-800 leading-tight"><?php echo htmlspecialchars($request['resident_name']); ?></h3>
                            <div class="flex items-center gap-2 mt-2">
                                <i class="fas fa-envelope text-blue-500 text-[10px]"></i>
                                <p class="text-sm font-bold text-slate-500"><?php echo htmlspecialchars($request['email']); ?></p>
                            </div>
                        </div>
                        <div class="w-full md:w-auto p-4 bg-white border border-slate-200 md:border-none md:p-0 rounded-2xl md:text-right">
                            <span class="text-[10px] font-black uppercase text-slate-400 block tracking-[0.2em] mb-1">Tracking Number</span>
                            <span class="font-mono text-lg font-black text-blue-600 tracking-tighter">#<?php echo $request['tracking_no']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-10">
                    <form action="" method="POST" class="space-y-8">
                        <div>
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4 px-1">
                                <i class="fas fa-tasks text-blue-500"></i> Update Progress Status
                            </label>
                            
                            <div class="relative">
                                <select name="status" class="w-full p-5 bg-slate-50 border border-slate-200 rounded-3xl font-black text-slate-700 outline-none focus:ring-4 focus:ring-blue-500/5 transition-all appearance-none text-sm uppercase tracking-widest">
                                    <option value="Pending" <?php if($request['status']=='Pending') echo 'selected'; ?>>Pending Approval</option>
                                    <option value="Processing" <?php if($request['status']=='Processing') echo 'selected'; ?>>Processing (Verification)</option>
                                    <option value="Ready for Pickup" <?php if($request['status']=='Ready for Pickup') echo 'selected'; ?>>Ready for Pickup</option>
                                    <option value="Completed" <?php if($request['status']=='Completed') echo 'selected'; ?>>Completed & Closed</option>
                                </select>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex gap-3 p-4 bg-blue-50/50 rounded-2xl border border-blue-100/50">
                                <i class="fas fa-info-circle text-blue-400 text-xs mt-0.5"></i>
                                <p class="text-[11px] text-blue-600 font-bold leading-relaxed uppercase tracking-tight">
                                    Changing status to <span class="underline">Ready for Pickup</span> will trigger an automated email to the resident.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-3 pt-4">
                            <button type="submit" name="update_status" class="flex-[2] bg-slate-900 text-white py-5 rounded-2xl heading text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-slate-200 active:scale-95 transition-all">
                                Save & Notify Resident
                            </button>
                            <a href="dashboard.php" class="flex-1 bg-slate-100 text-slate-400 py-5 rounded-2xl heading text-[10px] font-black uppercase tracking-[0.2em] text-center hover:bg-slate-200 transition-all">
                                Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4 px-6">
                <div class="w-1.5 h-1.5 rounded-full bg-blue-400"></div>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                    Request logged: <span class="text-slate-600"><?php echo date('M d, Y | h:i A', strtotime($request['applied_at'])); ?></span>
                </p>
            </div>
        </div>
    </main>

</body>
</html>