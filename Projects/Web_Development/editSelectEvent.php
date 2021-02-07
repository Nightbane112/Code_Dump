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
    <title>Site Administration - Event editing</title>
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
        <li><a href="editSelectList.php" title="Modify available event details" tabindex="3" accesskey="E">Edit / Update
                available event</a></li>
    </ul>
</nav>
<main id="mainContent">
    <h2>Edit event</h2>
    <section class="eventArticle">
        <p>Please enter new details for the event into the form below</p>
        <?php

        include 'database_conn.php'; // Make db connection

        // Check selected event ID
        $eventID = isset($_GET['eventID']) ? ($_GET['eventID']) : null;

        // Request information associated to event from database
        $checkSQL = "SELECT eventTitle, eventDescription, eventStartDate, eventEndDate, eventPrice,
                 catDesc, venueName
                 FROM AE_events
                 INNER JOIN AE_category 
                 ON AE_category.catID = AE_events.catID 
                 INNER JOIN AE_venue
                 ON AE_venue.venueID = AE_events.venueID
                 WHERE eventID = '$eventID'";

        // Send SQL to database
        $checkSQL = $dbConn->query($checkSQL);

        // Check if SQL query returns result
        if ($checkSQL === false) {
            echo "<p tabindex='4' accesskey='m'>Query failed: " . $dbConn->error . "</p>";
        } else {
            // Loop through each row and copy values from database
            while ($rowObj = $checkSQL->fetch_object()) {
                $eventTitle = $rowObj->eventTitle;
                $eventDescription = $rowObj->eventDescription;
                $eventStartDate = $rowObj->eventStartDate;
                $eventEndDate = $rowObj->eventEndDate;
                $eventPrice = $rowObj->eventPrice;
                $catDesc = $rowObj->catDesc;
                $venueName = $rowObj->venueName;

                /*--------------------------------------------*/
                // Create form with values from database
                echo "<form id='editSelectEvent' action='updateEvent.php?eventID=$eventID' method='post' tabindex='5'>\n";
                echo "<fieldset>\n";
                echo "<legend>Event Details</legend>\n";
                echo "<em>Columns marked with asterisks are required</em>\n";

                /*--------------------------------------------*/
                // Event title
                echo "<div>\n";
                echo "<label for='eventTitle'>Event title</label>";
                echo "<input id='eventTitle' type='text' name='eventTitle' value='$eventTitle' required autofocus tabindex='6'/>\n";
                echo "<em>*</em>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Event Description
                echo "<div>\n";
                echo "<label for='eventDesc'>Event description :</label>\n";
                echo "<textarea id='eventDesc' name='eventDesc' rows=5' cols='30' required tabindex='7'>$eventDescription</textarea>\n";
                echo "<em>*</em>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Event Start Date

                // Convert date string to proper PHP format
                $eventStartDate = strtotime($eventStartDate);
                $eventEndDate = strtotime($eventEndDate);

                // Extract values from date
                $eventStartDay = date('d', $eventStartDate);
                $eventStartMonth = date('m', $eventStartDate);
                $eventStartYear = date('Y', $eventStartDate);
                $eventEndDay = date('d', $eventEndDate);
                $eventEndMonth = date('m', $eventEndDate);
                $eventEndYear = date('Y', $eventEndDate);

                /*--------------------------------------------*/
                // Testing variables
                $month = array("January" => "01", "February" => "02", "March" => "03", "April" => "04", "May" => "05",
                    "June" => "06", "July" => "07", "August" => "08", "September" => "09", "October" => "10",
                    "November" => "11", "December" => "12"
                );

                /*--------------------------------------------*/
                echo "<div>\n";
                echo "<p>Start Date :</p>\n";

                // Day
                echo "<span>\n";
                echo "<label for='StartDay'>Day:</label>\n";
                echo "<input id='StartDay' type='number' name='eventStartDay' value='$eventStartDay' min='01' max='31' style='width:30px' tabindex='8' />\n";
                echo "</span>\n";

                // Month
                echo "<span>\n";
                echo "<label for='StartMonth'>Month:</label>\n";
                echo "<select id='StartMonth' name='eventStartMonth' tabindex='9'>\n";

                // Assign selected tag to event month when value matches
                foreach ($month as $name => $monthNum) {
                    if ($eventStartMonth === $monthNum) {
                        echo "<option value='$monthNum' selected>'$name'</option>\n";
                    } else {
                        echo "<option value='$monthNum'>'$name'</option>\n";
                    }
                }
                echo "</select>\n";
                echo "</span>\n";

                // Year
                echo "<span>\n";
                echo "<label for='StartYear'>Year:</label>\n";
                echo "<input id='StartYear' type='number' name='eventStartYear' value='$eventStartYear' min='1940' max='2100' style='width:50px' tabindex='10' />\n";
                echo "</span>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Event End Date
                echo "<div>\n";
                echo "<p>End Date :</p>\n";

                // Day
                echo "<span>\n";
                echo "<label for='EndDay'>Day:</label>\n";
                echo "<input id='EndDay' type='number' name='eventEndDay' value='$eventEndDay' min='01' max='31' style='width:30px' tabindex='11' />\n";
                echo "</span>\n";

                // Month
                echo "<span>\n";
                echo "<label for='EndMonth'>Month:</label>\n";
                echo "<select id='EndMonth' name='eventEndMonth' tabindex='12'>\n";

                // Assign selected tag to event month when value matches
                foreach ($month as $name => $monthNum) {
                    if ($eventStartMonth === $monthNum) {
                        echo "<option value='$monthNum' selected>$name</option>\n";
                    } else {
                        echo "<option value='$monthNum'>$name</option>\n";
                    }
                }
                echo "</select>\n";
                echo "</span>\n";

                // Year
                echo "<span>\n";
                echo "<label for='EndYear'>Year:</label>\n";
                echo "<input id='EndYear' type='number' name='eventEndYear' value='$eventEndYear' min='1940' max='2100' style='width:50px' tabindex='13' />\n";
                echo "</span>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Entry price
                echo "<div>\n";
                echo "<label for='price'>Entry price :</label>\n";
                echo "<input id='price' type='text' name='entryPrice' value='$eventPrice' placeholder='Price in &pound;' tabindex='14' />&pound\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Category
                echo "<div>\n";
                echo "<label for='category'>Event category :</label>\n";
                echo "<select id='category' name='categoryID' disabled>\n";
                echo "<option>$catDesc</option>\n";
                echo "</select>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Event venue
                echo "<div>\n";
                echo "<label for='venue'>Event venue :</label>\n";
                echo "<select id='venue' name='venueID' disabled>\n";
                echo "<option>$venueName</option>\n";
                echo "</select>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Form option
                echo "<p><em>Confirm changes</em></p>";
                echo "<div>\n";
                echo "<input type='reset' value='Reset form' tabindex='15' accesskey='r'/>\n";
                echo "</div>";
                echo "<div>\n";
                echo "<input type='submit' form='editSelectEvent' value='Update event' tabindex='16' accesskey='s'/>\n";
                echo "</div>\n";
                echo "<div>\n";
                echo "<input type='button' value='Return to list' onclick='location.href=\"editSelectList.php\"' tabindex='17' accesskey='r'/>\n";
                echo "</div>\n";

                /*--------------------------------------------*/
                // Closing tags for form
                echo "</fieldset>\n";
                echo "</form>\n";
            }
        }
        $dbConn->close(); // Close db connection
        ?>
    </section>
</main>
<!-- page footer here -->
<footer id="pageFooter" tabindex="18">
    <!--disclaimer and contact info goes here -->
    <p>
        <small>All content &copy; copyright 2016 Arts and Events | Please read our <a href="credits.html" tabindex="19">
                terms and conditions</a></small>
    </p>
    <address tabindex="20">
        <small>
            4 Lymington Rd <br/>
            Westgate-on-Sea <br/>
            CT8 8ET <br/>
            United Kingdom <br/>
        </small>
    </address>
    <p><a href="tel://+44777-4919-702" title="Give us a call" accesskey="T" tabindex="21"> +447774919702</a></p>
    <p><a href="mailto:arts'n'events@gmail.co.uk" title="Email us" accesskey="E"
          tabindex="22">arts'n'events@gmail.ac.uk</a></p>
</footer>
</body>
</html>