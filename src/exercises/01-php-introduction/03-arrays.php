<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
            $movie = ['The Matrix', 'Iron Man', 'Whiplash', 'Interstellar', 'The Shining'];
echo "<ul>";
for ($i = 1; $i < count($movie); $i++) {
    echo "<li>Movie $i: $movie[$i]</li>";
}
echo "</ul>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here Create an associative array for a student with keys: name, studentId, course, and grade. Display this information in a formatted sentence.
        $student = [
            "name" => "Billy",
            "studentId" => "12345678",
            "course" => "Computer science",
            "grade" => 97
        ];
        echo "<ul>";
        $text = 
        "<li><b>Name:</b> {$student['name']}</li> <li><b>Student ID:</b> {$student['studentId']}" . 
        "<li><b>course:</b> {$student['course']}</li> <li><b> grade:</b> {$student['grade']}</li>";

        print("<p>$text</p>");
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
         $countries = [
            "Germany" => "Berlin",
            "France" => "Paris",
            "Ireland" => "Dublin",
            "Belgium" => "Brussels",
            "Japan" => "Tokyo"
        ];
        echo "<ul>";
        foreach ($countries as $country => $text) {
            echo "<li>The capital of $country is $text</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $Starters = [
            'starters' => [
            "Chicken wings" => "$9.99",
            "Mash potatoes " => "$12.99",
            "Beef stew" => "$4.99",
            "Fries" => "$3.99",
            "Sweet potatoe fries" => "$2.99"
            ]
    ];
        $Maincourse = [
            'maincourse' => [
            "Chicken" => "$14.99",
            "potatoes " => "$4.99",
            "Beef" => "$28.99",
            "beans" => "$3.99",
            "Squid" => "$22.99"
            ]
    ];
        echo "<ul>";
        $text = 
        "<li><b>Starters:</b>{$Starters['starters']}" . 
        "<li><b>Main Course:</b>{$Maincourse['maincourse']}";

        print("<p>$text</p>");
        echo "</ul>";
            
         echo "<p>Our Cheapest Item is Sweet Potatoe Fries at {$Starters['starters']['Sweet potatoe fries']}.</p>";
         

        ?>
    </div>

</body>
</html>
