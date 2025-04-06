#!/bin/bash

# Define paths
INPUT_FASTA="$1"
OUTPUT_ALIGNED="$2"

# Remove old alignment file (if any)
rm -f "$OUTPUT_ALIGNED"

# Perform alignment
/usr/bin/clustalo -i "$INPUT_FASTA" -o "$OUTPUT_ALIGNED" --force --outfmt=clu

# Confirm alignment success
if [ -f "$OUTPUT_ALIGNED" ]; then
    echo "Alignment successfully completed: $OUTPUT_ALIGNED"
else
    echo "Alignment failed."
    exit 1
fi

