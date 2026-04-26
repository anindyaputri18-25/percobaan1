<?php
session_start();
include 'koneksi.php';

// Jika sudah login
if (isset($_SESSION['users'])) {
    $role = $_SESSION['role'];

    if ($role == 'Pending') {
        header("Location: pending.php");
    } else if ($role == 'Kasir') {
        header("Location: kasir_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $users = mysqli_fetch_assoc($result);

    if ($users && password_verify($password, $users['password'])) {
        $_SESSION['users'] = $users['username'];
        $_SESSION['role'] = $users['role'];

        if ($users['role'] == 'Pending') {
            header("Location: pending.php");
        } else if ($users['role'] == 'Kasir') {
            header("Location: kasir_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Username atau Password Salah!'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pharma Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-blue-600 uppercase tracking-tighter flex items-center justify-center gap-3">
                <i class="fas fa-pills"></i> Pharma <span class="text-slate-800">Stock</span>
            </h1>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mt-2">Management System v1.0</p>
        </div>

        <div class="bg-white p-10 rounded-[3rem] shadow-2xl shadow-blue-100 border border-slate-100 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full"></div>
            
            <div class="relative">
                <h2 class="text-2xl font-black text-slate-800 mb-2">Selamat Datang! 👋</h2>
                <p class="text-slate-500 text-sm mb-8 italic">Silakan masuk untuk mengelola stok obat hari ini.</p>

                <form method="POST" class="space-y-5">
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-4 mb-1 block">Username</label>
                        <div class="relative">
                            <i class="fas fa-users absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="text" name="username" placeholder="Masukkan username" required 
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-4 mb-1 block">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="password" name="password" placeholder="••••••••" required 
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                        </div>
                    </div>

                    <button name="login" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black shadow-lg shadow-blue-200 hover:bg-blue-700 active:scale-95 transition uppercase tracking-widest mt-4">
                        Masuk Sekarang <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-slate-50 pt-6">
                    <p class="text-sm text-slate-500">
                        Belum punya akun? 
                        <a href="register.php" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>

        <footer class="mt-10 text-center text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">
            &copy; 2026 Pharma Stock 💊
        </footer>
    </div>

</body>
</html>