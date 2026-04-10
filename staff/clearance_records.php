<?php 
require_once('../includes/config.php'); 
checkRole('staff'); // Or 'admin'
include('../includes/header.php'); 
?>

<div class="flex h-screen bg-gray-100">
    <?php include('../includes/sidebar.php'); ?>

    <div class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-black text-blue-900">Clearance Records</h1>
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Search Tracking No or Name..." 
                       class="p-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl">Search</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-xs font-black uppercase text-slate-400">
                    <tr>
                        <th class="p-5">Tracking No</th>
                        <th class="p-5">Resident Name</th>
                        <th class="p-5">Purpose</th>
                        <th class="p-5">Status</th>
                        <th class="p-5">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php
                    $search = $_GET['search'] ?? '';
                    $query = "SELECT * FROM clearance_requests WHERE 
                              tracking_no LIKE '%$search%' OR 
                              resident_name LIKE '%$search%' 
                              ORDER BY created_at DESC";
                    
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="p-5 font-mono font-bold text-blue-600"><?php echo $row['tracking_no']; ?></td>
                        <td class="p-5 font-bold text-slate-700"><?php echo $row['resident_name']; ?></td>
                        <td class="p-5 text-sm text-slate-500"><?php echo $row['purpose']; ?></td>
                        <td class="p-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-700">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td class="p-5">
                            <a href="update_status.php?id=<?php echo $row['id']; ?>" class="text-blue-600 font-bold hover:underline text-sm">Update Status</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>