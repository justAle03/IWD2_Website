#!/bin/bash
# count_sequences.sh: Count sequences using NCBI's esearch and return just the count.
# Usage: ./count_sequences.sh <protein_family> <taxonomic_group>

if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <protein_family> <taxonomic_group>" >&2
    exit 1
fi

protein_family=$1
tax_group=$2

# Form a broader query (remove field qualifiers)
query="${protein_family} AND ${tax_group}"
echo "DEBUG: Query in count_sequences.sh: $query" >&2

# Get the full XML output from esearch.
xml_output=$(/home/s2746547/edirect/esearch -db protein -query "$query")
# Extract the value inside <Count>...</Count>
count=$(echo "$xml_output" | sed -n 's:.*<Count>\(.*\)</Count>.*:\1:p')

echo $count

