<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <style>
        /* Global styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        header {
            color: #002F6C;
            font-size: 2.5rem;
            margin: 0;
            font-weight: 600;
            text-align: center;
            background-color: yellow;
            height: 100px;
            line-height: 100px; /* Center text vertically */
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
        }
        
        /* Sidebar styles */
        .sidebar {
            height: calc(100vh - 100px); /* Adjust height for fixed header */
            width: 250px; /* Sidebar width */
            position: fixed; /* Fixed sidebar */
            top: 100px; /* Position below header */
            left: 0;
            background-color: gray; /* Background color */
            color: white; /* Text color */
            padding: 20px; /* Padding inside sidebar */
            overflow-y: auto; /* Scroll if content is too long */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2); /* Optional shadow */
        }
        
        .sidebar h2 {
            margin-top: 0; /* Remove default margin */
        }
        
        .sidebar ul {
            list-style-type: none; /* Remove bullet points */
            padding: 0; /* Remove padding */
            margin: 0; /* Remove margin */
        }
        
        .sidebar ul li {
            margin: 15px 0; /* Spacing between items */
        }
        
        .sidebar ul li a {
            color: white; /* Text color for links */
            text-decoration: none; /* Remove underline */
            font-size: 18px; /* Font size */
            display: block; /* Block display for padding */
            padding: 10px; /* Padding inside link */
            border-radius: 4px; /* Rounded corners */
        }
        
        .sidebar ul li a:hover {
            background-color: #575757; /* Background color on hover */
        }
        
        /* Main content styling */
        .content {
            margin-left: 250px; /* Offset content for sidebar */
            padding: 20px; /* Padding for content */
            background-color: #f4f4f4; /* Background color for content */
            margin-top: 100px; /* Offset content for fixed header */
            justify-content: space-between;
            display: flex;
            
        }
        
        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%; /* Full width for smaller screens */
                height: auto; /* Height adjusts based on content */
                top: 0; /* Reset top position */
                left: 0; /* Reset left position */
                position: relative; /* Relative positioning */
                box-shadow: none; /* Remove shadow */
            }
            
            .content {
                margin-left: 0; /* No left margin for content */
                margin-top: 100px; /* Offset content for fixed header */
                justify-content: space-between;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        HALAMAN UTAMA
    </header>
    <div class="sidebar">
        <h2>Sidebar</h2>
        <ul>
            <li><a href="profile.php">Home</a></li>
            <!-- Add more list items here if needed -->
        </ul>
    </div>
    <div class="content">
        <h1></h1>
        <p><center>Halaman Utama disini</center></p>
        <!-- Add more content here -->
    </div>
</body>
</html>
