<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/02-statements.php">View Example &rarr;</a>
    </div>

    <h1>Statements Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Age Classifier</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for age. Use if/else statements to classify and 
        display the age group: "Child" (0-12), "Teenager" (13-19), "Adult" 
        (20-64), or "Senior" (65+).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $age = rand(0,100);
        echo "<p>Age Group.</p>";

        if ($age <= 12) {
            echo "<p>Child.</p>";
        }
        else if ($age <= 19) {
            echo "<p>Teenager.</p>";
        }
        else if ($age <= 64) {
            echo "<p>Adult.</p>";
        }
         else {
            echo "<p>Senior.</p>";
         }

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Day of the Week</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for the day of the week (use a number 1-7). Use 
        a switch statement to display whether it's a "Weekday" or "Weekend", 
        and the day name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $day = rand(1, 7);

switch (true) {

case ($day === 1):
        echo "<p>It is a Weekday.</p>";
        echo "<p>It is Monday.</p>";
        break;

case ($day === 2):
        echo "<p>It is a Weekday.</p>";
        echo "<p>It is Tuesday.</p>";
        break;

case ($day === 3):
        echo "<p>It is a Weekday.</p>";
        echo "<p>It is Wednesday.</p>";
        break;

case ($day === 4):
        echo "<p>It is a Weekday.</p>";
        echo "<p>It is Thursday.</p>";
        break;

    case ($day === 5):
        echo "<p>It is a Weekday.</p>";
        echo "<p>It is Friday.</p>";
        break;

        case ($day === 6):
        echo "<p>It's the Weekend.</p>";
        echo "<p>It is Saturday.</p>";
        break;

    case ($day === 7):
        echo "<p>It's the Weekend.</p>";
        echo "<p>It is Sunday.</p>";
        break;

}
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiplication Table</h2>
    <p>
        <strong>Task:</strong> 
        Use a for loop to create a multiplication table for a number of your 
        choice (1 through 10). Display each line in the format "X × Y = Z".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $table = (5);
        for($i =0; $i < 1; $i++) {
            echo"<p> 1 x $table = 5</p>";
        }

        for($i =0; $i < 1; $i++) {
            echo"<p> 2 x $table = 10</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 3 x $table = 15</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 4 x $table = 20</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 5 x $table = 25</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 6 x $table = 30</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 7 x $table = 35</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 8 x $table = 40</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 9 x $table = 45</p>";
        }
        for($i =0; $i < 1; $i++) {
            echo"<p> 10 x $table = 50</p>";
        }

        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Countdown Timer</h2>
    <p>
        <strong>Task:</strong> 
        Create a countdown from 10 to 0 using a while loop. Display each number, 
        and when you reach 0, display "Blast off!"
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
            $timer = (10);
echo "<p>Countdown from $timer .</p>";
while ($timer > 0) {
    echo "<p>There are $timer seconds left";
    $timer = $timer - 1;
    echo "...</p>";
}
echo "<p>Blast off!</p>";
        ?>
    </div>

</body>
</html>
