<?php
include "./connection.php";

$connection = getConnection();

$output = "";

$sql = "SHOW TABLES LIKE 'Doctor';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Doctor
			(DrID INT AUTO_INCREMENT NOT NULL,
			FName VARCHAR(15) NOT NULL,
			LName VARCHAR(15) NOT NULL,
			OpNum INT,
			PRIMARY KEY (DrID) );";
	$connection->query($sql);
	$output .= "<p>Table 'Doctor' created</p>";
} else {
	$output .= "<p>Table 'Doctor' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Nurse';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Nurse 
			(NurseID INT AUTO_INCREMENT NOT NULL, 
			FName VARCHAR(15) NOT NULL,
			LName VARCHAR(15) NOT NULL, 
			DrWaitList INT, 
			PWaitTime VARCHAR(15), 
			PRIMARY KEY (NurseID) );";
	$connection->query($sql);

	$output .= "<p>Table 'Nurse' created</p>";
} else {
	$output .= "<p>Table 'Nurse' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Patient';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Patient 
			(AHC INT NOT NULL,
			FName VARCHAR(15) NOT NULL,
			LName VARCHAR(15) NOT NULL,
			SessionID INT,
			DrWaitList INT,
			PRIMARY KEY (AHC) ); ";
	$connection->query($sql);
	$output .= "<p>Table 'Patient' created</p>";
	
} else {
	$output .= "<p>Table 'Patient' already exists</p>";
}

//$sql = "DROP TABLE Session;";
//$result = $connection->query($sql);

$sql = "SHOW TABLES LIKE 'Session';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Session 
			(SessionID INT AUTO_INCREMENT NOT NULL,
			Room VARCHAR(15) NOT NULL,
			TProvided VARCHAR(15), 
			DrID INT NOT NULL,
			PRIMARY KEY (SessionID),
			FOREIGN KEY (DrID) REFERENCES Doctor (DrID) ON DELETE SET NULL ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'Session' created</p>";
} else {
	$output .= "<p>Table 'Session' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Waitlist';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Waitlist 
			(DrID INT NOT NULL,
			PFName VARCHAR(15) NOT NULL,
			PLName VARCHAR(15) NOT NULL,
			CONSTRAINT PK_Waitlist PRIMARY KEY (PFName, PLName),
			FOREIGN KEY (DrID) REFERENCES Doctor (DrID) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'Waitlist' created</p>";
} else {
	$output .= "<p>Table 'Waitlist' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'MedicalInfo';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE MedicalInfo
			(PAHC INT NOT NULL,
			Allergies VARCHAR(15),
			CrntMeds VARCHAR(15),
			HConds VARCHAR(15),
			PRIMARY KEY (PAHC),
			FOREIGN KEY (PAHC) REFERENCES Patient(AHC) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'MedicalInfo' created</p>";
} else {
	$output .= "<p>Table 'MedicalInfo' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'WaitTime';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE WaitTime
			(PAHC INT NOT NULL,
			waitTime VARCHAR(15) NOT NULL,
			PRIMARY KEY (PAHC),
			FOREIGN KEY (PAHC) REFERENCES Patient(AHC) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'WaitTime' created</p>";
} else {
	$output .= "<p>Table 'WaitTime' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Checks';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Checks
			(PAHC INT NOT NULL,
			NurseID INT NOT NULL,
			PRIMARY KEY (PAHC, NurseID),
			FOREIGN KEY (PAHC) REFERENCES Patient(AHC) ON DELETE CASCADE ON UPDATE CASCADE,
			FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'Checks' created</p>";
} else {
	$output .= "<p>Table 'Checks' already exists</p>";
}

//$sql = "DROP TABLE NurseHas;";
//$result = $connection->query($sql);

$sql = "SHOW TABLES LIKE 'NurseHas';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE NurseHas
			(NurseID INT NOT NULL,
			SessionID INT NOT NULL,
			PRIMARY KEY (NurseID, SessionID),
			FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID) ON DELETE CASCADE ON UPDATE CASCADE,
			FOREIGN KEY (SessionID) REFERENCES Session(Session_ID) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'NurseHas' created</p>";
} else {
	$output .= "<p>Table 'NurseHas' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Operation';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Operation
			(OpNum INT AUTO_INCREMENT NOT NULL,
			StartTime VARCHAR(15) NOT NULL,
			EndTime VARCHAR(15) NOT NULL,
			OpnType VARCHAR(15) NOT NULL,
			PFName VARCHAR(15) NOT NULL,
			PLName VARCHAR(15) NOT NULL,
			Docs VARCHAR(15),
			PRIMARY KEY (OpNum) ); ";
	$connection->query($sql);
	$output .= "<p>Table 'Operation' created</p>";
} else {
	$output .= "<p>Table 'Operation' already exists</p>";
}

$sql = "SHOW TABLES LIKE 'Docs';";
$result = $connection->query($sql);
$num_rows = $result->num_rows;
if (!($num_rows > 0)) {
	$sql = "CREATE TABLE Docs
			(DrID INT NOT NULL,
			OpNum INT NOT NULL,
			PRIMARY KEY (DrID, OpNum),
			FOREIGN KEY (DrID) REFERENCES Doctor(DrID) ON DELETE CASCADE ON UPDATE CASCADE,
			FOREIGN KEY (OpNum) REFERENCES Operation(OpNum) ON DELETE CASCADE ON UPDATE CASCADE); ";
	$connection->query($sql);
	$output .= "<p>Table 'Docs' created</p>";
} else {
	$output .= "<p>Table 'Docs' already exists</p>";
}

$connection->close();
?>

<html>

<head>
	<title>Group 39 - Project</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<?php echo $output; ?>
		<br>
		<a href="../index.php"><button>Back</button></a>
	</div>

</html>