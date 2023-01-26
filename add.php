<html>

<head>
    <title>Add Data</title>
</head>

<body>
    <?php
    //including the database connection file
    include_once 'config.php';

    if (isset($_POST['Submit'])) {
        //$name = $_POST['name'];
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $age = $_POST['age'];
        $email = $_POST['email'];

        // checking empty fields
        if (empty($name) || empty($age) || empty($email)) {
            if (empty($name)):
                echo "<font color='red'>Name field is empty.</font><br/>";
            endif;

            if (empty($age)):
                echo "<font color='red'>Age field is empty.</font><br/>";
            endif;

            if (empty($email)):
                echo "<font color='red'>Email field is empty.</font><br/>";
            endif;

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
            // if all the fields are filled (not empty)

            //insert data to database
            $sql =
                'INSERT INTO users(name, age, email) VALUES(:name, :age, :email)';
            $query = $dbConn->prepare($sql);

            $query->bindparam(':name', $name);
            $query->bindparam(':age', $age);
            $query->bindparam(':email', $email);
            $query->execute();

            // Alternative to above bindparam and execute
            // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));

            //display success message
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
        }
    }
    ?>
</body>

</html>