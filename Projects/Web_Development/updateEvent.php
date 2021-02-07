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
    <title>Site Administration - Update event</title>
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
    <h2>Event update</h2>
    <?php

    include 'database_conn.php'; // Make db connection

    // Check selected event ID
    $eventID = isset($_GET['eventID']) ? ($_GET['eventID']) : null;

    // Collect info from form
    $eventTitle = isset($_REQUEST['eventTitle']) ? $_REQUEST['eventTitle'] : null; // Event title
    $eventDesc = isset($_REQUEST['eventDesc']) ? $_REQUEST['eventDesc'] : null; // Event Description
    $eventStartYear = isset($_REQUEST['eventStartYear']) ? $_REQUEST['eventStartYear'] : null; // Event Year (Start)
    $eventStartMonth = isset($_REQUEST['eventStartMonth']) ? $_REQUEST['eventStartMonth'] : null; // Event Month (Start)
    $eventStartDay = isset($_REQUEST['eventStartDay']) ? $_REQUEST['eventStartDay'] : null; // Event Day (Start)
    $eventEndYear = isset($_REQUEST['eventEndYear']) ? $_REQUEST['eventEndYear'] : null; // Event Year (End)
    $eventEndMonth = isset($_REQUEST['eventEndMonth']) ? $_REQUEST['eventEndMonth'] : null; // Event Month (End)
    $eventEndDay = isset($_REQUEST['eventEndDay']) ? $_REQUEST['eventEndDay'] : null; // Event Day (End)
    $entryPrice = isset($_REQUEST['entryPrice']) ? $_REQUEST['entryPrice'] : null; // Event entry price in pound sterling

    // Check for escape characters
    $eventTitle = $dbConn->escape_string($eventTitle);
    $eventDesc = $dbConn->escape_string($eventDesc);
    $eventStartYear = $dbConn->escape_string($eventStartYear);
    $eventStartMonth = $dbConn->escape_string($eventStartMonth);
    $eventStartDay = $dbConn->escape_string($eventStartDay);
    $eventEndYear = $dbConn->escape_string($eventEndYear);
    $eventEndMonth = $dbConn->escape_string($eventEndMonth);
    $eventEndDay = $dbConn->escape_string($eventEndDay);
    $entryPrice = $dbConn->escape_string($entryPrice);

    // Merge event year, month and day into one string
    $eventStartDate = $eventStartYear . "-" . $eventStartMonth . "-" . $eventStartDay;
    $eventEndDate = $eventEndYear . "-" . $eventEndMonth . "-" . $eventEndDay;

    // Generate SQL query to upload into database
    $updateSQL = "UPDATE `AE_events` 
                  SET eventTitle = '$eventTitle', eventDescription = '$eventDesc', eventStartDate = '$eventStartDate',
                  eventEndDate = '$eventEndDate', eventPrice = '$entryPrice'
                  WHERE eventID = '$eventID'";

    // Use variable to determine transaction success
    $successTrans = $dbConn->query($updateSQL);

    // Display message on upload or error
    if ($successTrans === false) {
        echo "<p tabindex='4' accesskey='m'>Sorry, an error has occured: " . $dbConn->error . "</p>";
        echo "<p>Please <a href='editSelectEvent.php?eventID=$eventID' tabindex='5' accesskey='b'>try again</a></p>\n";
    }
    else {
        echo "<p tabindex='4' accesskey='m'>The event has been successfully updated.</p>\n";
    }
    echo "<p>Return to the <a href='adminPage.html' tabindex='6' accesskey='r'>admin page</a></p>\n";

    $dbConn->close(); // Close db connection

    ?>
</main>
<!-- page footer here -->
<footer id="pageFooter" tabindex="7">
    <!--disclaimer and contact info goes here -->
    <p>
        <small>All content &copy; copyright 2016 Arts and Events | Please read our <a href="credits.html" tabindex="8">
                terms and conditions</a></small>
    </p>
    <address tabindex="9">
        <small>
            4 Lymington Rd <br/>
            Westgate-on-Sea <br/>
            CT8 8ET <br/>
            United Kingdom <br/>
        </small>
    </address>
    <p><a href="tel://+44777-4919-702" title="Give us a call" accesskey="T" tabindex="10"> +447774919702</a></p>
    <p><a href="mailto:arts'n'events@gmail.co.uk" title="Email us" accesskey="E"
          tabindex="11">arts'n'events@gmail.ac.uk</a></p>
</footer>
</body>
</html>
