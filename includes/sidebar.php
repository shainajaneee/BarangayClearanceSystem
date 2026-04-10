<?php
// Determine active page for styling
$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? '';
?>

<div class="flex flex-col w-64 h-screen px-4 py-8 bg-blue-900 border-r border-blue-800 shadow-2xl">
    <div class="flex flex-col items-center mb-10">
        <h2 class="text-xl font-bold text-white uppercase tracking-wider">Brgy. Old Poblacion</h2>
        <p class="text-xs text-blue-300 font-medium">Digital Clearance System</p>
    </div>

    <div class="flex flex-col justify-between flex-1">
        <nav class="space-y-2">
            <a class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-300 transform rounded-lg hover:bg-blue-800 <?php echo ($current_page == 'dashboard.php') ? 'bg-blue-800' : ''; ?>" href="dashboard.php">
                <span class="mx-4 font-medium">Dashboard</span>
            </a>

            <?php if ($role === 'admin'): ?>
                <a class="flex items-center px-4 py-3 text-gray-100 transition-colors duration-300 transform rounded-lg hover:bg-blue-800" href="manage_staff.php">
                    <span class="mx-4 font-medium">Manage Staff</span>
                </a>
                <a class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-800" href="manage_users.php">
    <span class="mx-4 font-medium">Manage Users</span>
</a>
                </a>
                <a class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-800" href="manage_residents.php">
    <span class="mx-4 font-medium">Manage Residents</span>
</a>
            <?php endif; ?>

            
        </nav>

        <div class="mt-auto">
            <div class="flex items-center px-4 -mx-2 mb-4">
                <div class="mx-2">
                    <h4 class="font-medium text-blue-100"><?php echo $_SESSION['username'] ?? 'User'; ?></h4>
                    <p class="text-xs text-blue-400 capitalize"><?php echo $role; ?></p>
                </div>
            </div>
            
            <a href="../logout.php" class="flex items-center px-4 py-3 text-red-400 transition-colors duration-300 transform rounded-lg hover:bg-red-500 hover:text-white">
                <span class="mx-4 font-medium">Logout</span>
            </a>
        </div>
    </div>
</div>