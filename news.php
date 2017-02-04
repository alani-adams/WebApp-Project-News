<?php
/*

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) NOT NULL,
  `date` varchar(140) NOT NULL,
  `story` text NOT NULL,
  `approved` int(11) NOT NULL,
  `submitted_by` varchar(50) NOT NULL,
  `photo` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `stories` (`id`, `title`, `date`, `story`, `approved`, `submitted_by`, `photo`) VALUES
(1, 'This is a test story', 'Oct 1, 2017', 'Bacon ipsum dolor amet shankle pork chop pastrami ground round, jerky bresaola drumstick short loin kevin meatloaf jowl sausage. Biltong bacon drumstick kevin meatloaf short ribs corned beef cow ball tip pork loin ham turducken. Shank filet mignon swine pork loin salami bacon pork kevin shoulder capicola t-bone pastrami. Sirloin jerky pastrami, chuck cow cupim ham hock porchetta. Pancetta alcatra pig strip steak pork.\r\n\r\nShort ribs pig shank, shankle landjaeger pork loin ham hock alcatra cow. Venison t-bone pork pork belly beef, tongue jerky doner ball tip ribeye strip steak. Strip steak venison tenderloin hamburger, porchetta ground round swine. Salami tail sirloin kevin, pastrami pork chop turkey porchetta capicola picanha.\r\n\r\nSalami kielbasa rump landjaeger ham hock beef. Beef pork boudin, flank strip steak hamburger ham hock cow spare ribs. Jerky cupim fatback pork, pig tail ball tip prosciutto. Beef ground round porchetta ribeye brisket, pastrami jerky chicken tri-tip drumstick fatback meatball cow salami pork loin. Beef turducken ground round rump. Porchetta jowl frankfurter ball tip ground round, salami andouille tri-tip. Kielbasa ham hock salami, bacon t-bone venison shankle biltong beef ribs hamburger chuck.\r\n\r\nTongue spare ribs filet mignon, pork leberkas picanha kevin chuck frankfurter bacon sirloin fatback beef ribs. Kielbasa jowl picanha, cupim meatloaf fatback pork. Alcatra sirloin salami fatback pork tail bresaola ham hock ground round capicola beef ribs. Swine andouille bacon spare ribs turkey. Porchetta bresaola spare ribs sirloin, pork belly rump salami shankle alcatra andouille meatloaf beef ribs jowl kielbasa capicola. Ground round short loin meatball, tri-tip flank pancetta swine shank. Bacon leberkas kielbasa, ground round brisket salami corned beef tongue shankle.\r\n\r\nSpare ribs t-bone shank picanha pork belly, tail shankle venison salami landjaeger jerky pig capicola pork loin. Hamburger ground round t-bone, ball tip pork loin pig prosciutto swine chuck pastrami frankfurter shankle. Pastrami frankfurter shankle pancetta boudin ground round rump tri-tip short ribs brisket leberkas fatback t-bone sausage. Picanha meatball capicola venison, biltong chuck jowl bresaola cupim leberkas.', 1, 'James', 'image1.gif');
*/

if($action == "publish_story")
{
	$id = $_POST["id"];
	$id = htmlentities($link->real_escape_string($id));

	$result = $link->query("UPDATE stories SET approved='1' WHERE id='" . $id . "'");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else
		$message = "Story Published";
}
elseif($action == "unpublish_story")
{
	$id = $_POST["id"];
	$id = htmlentities($link->real_escape_string($id));

	$result = $link->query("UPDATE stories SET approved='0' WHERE id='" . $id . "'");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else
		$message = "Story Unpublished";
}
?>

<html>
	<head>
		<title>Welcome</title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
	</head>
	<body>
		<h1>I<3 NEWS!</h1>









		<h3>Submit a Story</h3>
		<form method="post" action="index.php" name="add_review">
			Username: <input type="text" name="name" id="add_name" /> <br/>
			Title:<input type="text" name="name" id="add_name" /> <br/>
		</form>
			Story:<br/>
		<textarea rows="10" cols="100"> </textarea>



		<?php
		$result = $link->query("SELECT * FROM stories");
		if(!$result)
			die ('Can\'t query users because: ' . $link->error);
		else
		{
			while($row = $result->fetch_assoc()):
				$id = $row["id"];
				$title = $row["title"];
				$story = $row["story"];
				$approved = $row["approved"];
				$submitted_by = $row["submitted_by"];
				?>
				<table border="1">
					<tr>
						<td colspan="2"><?php print $title;?></td>
					</tr>
					<tr>
						<td colspan="2"><?php print $story;?></td>
					</tr>
					<tr>
						<td><?php print $submitted_by;?></td>
						<td>
							<?php 
							if($approved == 0)
							{
								print "<form method='post' action='index.php'>
										<input type='hidden' name='action' value='publish_story' />
										<input type='hidden' name='id' value='$id' />
										<input type='submit' value='Publish' />
									   </form>";
							}
							elseif($approved == 1)
							{
								print "<form method='post' action='index.php'>
										<input type='hidden' name='action' value='unpublish_story' />
										<input type='hidden' name='id' value='$id' />
										<input type='submit' value='Unpublish' />
									   </form>";
							}
							?>
						</td>
					</tr>
				</table>
				<?php
			endwhile;
		}
		</body>
		
				

	
</html>