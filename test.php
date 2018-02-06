<?php
	echo "running";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Site Title</title>
  <!-- <script src="jquery-3.3.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>
</head>

<body>

  <!-- Add an optional button to open the popup -->
  <button class="my_popup_open">Open popup</button>

  <!-- Add content to the popup -->
  <div id="my_popup">

    ...popup content...

    <!-- Add an optional button to close the popup -->
    <button class="my_popup_close">Close</button>

  </div>

  <!-- Include jQuery -->
  

  <!-- Include jQuery Popup Overlay -->
  

  <script>
    $(document).ready(function() {

      // Initialize the plugin
      $('#my_popup').popup();

    });
  </script>

</body>
</html>