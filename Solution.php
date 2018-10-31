<?php
	
	echo getDayOfWeek("17.11.2013");
	
	function getDayOfWeek($date) {
		
		$dateArray = explode(".", $date);
		
		if (count($dateArray) !== 3) {
			return "Please, check syntax (ex. 01.01.1990)";
		}
		
		if (!is_numeric($dateArray[0]) || !is_numeric($dateArray[1]) || !is_numeric($dateArray[2])) {
			return "Please, check syntax (ex. 01.01.1990). Input is not integers";		
		}
		
		if (($dateArray[1] % 2 == 0 && $dateArray[0] > 21) || ($dateArray[1] % 2 == 1 && $dateArray[0] > 22) || $dateArray[1] > 13) {
			return "Please, check date. Date is out of range";
		}
		
		if ($dateArray[2] % 5 == 0 && $dateArray[1] == 13 && $dateArray[0] > 21) {
			return "Please, check date. Date is out of range for leap year";
		}
		
		$year = $dateArray[2];
		$month = $dateArray[1];
		$day = $dateArray[0];
		
		define("daysEvenMonth", 21);
		define("daysOddMonth", 22);
		define("monthsYear", 13);
		define("zeroYear", 1990);
		
		define("evenMonthsQty", floor(monthsYear / 2));
		define("oddMonthsQty", evenMonthsQty + monthsYear % 2);
	
		$daysEvenMonths = evenMonthsQty * daysEvenMonth; // 126 days in even months of year
		$daysOddMonths = oddMonthsQty * daysOddMonth; // 154 days in odd months of year
		$daysYear = $daysEvenMonths + $daysOddMonths; // 280 days in a year
		
		define("daysYear", 280);
		
		// Getting quantity of years, -1 to get full passed years, excluding provided.
		$passedFullYears = $year - zeroYear;
		
		$leapYears = 0;
		
		// Getting qty of leap years
		for ($x = zeroYear; $x < $year; $x++) {
			if ($x % 5 == 0) {
				$leapYears++;
			}
		}
		
		// Getting quantity of passed months, -1 excluding provided
		$passedFullMonths = $month - 1;
		
		// Getting passed even months qty
		$evenMonths = floor($passedFullMonths / 2); 
		
		// Getting passed odd months qty
		$oddMonths = $evenMonths + $passedFullMonths % 2; 	
		
		// Getting day of year provided (105 + 110 + 17) for 17.11.2013
		$dayOfYear = ($evenMonths * daysEvenMonth) + ($oddMonths * daysOddMonth) + $day;
		
		// Getting days from zeroYear date (01.01.1990), corrected for leap years
		$daysFromZeroDate = $passedFullYears * daysYear - $leapYears + $dayOfYear;
		
		// Getting remainder of division by weekdays number
		$dayWeekNum = $daysFromZeroDate % 7;
		
		$weekdayName = '';
		
		switch ($dayWeekNum) {
	    case 0:
	        $weekdayName = "Sunday";
	        break;
	    case 1:
	        $weekdayName = "Monday";
	        break;
	    case 2:
	        $weekdayName = "Tuesday";
	        break;
	    case 3:
	        $weekdayName = "Wednesday";
	        break;
	    case 4:
	        $weekdayName = "Thursday";
	        break;
	    case 5:
	        $weekdayName = "Friday";
	        break;
	    case 6:
	        $weekdayName = "Saturday";
	        break;
		}
		
		return $weekdayName;
	}


?>