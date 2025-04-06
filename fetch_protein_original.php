<?php
include 'redir.php'; // Ensure session is active

// Retrieve and sanitize input
$protein_family = escapeshellarg($_POST['protein_family']);
$taxonomic_group = escapeshellarg($_POST['taxonomic_group']);

// Build command to call the external script
// Option A: Bash script using edirect
$command = "home/s2746547/public_html/Website/fetch_sequences.sh $protein_family $taxonomic_group";
// Option B: Python script using BioPython (uncomment next line if you choose that)
// $command = "python3 fetch_sequences.py $protein_family $taxonomic_group";

// Execute the command
$output = shell_exec($command);

// Provide feedback to the user
if(file_exists("proteins.fasta")) {
    echo "<p>Protein sequences retrieved successfully! (See proteins.fasta)</p>";
    // Optionally, display a summary or link to view the file
} else {
    echo "<p>Error: Unable to retrieve protein sequences. Please check your search criteria.</p>";
}

echo "<p><a href='indexp.php'>Return Home</a></p>";
?>

