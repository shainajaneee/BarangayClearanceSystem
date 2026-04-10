<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Brgy. Old Poblacion System</title>
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-900 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
<a href="dashboard.php" class="flex items-center gap-3 active:scale-95 transition-transform">
    <img src="../assets/pictures/logo.jpg" alt="BOP Logo" class="h-8 w-auto md:h-10">
</a>            <div class="space-x-4">
                <?php if(isset($_SESSION['role'])): ?>
                    <span class="text-sm opacity-75">Hello, <?php echo $_SESSION['username'] ?? 'User'; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </nav>