<?php

/*CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) NOT NULL,
  `date1` varchar(140) NOT NULL,
  `story` text NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `submitted_by` varchar(50) NOT NULL,
  `photo` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
*/
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

$link = mysql_connect("localhost","root","");
if (!$link) {
    printf("Connect failed: %s\n", mysql_error());
    exit();
}
$db_selected = mysql_select_db("user", $link);
if (!$db_selected) {
    die("Database selection failed: " . mysql_error());
}

$Title = $_POST['title'];
$Date = date("d-m-Y");
$Submitted_by = $_POST['submitted_by'];
$Story = $_POST['story'];
$Approved = 0;
$Photo = mysql_real_escape_string(htmlspecialchars($_FILES['fileToUpload']['name']));
$id = 1;


$sql = "INSERT INTO stories (id, title, date1, story, approved, submitted_by, photo) VALUES ('Sid', '$Title', '$Date', '$Story', '$Approved', '$Submitted_by', '$Photo')";

if (!mysql_query($sql)) {
	die('Error: ' . mysql_error());
}
mysql_close();
?>

<html>
  <body>
    <h1> Thanks for submitting a story! </h1>
    <form method="LINK" action="news.php">
      <input type="submit" value="Return to News">
    </form>
  </body>
</html>