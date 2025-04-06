#!/bin/bash
# fetch_sequences.sh: Retrieves protein sequences using NCBI's esearch and efetch

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <protein_family> <taxonomic_group> <output_file>"
    exit 1
fi

protein_family=$1
tax_group=$2
output_file=$3

# Form the query
query="${protein_family}[Title] AND ${tax_group}[Organism]"

# Fetch sequences using NCBI edirect tools
/home/s2746547/edirect/esearch -db protein -query "$query" \
  | /home/s2746547/edirect/efetch -format fasta > "$output_file"

if [ -s "$output_file" ]; then
    echo "Sequences saved to $output_file"
else
    echo "Error: No sequences retrieved."
fi


