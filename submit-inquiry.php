<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8') : '';
    $phone = isset($_POST['phone']) ? preg_replace('/[^0-9+\-\s]/', '', trim($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8') : '';
    $occupation = isset($_POST['occupation']) ? htmlspecialchars(trim($_POST['occupation']), ENT_QUOTES, 'UTF-8') : '';
    $course = isset($_POST['course']) ? htmlspecialchars(trim($_POST['course']), ENT_QUOTES, 'UTF-8') : '';
    $batch = isset($_POST['batch']) ? htmlspecialchars(trim($_POST['batch']), ENT_QUOTES, 'UTF-8') : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8') : '';
    
    if (empty($name) || empty($phone) || empty($course)) {
        header('Location: contact.php?error=1');
        exit;
    }
    
    $inquiry = [
        'id' => uniqid(),
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'city' => $city,
        'occupation' => $occupation,
        'course' => $course,
        'batch' => $batch,
        'message' => $message,
        'status' => 'New',
        'date' => date('Y-m-d H:i:s')
    ];
    
    $dataFile = 'data/inquiries.json';
    
    if (!file_exists('data')) {
        mkdir('data', 0755, true);
    }
    
    $inquiries = [];
    if (file_exists($dataFile)) {
        $content = file_get_contents($dataFile);
        $inquiries = json_decode($content, true) ?: [];
    }
    
    array_unshift($inquiries, $inquiry);
    
    file_put_contents($dataFile, json_encode($inquiries, JSON_PRETTY_PRINT));
    
    header('Location: contact.php?success=1');
    exit;
} else {
    header('Location: contact.php');
    exit;
}
?>
