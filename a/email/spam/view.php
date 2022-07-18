<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header.php');
?>

<body>

  <div class="space">

    <?php
    $uid = $_GET['uid'];
    if (strlen($uid) > 0) {
      echo '<form style="margin-left: 95%;">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#share">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
      </svg>
      </button>
        </form>';
      require_once('../../../resources/DB/config.php');


      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM spam WHERE uid ='$uid'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $uid = $row['uid'];
          $from = $row['fromaddress'];
          $subject = $row['subject'];
          $body = $row['body'];
          $name = strtok($from, '|');
          echo "<h1>$name</h1>";
          $email = explode("|", $from)[1];
          echo "<small>$email</small>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<h4>$subject</h4>";
          echo "<p>$body</p>";
        }
      } else {
        echo "Failed to load message, error NO. 369";
      }
    }
    ?>
    <div class="modal fade" id="share" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <b>Are you sure?</b>
          </div>
          <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
          <div class="modal-footer">
            <form action="../../a/email/functions/delete-spam.php" method="POST" target="dummyframe">
              <input type="hidden" name="uid" value="<?php echo $uid ?>">
              <button type="submit" class="btn btn-primary" onclick="reload();">Delete</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      function reload() {
        location.reload();
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </div>
</body>