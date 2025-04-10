<?php
session_start();
include 'header.php';
?>
<h2>Help & Support</h2>

<p>Welcome to the Help page for the Protein Analysis Website! If you're having difficulty or need guidance on how to use the site, please refer to the information below.</p>

<h3>Getting Started</h3>
<p>
  After logging in, you'll have access to the full custom analysis workflow, the stand-alone tools and the job history page. While you are still deciding, you can have a look at the interactive demo and the interactive tutorial if you wish. The interactive demo uses a pre‑stored example dataset (glucose‑6‑phosphatase proteins from Aves) to help you familiarise yourself with the website’s user interface and capabilities without waiting for real‐time analysis. If you just want to see quickly what type of results you might be able to generate with this website, I suggest you have a look at the interactive tutorial. 
</p>

<h3>Using the Analysis Tools</h3>
<ul>
  <li><strong>Retrieve Protein Sequences:</strong> Enter a protein family and taxonomic group to fetch relevant protein sequences from NCBI in real time.</li>
  <li><strong>Custom Analysis Pipeline:</strong> Once the sequences are retrieved, you can perform sequence alignment (Clustal Omega), conservation analysis (EMBOSS Plotcon) and motif analysis (EMBOSS Patmatmotifs) to uncover biologically important features.</li>
  <li><strong>Standalone Tools:</strong> You may also upload your own FASTA or alignment files if you have pre‑computed data. Each file is tagged with a unique job ID so you can easily track your results via the Job History page.</li>
</ul>

<h3>Frequently Asked Questions</h3>
<ul>
  <li><strong>Why must I log in?</strong> - You must <strong> not </strong>! However, I strongly advise you to if you do not want to miss out on the opportunity to access this website's full functionality.</li>
  <li><strong>What should I do if I encounter errors?</strong> – Ensure you enter the correct query details and file formats. For further assistance, consult this Help page or contact support.</li>
  <li><strong>How are my results saved?</strong> – All analysis results are saved with a unique job ID which you can later view and download in the Job History page.</li>
</ul>

<h3>Additional Resources</h3>
<ul>
  <li><a href="https://www.ncbi.nlm.nih.gov/books/NBK179288/" target="_blank">NCBI E-utilities Documentation</a></li>
  <li><a href="https://www.ebi.ac.uk/Tools/msa/clustalo/" target="_blank">Clustal Omega Documentation</a></li>
  <li><a href="https://www.ebi.ac.uk/Tools/emboss/plotcon/" target="_blank">EMBOSS Plotcon Documentation</a></li>
  <li><a href="https://prosite.expasy.org/" target="_blank">PROSITE Database</a></li>
</ul>

<h3>Need More Help?</h3>
<p>
  If you are still having difficulty or need more guidance, please feel free to contact me at 
  <a href="mailto:support@example.com">support@example.com</a>. Always happy to help!
</p>

<?php include 'footer.php'; ?>

