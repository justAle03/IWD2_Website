<?php
session_start();
// For the demo, we fix the job ID and pre‑stored file paths.
$_SESSION['jobID'] = 'example';
$_SESSION['user_fasta'] = 'temp_output/example_proteins.fasta';
include 'header.php';
?>
<h2>Interactive Demo</h2>
<p>
    Welcome to the Interactive Demo of this Protein Analysis Website! This demo is designed to showcase the complete workflow using a pre‑stored example dataset of <strong>glucose‑6‑phosphatase proteins from Aves</strong>. Here you can explore the key functionalities of the website and familiarise yourself with the user interface without waiting for real-time data retrieval.
</p>
<h3>What You Will Experience</h3>
<p>
    In this demo, you can:
</p>
<ul>
    <li><strong>Search the example dataset:</strong> Filter protein records by accession, name or species to quickly find proteins of interest. You can use both full or partial keywords for your search.</li>
    <li><strong>Perform a sequence alignment through Clustal Omega:</strong> Examine a pre‑computed alignment that highlights conserved regions, indicating functionally important domains.</li>
    <li><strong>Generate a motif analysis report through EMBOSS Patmatmotifs:</strong> Review a motif analysis report that identifies known functional motifs or domains in the proteins.</li>
    <li><strong>Create a conservation plot through EMBOSS Plotcon:</strong> See a graphical representation of sequence conservation across the alignment which helps reveal critical, evolutionarily conserved regions.</li>
</ul>
<p>
The demo uses pre‑stored results to give you an immediate and clear idea of how the website works so that after going through it you will be ready to confidently perform a full analysis with a custom dataset. Remember that you can freely download any file generated at any step of the analysis, there is only one caveat: you need to scroll all the way to the bottom!
</p>
<h3>Navigate the Demo</h3>
<p>
    Use the links below to explore each step of the workflow:
    <li><a href="interactive_search.php" class="menu-button">Search Example Dataset</a></li>
    <li><a href="interactive_alignment.php" class="menu-button">View Alignment</a></li>
    <li><a href="interactive_motif_analysis.php" class="menu-button">View Motif Analysis Report</a></li>
    <li><a href="interactive_conservation.php" class="menu-button">View Conservation Plot</a></li>
</p>
<?php include 'footer.php'; ?>

