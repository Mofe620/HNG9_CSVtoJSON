# Welcome to Mofe's HNGi9 NFT CSV to JSON Script

## How to Implement
Simply run the server and upload the CSV file via the input form on index.php
Your CSV should be read with the script instantly generating json files for each row of your data in the "json_files" folder. Your uploaded file will be stored in the "uploads" folder.

## NOTE
 - The spreadsheets were not fully compiled at the time I wrote this script. I used the naming file from Team Chisel, as contained in the "uploads" folder.
 - Files from previous tests may be present in the "json_files" and "uploads" folders, simply for demonstration purposes. If so, you might want to delete all files from these folders before running the script, for a clean experience. 
 - Sha256 Hash is carried out per row and added to a new csv file in the "csv_modified" folder.