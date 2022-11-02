<?php

if (isset($_POST["submit"])) {
    if ($_FILES['csv_file']['name']) {
        $file_array = explode(".", $_FILES['csv_file']['name']);

        $file_name = $file_array[0];

        $extension = end($file_array);

        if ($extension == 'csv') {
            if (file_exists("upload/" . $file_name)) {
                echo $file_name . " is already exists.";
            } else {
                move_uploaded_file($_FILES["csv_file"]["tmp_name"], "uploads/" . $file_name);
                echo "Your file was uploaded successfully.";
            }

            $path_to_file = 'uploads/';
            if (!($uploaded_file = fopen($path_to_file . $file_name, 'r+'))) {
                die("Can't open file...");
            }

            //read csv headers
            $key = fgetcsv($uploaded_file, "1024", ",");

            // parse csv rows into array
            $json = array();
            while ($row = fgetcsv($uploaded_file, "1024", ",")) {
                $json[] = array_combine($key, $row);
            }

            // release file handle
            fclose($uploaded_file);

            foreach ($json as $item) {
                $item["format"] = "CHIP-0007";
                $item["sensitive_content"] = false;

                // encode array to json
                $json_data = json_encode($item);

                $json_file = fopen("json_files/".$item["NFT NAME"].".json", "a");
                fwrite($json_file, $json_data);
                fclose($json_file);
            }
            echo "Your json files have been generated successfully";

        } else {
            echo 'Only <b>.csv</b> file allowed';
        }
    } else {
        echo 'Please Select a File to Upload';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV to JSON</title>
</head>

<body>
    <h1>Generate multiple JSON files from your CSV Documents</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" id="">
        <input type="submit" name="submit" value="Convert">
    </form>
</body>

</html>