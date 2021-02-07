<!doctype html>
<html lang="en">
<!-- Webpage specification -->
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,maximum-scale=1.0"/>
    <link href="theme.css" rel="stylesheet" type="text/css"/>
    <!-- For pre-IE 9 compatibility -->
    <!--[if lt IE 9]>
    <script src="/Assets/src/html5shiv-printshiv.js"></script>
    <![endif]-->
    <title>View Events</title>
</head>
<body>
<header id="pageHeader">
    <!--Company branding / banner here-->
    <h1>Arts and Events</h1>
    <p>Your one-stop center to your uptown lifestyle </p>
</header>
<!-- Navigation frame -->
<nav id="pageNav">
    <ul>
        <!-- Navigation Links-->
        <li><a href="index.html" title="Home" tabindex="1" accesskey="H">Home</a></li>
        <li><a href="viewEvents.php" title="View Events" tabindex="2" accesskey="E">View Events</a></li>
        <li><a href="adminPage.html" title="Admin" tabindex="3" accesskey="A">Admin</a></li>
        <li><a href="credits.html" title="Credits" tabindex="4" accesskey="C">Credits</a></li>
        <li><a href="Wireframe.pdf" title="Wireframe" tabindex="5" accesskey="W">Wireframe</a></li>
    </ul>
</nav>
<main id="mainContent">
    <h2>Event List</h2>
    <p>View previous event lineups</p>
    <section class="eventArticle">

        <?php

        include 'database_conn.php'; // Make db connection

        // SQL query for fetching event list
        $sql = "SELECT eventID, eventTitle, eventDescription, eventStartDate, eventEndDate, eventPrice, catDesc, venueName,
                location
                FROM AE_events
                INNER JOIN AE_category 
                ON AE_category.catID = AE_events.catID 
                INNER JOIN AE_venue
                ON AE_venue.venueID = AE_events. venueID
                ORDER BY eventTitle";

        // Send query to db
        $queryResult = $dbConn->query($sql);

        // Check if SQL query returns result
        if ($queryResult === false) {
            echo "<p>Query failed: " . $dbConn->error . "</p>";
        } else {
            // Add title
            echo "<h2>All events</h2>";
            echo "\n";
            // Loop through each row and copy values from database
            while ($rowObj = $queryResult->fetch_object()) {
                $eventTitle = $rowObj->eventTitle;
                $eventDescription = $rowObj->eventDescription;
                $eventStartDate = $rowObj->eventStartDate;
                $eventEndDate = $rowObj->eventEndDate;
                $eventPrice = $rowObj->eventPrice;
                $catDesc = $rowObj->catDesc;
                $venueName = $rowObj->venueName;
                $location = $rowObj->location;

                // Display category icons next to article
                echo "<article>\n";
                echo "<div class='avatar'>";
                
                switch ($eventCat){
                    case "Carnival":
                        echo '<img src="Assets/Images/Icons/carnival.svg" alt="Carnival Icon"';
                        break;
                    case "Theatre":
                        echo '<img src="Assets/Images/Icons/theatre.svg" alt="Theatre Icon"';
                        break;
                    case "Comedy":
                        echo '<img src="Assets/Images/Icons/comedy.svg" alt="Comedy Icon"';
                        break;
                    case "Exhibition":
                        echo '<img src="Assets/Images/Icons/exhibition.svg" alt="Exhibition Icon"';
                        break;
                    case "Festival":
                        echo '<img src="Assets/Images/Icons/festival.svg" alt="Festival Icon"';
                        break;
                    case "Family":
                        echo '<img src="Assets/Images/Icons/family.svg" alt="Family Icon"';
                        break;
                    case "Music":
                        echo '<img src="Assets/Images/Icons/music.svg" alt="Music Icon"';
                        break;
                    case "Sport";
                        echo '<img src="Assets/Images/Icons/sport.svg" alt="Sport Icon"';
                        break;
                    case "Dance";
                        echo '<img src="Assets/Images/Icons/dance.svg" alt="Dance Icon"';
                        break;
                    default:
                        echo '';
                }
                /*
                if ($catDesc === "Carnival"){
                    echo '<img src="Assets/Images/Icons/carnival.svg" alt="Carnival Icon"';
                }
                if ($catDesc === "Theatre"){
                    echo '<img src="Assets/Images/Icons/theatre.svg" alt="Theatre Icon"';
                }
                if ($catDesc === "Comedy"){
                    echo '<img src="Assets/Images/Icons/comedy.svg" alt="Comedy Icon"';
                }
                if ($catDesc === "Exhibition"){
                    echo '<img src="Assets/Images/Icons/exhibition.svg" alt="Exhibition Icon"';
                }
                if ($catDesc === "Festival"){
                    echo '<img src="Assets/Images/Icons/festival.svg" alt="Festival Icon"';
                }
                if ($catDesc === "Family"){
                    echo '<img src="Assets/Images/Icons/family.svg" alt="Family Icon"';
                }
                if ($catDesc === "Music"){
                    echo '<img src="Assets/Images/Icons/music.svg" alt="Music Icon"';
                }
                if ($catDesc === "Sport"){
                    echo '<img src="Assets/Images/Icons/sport.svg" alt="Sport Icon"';
                }
                if ($catDesc === "Dance"){
                    echo '<img src="Assets/Images/Icons/dance.svg" alt="Dance Icon"';
                }
                */
                echo " width='70' height='70'/>";
                echo "</div>\n";

                // Display each event entry from database
                echo "<div>\n";
                // Title
                echo "<h3>$eventTitle</h3>\n";
                // Date
                echo "Date : <time>$eventStartDate</time> - <time>$eventEndDate</time><br />\n";
                // Location
                echo "Venue : $venueName, $location<br />\n";
                // Category
                echo "Category : $catDesc<br />\n";
                // Description
                echo "<p>$eventDescription</p>\n";
                // Price
                if ($eventPrice > 0) {
                    echo "<p>Entry price : $eventPrice &pound;</p>\n";
                } else if ($eventPrice == 0){
                    echo "<p>Entry price : Free</p>\n";
                } else {
                    echo "<p>Entry price : TBA</p>\n";
                }
                echo "</div>\n";
                echo "</article>\n\n";
            }
        }
        $queryResult->close(); // Close query stream
        $dbConn->close(); // Close db connection
        ?>
    </section>
</main>
</body>
<!-- page footer here -->
<footer id="pageFooter" tabindex="20">
    <!--disclaimer and contact info goes here -->
    <p>
        <small>All content &copy; copyright 2016 Arts and Events | Please read our <a href="credits.html" tabindex="21">
                terms and conditions</a></small>
    </p>
    <address tabindex="22">
        <small>
            4 Lymington Rd <br/>
            Westgate-on-Sea <br/>
            CT8 8ET <br/>
            United Kingdom <br/>
        </small>
    </address>
    <p><a href="tel://+44777-4919-702" title="Give us a call" accesskey="T" tabindex="23"> +447774919702</a></p>
    <p><a href="mailto:arts'n'events@gmail.co.uk" title="Email us" accesskey="E"
          tabindex="24">arts'n'events@gmail.ac.uk</a></p>
</footer>

</html>
