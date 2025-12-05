<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$dataFile = '../../data/inquiries.json';
$inquiries = [];

if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    $inquiries = json_decode($content, true) ?: [];
}

$totalInquiries = count($inquiries);
$newInquiries = count(array_filter($inquiries, function($i) { return $i['status'] === 'New'; }));
$contactedInquiries = count(array_filter($inquiries, function($i) { return $i['status'] === 'Contacted'; }));
$enrolledInquiries = count(array_filter($inquiries, function($i) { return $i['status'] === 'Enrolled'; }));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed');
    }
    
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        
        if ($_POST['action'] === 'update_status' && isset($_POST['status'])) {
            $newStatus = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
            $allowedStatuses = ['New', 'Contacted', 'Enrolled'];
            
            if (in_array($newStatus, $allowedStatuses)) {
                foreach ($inquiries as &$inquiry) {
                    if ($inquiry['id'] === $id) {
                        $inquiry['status'] = $newStatus;
                        break;
                    }
                }
                file_put_contents($dataFile, json_encode($inquiries, JSON_PRETTY_PRINT));
            }
        } elseif ($_POST['action'] === 'delete') {
            $inquiries = array_filter($inquiries, function($i) use ($id) { return $i['id'] !== $id; });
            $inquiries = array_values($inquiries);
            file_put_contents($dataFile, json_encode($inquiries, JSON_PRETTY_PRINT));
        }
        
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AstroVastu Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: var(--bg-light);
            padding-top: 0;
        }
        .page-wrapper {
            padding: 30px;
        }
        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin: 2px;
        }
        .btn-view { background: #3b82f6; color: white; }
        .btn-contact { background: #f59e0b; color: white; }
        .btn-enroll { background: #10b981; color: white; }
        .btn-delete { background: #ef4444; color: white; }
        .action-btn:hover { opacity: 0.8; transform: translateY(-2px); }
        .inquiry-details {
            display: none;
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .inquiry-details.active { display: block; }
        @media (max-width: 768px) {
            .admin-stats { grid-template-columns: 1fr 1fr; }
            .page-wrapper { padding: 15px; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="admin-container">
            <div class="admin-header">
                <div>
                    <h1><i class="fas fa-om" style="margin-right: 15px;"></i>Admin Dashboard</h1>
                    <p style="opacity: 0.8; margin-top: 5px;">Welcome, <?php echo $_SESSION['admin_username']; ?></p>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <a href="../index.php" class="logout-btn" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Website
                    </a>
                    <a href="logout.php" class="logout-btn" style="background: rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            
            <div class="admin-stats">
                <div class="stat-box">
                    <i class="fas fa-clipboard-list"></i>
                    <div>
                        <h3><?php echo $totalInquiries; ?></h3>
                        <p>Total Inquiries</p>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-bell" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"></i>
                    <div>
                        <h3><?php echo $newInquiries; ?></h3>
                        <p>New Inquiries</p>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-phone" style="background: linear-gradient(135deg, #f59e0b, #d97706);"></i>
                    <div>
                        <h3><?php echo $contactedInquiries; ?></h3>
                        <p>Contacted</p>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-user-check" style="background: linear-gradient(135deg, #10b981, #059669);"></i>
                    <div>
                        <h3><?php echo $enrolledInquiries; ?></h3>
                        <p>Enrolled</p>
                    </div>
                </div>
            </div>
            
            <div class="inquiries-table">
                <h2><i class="fas fa-inbox" style="margin-right: 10px; color: var(--primary-color);"></i>All Inquiries</h2>
                
                <?php if (empty($inquiries)): ?>
                <div style="padding: 60px; text-align: center; color: var(--text-light);">
                    <i class="fas fa-inbox" style="font-size: 60px; margin-bottom: 20px; opacity: 0.3;"></i>
                    <p style="font-size: 18px;">No inquiries yet</p>
                    <p>New admission inquiries will appear here</p>
                </div>
                <?php else: ?>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inquiries as $inquiry): ?>
                            <tr>
                                <td><?php echo date('d M Y', strtotime($inquiry['date'])); ?><br><small style="color: var(--text-light);"><?php echo date('h:i A', strtotime($inquiry['date'])); ?></small></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($inquiry['name']); ?></strong>
                                    <?php if (!empty($inquiry['email'])): ?>
                                    <br><small style="color: var(--text-light);"><?php echo htmlspecialchars($inquiry['email']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="tel:<?php echo htmlspecialchars($inquiry['phone']); ?>" style="color: var(--primary-color);">
                                        <?php echo htmlspecialchars($inquiry['phone']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($inquiry['course']); ?></td>
                                <td><?php echo htmlspecialchars($inquiry['city'] ?: '-'); ?></td>
                                <td>
                                    <?php
                                    $statusClass = 'status-new';
                                    if ($inquiry['status'] === 'Contacted') $statusClass = 'status-contacted';
                                    if ($inquiry['status'] === 'Enrolled') $statusClass = 'status-enrolled';
                                    ?>
                                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $inquiry['status']; ?></span>
                                </td>
                                <td>
                                    <button class="action-btn btn-view" onclick="toggleDetails('<?php echo htmlspecialchars($inquiry['id']); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if ($inquiry['status'] === 'New'): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($inquiry['id']); ?>">
                                        <input type="hidden" name="status" value="Contacted">
                                        <button type="submit" class="action-btn btn-contact"><i class="fas fa-phone"></i></button>
                                    </form>
                                    <?php endif; ?>
                                    <?php if ($inquiry['status'] !== 'Enrolled'): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($inquiry['id']); ?>">
                                        <input type="hidden" name="status" value="Enrolled">
                                        <button type="submit" class="action-btn btn-enroll"><i class="fas fa-user-check"></i></button>
                                    </form>
                                    <?php endif; ?>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($inquiry['id']); ?>">
                                        <button type="submit" class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding: 0; border: none;">
                                    <div class="inquiry-details" id="details-<?php echo $inquiry['id']; ?>">
                                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                                            <div>
                                                <strong>Full Name:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['name']); ?>
                                            </div>
                                            <div>
                                                <strong>Phone:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['phone']); ?>
                                            </div>
                                            <div>
                                                <strong>Email:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['email'] ?: 'Not provided'); ?>
                                            </div>
                                            <div>
                                                <strong>City:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['city'] ?: 'Not provided'); ?>
                                            </div>
                                            <div>
                                                <strong>Occupation:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['occupation'] ?: 'Not provided'); ?>
                                            </div>
                                            <div>
                                                <strong>Preferred Batch:</strong><br>
                                                <?php echo htmlspecialchars($inquiry['batch'] ?: 'Not specified'); ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($inquiry['message'])): ?>
                                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ccc;">
                                            <strong>Message:</strong><br>
                                            <?php echo nl2br(htmlspecialchars($inquiry['message'])); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            details.classList.toggle('active');
        }
    </script>
</body>
</html>
