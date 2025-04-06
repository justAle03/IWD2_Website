#!/bin/bash
# fetch_sequences.sh: Retrieves protein sequences using NCBI's esearch and efetch,
# then limits the output to the first N sequences using awk.
#
# Usage: ./fetch_sequences.sh <protein_family> <taxonomic_group> <output_file> [limit]

if [ "$#" -lt 3 ] || [ "$#" -gt 4 ]; then
    echo "Usage: $0 <protein_family> <taxonomic_group> <output_file> [limit]" >&2
    exit 1
fi

protein_family=$1
tax_group=$2
output_file=$3

if [ "$#" -eq 4 ]; then
    limit=$4
else
    limit=100  # Default limit if not provided
fi

# Check if the directory of the output file is writable
output_dir=$(dirname "$output_file")
if [ ! -w "$output_dir" ]; then
    echo "DEBUG: Directory $output_dir is not writable" >&2
fi

echo "DEBUG: Limit set to $limit sequences" >&2

# Form the query
query="${protein_family}[Title] AND ${tax_group}[Organism]"
echo "DEBUG: Query = $query" >&2

# Fetch sequences using NCBI edirect tools, then use awk to limit the output.
# The awk command counts header lines (">") and stops printing once the count exceeds the limit.
 
/home/s2746547/edirect/esearch -db protein -query "$query" \
  | /home/s2746547/edirect/efetch -format fasta \
  | awk -v limit="$limit" 'BEGIN {n=0} /^>/{n++; if(n>limit) exit} {print}' > "$output_file"

# Debug: Check output file details
if [ -s "$output_file" ]; then
    echo "DEBUG: Sequences saved to $output_file" >&2
    file_size=$(stat -c%s "$output_file")
    echo "DEBUG: Output file size = ${file_size} bytes" >&2
else
    echo "DEBUG: Error: No sequences retrieved." >&2
fi

