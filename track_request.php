<?php 
require_once('includes/config.php'); 
$result = null;
$error = null;

if(isset($_POST['track'])) {
    $tn = strtoupper(trim($_POST['tracking_no'])); // Force uppercase for DB consistency
    $stmt = $conn->prepare("SELECT * FROM clearance_requests WHERE tracking_no = ?");
    $stmt->bind_param("s", $tn);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    if(!$result) { $error = "Invalid Tracking Number. Please check your reference slip."; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Track Your Application | Old Poblacion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brgy-navy': '#00468B',
                        'brgy-gold': '#FFCC00',
                    },
                    fontFamily: {
                        'heading': ['Montserrat', 'sans-serif'],
                        'body': ['Open Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Open Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        .status-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen text-slate-900">

    <div class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-md mx-auto px-6 py-4 flex items-center justify-between">
            <a href="index.php" class="p-2 -ml-2 hover:bg-slate-50 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-brgy-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xs font-black uppercase tracking-[0.2em] text-brgy-navy">Tracking Portal</h1>
            <div class="w-10"></div> </div>
    </div>

    <div class="max-w-md mx-auto p-6 flex flex-col min-h-[calc(100vh-65px)]">
        
        <div class="mb-8">
            <h2 class="text-2xl font-black text-brgy-navy mb-2">Check Progress</h2>
            <p class="text-sm text-slate-500 font-semibold">Enter the tracking number provided during your application to see the current status.</p>
        </div>

        <form action="" method="POST" class="space-y-4">
            <div class="relative group">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2 block ml-1">Reference Number</label>
                <input type="text" name="tracking_no" required 
                       placeholder="BOP-2026-XXXX" 
                       value="<?php echo isset($_POST['tracking_no']) ? $_POST['tracking_no'] : ''; ?>"
                       class="w-full p-5 bg-white border-2 border-slate-100 rounded-2xl font-mono font-bold text-brgy-navy focus:border-brgy-navy focus:ring-4 focus:ring-brgy-navy/5 outline-none text-lg uppercase transition-all shadow-sm">
                <div class="absolute right-5 bottom-5 text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button type="submit" name="track" class="w-full bg-brgy-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest shadow-xl shadow-blue-900/20 active:scale-[0.98] transition-all hover:bg-blue-800">
                Track Application
            </button>
        </form>

        <?php if($error): ?>
            <div class="mt-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl text-[11px] font-bold uppercase text-center tracking-widest flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if($result): ?>
            <?php 
                $s = $result['status'];
                $isPending = ($s == 'Pending');
                $isProcessing = ($s == 'Processing');
                $isReady = ($s == 'Ready' || $s == 'Completed');
            ?>
            <div class="mt-8 bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200 border border-white animate-in fade-in slide-in-from-bottom-6 duration-500">
                
                <div class="flex items-center justify-between mb-10 px-2">
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black <?php echo $result ? 'bg-brgy-navy text-white' : 'bg-slate-100 text-slate-400'; ?>">1</div>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Applied</span>
                    </div>
                    <div class="h-[2px] flex-1 bg-slate-100 mx-2 mb-6">
                        <div class="h-full bg-brgy-navy transition-all duration-1000" style="width: <?php echo ($isProcessing || $isReady) ? '100%' : '0%'; ?>"></div>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black <?php echo ($isProcessing || $isReady) ? 'bg-brgy-navy text-white' : 'bg-slate-100 text-slate-400'; ?>">2</div>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Review</span>
                    </div>
                    <div class="h-[2px] flex-1 bg-slate-100 mx-2 mb-6">
                        <div class="h-full bg-brgy-navy transition-all duration-1000" style="width: <?php echo ($isReady) ? '100%' : '0%'; ?>"></div>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black <?php echo ($isReady) ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-100' : 'bg-slate-100 text-slate-400'; ?>">3</div>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Ready</span>
                    </div>
                </div>

                <div class="text-center mb-8 bg-slate-50 rounded-3xl py-6 border border-slate-100">
                    <div class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-1">Status Result</div>
                    <div class="text-3xl font-black uppercase <?php echo $isReady ? 'text-emerald-500' : ($isProcessing ? 'text-blue-500' : 'text-amber-500'); ?> tracking-tighter flex items-center justify-center gap-2">
                        <?php if(!$isReady): ?> <span class="w-2 h-2 bg-current rounded-full status-pulse"></span> <?php endif; ?>
                        <?php echo $s; ?>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex flex-col gap-1 py-3 border-b border-slate-50">
                        <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Resident Name</span>
                        <span class="text-sm font-bold text-slate-800"><?php echo $result['resident_name']; ?></span>
                    </div>
                    <div class="flex flex-col gap-1 py-3 border-b border-slate-50">
                        <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Document Type</span>
                        <span class="text-sm font-bold text-slate-800"><?php echo $result['document_type']; ?></span>
                    </div>
                    <div class="flex flex-col gap-1 py-3">
                        <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Filing Date</span>
                        <span class="text-sm font-bold text-slate-800"><?php echo date('F d, Y', strtotime($result['applied_at'])); ?></span>
                    </div>
                </div>
            </div>
            
            <?php if($isReady): ?>
                <div class="mt-6 p-5 bg-emerald-50 rounded-2xl border border-emerald-100">
                    <p class="text-[11px] text-emerald-800 leading-relaxed font-bold">
                        ✨ <span class="uppercase">Note:</span> Your document is ready! Please proceed to the Barangay Hall with a valid ID to claim.
                    </p>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <footer class="mt-auto pt-10 pb-6 text-center">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-loose">
                Barangay Old Poblacion<br>
                <span class="text-slate-200">Escalante City, Negros Occidental</span>
            </p>
        </footer>
    </div>

</body>
</html>