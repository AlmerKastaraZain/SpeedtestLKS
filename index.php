<?php
// Set timezone
date_default_timezone_set('UTC');

// Get current month and year from query parameters, default to the current month and year
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Calculate the first and last days of the month
$firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
$daysInMonth = date('t', $firstDayOfMonth);
$monthName = date('F', $firstDayOfMonth);

// Calculate previous and next month/year for navigation
$prevMonth = $currentMonth - 1;
$nextMonth = $currentMonth + 1;
$prevYear = $currentYear;
$nextYear = $currentYear;

if ($prevMonth == 0) {
    $prevMonth = 12;
    $prevYear -= 1;
} elseif ($nextMonth == 13) {
    $nextMonth = 1;
    $nextYear += 1;
}

// Get the weekday of the first day of the month
$firstDayOfWeek = date('w', $firstDayOfMonth);

// Highlight today's date if in the current month and year
$todayDate = date('j');
$isCurrentMonth = ($currentMonth == date('m') && $currentYear == date('Y'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Calendar</title>
    <link rel="stylesheet" href="calendar.css">
</head>
<body>

<div class="custom-calendar-wrap">
    <div class="custom-inner">
        <div class="custom-header clearfix">
            <nav>
                <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="custom-btn custom-prev"></a>
                <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="custom-btn custom-next"></a>
            </nav>
            <h2 id="custom-month" class="custom-month"><?= $monthName ?></h2>
            <h3 id="custom-year" class="custom-year"><?= $currentYear ?></h3>
        </div>
        <div id="calendar" class="fc-calendar-container">
            <div class="fc-calendar fc-five-rows">
                <div class="fc-head">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="fc-body">
                    <?php
                    // Print empty cells for days before the first day of the month
                    echo '<div class="fc-row">';
                    for ($i = 0; $i < $firstDayOfWeek; $i++) {
                        echo '<div><span class="fc-date"></span></div>';
                    }

                    // Print days of the month
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        if (($i % 7) == 0 && $day != 1) echo '</div><div class="fc-row">'; // Start a new row each week

                        $class = ($isCurrentMonth && $day == $todayDate) ? 'fc-today' : '';
                        echo "<div class='$class'><span class='fc-date'>$day</span></div>";
                        $i++;
                    }

                    // Fill the remaining cells of the last week
                    while (($i % 7) != 0) {
                        echo '<div><span class="fc-date"></span></div>';
                        $i++;
                    }
                    echo '</div>'; // Close the last row
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
