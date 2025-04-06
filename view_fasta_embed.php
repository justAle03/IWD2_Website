<?php
// view_fasta_embed.php
$fasta_file = 'temp_output/example_proteins.fasta';

// Read only first 10 lines of FASTA for preview
$fasta_lines = file($fasta_file);
$fasta_preview = implode('', $fasta_lines);
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Example FASTA Dataset (Preview)</title>
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
    <h3>Example FASTA Dataset</h3>
    <pre><?= htmlspecialchars($fasta_preview); ?></pre>
    <a href="<?= $fasta_file ?>" class="download-link" download>⬇️ Download Full FASTA file</a>
</body>
</html>

