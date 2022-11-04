# hng-task-csv
# Description
This script takes a csv file, generates a Chip-0007 JSON object for each line, and creates 
an output file with the sha256 hash of the JSON object for each line added under the column HASH
# Usage
Navigate to the folder where you have the script and type the command below
php hng-csv-task.php "file-path"
Example: php hng-csv-task.php "./NFT Naming csv - Team Clutch.csv"
# Input File Format
The input file should be a comma separated value (CSV) file
The header should not include the HASH entry
The text in the fields should not include a comma, since it is a comma separated file
You can use any other symbol inplace of a comma

Sample input output files are provided. 
Input file: NFT Naming csv - Team Clutch.csv
Output file: NFT Naming csv - Team Clutch.output.csv
