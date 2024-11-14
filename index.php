

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
</head>
<body>
    <h2>Upload XML File to Convert to JSON</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="xmlFile" accept=".xml" required>
        <button type="submit">Convert</button>
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['xmlFile'])) {
            // Load the XML file
            $xmlFile = $_FILES['xmlFile']['tmp_name'];
            $xmlContent = file_get_contents($xmlFile);

            // Convert XML to SimpleXMLElement
            $xml = simplexml_load_string($xmlContent);

            // Convert SimpleXMLElement to JSON
            $json = json_encode($xml, JSON_PRETTY_PRINT);

            // Display the JSON output
            echo "<h3>Converted JSON:</h3>";
            echo "<pre>$json</pre>";
        }
    ?>
</body>
</html>
