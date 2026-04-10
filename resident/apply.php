<?php 
require_once('../includes/config.php'); 
checkRole('resident'); 
include('../includes/header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Request Clearance | BOP Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .heading { font-family: 'Montserrat', sans-serif; }
        input:focus, select:focus, textarea:focus { border-color: #2563eb !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased text-slate-900">

    <aside class="hidden lg:flex flex-col w-72 bg-[#001529] h-screen fixed left-0 top-0 text-white z-50">
        <div class="p-8 border-b border-white/10 flex items-center gap-3">
             <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-signature text-xs"></i>
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
        <a href="apply.php" class="flex flex-col items-center gap-1 text-blue-600">
            <i class="fas fa-plus-circle text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Apply</span>
        </a>
        <a href="appointments.php" class="flex flex-col items-center gap-1 text-slate-400">
            <i class="fas fa-calendar-check text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Visits</span>
        </a>
        <a href="../logout.php" class="flex flex-col items-center gap-1 text-rose-500">
            <i class="fas fa-power-off text-lg"></i>
            <span class="text-[9px] font-black uppercase tracking-widest">Logout</span>
        </a>
    </nav>

    <main class="lg:ml-72 min-h-screen flex flex-col pb-24 lg:pb-0">
        
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 p-4 md:p-6 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <a href="dashboard.php" class="lg:hidden bg-slate-100 p-2 rounded-lg text-slate-600 mr-1">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <h2 class="heading text-sm font-black text-slate-800 uppercase tracking-tight">Request Clearance</h2>
            </div>
            <div class="hidden md:block">
                <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                    Step 1: Application
                </span>
            </div>
        </header>

        <div class="p-5 md:p-10 max-w-2xl mx-auto w-full">
            
            <div class="mb-8 hidden md:block">
                <h1 class="heading text-3xl font-black text-slate-900 tracking-tight leading-none">New Application</h1>
                <p class="text-slate-500 font-medium mt-2">Fill out the details below to process your document.</p>
            </div>

            <form action="process_request.php" method="POST" class="space-y-5">
                
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Applicant Identity</label>
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-black">
                            <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Verified Resident Account</p>
                        </div>
                    </div>
                    <input type="hidden" name="resident_name" value="<?php echo $_SESSION['username']; ?>">
                </div>

                <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3 px-1">Type of Document</label>
                        <div class="relative">
                            <select name="document_type" required 
                                    class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold appearance-none outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                                <option value="">-- Select Document --</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="Barangay ID">Barangay ID</option>
                                <option value="Certificate of Residency">Certificate of Residency</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3 px-1">Purpose of Request</label>
                        <textarea name="purpose" rows="4" placeholder="e.g. For Employment, Scholarship, etc." required 
                                  class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3 px-1">Active Contact Number</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">+63</span>
                            <input type="tel" name="contact_no" placeholder="912 345 6789" required 
                                   class="w-full p-4 pl-14 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                    </div>

                </div>

                <div class="pt-4">
                    <button type="submit" name="submit_request" 
                            class="w-full bg-[#001529] text-white py-5 rounded-[2rem] heading text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-slate-200 active:scale-95 transition-all">
                        Submit Application
                    </button>
                    <p class="text-center text-[10px] text-slate-400 font-bold mt-6 uppercase tracking-widest">
                        <i class="fas fa-info-circle mr-1"></i> Data will be processed by Barangay Staff
                    </p>
                </div>

            </form>
        </div>
    </main>

    <?php include('../includes/footer.php'); ?>
</body>
</html>