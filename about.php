<?php
session_start();
include 'header.php';
?>
<h2>About This Website</h2>

<p>
    This Protein Analysis Website is implemented as a dynamic, full-stack web application that integrates multiple bioinformatics tools to deliver comprehensive analyses of protein sequences. The design emphasizes both robust functionality and a user-friendly interface.
</p>

<h3>Architecture & Design</h3>
<p>
    The site follows a modular architecture using PHP for server-side processing, MySQL for data storage, and a combination of Bash scripts for executing external bioinformatics tools. Key features include:
</p>
<ul>
    <li><strong>Component-Based Structure:</strong> The website is divided into multiple components – including custom query workflows, stand-alone upload tools, interactive examples, and job history – each with its own dedicated scripts and views.</li>
    <li><strong>Session Management:</strong> User authentication and session management (via PHP sessions) secure access and track the state of the analysis workflow, including unique job IDs that are used to tag all files and database records.</li>
    <li><strong>Seamless Integration:</strong> PHP scripts invoke external bioinformatics tools (Clustal Omega, EMBOSS Plotcon, EMBOSS Patmatmotifs) via Bash, capturing output and integrating results with the web interface. File naming is carefully handled to group related analysis outputs under a common unique job identifier.</li>
</ul>

<h3>Technologies & Tools</h3>
<p>
    The website leverages several established technologies and open-source tools:
</p>
<ul>
    <li><strong>PHP & MySQL:</strong> PHP is used for dynamic content generation and server-side processing, while MySQL stores protein sequence data and analysis metadata.</li>
    <li><strong>Bash Scripting:</strong> Shell scripts manage the execution of bioinformatics programs, processing FASTA files, performing alignments, and generating plots and reports.</li>
    <li><strong>Bioinformatics Tools:</strong> 
        <ul>
            <li><em>NCBI E-utilities</em> enable real-time retrieval of protein sequences.</li>
            <li><em>Clustal Omega</em> is used to perform multiple sequence alignment.</li>
            <li><em>EMBOSS Plotcon</em> generates conservation plots from alignments.</li>
            <li><em>EMBOSS Patmatmotifs</em> scans sequences for functional motifs.</li>
        </ul>
    </li>
    <li><strong>Git & GitHub:</strong> Version control is managed with Git, ensuring all changes are tracked and code is safely backed up on GitHub.</li>
    <li><strong>HTML, CSS, and JavaScript:</strong> These frontend technologies are used to deliver a modern, responsive user interface that effectively presents complex data.</li>
</ul>

<h3>Implementation Decisions & Workflow</h3>
<p>
    The system distinguishes between three primary workflows:
</p>
<ul>
    <li><strong>Full Custom Analysis Workflow:</strong> Users can perform queries to fetch protein data from public databases, upload their own data, and execute full analyses. Unique job IDs ensure that every analysis is tracked, and results can be revisited through the Job History page.</li>
    <li><strong>Interactive Demo Workflow:</strong> A demo mode uses pre‑stored data to allow users to interact with the analysis tools immediately. This provides a “try before you submit” experience with real biological insights, without waiting for live computation.</li>
    <li><strong>Stand-alone Tools Workflow:</strong> These tools give the user the possibility to skip some of the steps of the analysis and upload files that they obtained from third party sources and still be able to gain valuable biological insights accessing the website core functionalities. 
</ul>


<h3>Biological Relevance</h3>
<p>
    Beyond the technical implementation, the website is designed to empower researchers to glean biological insights from their data. By integrating sequence alignment, conservation plotting, and motif analysis, the platform helps identify evolutionarily conserved regions, functional domains, and other key characteristics that are critical for understanding protein function.
</p>

<?php include 'footer.php'; ?>

