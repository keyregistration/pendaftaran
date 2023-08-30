<!DOCTYPE html>
<html>
<head>
    <title>Registration Data</title>
    <style>
        /* Reset default margin and padding */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        #container {
            max-width: 1200px; /* Adjust the max-width for landscape layout */
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex; /* Use flexbox to create a landscape layout */
            flex-direction: row; /* Arrange items in a row */
        }

        /* Table Styles */
        table {
            flex: 1; /* Take up available space */
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        /* Search Input Styles */
        #searchInput {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            margin-top: 10px;
            box-sizing: border-box;
        }
    </style>
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput").value.toUpperCase();
            const table = document.getElementById("dataTable");
            const rows = table.getElementsByTagName("tr");
            
            for (let i = 1; i < rows.length; i++) {
                const keyCell = rows[i].getElementsByTagName("td")[2]; // Index 2 corresponds to Key Selection column
                
                if (keyCell) {
                    const keyText = keyCell.textContent || keyCell.innerText;
                    if (keyText.toUpperCase().indexOf(input) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</head>
<body>
<div id="container">
        <div style="flex: 1;">
            <h1>Registration Data</h1>
            <div>
                <label for="searchInput">Search by Key Selection:</label>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Enter key selection...">
            </div>
        <table id="dataTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Key Selection</th>
                <th>Purpose</th>
                <th>Start Time</th>
                <th>Finish Time</th>
                <th>Date</th>
            </tr>

            <?php
            // Establish a connection to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pendaftaran";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve and display data from the database
            $sql = "SELECT * FROM registrations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['key_selection']}</td>
                            <td>{$row['purpose']}</td>
                            <td>{$row['time_start']}</td>
                            <td>{$row['time_finish']}</td>
                            <td>{$row['date']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data available</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>