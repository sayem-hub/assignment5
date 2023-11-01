<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="row">

            <div class="text-end">
                <?php
                if (isset($_SESSION['email'])) {
                    // User is logged in, display the logout button.
                    echo "Welcome, " . $_SESSION['username'] . "!<br>";
                    echo "<a href='../logout.php'>Logout</a>";
                } else {
                    // User is not logged in, display registration and login forms.
                    include('forms.php');
                }
                ?>
            </div>

            <div class="col-12">


                <?php
                if (isset($_SESSION['email'])) { ?>

                    <?php
                    $serialziedData = file_get_contents('../data/db.txt');
                    $students = unserialize($serialziedData);
                    ?>
                    <table class="table table-bordred">
                        <tr>
                            <th>Name</th>
                            <th>Roll</th>

                            <th width="25%">Action</th>

                        </tr>
                        <?php
                        foreach ($students as $student) {
                            ?>
                            <tr>
                                <td>
                                    <?php printf('%s %s', $student['fname'], $student['lname']); ?>
                                </td>
                                <td>
                                    <?php printf('%s', $student['roll']); ?>
                                </td>

                                <td>
                                    <?php printf('<a href="/crud/index.php?task=edit&id=%s">Edit</a> | <a class="delete" href="/crud/index.php?task=delete&id=%s">Delete</a>', $student['id'], $student['id']); ?>
                                </td>

                                <td>
                                    <?php printf('<a href="/crud/index.php?task=edit&id=%s">Edit</a>', $student['id']); ?>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                <?php } ?>

            </div>
        </div>


</body>

</div>

</html>