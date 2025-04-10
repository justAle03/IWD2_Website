<?php
include 'header.php';
?>
<h2>Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>!</h2>
<p>
  This website is designed to provide a comprehensive analysis of protein sequences for biological research. Here are the key functionalities:
</p>

<h3>Click Me!:</h3>
<p>
  ✨ This is where the magic truly begins: Have a look at these guidance pages to learn how to use the website and what results to expect before trying it yourself! Use the interactive demo to explore the website’s capabilities using a pre‑stored example dataset (glucose‑6‑phosphatase proteins from Aves). You can search the dataset, view example alignments, see conservation plots and review motif analysis reports - all designed to give you a clear insight into the user interface and analysis process. You will also be able to download the generated files along the way, how cool is that! Open the interactive tutorial to get a quick flavour of the type of results you might get without having to go through the whole analysis process.
</p>

<h3>Full Analysis Workflow:</h3>
<ul>
  <li>🔍 Retrieve Protein Sequences: Enter a protein family and taxonomic group to fetch relevant protein sequences from the NCBI in real time.</li>
  <li>🚀 Custom Analysis Pipeline: Once retrieved, you can perform a series of analyses on these sequences - including sequence alignment (Clustal Omega), conservation analysis (EMBOSS Plotcon) and motif analysis to scan for known domains (EMBOSS Patmatmotifs).</li>
</ul>

<h3>Stand-alone Tools:</h3>
<ul>
  <li>📤 Upload Your Own Data: If you already have FASTA files or pre-computed alignment (.aln) files, the standalone tools let you upload these files to run further analyses (e.g., generating conservation plots, perform alignments or create motif reports).</li>
  <li>🔒 Files are tagged with a unique job ID so that you can easily track and retrieve your results later via the Job History page.</li>
</ul>

<h3>Job History:</h3>
<ul>
  <li>📁 View Past Analyses: Access previous jobs and download associated results (e.g., FASTA files, alignments, conservation plots and motif reports), making it easy to revisit or share your findings.</li>
</ul>

<h3>Credits:</h3>
<ul>
  <li>💡 Although I wish I was the sole mind behind all these incredible tool, truth is... I am not 🤯 and it is fundamental to give credit where credit is due. If you value giving credit as much as I do, please take some time to go through this page. It will not be time wasted, promise!</li>
</ul>

<h3>Help:</h3>
<ul>
  <li>❓ Lost in translation? Fear not, have a look here and you might find what you are looking for... or not 😜.</li>
</ul>

<h3>Logout:</h3>
<ul>
  <li>🚪 If you are ready to leave us 😢, click on this and you will be out and about again. Thank you for being here, however briefly.</li>
</ul>

<p>
  I hope this platform empowers your research by integrating robust bioinformatics analyses with a user-friendly interface.
</p>

<?php include 'footer.php'; ?>

