<?php
// --- DATABASE CONFIGURATION ---
$host = 'localhost';
$dbname = 'malli exp6';
$db_user = 'root'; // Change if needed
$db_pass = '';     // Change if needed

$success_msg = '';
$error_msg = '';

// --- FORM HANDLING & VALIDATION ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize Inputs
    $name = htmlspecialchars(strip_tags(trim($_POST['full_name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $company = htmlspecialchars(strip_tags(trim($_POST['company'])));
    $job_title = htmlspecialchars(strip_tags(trim($_POST['job_title'])));

    // 2. Server-Side Validation
    if (empty($name) || empty($email) || empty($phone)) {
        $error_msg = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Please enter a valid email address.";
    } else {
        // 3. Database Insertion (Secure PDO Prepared Statements)
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if email already registered
            $check_stmt = $pdo->prepare("SELECT id FROM registrations WHERE email = :email");
            $check_stmt->execute(['email' => $email]);
            
            if ($check_stmt->rowCount() > 0) {
                $error_msg = "This email is already registered for the seminar.";
            } else {
                // Insert new record
                $sql = "INSERT INTO registrations (full_name, email, phone, company, job_title) 
                        VALUES (:name, :email, :phone, :company, :job_title)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'company' => $company,
                    'job_title' => $job_title
                ]);

                $success_msg = "Registration successful! Your seat is reserved.";
                
                // Clear fields after success
                $_POST = array(); 
            }
        } catch(PDOException $e) {
            $error_msg = "System Error: Could not process registration. " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Tech Seminar Registration</title>
    <!-- Using Tailwind CSS for a modern, professional UI -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans text-slate-800">

    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side: Event Details -->
        <div class="bg-indigo-600 text-white p-10 md:w-5/12 flex flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight mb-2">Global Tech Seminar 2026</h2>
                <p class="text-indigo-200 mb-8">Join industry leaders to discuss the future of AI and scalable architecture.</p>
                
                <div class="space-y-4 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>October 15, 2026 • 9:00 AM - 5:00 PM</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Moscone Center, San Francisco, CA</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-sm text-indigo-300">
                Limited seats available. Registration closes soon.
            </div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="p-10 md:w-7/12">
            <h3 class="text-2xl font-bold text-slate-800 mb-6">Secure Your Spot</h3>

            <!-- Alert Messages -->
            <?php if (!empty($error_msg)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <p class="font-medium">Registration Failed</p>
                    <p class="text-sm"><?php echo $error_msg; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_msg)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <p class="font-medium">Success!</p>
                    <p class="text-sm"><?php echo $success_msg; ?></p>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-5">
                
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-slate-700 mb-1">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" required 
                           value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                <!-- Email & Phone (Grid) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Work Email *</label>
                        <input type="email" id="email" name="email" required 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <!-- Company & Job Title (Grid) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 mb-1">Company</label>
                        <input type="text" id="company" name="company" 
                               value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div>
                        <label for="job_title" class="block text-sm font-medium text-slate-700 mb-1">Job Title</label>
                        <input type="text" id="job_title" name="job_title" 
                               value="<?php echo isset($_POST['job_title']) ? htmlspecialchars($_POST['job_title']) : ''; ?>"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all shadow-md">
                        Complete Registration
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>