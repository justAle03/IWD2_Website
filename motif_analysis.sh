#!/bin/bash
# motif_analysis.sh: Processes a multi-FASTA file for motif analysis.
# Splits the input FASTA file into individual sequence files, runs patmatmotifs on each,
# merges the outputs, and produces a final report that summarizes how many proteins
# returned a HitCount > 0 (without listing their accessions in the summary).
#
# Usage: ./motif_analysis.sh <input_fasta> <final_output_report>
# Example: ./motif_analysis.sh temp_output/example_proteins.fasta temp_output/motif_result_final.txt

if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <input_fasta> <final_output_report>"
    exit 1
fi

INPUT_FASTA="$1"
FINAL_OUTPUT="$2"
OUTPUT_DIR=$(dirname "$FINAL_OUTPUT")
TIMESTAMP=$(date +%s)

# Ensure the output directory exists.
mkdir -p "$OUTPUT_DIR"

# Create a temporary directory for split files.
TMP_DIR=$(mktemp -d -p "$OUTPUT_DIR" tmp_split_$TIMESTAMP.XXXX)
# Split the multi-FASTA file into individual files (each starting with '>')
csplit -z -f "$TMP_DIR/seq_" "$INPUT_FASTA" '/^>/' '{*}'

# Count total number of sequences (i.e. files) created.
TOTAL_FILES=$(ls "$TMP_DIR" | wc -l)

# Initialize (or empty) the merged raw output file.
MERGED_OUTPUT="$OUTPUT_DIR/motif_result_merged_${TIMESTAMP}_raw.txt"
> "$MERGED_OUTPUT"

# Process each split file with patmatmotifs and append its output to the merged file.
for file in "$TMP_DIR"/seq_*; do
    if [ ! -s "$file" ]; then
        continue
    fi
    PATMAT_OUTPUT="${file}.motif"
    /usr/bin/patmatmotifs -auto yes -full -sequence "$file" -outfile "$PATMAT_OUTPUT" -prune yes > /dev/null 2>&1
    cat "$PATMAT_OUTPUT" >> "$MERGED_OUTPUT"
done

# Clean up temporary directory.
rm -rf "$TMP_DIR"

# Process the merged output to generate the final report.
FINAL_REPORT="$FINAL_OUTPUT"
awk -v total_seqs="$TOTAL_FILES" 'BEGIN {
    RS = "";
    ORS = "\n\n";
    count = 0;
    details = "";
}
{
    if (match($0, /HitCount:\s*([0-9]+)/, b)) {
        hit = b[1] + 0;
        if (hit > 0) {
            count++;
            details = details $0 "\n";
        }
    }
}
END {
    print "SUMMARY: " count " out of " total_seqs " proteins returned HitCount > 0.\n";
    print details;
}' "$MERGED_OUTPUT" > "$FINAL_REPORT"

# Output the final report filename (for capture by PHP).
echo "$FINAL_REPORT"
exit 0

