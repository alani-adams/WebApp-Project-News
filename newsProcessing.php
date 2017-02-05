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
$Photo = NULL; //******THIS IS THE PHOTO STUFF THAT NEEDS TO BE DONE!!!!!!

$id = 1;

$sql = "INSERT INTO stories (id, title, date1, story, approved, submitted_by, photo) VALUES ('Sid', '$Title', '$Date', '$Story', '$Approved', '$Submitted_by', '$Photo')";

if (!mysql_query($sql)) {
	die('Error: ' . mysql_error());
}

echo "Thanks for submitting a story!";


mysql_close();
?>