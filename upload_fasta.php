<?php
session_start();
include 'header.php';

echo "<h2>📤 Upload Your FASTA File</h2>";

// Always generate a new job ID for each upload.
$upload_dir = "temp_output/";
$timestamp = time();
$jobID = 'job_' . $timestamp . '_' . uniqid();
$_SESSION['jobID'] = $jobID;  // Update the session with the new job ID

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fasta_file'])) {
    $uploaded_name = $jobID . ".fasta";
    $target_file = $upload_dir . basename($uploaded_name);

    // Validate file type
    $file_type = strtolower(pathinfo($_FILES['fasta_file']['name'], PATHINFO_EXTENSION));
    if ($file_type !== 'fasta' && $file_type !== 'fa' && $file_type !== 'txt') {
        echo "<p style='color:red;'>❌ Please upload a valid FASTA file (.fasta, .fa, .txt)</p>";
    } elseif (move_uploaded_file($_FILES['fasta_file']['tmp_name'], $target_file)) {
        $_SESSION['user_fasta'] = $target_file;

        echo "<p>✅ File uploaded successfully: <strong>$target_file</strong></p>";
        echo "<p><a href='$target_file' download>📥 Download your uploaded file</a></p>";
        echo "<p><a class='menu-button' href='custom_alignment.php'>➡️ Proceed to Alignment</a></p>";
        echo "<p><a class='menu-button' href='motif_analysis.php'>➡️ Proceed to Motif Analysis</a></p>";
    } else {
        echo "<p style='color:red;'>❌ Upload failed. Please try again.</p>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Select a FASTA file to upload:</label><br>
    <input type="file" name="fasta_file" accept=".fasta,.fa,.txt" required>
    <br><br>
    <input type="submit" value="Upload FASTA File">
</form>

<?php include 'footer.php'; ?>

