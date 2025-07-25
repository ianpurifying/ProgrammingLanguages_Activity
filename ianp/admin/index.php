<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/database.php';

requireAuth();

$db = new Database();

$inquireCount = $db->prepare("SELECT COUNT(*) FROM inquire");
$inquireCount->execute();
$totalInquiries = $inquireCount->fetchColumn();

$contactCount = $db->prepare("SELECT COUNT(*) FROM contact");
$contactCount->execute();
$totalContacts = $contactCount->fetchColumn();

$pendingInquiries = $db->prepare("SELECT COUNT(*) FROM inquire WHERE status = 'pending'");
$pendingInquiries->execute();
$pendingCount = $pendingInquiries->fetchColumn();

$recentInquiries = $db->prepare("SELECT * FROM inquire ORDER BY created_at DESC LIMIT 5");
$recentInquiries->execute();
$inquiries = $recentInquiries->fetchAll(PDO::FETCH_ASSOC);

$recentContacts = $db->prepare("SELECT * FROM contact ORDER BY created_at DESC LIMIT 5");
$recentContacts->execute();
$contacts = $recentContacts->fetchAll(PDO::FETCH_ASSOC);

$title = 'Dashboard';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-lg border border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-4 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-sm font-medium text-blue-800 uppercase tracking-wide">Total Inquiries</h3>
                    <p class="text-3xl font-bold text-blue-900 mt-1"><?= $totalInquiries ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-6 rounded-xl shadow-lg border border-emerald-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-4 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg">
                    <i class="fas fa-address-book text-2xl"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-sm font-medium text-emerald-800 uppercase tracking-wide">Total Contacts</h3>
                    <p class="text-3xl font-bold text-emerald-900 mt-1"><?= $totalContacts ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl shadow-lg border border-amber-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-4 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-lg">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-sm font-medium text-amber-800 uppercase tracking-wide">Pending</h3>
                    <p class="text-3xl font-bold text-amber-900 mt-1"><?= $pendingCount ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics & Insights Section with PDF Export -->
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 via-purple-700 to-indigo-700 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-white bg-opacity-20 rounded-lg mr-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Analytics & Insights</h3>
                            <span class="text-purple-200 text-sm font-normal">Real-time data overview</span>
                        </div>
                    </div>
                    
                    <!-- PDF Export Button -->
                    <button 
                        id="exportPdfBtn" 
                        onclick="exportReportToPDF()" 
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-2 px-4 rounded-lg border border-white border-opacity-30 transition-all duration-200 flex items-center space-x-2 hover:scale-105"
                        title="Export Analytics Report as PDF"
                    >
                        <i class="fas fa-download"></i>
                        <span>Download Report</span>
                    </button>
                </div>
            </div>
            
            <!-- Report Content Container for PDF Export -->
            <div id="reportContent" class="p-8">
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <div class="analytics-card bg-gradient-to-br from-slate-50 to-slate-100 p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-semibold text-slate-800 flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                Inquiries Trend
                            </h4>
                            <span class="text-xs text-slate-500 bg-slate-200 px-2 py-1 rounded-full">Last 30 Days</span>
                        </div>
                        <div class="relative">
                            <canvas id="inquiriesChart" width="400" height="200" class="rounded-lg"></canvas>
                        </div>
                    </div>
                    
                    <div class="analytics-card bg-gradient-to-br from-slate-50 to-slate-100 p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-semibold text-slate-800 flex items-center">
                                <div class="w-3 h-3 bg-indigo-500 rounded-full mr-2"></div>
                                Category Distribution
                            </h4>
                            <span class="text-xs text-slate-500 bg-slate-200 px-2 py-1 rounded-full">All Time</span>
                        </div>
                        <div class="relative">
                            <canvas id="categoryChart" width="400" height="200" class="rounded-lg"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Metrics Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Top Users -->
                    <div class="analytics-card bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-semibold text-blue-900 flex items-center">
                                <i class="fas fa-users text-blue-600 mr-2"></i>
                                Top Active Users
                            </h4>
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-blue-600 text-sm"></i>
                            </div>
                        </div>
                        <div id="topUsersContainer" class="space-y-3"></div>
                    </div>
                    
                    <!-- Resolution Time -->
                    <div class="analytics-card bg-gradient-to-br from-emerald-50 to-teal-50 p-6 rounded-xl border border-emerald-100 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-semibold text-emerald-900 flex items-center">
                                <i class="fas fa-stopwatch text-emerald-600 mr-2"></i>
                                Resolution Time
                            </h4>
                            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-emerald-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-emerald-700 mb-2" id="avgResolutionTime">-</div>
                            <div class="text-sm font-medium text-emerald-600 uppercase tracking-wide">Average Hours</div>
                            <div class="mt-4 h-2 bg-emerald-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full w-3/4 transition-all duration-1000"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Peak Activity -->
                    <div class="analytics-card bg-gradient-to-br from-violet-50 to-purple-50 p-6 rounded-xl border border-violet-100 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-semibold text-violet-900 flex items-center">
                                <i class="fas fa-chart-bar text-violet-600 mr-2"></i>
                                Peak Activity
                            </h4>
                            <div class="w-8 h-8 bg-violet-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-fire text-violet-600 text-sm"></i>
                            </div>
                        </div>
                        <div id="peakActivityContainer" class="space-y-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Activities -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-activity mr-3"></i>
                    Recent Activities
                </h3>
            </div>
            <div class="p-6">
                <div id="recentActivities" class="space-y-4"></div>
            </div>
        </div>

        <!-- Recent Inquiries -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-inbox mr-3"></i>
                    Recent Inquiries
                </h3>
            </div>
            <div class="p-6">
                <?php if ($inquiries): ?>
                    <div class="space-y-4">
                        <?php foreach ($inquiries as $inquiry): ?>
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-100 hover:shadow-md transition-all duration-200 hover:scale-[1.02]">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <p class="font-semibold text-gray-900"><?= htmlspecialchars($inquiry['fullname']) ?></p>
                                    </div>
                                    <p class="text-sm text-gray-700 font-medium ml-11"><?= htmlspecialchars($inquiry['subject']) ?></p>
                                    <p class="text-xs text-gray-500 ml-11 mt-1 flex items-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <?= date('M j, Y', strtotime($inquiry['created_at'])) ?>
                                    </p>
                                </div>
                                <span class="status-<?= $inquiry['status'] ?> ml-4"><?= ucfirst($inquiry['status']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No inquiries yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- PDF Export JavaScript Function -->
<script>
async function exportReportToPDF() {
    const exportBtn = document.getElementById('exportPdfBtn');
    const reportContent = document.getElementById('reportContent');
    
    if (!reportContent) {
        console.error('Report content not found');
        return;
    }
    
    // Show loading state
    const originalHTML = exportBtn.innerHTML;
    exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating PDF...';
    exportBtn.disabled = true;
    
    try {
        // Configure html2canvas options for better quality
        const canvas = await html2canvas(reportContent, {
            scale: 2, // Higher quality
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            removeContainer: true,
            imageTimeout: 0,
            logging: false,
            width: reportContent.scrollWidth,
            height: reportContent.scrollHeight,
            onclone: function(clonedDoc) {
                // Ensure all styles are preserved in the clone
                const clonedElement = clonedDoc.getElementById('reportContent');
                if (clonedElement) {
                    clonedElement.style.transform = 'none';
                    clonedElement.style.animation = 'none';
                    
                    // Remove any hover effects and transitions for PDF
                    const cards = clonedElement.querySelectorAll('.analytics-card');
                    cards.forEach(card => {
                        card.style.transform = 'none';
                        card.style.transition = 'none';
                        card.style.animation = 'none';
                    });
                }
            }
        });
        
        // Create PDF with jsPDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4',
            compress: true
        });
        
        // Calculate dimensions
        const imgWidth = 210; // A4 width in mm
        const pageHeight = 295; // A4 height in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        let heightLeft = imgHeight;
        let position = 0;
        
        // Add title page
        pdf.setFontSize(20);
        pdf.setTextColor(88, 28, 135); // Purple color
        pdf.text('Analytics & Insights Report', 20, 30);
        
        pdf.setFontSize(12);
        pdf.setTextColor(107, 114, 128); // Gray color
        const currentDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        pdf.text(`Generated on: ${currentDate}`, 20, 45);
        
        // Add a separator line
        pdf.setDrawColor(209, 213, 219);
        pdf.line(20, 55, 190, 55);
        
        // Add the analytics content
        const imgData = canvas.toDataURL('image/png', 0.8);
        
        // If content fits on one page
        if (heightLeft < pageHeight - 70) {
            pdf.addImage(imgData, 'PNG', 0, 70, imgWidth, imgHeight);
        } else {
            // Multi-page handling
            pdf.addImage(imgData, 'PNG', 0, 70, imgWidth, imgHeight);
            heightLeft -= (pageHeight - 70);
            
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight + 70;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
        }
        
        // Add footer to all pages
        const pageCount = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            pdf.setPage(i);
            pdf.setFontSize(8);
            pdf.setTextColor(156, 163, 175);
            pdf.text(`Page ${i} of ${pageCount}`, 20, 285);
            pdf.text('Admin Dashboard - Analytics Report', 140, 285);
        }
        
        // Generate filename with timestamp
        const timestamp = new Date().toISOString().slice(0, 19).replace(/:/g, '-');
        const filename = `Analytics_Report_${timestamp}.pdf`;
        
        // Save the PDF
        pdf.save(filename);
        
        console.log('PDF exported successfully');
        
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF. Please try again.');
    } finally {
        // Restore button state
        exportBtn.innerHTML = originalHTML;
        exportBtn.disabled = false;
    }
}

// Optional: Add keyboard shortcut for PDF export (Ctrl+P or Cmd+P)
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P')) {
        e.preventDefault();
        exportReportToPDF();
    }
});
</script>

<?php include 'includes/footer.php'; ?>