<html>
<head>
<title></title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="Author" content="Theofilo Brito">
<meta name="Generator" content="AceHTML 4 Pro">
  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="calendar-blue2.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="lang/calendar-br.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>

</head>
<body>


<p><b>Input field with a trigger button.</b> Clicking the button activates
the calendar.  Note that this one needs double-click (singleClick parameter
is explicitely set to false).  Also demonstrates the "step" parameter
introduced in 0.9.6 (show all years in drop-down boxes, instead of every
other year as default).</p>

<form action="#" method="get">
<input type="text" name="date" id="f_date_b" /><button type="reset" id="f_trigger_b">...</button>
</form>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>



<hr>

<div style="float: right; margin-left: 1em; margin-bottom: 1em;"
id="calendar-container"></div>

<script type="text/javascript">
  function dateChanged(calendar) {
    // Beware that this function is called even if the end-user only
    // changed the month/year.  In order to determine if a date was
    // clicked you can use the dateClicked property of the calendar:
    if (calendar.dateClicked) {
      // OK, a date was clicked, redirect to /yyyy/mm/dd/index.php
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31
      // redirect...
      window.location = "/" + y + "/" + m + "/" + d + "/index.php";
    }
  };

  Calendar.setup(
    {
      flat         : "calendar-container", // ID of the parent element
      flatCallback : dateChanged           // our callback function
    }
  );
</script>




</body>
</html>
