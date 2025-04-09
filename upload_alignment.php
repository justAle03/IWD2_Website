<?php
include_once 'redir.php';
include 'header.php';

echo "<h2>📂 Upload Your Alignment File (.aln)</h2>";

// Always generate a new job ID for each upload.
$upload_dir = "temp_output/";
$timestamp = time();
$jobID = 'job_' . $timestamp . '_' . uniqid();
$_SESSION['jobID'] = $jobID;  // Update the session with the new job ID

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['alignment_file'])) {
    $uploaded_name = $jobID . ".aln";
    $target_file = $upload_dir . basename($uploaded_name);

    // Validate file extension.
    $file_type = strtolower(pathinfo($_FILES['alignment_file']['name'], PATHINFO_EXTENSION));
    if ($file_type !== 'aln') {
        echo "<p style='color:red;'>❌ Please upload a valid alignment file (.aln)</p>";
    } elseif (move_uploaded_file($_FILES['alignment_file']['tmp_name'], $target_file)) {
        $_SESSION['aligned_file'] = $target_file;

        echo "<p>✅ Alignment file uploaded successfully: <strong>$target_file</strong></p>";
        echo "<p><a class='menu-button' href='$target_file' download>📥 Download your uploaded alignment file</a></p>";
        echo "<p><a class='menu-button' href='custom_conservation.php' class='button-link'>➡️ Generate Conservation Plot</a></p>";
    } else {
        echo "<p style='color:red;'>❌ Upload failed. Please try again.</p>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <p>Select your Clustal alignment file (.aln):</p>
    <input type="file" name="alignment_file" accept=".aln" required>
    <br><br>
    <input type="submit" value="Upload Alignment File" class="menu-button">
</form>

<?php include 'footer.php'; ?>

