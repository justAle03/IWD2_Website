<?php
session_start();
// For the demo, we fix the job ID and pre‑stored file paths.
$_SESSION['jobID'] = 'example';
$_SESSION['user_fasta'] = 'temp_output/example_proteins.fasta';
include 'header.php';
?>
<h2>Interactive Demo</h2>
<p>
    Welcome to the Interactive Demo of our Protein Analysis Website! This demo is designed to showcase the complete workflow using a pre‑stored example dataset of <strong>glucose‑6‑phosphatase proteins from Aves</strong>. Here you can explore the key functionalities of the website without waiting for real-time data retrieval.
</p>
<h3>What You Will Experience</h3>
<p>
    In this demo, you can:
</p>
<ul>
    <li><strong>Search the Example Dataset:</strong> Filter protein records by accession, name, or species to quickly find proteins of interest.</li>
    <li><strong>View Sequence Alignment:</strong> Examine a pre‑computed alignment that highlights conserved regions, indicating functionally important domains.</li>
    <li><strong>Motif Analysis:</strong> Review a motif analysis report that identifies known functional motifs or domains in the proteins.</li>
    <li><strong>Conservation Plot:</strong> See a graphical representation of sequence conservation across the alignment, which helps reveal critical, evolutionarily conserved regions.</li>
</ul>
<p>
    Each of these steps is designed to provide you with both an understanding of the analysis process and relevant biological insights. The demo uses pre‑stored results to give you an immediate and clear idea of how the website works.
</p>
<h3>Navigate the Demo</h3>
<p>
    Use the links below to explore each step of the workflow:
</p>
<ul>
    <li><a href="interactive_search.php" class="button-link">Search Example Dataset</a></li>
    <li><a href="interactive_alignment.php" class="button-link">View Alignment</a></li>
    <li><a href="interactive_motif_analysis.php" class="button-link">View Motif Analysis Report</a></li>
    <li><a href="interactive_conservation.php" class="button-link">View Conservation Plot</a></li>
</ul>
<?php include 'footer.php'; ?>

