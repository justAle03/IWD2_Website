#!/usr/bin/python3
from Bio import Entrez, SeqIO
import sys

# Set your email (and optionally API key) here
Entrez.email = "your_email@example.com"
# Entrez.api_key = "YOUR_API_KEY"  # Recommended if you have an API key

if len(sys.argv) < 3:
    print("Usage: fetch_sequences.py <protein_family> <taxonomic_group>")
    sys.exit(1)

protein_family = sys.argv[1]
tax_group = sys.argv[2]

query = f"{protein_family}[Title] AND {tax_group}[Organism]"

handle = Entrez.esearch(db="protein", term=query, retmax=50)
record = Entrez.read(handle)
ids = record["IdList"]

handle = Entrez.efetch(db="protein", id=ids, rettype="fasta", retmode="text")
with open("proteins.fasta", "w") as out_handle:
    out_handle.write(handle.read())

