<?php
session_start();
include('../resources/headers/header.php');

if (!function_exists('imap_open')) {
	echo "IMAP is not configured.";
	exit();
} else {
	require_once('../resources/DB/config.php');
	// Create connection
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM settings";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$imapurl = $row["imapurl"];
			$imapport = $row["imapport"];
			$imapusername = $row["imapusername"];
			$imappassword = $row['imappassword'];
		}
	} else {
		echo 'Account does not exist.';
	}

	$fullurl = '{' . $imapurl . ':' . $imapport . '/imap/ssl}INBOX';

	/* IMAP Connection code with GMAIL IMAP */
	$imap_conn = imap_open("$fullurl", "$imapusername", "$imappassword") or die('Cannot connect to server, error: ' . imap_last_error());

	/* SET email subject filter criteria */
	$inbox = imap_search($imap_conn, 'ALL');

	if (!empty($inbox)) {

		foreach ($inbox as $email) {
			// Get email header information
			$overview = imap_fetch_overview($imap_conn, $email, 0);
			// Get email body
			$message = imap_fetchbody($imap_conn, $email, '2');
			$date = date("d F, Y", strtotime($overview[0]->date));

			$from1 = $overview[0]->from;
			$from2 = clear($from1);
			$from3 = str_replace("<", "| ", "$from2");
			$from = str_replace(">", "", "$from3");

			$to1 = $overview[0]->to;
			$to2 = clear($to1);
			$to3 = trim(substr($to2, strpos($to2, '<')));
			$to4 = str_replace("<", "", "$to3");
			$to = str_replace(">", "", "$to4");

			$subject1 = $overview[0]->subject;
			$subject = clear($subject1);

			$msgno = $overview[0]->msgno;

			$message = clear($message);

			$date;
			$string = getString(20);
			$sql = "INSERT INTO `emails`(`fromaddress`, `subject`, `date`, `body`, `owner`, `uid`) VALUES ('$from', '$subject','$date','$message','$to','$string')";

			if ($conn->query($sql) === TRUE) {
				echo 'Email list updated.<br>';
				imap_delete($imap_conn, $msgno);
			} else {
				echo 'Error with database, error NO. 432<br>';
			}
		}
	}
	// Close imap connection
	imap_close($imap_conn, CL_EXPUNGE);
}
?>
</div>
</body>

</html>