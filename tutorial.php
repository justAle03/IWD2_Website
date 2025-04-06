<?php 
include 'header.php';
?>

<h2>🧬 Protein Analysis Tutorial</h2>

<p>
    Welcome to the interactive tutorial! Here you can explore all functionalities of the website using the provided example dataset 
    (<strong>glucose-6-phosphatase proteins in Aves</strong>). This tutorial is designed to guide you through the workflow and explain 
    the biological significance behind each analysis step.
</p>

<!-- Example Dataset (Preview) -->
<h3>📋 Example Dataset (Preview)</h3>
<p>
    This section shows a preview of the protein dataset. The table displays approximately 50 records. 
    <strong>Interpretation:</strong> Look for variation in protein names and species to understand the diversity within the dataset.
    For more details on data formats, refer to the <a href="https://www.ncbi.nlm.nih.gov/books/NBK21185/" target="_blank">FASTA format documentation</a>.
</p>
<div class="embed-container">
    <iframe src="view_example.php?limit=50" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Interactive Search within Example Dataset -->
<h3>🔎 Search within Example Dataset</h3>
<p>
    Use this tool to filter proteins by accession, protein name, or species. The search function helps you quickly identify proteins of interest.
    <strong>Interpretation:</strong> After searching, the results table will highlight records that match your criteria. 
    For further guidance on effective querying, see <a href="https://www.ncbi.nlm.nih.gov/books/NBK179288/" target="_blank">NCBI E-utilities documentation</a>.
</p>
<div class="embed-container">
    <iframe src="p2_embed.php?limit=50" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- FASTA File View -->
<h3>📂 View Example FASTA Dataset</h3>
<p>
    This section shows the same data in FASTA format, a common format for storing sequence data.
    <strong>Interpretation:</strong> Notice the header line containing the accession, protein name, and species, followed by the sequence.
    For more on FASTA, consult <a href="https://blast.ncbi.nlm.nih.gov/Blast.cgi?CMD=Web&PAGE_TYPE=BlastDocs&DOC_TYPE=FAQ" target="_blank">NCBI FASTA FAQ</a>.
</p>
<div class="embed-container">
    <iframe src="view_fasta_embed.php?limit=50" style="width: 100%; height: 300px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Alignment View -->
<h3>📑 Sequence Alignment (Clustal Omega)</h3>
<p>
    Sequence alignment arranges protein sequences to highlight regions of similarity, which can indicate structural or functional importance.
    <strong>Interpretation:</strong> Regions that remain conserved across species may be critical for the protein's function. 
    For more details, check the <a href="https://www.ebi.ac.uk/Tools/msa/clustalo/" target="_blank">Clustal Omega documentation</a>.
</p>
<div class="embed-container">
    <iframe src="alignment_embed.php?limit=50" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Conservation Plot View -->
<h3>📊 Conservation Analysis (plotcon)</h3>
<p>
    Conservation plots graphically display how conserved each region is across an alignment. Peaks indicate high conservation,
    often corresponding to functionally important regions.
    <strong>Interpretation:</strong> High peaks suggest critical domains, while lower regions may indicate variable loops.
    See <a href="https://www.ebi.ac.uk/Tools/emboss/plotcon/" target="_blank">EMBOSS plotcon documentation</a> for more.
</p>
<div class="embed-container">
    <iframe src="plotcon_embed.php?limit=50" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<!-- Motif Analysis Report Preview -->
<h3>📋 Motif Analysis Report (Example Dataset)</h3>
<p>
    Motif analysis searches for conserved protein domains or patterns (motifs) using databases like PROSITE. 
    <strong>Interpretation:</strong> The report indicates which proteins contain known motifs, offering insights into their potential functions.
    For more details, see the <a href="https://prosite.expasy.org/" target="_blank">PROSITE website</a>.
</p>
<div class="embed-container">
    <iframe src="view_motif_embed.php?limit=50" style="width: 100%; height: 400px; border: 1px solid #ccc;"></iframe>
</div>
<hr>

<?php include 'footer.php'; ?>

