<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();

$analytics = [];

$inquiriesOverTime = $db->prepare("
    SELECT DATE(created_at) as date, COUNT(*) as count 
    FROM inquire 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) 
    GROUP BY DATE(created_at) 
    ORDER BY date ASC
");
$inquiriesOverTime->execute();
$timeData = $inquiriesOverTime->fetchAll(PDO::FETCH_ASSOC);

$analytics['inquiries_over_time'] = $timeData;

$categoryBreakdown = $db->prepare("
    SELECT 
        CASE 
            WHEN category IS NULL OR category = '' THEN 'General' 
            ELSE category 
        END as category, 
        COUNT(*) as count 
    FROM inquire 
    GROUP BY category 
    ORDER BY count DESC
");
$categoryBreakdown->execute();
$categoryData = $categoryBreakdown->fetchAll(PDO::FETCH_ASSOC);

$analytics['category_breakdown'] = $categoryData;

$topUsers = $db->prepare("
    SELECT email, COUNT(*) as inquiry_count 
    FROM inquire 
    GROUP BY email 
    ORDER BY inquiry_count DESC 
    LIMIT 5
");
$topUsers->execute();
$userData = $topUsers->fetchAll(PDO::FETCH_ASSOC);

$analytics['top_users'] = $userData;

$resolutionTime = $db->prepare("
    SELECT AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours 
    FROM inquire 
    WHERE status != 'pending' AND updated_at IS NOT NULL
");
$resolutionTime->execute();
$avgTime = $resolutionTime->fetchColumn();

$analytics['average_resolution_time'] = round($avgTime ?: 0, 1);

$peakHours = $db->prepare("
    SELECT HOUR(created_at) as hour, COUNT(*) as count 
    FROM inquire 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    GROUP BY HOUR(created_at) 
    ORDER BY count DESC 
    LIMIT 5
");
$peakHours->execute();
$hourData = $peakHours->fetchAll(PDO::FETCH_ASSOC);

$analytics['peak_hours'] = $hourData;

$peakDays = $db->prepare("
    SELECT DAYNAME(created_at) as day, COUNT(*) as count 
    FROM inquire 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    GROUP BY DAYOFWEEK(created_at), DAYNAME(created_at)
    ORDER BY count DESC
");
$peakDays->execute();
$dayData = $peakDays->fetchAll(PDO::FETCH_ASSOC);

$analytics['peak_days'] = $dayData;

header('Content-Type: application/json');
echo json_encode($analytics);
?>