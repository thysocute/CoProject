<?php
    /*
     * Documentation for getCalendarEvents.php
    */
    session_start();

    require_once('../includes/databaseConnection.php'); //Make the connection to the database
    require_once('../php/fullCalendarUtil.php'); //Includes the Event class and the datetime utilities (provided by FullCalendar.io)

    /* Step 1: Set variables for start and end date ranges */
    //Short-circuit if the client did not give us a date range.
    if (!isset($_GET['start']) || !isset($_GET['end'])) {
        die("Please provide a date range.");
    }

    // Parse the start/end parameters.
    // These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
    // Since no timezone will be present, they will parsed as UTC.
    $range_start = parseDateTime($_GET['start']);
    $range_end = parseDateTime($_GET['end']);

    //Set the $_SESSION parameters for the side bar in calendar.php
    // $_SESSION['start'] = $_GET['start'];
    // $_SESSION['end'] = $_GET['end'];

    /* Test start and end ranges */
    // $range_start = parseDateTime("2018-04-01");
    // $range_end = parseDateTime("2018-04-30");
    // $_SESSION['username'] = 'user1';

    // Parse the timezone parameter if it is present.
    $timezone = null;
    if (isset($_GET['timezone'])) {
        $timezone = new DateTimeZone($_GET['timezone']);
    }


    /* Step 2: Select the data from the database */
    $all_events = array(); //Holds all the events for the user

    /* Step 2a: Get the calendars the user has access to */
    // 加用户
    // $sql = "SELECT calendar_id FROM calendar_rights WHERE username = '" . $_SESSION['username'] . "'";
    /*
     * 改数据库的时候只需要改这里
     */
    $sql = "SELECT calendar_id FROM calendar_rights WHERE user_id IN (SELECT user_id FROM users WHERE account= '".$_SESSION["account"]."')";

    try {
        $userCalendars = $pdo->query($sql);
    } catch (PDOException $e) {
        echo "Error (./getCalendarEvents.php [infile]): $e";
    }

    /* Step 2b: Iterate through the calendars and add all events for those calendars to the $all_events array */
    $results = array(); // Holds all the events that are found for the user
    while ($singleCalendar = $userCalendars->fetch()) {
        $sql = "SELECT * FROM calendar_events WHERE calendar_id = '" . $singleCalendar['calendar_id'] . "'";

        // $sql = "SELECT * FROM calendar_events WHERE calendar_id = '1'";

        try {
            $allEvents = $pdo->query($sql);
        } catch (PDOException $e) {
            echo "Error (./getCalendarEvents.php [infile]): $e";
        }

        /* Step 3: Format the data as specified with key : value attributes in https://fullcalendar.io/docs/event-object */
        while ($row = $allEvents->fetch()) {
            // echo $row['name'];
            // echo $row['calendar_id'];
            $results[] = array(
                    "id"			=> $row['event_id'],
                    "title"			=> $row['title'],
                    "description"   => $row['description'],
                    "start"			=> $row['start_date'],
                    "end"			=> $row['end_date'],
                    "allDay"		=> $row['all_day'],
                    "color" 		=> $row['color'],
                    "remark" 	    => $row['remark']
            );
        }

       /* 
        * todo
        * 以calendar_id从calendar表中获取calendar_group
        * 然后根据calendar_group获取calendar_id
        * 查询calendar_id中remark = 1的数据的event_id
        * 去掉重复项
        */ 

    }

    /* Step 4: Convert the data into Event objects to be returned to the client */
    // Accumulate an output array of event data arrays.
    $output_arrays = array();
    foreach ($results as $array) {
        //Convert the input array into a useful Event object
        $event = new Event($array, $timezone);

        //If the event is in-bounds, add it to the output
        //
        //isWithinDayRange 不知道那里有问题
        // if ($event->isWithinDayRange($range_start, $range_end)) {
            $output_arrays[] = $event->toArray();
        // }
    }
    /* Step 5:  Send JSON to the client */
    echo json_encode($output_arrays);
?>
