<!--Own code Starts-->
<?php
// Include the configuration file to establish a database connection
include 'config.php';

// Query to fetch book details
$query = "SELECT BookID, Title, Author, ISBN, Available, Status FROM librarybooks ORDER BY BookID";
$books = $conn->query($query); // Execute the query and store the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design settings -->
    <title>Library Books</title> <!-- Page title -->
    <style>
        table {
            width: 100%; /* Ensure table takes full width */
            border-collapse: collapse; /* Remove space between cells */
        }
        th, td {
            padding: 10px; /* Add padding for readability */
            text-align: left; /* Align text to the left */
        }
        th {
            background-color: #f2f2f2; /* Light background color for header */
        }
        td {
            border-top: 1px solid #ddd; /* Add a border at the top of each row */
        }
    </style>
</head>
<body>
    <h2>Library Books</h2> <!-- Heading for the page -->

    <table> <!-- Table to display the books -->
        <thead>
            <tr>
                <th>Book ID</th> <!-- Column for Book ID -->
                <th>Title</th> <!-- Column for Book Title -->
                <th>Author</th> <!-- Column for Author -->
                <th>ISBN</th> <!-- Column for ISBN -->
                <th>Available</th> <!-- Column for Availability Status -->
                <th>Status</th> <!-- Column for Status -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($books->num_rows > 0) { // If books are available in the database
                // Loop through each book and display its details in the table
                while ($book = $books->fetch_assoc()) {
                    echo "<tr>
                            <td>{$book['BookID']}</td>
                            <td>{$book['Title']}</td>
                            <td>{$book['Author']}</td>
                            <td>{$book['ISBN']}</td>
                            <td>{$book['Available']}</td>
                            <td>{$book['Status']}</td>
                          </tr>";
                }
            } else {
                // If no books are found, display a message in the table
                echo "<tr><td colspan='6'>No books found in the library</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<!--Own code Ends-->
