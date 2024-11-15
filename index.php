<?php
// Load the JSON file
$json = file_get_contents('result.json');
$data = json_decode($json, true);

// Initialize variables
$totalMessagesSent = 0;
$totalMessagesReceived = 0;
$totalSentChars = 0;
$totalReceivedChars = 0;
$wordCounts = [];

// Process each message
foreach ($data['messages'] as $message) {
    $text = $message['text'];
    if ($message['from'] === 'Budi') {
        // Sent by user
        $totalMessagesSent++;
        $totalSentChars += strlen($text);
        $words = preg_split('/\s+/', strtolower($text));
        foreach ($words as $word) {
            $word = trim($word, '.,!?'); // Clean punctuation
            if ($word) {
                $wordCounts[$word] = ($wordCounts[$word] ?? 0) + 1;
            }
        }
    } elseif ($message['from'] === 'Bot') {
        // Received by user
        $totalMessagesReceived++;
        $totalReceivedChars += strlen($text);
    }
}

// Calculate averages
$avgSentLength = $totalMessagesSent > 0 ? $totalSentChars / $totalMessagesSent : 0;
$avgReceivedLength = $totalMessagesReceived > 0 ? $totalReceivedChars / $totalMessagesReceived : 0;

// Get top 5 words
arsort($wordCounts); // Sort words by frequency
$topWords = array_slice($wordCounts, 0, 5, true);

// Display results
echo "<h1>Chat Analytics</h1>";
echo "<p><strong>Total Messages Sent:</strong> $totalMessagesSent</p>";
echo "<p><strong>Total Messages Received:</strong> $totalMessagesReceived</p>";
echo "<p><strong>Average Character Length Sent:</strong> " . number_format($avgSentLength, 2) . "</p>";
echo "<p><strong>Average Character Length Received:</strong> " . number_format($avgReceivedLength, 2) . "</p>";

echo "<h3>Top 5 Sent Words</h3>";
echo "<ul>";
foreach ($topWords as $word => $count) {
    echo "<li>$word ($count)</li>";
}
echo "</ul>";
?>
