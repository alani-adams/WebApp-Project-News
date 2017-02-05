<html>
<!-- /*

Database: `user`

Table structure for table `stories`


CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) NOT NULL,
  `date1` varchar(140) NOT NULL,
  `story` text NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `submitted_by` varchar(50) NOT NULL,
  `photo` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `stories` (`id`, `title`, `date`, `story`, `approved`, `submitted_by`, `photo`) VALUES
(1, 'This is a test story', 'Oct 1, 2017', 'Bacon ipsum dolor amet shankle pork chop pastrami ground round, jerky bresaola drumstick short loin kevin meatloaf jowl sausage. Biltong bacon drumstick kevin meatloaf short ribs corned beef cow ball tip pork loin ham turducken. Shank filet mignon swine pork loin salami bacon pork kevin shoulder capicola t-bone pastrami. Sirloin jerky pastrami, chuck cow cupim ham hock porchetta. Pancetta alcatra pig strip steak pork.\r\n\r\nShort ribs pig shank, shankle landjaeger pork loin ham hock alcatra cow. Venison t-bone pork pork belly beef, tongue jerky doner ball tip ribeye strip steak. Strip steak venison tenderloin hamburger, porchetta ground round swine. Salami tail sirloin kevin, pastrami pork chop turkey porchetta capicola picanha.\r\n\r\nSalami kielbasa rump landjaeger ham hock beef. Beef pork boudin, flank strip steak hamburger ham hock cow spare ribs. Jerky cupim fatback pork, pig tail ball tip prosciutto. Beef ground round porchetta ribeye brisket, pastrami jerky chicken tri-tip drumstick fatback meatball cow salami pork loin. Beef turducken ground round rump. Porchetta jowl frankfurter ball tip ground round, salami andouille tri-tip. Kielbasa ham hock salami, bacon t-bone venison shankle biltong beef ribs hamburger chuck.\r\n\r\nTongue spare ribs filet mignon, pork leberkas picanha kevin chuck frankfurter bacon sirloin fatback beef ribs. Kielbasa jowl picanha, cupim meatloaf fatback pork. Alcatra sirloin salami fatback pork tail bresaola ham hock ground round capicola beef ribs. Swine andouille bacon spare ribs turkey. Porchetta bresaola spare ribs sirloin, pork belly rump salami shankle alcatra andouille meatloaf beef ribs jowl kielbasa capicola. Ground round short loin meatball, tri-tip flank pancetta swine shank. Bacon leberkas kielbasa, ground round brisket salami corned beef tongue shankle.\r\n\r\nSpare ribs t-bone shank picanha pork belly, tail shankle venison salami landjaeger jerky pig capicola pork loin. Hamburger ground round t-bone, ball tip pork loin pig prosciutto swine chuck pastrami frankfurter shankle. Pastrami frankfurter shankle pancetta boudin ground round rump tri-tip short ribs brisket leberkas fatback t-bone sausage. Picanha meatball capicola venison, biltong chuck jowl bresaola cupim leberkas.', 1, 'James', 'image1.gif');
*/

-->

	<head>
		<title>I <3 News! </title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
	</head>
	<body>
		<h1>I<3 NEWS!</h1>
		<?php

			$link =  mysql_connect("localhost","root","");

			if (!$link) {
    			printf("Connect failed: %s\n", mysql_error());
    			exit();
			}

			$db_selected = mysql_select_db("user", $link);
			if (!$db_selected) {
    			die("Database selection failed: " . mysql_error());
			}
			$sql = "SELECT id, title, date1, story, approved, submitted_by, photo FROM stories";
			$result = mysql_query("select * from stories");;

			if (mysql_num_rows($result) > 0) 
			{
     			// output data of each row
     			while($row = mysql_fetch_assoc($result)) {
     				if($row["approved"] == 1) {
         				echo $row["title"]. "<br>" . "By " . $row["submitted_by"]. "<br>" . $row["date1"] . "<br>" . $row["story"];
     				}
     			}
			} else {
     			echo "There are no stories!";
			}

		?>

		<h3>Submit a Story</h3>
		<form method="post" action="newsSQL.php" name="add_story">
			Username: <input type="text" name="submitted_by" id="add_name" /> <br/>
			Title:<input type="text" name="title" id="add_title" /> <br/>
			Story:<br/>
			<textarea rows="10" cols="100" name="story"> </textarea><br/>
			<input type="submit" value="Submit Story" />
		</form>


		


		
	</body>
		
				

	
</html>