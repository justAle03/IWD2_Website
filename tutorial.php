<?php 
include 'header.php';
?>

<h2>🧬 Protein Analysis Tutorial</h2>

<p>
    Welcome to the interactive tutorial! Here you can explore the full set of results that you can obtain through the various functionalities of the website using the provided example dataset 
    (<strong>glucose-6-phosphatase proteins in Aves</strong>). This interactive tutorial is designed to show you the type of results you can generate through through the workflow so you can decide which tools to try!
</p>

<!-- Example Dataset (Preview) -->
<h3>📋 Example Dataset (Preview)</h3>
<p>
    This section shows a preview of the underlying protein dataset. The table displays 945 records.You can scroll down to explore what species are featured within the example dataset.
</p>
<div class="embed-container">
    <iframe src="view_example.php" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Interactive Search within Example Dataset -->
<h3>🔎 Search within Example Dataset</h3>
<p>
    Use this tool to search proteins by accession, protein name or species. You can explore using full or partial search terms. The search function can help you to quickly identify proteins of interest and even create subsets to use for further analysis.
</p>
<div class="embed-container">
    <iframe src="p2_embed.php" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- FASTA File View -->
<h3>📂 View Example FASTA Dataset</h3>
<p>
    This section shows the same data in FASTA format, a common format for storing sequence data. Note how each record starts with ">" and the relevant accession code.If you scroll through the fasta file, you will be able to quickly see the sequences in more depth, having access to the specific aminoacid composition of each protein. 
</p>
<div class="embed-container">
    <iframe src="view_fasta_embed.php" style="width: 100%; height: 300px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Alignment View -->
<h3>📑 Sequence Alignment (Clustal Omega)</h3>
<p>
    Sequence alignment arranges protein sequences to highlight regions of similarity which can indicate structural or functional importance. Regions that remain conserved across species may be critical for the protein's function. 
</p>
<div class="embed-container">
    <iframe src="alignment_embed.php" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Conservation Plot View -->
<h3>📊 Conservation Analysis (EMBOSS Plotcon)</h3> 
<p>
    Conservation plots graphically display how conserved each region is across an alignment. Peaks indicate high conservation,
    often corresponding to functionally important regions. High peaks suggest critical domains while lower regions may indicate variable loops.
</p>
<div class="embed-container">
    <iframe src="plotcon_embed.php" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Motif Analysis Report Preview -->
<h3>📋 Motif Analysis Report (EMBOSS Patmatmotifs)</h3>
<p>
    Motif analysis searches for conserved protein domains or patterns (motifs) using databases like PROSITE. The report indicates which proteins contain known motifs, offering insights into their potential functions.
</p>
<div class="embed-container">
    <iframe src="view_motif_embed.php" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<?php include 'footer.php'; ?>

