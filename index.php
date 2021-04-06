<?php
	session_start();

	$errors = "";

	function array2string($ary, $depht=0)
	{
	    $output = ""; // string that represents your array
	    $prefix = ""; // spaces to print before "key value"
	    for ($i = 0; $i < $depht; $i++) // print as many spaces "\t" as how deep we are in the array
	    {
	        $prefix .= "\t";
	    }
	    foreach($ary as $key => $value)
	    {
	         if (is_array($value))
	         {
	             // if $value is an array print it with this same function
	             $output .= array2string($value, $depht+1);
	         } else
	         {
	             // else, simply append "key value"
	            $output .= "<th>" . $value . "</th>";
	         }
	    }

	    return "<tr>" . $output . "</tr>";
	}

	if (isset($_POST['submit'])) {

    $fee = $_POST['hours'];
    $data = array();

    if (empty($_POST['plat-num'])) {
      $errors = "You must fill in the plat number";
    } else {
      if ($_POST['vehicle'] == 'Motorcycle') {
        if (($_POST['parking-spot'] == "A1") || 
            ($_POST['parking-spot'] == "A2") ||
            ($_POST['parking-spot'] == "A3") ||
            ($_POST['parking-spot'] == "A4") ||
            ($_POST['parking-spot'] == "A5") ||
            ($_POST['parking-spot'] == "A6") ||
            ($_POST['parking-spot'] == "A7") ||
            ($_POST['parking-spot'] == "A8") ||
            ($_POST['parking-spot'] == "A9") ||
            ($_POST['parking-spot'] == "A10")) {
          if($_POST['hours'] < 6) {
              $data = array(
              'spotData' => $_POST['parking-spot'],
              'platData' => $_POST['plat-num'],
              'vehicleData' => $_POST['vehicle'],
              'durationData' => $_POST['hours'],
              'feeData' => $fee * 1.5);
          } else {
              $data = array(
              'spotData' => $_POST['parking-spot'],
              'platData' => $_POST['plat-num'],
              'vehicleData' => $_POST['vehicle'],
              'durationData' => $_POST['hours'],
              'feeData' => 50);
          }
        } else {
          $errors = "Motorcycle can only park in A1 - A10";
        }
      } else {
        if (($_POST['parking-spot'] != "A1") && 
            ($_POST['parking-spot'] != "A2") &&
            ($_POST['parking-spot'] != "A3") &&
            ($_POST['parking-spot'] != "A4") &&
            ($_POST['parking-spot'] != "A5") &&
            ($_POST['parking-spot'] != "A6") &&
            ($_POST['parking-spot'] != "A7") &&
            ($_POST['parking-spot'] != "A8") &&
            ($_POST['parking-spot'] != "A9") &&
            ($_POST['parking-spot'] != "A10")) {
          if($_POST['hours'] < 6) {
              $data = array(
              'spotData' => $_POST['parking-spot'],
              'platData' => $_POST['plat-num'],
              'vehicleData' => $_POST['vehicle'],
              'durationData' => $_POST['hours'],
              'feeData' => $fee * 3);
          } else {
              $data = array(
              'spotData' => $_POST['parking-spot'],
              'platData' => $_POST['plat-num'],
              'vehicleData' => $_POST['vehicle'],
              'durationData' => $_POST['hours'],
              'feeData' => 50);
          }
        } else {
          $errors = "Car cannot park in A1 - A10";
        }
      }

      $_SESSION['data'][] = $data;

    }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2>ParkingLot Management System</h2>
	</div>
	<form action="index.php" method="post" id="myForm">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<table>
			<tr>
				<td><label for="parking-spot">Parking Spot</label></td>
				<td>:</td>
				<td>
					<select name="parking-spot" id="parking-spot" required>
						<option value="A1">A1</option>
						<option value="A2">A2</option>
						<option value="A3">A3</option>
						<option value="A4">A4</option>
						<option value="A5">A5</option>
						<option value="A6">A6</option>
						<option value="A7">A7</option>
						<option value="A8">A8</option>
						<option value="A9">A9</option>
						<option value="A10">A10</option>
						<option value="A11">A11</option>
						<option value="A12">A12</option>
						<option value="A13">A13</option>
						<option value="A14">A14</option>
						<option value="A15">A15</option>
						<option value="A16">A16</option>
						<option value="A17">A17</option>
						<option value="A18">A18</option>
						<option value="A19">A19</option>
						<option value="A20">A20</option>
						<option value="B1">B1</option>
						<option value="B2">B2</option>
						<option value="B3">B3</option>
						<option value="B4">B4</option>
						<option value="B5">B5</option>
						<option value="B6">B6</option>
						<option value="B7">B7</option>
						<option value="B8">B8</option>
						<option value="B9">B9</option>
						<option value="B10">B10</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="plat-num">Plat-Number</label></td>
				<td>:</td>
				<td><input type="text" name="plat-num" id="plat-num" placeholder="LL-NNN"></td>
			</tr>
			<tr>
				<td><label for="vehicle">Vehicle</label></td>
				<td>:</td>
				<td>
					<select name="vehicle" id="vehicle" required>
						<option value="Car">Car</option>
						<option value="Motorcycle">Motorcycle</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="">Hours of stay</label></td>
				<td>:</td>
				<td>
					<select name="hours" id="hours" required>
						<option value="1">1 hour</option>
						<option value="2">2 hours</option>
						<option value="3">3 hours</option>
						<option value="4">4 hours</option>
						<option value="5">5 hours</option>
						<option value="More than 5 hours">More than 5 hours</option>
					</select>
				</td>
			</tr>		
		</table>
		<div class="center">
			<input type="submit" name="submit" class="btn">
			<input type="reset" name="reset" class="btn">
			<button type="clear" class="btn" name="clear">Clear</button>
		</div>
		</form>
		<table>
			<thead>
				<tr>
					<th>Parking Spot</th>
					<th>Plat Number</th>
					<th>Vehicle Type</th>
					<th>Duration</th>
					<th>Fee</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				    echo array2string($_SESSION);

				    if(isset($_POST['clear'])) {
				        session_destroy();
				      }

      			?>
			</tbody>
		</table>
</body>
</html>