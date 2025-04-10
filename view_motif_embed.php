<?php
// view_motif_embed.php
$report_file = 'temp_output/example_motif_report.txt';

// Check if the file exists first
if (file_exists($report_file)) {
    // Read the file into an array (each element is a line)
    $report_lines = file($report_file);
    // For preview
    $report_preview = implode('', $report_lines);
} else {
    $report_preview = "Report file not found.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style>
        body { padding: 10px; }
        pre {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            overflow-x: auto;
        }
        a.download-link {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #0277BD;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a.download-link:hover {
            background-color: #01579B;
        }
    </style>
</head>
<body>
    <pre><?= htmlspecialchars($report_preview); ?></pre>
</body>
</html>

