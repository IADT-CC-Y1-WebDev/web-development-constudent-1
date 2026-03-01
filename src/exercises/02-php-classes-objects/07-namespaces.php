<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Namespaces Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/07-namespaces.php">View Example &rarr;</a>
    </div>

    <h1>Namespaces Exercises</h1>

    <p><strong>Note:</strong> In these exercises you will create namespaced versions of your classes in a new <code>College/</code> folder. The original classes in <code>classes/</code> will remain unchanged.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Create the College Namespace</h2>
    <p>
        <strong>Task:</strong>
    </p>
    <ol>
        <li>Create a new folder called <code>College</code> inside the <code>classes/</code> folder</li>
        <li>Copy your <code>Student.php</code> file into the <code>classes/College/</code> folder</li>
        <li>Edit <code>classes/College/Student.php</code> to add <code>namespace College;</code> at the very top (after <code>&lt;?php</code>)</li>
    </ol>
    <p>
        Then use <code>require_once</code> to include the namespaced class and create a student
        using the full namespace path: <code>new \College\Student(...)</code>.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/College/Student.php';
        // $student = new \College\Student("Alice", "C12345");
        // echo $student;
        require_once __DIR__ . '/classes/College/Student.php';

        $s1 = new \College\Student("Con", "777");
            echo "Count: " . \College\Student::getCount() . "<br>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Using the 'use' Statement</h2>
    <p>
        <strong>Task:</strong>
        Instead of using the full namespace path each time, add a <code>use</code>
        statement to import the Student class. Then create students using just
        the class name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/College/Student.php';
        // use College\Student;
        // $student = new Student("Bob", "C12346");
        // echo $student;
        require_once __DIR__ . '/classes/College/Student.php';

        use College\Student;

        $s1 = new Student("Bob", "C12346");

        echo "<strong>All students:</strong><br>";
        foreach (Student::findAll() as $student) {
        echo $student . "<br>";
    }

        echo "<br><strong>Finding student C12346:</strong><br>";
        $found = Student::findByNumber("C12346");
        echo $found;
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Namespace All Classes</h2>
    <p>
        <strong>Task:</strong>
    </p>
    <ol>
        <li>Copy <code>Undergrad.php</code> and <code>Postgrad.php</code> into the <code>classes/College/</code> folder</li>
        <li>Add <code>namespace College;</code> to each file</li>
    </ol>
    <p>
        Require all three files and use <code>use</code> statements to import them.
        Create one of each type and display them.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/College/Student.php';
        // require_once __DIR__ . '/classes/College/Undergrad.php';
        // require_once __DIR__ . '/classes/College/Postgrad.php';
        // use College\Student;
        // use College\Undergrad;
        // use College\Postgrad;
        require_once __DIR__ . '/classes/College/Student.php';
        require_once __DIR__ . '/classes/College/Undergrad.php';
        require_once __DIR__ . '/classes/College/Postgrad.php';

        use College\Student as CollegeStudent;   
        use College\Undergrad;
        use College\Postgrad;

        $student = new CollegeStudent("Alice", "C12345");
        $ug = new Undergrad("Bob", "U12345", "Maths", 2);
        $pg = new Postgrad("Charlie", "P12345", "Dr. Smith", "Physics");

        echo "<strong>All College students:</strong><br>";
        echo $student . "<br>";
        echo $ug . "<br>";
        echo $pg;
     ?>
    </div>

</body>
</html>
