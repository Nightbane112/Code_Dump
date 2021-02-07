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
    <title>Site Administration - Event Preview</title>
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
    <h2>Your entered details</h2>
    <?php
    /* Display event preview */

    $error = false; // for error-checking

    // Retrieve data from form
    $eventTitle = isset($_REQUEST['eventTitle']) ? $_REQUEST['eventTitle'] : null; // Event title
    $eventDesc = isset($_REQUEST['eventDesc']) ? $_REQUEST['eventDesc'] : null; // Event Description
    $eventStartYear = isset($_REQUEST['eventStartYear']) ? $_REQUEST['eventStartYear'] : null; // Event Year (Start)
    $eventStartMonth = isset($_REQUEST['eventStartMonth']) ? $_REQUEST['eventStartMonth'] : null; // Event Month (Start)
    $eventStartDay = isset($_REQUEST['eventStartDay']) ? $_REQUEST['eventStartDay'] : null; // Event Day (Start)
    $eventEndYear = isset($_REQUEST['eventEndYear']) ? $_REQUEST['eventEndYear'] : null; // Event Year (End)
    $eventEndMonth = isset($_REQUEST['eventEndMonth']) ? $_REQUEST['eventEndMonth'] : null; // Event Month (End)
    $eventEndDay = isset($_REQUEST['eventEndDay']) ? $_REQUEST['eventEndDay'] : null; // Event Day (End)
    $entryPrice = isset($_REQUEST['entryPrice']) ? $_REQUEST['entryPrice'] : null; // Event entry price in pound sterling
    $catID = isset($_REQUEST['categoryID']) ? $_REQUEST['categoryID'] : null; // Event Category
    $venueID = isset($_REQUEST['venueID']) ? $_REQUEST['venueID'] : null; // Event venue


    // Convert categoryIDs to values
    switch ($catID) {
        case "c1":
            $eventCat = "Carnival";
            break;
        case "c2":
            $eventCat = "Theatre";
            break;
        case "c3":
            $eventCat = "Comedy";
            break;
        case "c4":
            $eventCat = "Exhibition";
            break;
        case "c5":
            $eventCat = "Festival";
            break;
        case "c6":
            $eventCat = "Family";
            break;
        case "c7":
            $eventCat = "Music";
            break;
        case "c8":
            $eventCat = "Sport";
            break;
        case "c9":
            $eventCat = "Dance";
            break;
        default:
            $eventCat = null;
    }
    /* Old code
    if ($catID === "c1") {
        $eventCat = "Carnival";
    }
    if ($catID === "c2") {
        $eventCat = "Theatre";
    }
    if ($catID === "c3") {
        $eventCat = "Comedy";
    }
    if ($catID === "c4") {
        $eventCat = "Exhibition";
    }
    if ($catID === "c5") {
        $eventCat = "Festival";
    }
    if ($catID === "c6") {
        $eventCat = "Family";
    }
    if ($catID === "c7") {
        $eventCat = "Music";
    }
    if ($catID === "c8") {
        $eventCat = "Sport";
    }
    if ($catID === "c9") {
        $eventCat = "Dance";
    }
    */
    
    // Convert venueIDs to values
    switch ($venueID) {
        case "v1":
            $eventVenue = "Theatre Royal";
            break;
        case "v2":
            $eventVenue = "Baltic Centre for Contemporary Art";
            break;
        case "v3":
            $eventVenue = "Laing Art Gallery";
            break;
        case "v4":
            $eventVenue = "The Biscuit Factory";
            break;
        case "v5":
            $eventVenue = "Discovery Museum";
            break;
        case "v6":
            $eventVenue = "HMS Calliope";
            break;
        case "v7":
            $eventVenue = "Metro Radio Arena";
            break;
        case "v8":
            $eventVenue = "Mill Volvo Tyne Theatre";
            break;
        case "v9":
            $eventVenue = "PLAYHOUSE Whitley Bay";
            break;
        case "v10":
            $eventVenue = "Shipley Art Gallery";
            break;
        case "v11":
            $eventVenue = "Seven Stories";
            break;
        default:
            $eventVenue = null;
    }
    /* Old code
    if ($venueID === "v1") {
        $eventVenue = "Theatre Royal";
    }
    if ($venueID === "v2") {
        $eventVenue = "BALTIC Centre for Contemporary Art";
    }
    if ($venueID === "v3") {
        $venueID = "Laing Art Gallery";
    }
    if ($venueID === "v4") {
        $eventVenue = "The Biscuit Factory";
    }
    if ($venueID === "v5") {
        $eventVenue = "Discovery Museum";
    }
    if ($venueID === "v6") {
        $eventVenue = "HMS Calliope";
    }
    if ($venueID === "v7") {
        $eventVenue = "Metro Radio Arena";
    }
    if ($venueID === "v8") {
        $eventVenue = "Mill Volvo Tyne Theatre";
    }
    if ($venueID === "v9") {
        $eventVenue = "PLAYHOUSE Whitley Bay";
    }
    if ($venueID === "v10") {
        $eventVenue = "Shipley Art Gallery";
    }
    if ($venueID === "v11") {
        $eventVenue = "Seven Stories";
    }
    */

    /*----------------------------------------*/
    // Display error if any

    // Concatenate event year, month and day into one string
    $eventStartDate = $eventStartYear."-".$eventStartMonth."-".$eventStartDay;
    $eventEndDate = $eventEndYear."-".$eventEndMonth."-".$eventEndDay;

    // Check if event Start year is empty
    if (empty($eventStartYear) || empty($eventStartMonth) || empty($eventStartDay)) {
        echo "<p tabindex='4' accesskey='e'>The starting date for this event was not stated correctly. The date will be set to \"TBD\".</p>\n";
        $eventStartDate = "TBD";
        $error = true;
    }
    else {
        // Check validity of date entered
        $date = true;

        function validateStartDate($eventStartDate){
            $date = DateTime::createFromFormat('Y-m-d',$eventStartDate);
            return $date;
        }
        if ($date == false) {
            echo "<p tabindex='4' accesskey='e'>The event start date entered is invalid. Please re-enter the date.</p>\n";
            $error = true;
        }
    }
    // Check if event End year is empty
    if (empty($eventEndYear) || empty($eventEndMonth) || empty($eventEndDay)) {
        echo "<p tabindex='5' accesskey='e'>The end date for this event was not stated correctly. The date will be set to \"TBD\".</p>\n";
        $eventEndDate = "TBD";
        $error = true;
    }
    else {
        // Check validity of date entered
        $date = true;
        
        function validateEndDate($eventEndDate){
            $date = DateTime::createFromFormat('Y-m-d',$eventEndDate);
            return $date;
        }
        if ($date == false) {
            echo "<p tabindex='5' accesskey='e'>The event end date entered is invalid. Please re-enter the date.</p>\n";
            $error = true;
        }
    }

    // Check if entry price is empty
    if (empty($entryPrice) && $eventStartDate === "TBD") {
        echo "<p tabindex='6' accesskey='e'>Since event date has not been set, entry price will be set to \"TBD\".</p>\n";
        $entryPrice = "TBD";
    } else if (empty($entryPrice)) {
        echo "<p tabindex='6' accesskey='e'>The price for entry to event was not stated. Entry price will be set to 0.</p>\n";
        $entryPrice = 0;
    }

    // Check if event start date is earlier than event end date and vice versa
    if ($eventEndDate < $eventStartDate) {
        echo "<p tabindex='7' accesskey='e'>Event end date should not be earlier event start date. <em>($eventStartDate - $eventEndDate)</em></p>";
        $error = true;
    } else if ($eventStartDate > $eventEndDate) {
        echo "<p tabindex='7' accesskey='e'>Event start date should not be later event end date. <em>($eventStartDate - $eventEndDate)</em></p>";
        $error = true;
    }

    // Display form

    /*--------------------------------------------*/
    // Create form with values from database
    echo "<form id='addNewEventPreview' action='addEvent.php' method='post' tabindex='8' accesskey='f'>\n";
    echo "<fieldset>\n";
    echo "<legend>Event Details</legend>\n";
    echo "<em>Columns marked with asterisks are required</em>\n";

    /*--------------------------------------------*/
    // Event title
    echo "<div>\n";
    echo "<label for='eventTitle'>Event title</label>";
    echo "<input id='eventTitle' type='text' name='eventTitle' value='$eventTitle' disabled required/>\n";
    echo "<em>*</em>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Event Description
    echo "<div>\n";
    echo "<label for='eventDesc'>Event description :</label>\n";
    echo "<textarea id='eventDesc' name='eventDesc' rows='5' cols='30' required disabled>$eventDesc</textarea>\n";
    echo "<em>*</em>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Event Start Date
    echo "<div>\n";
    echo "<p>Start Date :</p>\n";

    // Testing variables
    $month = array("January" => "01", "February" => "02", "March" => "03", "April" => "04", "May" => "05",
        "June" => "06", "July" => "07", "August" => "08", "September" => "09", "October" => "10",
        "November" => "11", "December" => "12"
    );

    // Day
    echo "<span>\n";
    echo "<label for='eventStartDay'>Day:</label>\n";
    echo "<input id='eventStartDay' type='number' name='eventStartDay' value='$eventStartDay' min='01' max='31' style='width:30px' disabled />\n";
    echo "</span>\n";

    // Month
    echo "<span>\n";
    echo "<label for='eventStartMonth'>Month:</label>\n";
    echo "<select id='eventStartMonth' name='eventStartMonth' disabled>\n";

    // Assign selected tag to event month when value matches
    foreach ($month as $name => $monthNum) {
        if ($eventStartMonth === $monthNum) {
            echo "<option value='$monthNum'>$name</option>\n";
        }
    }
    echo "</select>\n";
    echo "</span>\n";

    // Year
    echo "<span>\n";
    echo "<label for='eventStartYear'>Year:</label>\n";
    echo "<input id='eventStartYear' type='number' name='eventStartYear' value='$eventStartYear' min='1940' max='2100' style='width:50px' disabled />\n";
    echo "</span>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Event End Date
    echo "<div>\n";
    echo "<p>End Date :</p>\n";

    // Day
    echo "<span>\n";
    echo "<label for='eventEndDay'>Day:</label>\n";
    echo "<input id='eventEndDay' type='number' name='eventEndDay' value='$eventEndDay' min='01' max='31' style='width:30px' disabled />\n";
    echo "</span>\n";

    // Month
    echo "<span>\n";
    echo "<label for='eventEndMonth'>Month:</label>\n";
    echo "<select id='eventEndMonth' name='eventEndMonth' disabled>\n";
    // Assign selected tag to event month when value matches
    foreach ($month as $name => $monthNum) {
        if ($eventStartMonth === $monthNum) {
            echo "<option value='$monthNum' selected=>$name</option>\n";
        } else {
            echo "<option value='$monthNum'>$name</option>\n";
        }
    }
    echo "</select>\n";
    echo "</span>\n";

    // Year
    echo "<span>\n";
    echo "<label for='eventEndYear'>Year:</label>\n";
    echo "<input id='eventEndYear' type='number' name='eventEndYear' value='$eventEndYear' min='1940' max='2100' style='width:50px' disabled/>\n";
    echo "</span>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Entry price
    echo "<div>\n";
    echo "<label for='entryPrice'>Entry price :</label>\n";
    echo "<input id='entryPrice' type='text' name='entryPrice' value='$entryPrice' placeholder='Price in &pound;' disabled/>&pound;\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Category

    
    echo "<div>\n";
    echo "<label for='categoryID'>Event category :</label>\n";
    echo "<select id='categoryID' name='categoryID' disabled>\n";
    echo "<option value='$catID'>$eventCat</option>\n";
    echo "</select>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Event venue
    echo "<div>\n";
    echo "<label for='venueID'>Event venue :</label>\n";
    echo "<select id='venueID' name='venueID' disabled>\n";
    echo "<option value='$venueID'>$eventVenue</option>\n";
    echo "</select>\n";
    echo "</div>\n";

    /*--------------------------------------------*/
    // Closing tags for form
    echo "</fieldset>\n";
    echo "</form>\n";

    /*--------------------------------------------*/
    // Event Preview

    echo "<h3 tabindex='9' accesskey='o'>Expected output: </h3>";
    echo '<section class = "eventArticle">';

    // Display category icons next to article
    echo "<article>\n";
    echo '<div class="avatar">';
    
    /* Old code
    if ($eventCat === "Carnival") {
        echo '<img src="Assets/Images/Icons/carnival.svg" alt="Carnival Icon"';
    }
    if ($eventCat === "Theatre") {
        echo '<img src="Assets/Images/Icons/theatre.svg" alt="Theatre Icon"';
    }
    if ($eventCat === "Comedy") {
        echo '<img src="Assets/Images/Icons/comedy.svg" alt="Comedy Icon"';
    }
    if ($eventCat === "Exhibition") {
        echo '<img src="Assets/Images/Icons/exhibition.svg" alt="Exhibition Icon"';
    }
    if ($eventCat === "Festival") {
        echo '<img src="Assets/Images/Icons/festival.svg" alt="Festival Icon"';
    }
    if ($eventCat === "Family") {
        echo '<img src="Assets/Images/Icons/family.svg" alt="Family Icon"';
    }
    if ($eventCat === "Music") {
        echo '<img src="Assets/Images/Icons/music.svg" alt="Music Icon"';
    }
    if ($eventCat === "Sport") {
        echo '<img src="Assets/Images/Icons/sport.svg" alt="Sport Icon"';
    }
    if ($eventCat === "Dance") {
        echo '<img src="Assets/Images/Icons/dance.svg" alt="Dance Icon"';
    }
    */
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
    
    echo ' width="50" height="50" />';
    echo "</div>\n";

    // Display expected output of event
    echo "<div>\n";
    // Title
    echo "<h3 tabindex='10'>$eventTitle</h3>\n";
    // Date
    // if event start and ends on same day, display start date only
    if ($eventStartDate === $eventEndDate) {
        echo "Date : <time>$eventStartDate</time><br />\n";
    } else {
        echo "Date : <time>$eventStartDate</time> - <time>$eventEndDate</time><br />\n";
    }
    // Location
    echo "Venue : $eventVenue<br />\n";
    // Category
    echo "Category : $eventCat<br />\n";
    // Description
    echo "<p>$eventDesc</p>\n";
    // Price
    if ($entryPrice > 0) {
        echo "<p>Entry price : $entryPrice &pound;</p>\n";
    } else if ($entryPrice === 0) {
        echo "<p>Entry price : Free</p>\n";
    } else {
        echo "<p>Entry price : TBA</p>\n";
    }
    echo "</div>\n";
    echo "</article>\n\n";

    // Ask for confirmation
    echo "<em tabindex='11'>Confirm event entered?</em>";
    // Send to database but don't allow if still has error
    if ($error) {
        echo "\n<div>\n";
        echo "<input type='submit' value='Confirm Event' tabindex='12' accesskey='c' disabled />\n";
        echo "</div>";
    } else {
        echo "\n<div>\n";
        echo "<input type='submit' form='addNewEventPreview' value='Confirm Event' tabindex='12' accesskey='c'/>\n";
        echo "</div>";
    }
    // Return to form
    echo "\n<div>\n";
    echo "<input type='button' value='Return to form' tabindex='13' accesskey='r' onclick='location.href=\"addEventsForm.html\"'/>";
    echo "\n</div>\n";
    echo "</form>\n";

    ?>
</main>
<!-- page footer here -->
<footer id="pageFooter" tabindex="14">
    <!--disclaimer and contact info goes here -->
    <p>
        <small>All content &copy; copyright 2016 Arts and Events | Please read our <a href="credits.html" tabindex="15">
                terms and conditions</a></small>
    </p>
    <address tabindex="16">
        <small>
            4 Lymington Rd <br/>
            Westgate-on-Sea <br/>
            CT8 8ET <br/>
            United Kingdom <br/>
        </small>
    </address>
    <p><a href="tel://+44777-4919-702" title="Give us a call" accesskey="T" tabindex="17"> +447774919702</a></p>
    <p><a href="mailto:arts'n'events@gmail.co.uk" title="Email us" accesskey="E"
          tabindex="18">arts'n'events@gmail.ac.uk</a></p>
</footer>
</body>
</html>
