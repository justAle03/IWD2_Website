<?php
session_start();
include 'header.php';
?>
<h2>Credits</h2>

<h3>Tools and Resources Used</h3>
<p>This website integrates several bioinformatics tools and resources to deliver a robust protein analysis workflow. The following tools and resources were used:</p>
<ul>
    <li>🔍 <strong>NCBI E-utilities:</strong> Used for retrieving protein sequences from NCBI in real time.</li>
    <li>🚀 <strong>Clustal Omega:</strong> Used to perform multiple sequence alignment which helps to identify conserved regions that can be critical for protein function.</li>
    <li>📊 <strong>EMBOSS Plotcon:</strong> Utilized to generate conservation plots from the sequence alignment, visually highlighting conserved regions.</li>
    <li>🔬 <strong>EMBOSS Patmatmotifs:</strong> Used for motif analysis to scan protein sequences for known functional domains.</li>
    <li>📝 <strong>HTML, PHP, MySQL and Bash Scripting:</strong> These technologies provide the backbone for the website’s analysis and data management.</li>
    <li>💻 <strong>Git and GitHub:</strong> Employed for version control and to manage the project’s development history.</li>
</ul>

<h3>Additional Code and Resource Credits</h3>
<p>Helpful code examples and documentation were referenced from:</p>
<ul>
    <li>The official <a href="https://www.ncbi.nlm.nih.gov/books/NBK179288/" target="_blank">NCBI E-utilities documentation</a>.</li>
    <li><a href="https://www.ebi.ac.uk/Tools/msa/clustalo/" target="_blank">Clustal Omega documentation</a> from the EBI.</li>
    <li><a href="https://www.ebi.ac.uk/Tools/emboss/plotcon/" target="_blank">EMBOSS Plotcon documentation</a>.</li>
    <li>The <a href="https://prosite.expasy.org/" target="_blank">PROSITE website</a> for motif-related information.</li>
    <li>The <a href="https://www.w3schools.com/" target="_blank">W3Schools website</a> for code examples information and general website design inspiration.</li>
</ul>

<h3>Assistance from ChatGPT</h3>
<p>
    I used ChatGPT, an AI language model developed by OpenAI, to support me with this assessment in various ways. ChatGPT provided code snippets, troubleshooting guidance and helped structure the functionalities across HTML, PHP, MySQL and Bash scripts. I supplied detailed instructions and context, ensuring that the generated guidance aligned with the project requirements. While ChatGPT helped streamline many tasks, all final decisions and integrations reflect my own work.
</p>

<?php include 'footer.php'; ?>

