#!/bin/bash
# conservation_plot.sh: Generates a conservation plot using plotcon and outputs the final filename.
# Usage: ./conservation_plot.sh <aligned_file> <timestamp> <jobID>
# The output file will be named: temp_output/<JOB_ID>_<TIMESTAMP>_plot.png

if [ "$#" -ne 3 ]; then
    echo "Usage: $0 <aligned_file> <timestamp> <jobID>" >&2
    exit 1
fi

INPUT_ALN="$1"
TIMESTAMP="$2"
JOB_ID="$3"

OUTPUT_DIR="temp_output"
OUTPUT_PNG="$OUTPUT_DIR/${JOB_ID}_${TIMESTAMP}_plot.png"

# Remove any old plot files matching the pattern.
rm -f "$OUTPUT_PNG"*

# Run plotcon and redirect its output to /dev/null to avoid extra output.
# (Adjust the plotcon command parameters as needed.)
/usr/bin/plotcon -sequences "$INPUT_ALN" -winsize 4 -graph png -goutfile "$OUTPUT_PNG" > /dev/null 2>&1

# If plotcon created a file with a ".1.png" suffix, rename it to the expected name.
if [ -f "${OUTPUT_PNG}.1.png" ]; then
    mv "${OUTPUT_PNG}.1.png" "$OUTPUT_PNG"
fi

# Only output the final filename if it exists.
if [ -f "$OUTPUT_PNG" ]; then
    echo "$OUTPUT_PNG"
else
    echo "Error: Conservation plot not generated." >&2
    exit 1
fi

