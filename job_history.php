<?php
session_start();
include 'header.php';

// Define the directory where job files are stored.
$upload_dir = "temp_output/";

// Get all files in temp_output that start with "job_"
$allFiles = glob($upload_dir . "job_*");

// Extract unique job IDs from the filenames.
$jobIDs = array();
foreach ($allFiles as $file) {
    $base = basename($file);
    // Use regex to capture the job ID portion.
    // Assuming job IDs are in the format: job_<timestamp>_<uniqid>
    if (preg_match('/^(job_\d+_[a-f0-9]+)/i', $base, $matches)) {
        $jobIDs[$matches[1]] = true;
    }
}
$uniqueJobIDs = array_keys($jobIDs);

// Sort job IDs descending based on the timestamp (extracted from job ID).
usort($uniqueJobIDs, function($a, $b) {
    preg_match('/^job_(\d+)_/i', $a, $matchA);
    preg_match('/^job_(\d+)_/i', $b, $matchB);
    $tsA = isset($matchA[1]) ? (int)$matchA[1] : 0;
    $tsB = isset($matchB[1]) ? (int)$matchB[1] : 0;
    return $tsB - $tsA;
});

// Limit to the top 10 jobs.
$uniqueJobIDs = array_slice($uniqueJobIDs, 0, 10);

// Helper function to generate a standardized download link.
function generateFileLink($file, $jobID) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $baseName = basename($file);
    $label = "";
    if ($ext === "fasta") {
        if (strpos($baseName, $jobID . "_subset") === 0) {
            // For subset files, extract the number if available.
            if (preg_match('/_subset(\d+)\.fasta$/', $baseName, $matches)) {
                $label = "Download Subset FASTA file (" . $matches[1] . ")";
            } else {
                $label = "Download Subset FASTA file";
            }
        } elseif ($baseName === $jobID . ".fasta") {
            $label = "Download Full FASTA file";
        } else {
            $label = "Download FASTA file";
        }
    } elseif ($ext === "aln") {
        $label = "Download Alignment file";
    } elseif ($ext === "png") {
        $label = "Download Conservation Plot";
    } elseif ($ext === "txt") {
        $label = "Download Motif Analysis Report";
    } else {
        $label = "Download " . strtoupper($ext) . " file";
    }
    return "<a href='$file' class='button-link' download>$label</a>";
}
?>

<h2>Job History (Top 10)</h2>

<?php if (count($uniqueJobIDs) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Job ID</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($uniqueJobIDs as $jobID): ?>
        <tr>
            <td><?= htmlspecialchars($jobID) ?></td>
            <td>
                <?php 
                // Retrieve all files for this job.
                $files = glob($upload_dir . "*" . $jobID . "*");
                ?>
                <?php if (count($files) > 0): ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php 
                        foreach ($files as $file) {
                            echo "<li>" . generateFileLink($file, $jobID) . "</li>";
                        }
                        ?>
                    </ul>
                <?php else: ?>
                    <em>No files available.</em>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No job history available.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>

