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
    <title>Site Administration - Select event to edit</title>
</head>
<body>
<header id="pageHeader">
    <!--Company branding / banner here-->
    <h1>Arts and Events</h1>
    <p>Your one-stop center to your uptown lifestyle </p>
</header>
<nav id="adminPageNav">
    <ul>
        <li><a href="adminPage.html" title="Site administration" tabindex="1" accesskey="H">Admin page</a></li>
        <li><a href="addEventsForm.html" title="New Events" tabindex="2" accesskey="A">Add a new event</a></li>
        <li><a href="editSelectList.php" title="Modify available event details" tabindex="3" accesskey="E">Edit / Update available event</a></li>
    </ul>
</nav>
<main id="mainContent">
    <h2>Choose an event to edit</h2>
    <section class="eventArticle">

<?php

include 'database_conn.php'; // Make db connection

// Counter for tab index
$counter = 3;

// SQL query for fetching event list
$sql = "SELECT eventID, eventTitle, eventDescription, eventStartDate, eventEndDate, 
        eventPrice, catDesc, venueName, location
        FROM AE_events
        INNER JOIN AE_category 
        ON AE_category.catID = AE_events.catID 
        INNER JOIN AE_venue
        ON AE_venue.venueID = AE_events.venueID
        ORDER BY eventTitle";

// Send query to db
$queryResult = $dbConn->query($sql);

// Check if SQL query returns result
if ($queryResult === false) {
    echo "<p>Query failed: " . $dbConn->error . "</p>";
} else {
    // Loop through each row and copy values from database
    while ($rowObj = $queryResult->fetch_object()) {
        $eventID = $rowObj->eventID;
        $eventTitle = $rowObj->eventTitle;
        $eventDescription = $rowObj->eventDescription;
        $eventStartDate = $rowObj->eventStartDate;
        $eventEndDate = $rowObj->eventEndDate;
        $eventPrice = $rowObj->eventPrice;
        $catDesc = $rowObj->catDesc;
        $venueName = $rowObj->venueName;
        $location = $rowObj->location;

        // Increment counter on every event entry
        ++$counter;

        // Display each event entry from database
        echo "<article>\n";
        echo "<div>\n";
        // Title
        echo "<h3 tabindex='$counter' accesskey='t'>$eventTitle</h3>\n";
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
        } else if ($eventPrice == 0) {
            echo "<p>Entry price : Free</p>\n";
        } else {
            echo "<p>Entry price : TBA</p>\n";
        }
        // Increment counter on every tabindex entry
        ++$counter;
        echo "<button type='button' tabindex='$counter' ";
        echo "onclick='location.href=\"editSelectEvent.php?eventID=$eventID\"'>Edit event</button>";
        echo "</div>\n";
        echo "</article>\n\n";
    }
}
$queryResult->close(); // Close query stream
$dbConn->close(); // Close db connection

// Close main tag
echo "</main>\n";

/*-------------------------------------------*/
// Page footer

// Increment counter on every tabindex entry
++$counter;

echo "<footer id=\"pageFooter\" tabindex=\"$counter\">\n";
echo "<p>\n";

// Increment counter on every tabindex entry
++$counter;

// Disclaimer and contact info
echo "<small>All content &copy; copyright 2016 Arts and Events | Please read our
            <a href=\"credits.html\" tabindex=\"$counter\">terms and conditions</a></small>\n";
echo "</p>\n";

// Increment counter on every tabindex entry
++$counter;

// Address
echo "<address tabindex='$counter'>\n";
echo "<small>\n";
echo "4 Lymington Rd <br/>\n";
echo "Westgate-on-Sea <br/>\n";
echo "CT8 8ET <br/>\n";
echo "</small>\n";
echo "</address>\n";

// Increment counter on every tabindex entry
++$counter;

// Telephone number
echo "<p><a href=\"tel://+44777-4919-702\" title=\"Give us a call\" accesskey=\"T\" tabindex=\"$counter\"> +447774919702</a></p>\n";

// Increment counter on every tabindex entry
++$counter;

// E-mail
echo "<p><a href=\"mailto:arts'n'events@gmail.co.uk\" title=\"Email us\" accesskey=\"E\" tabindex=\"$counter\">arts'n'events@gmail.ac.uk</a></p>\n";

/*--------------------------------*/
// Closing tags

echo "</footer>\n";
echo "</body>\n";
echo "</html>\n";

?>