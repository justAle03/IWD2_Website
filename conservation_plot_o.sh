#!/bin/bash

# Arguments
INPUT_ALN="$1"
BASE_ID="$2"  # Just the timestamp or ID, not the full path
OUTPUT_DIR="temp_output"
OUTPUT_PNG="$OUTPUT_DIR/${BASE_ID}_plot.png"

# Remove old plot if it exists
rm -f "$OUTPUT_PNG"*

# Generate conservation plot with plotcon
/usr/bin/plotcon -sequences "$INPUT_ALN" -winsize 4 -graph png -goutfile "$OUTPUT_PNG"

# Check output and rename if needed
if [ -f "${OUTPUT_PNG}.1.png" ]; then
    mv "${OUTPUT_PNG}.1.png" "$OUTPUT_PNG"
    echo "$OUTPUT_PNG"
else
    echo "Error: Conservation plot not generated." >&2
    exit 1
fi

