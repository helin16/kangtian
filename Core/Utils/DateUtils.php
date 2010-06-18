<?php

abstract class DateUtils
{
	/**
	 * Returns a HydraDate object representing the current date and time
	 *
	 * @return HydraDate
	 */
    public static function now()
    {
        return new HydraDate();
    }

    /**
     * Returns the biggest date we can store in the database
     *
     * @return HydraDate
     */
    public static function bigDate()
    {
    	$date = new HydraDate();
    	$date->setDate(31, 11, 9999);
    	$date->setTime(23, 59, 59);
        return $date;
    }

    public static function zeroDate()
    {
    	$date = new HydraDate();
    	$date->setDate(1, 1, 1);
    	$date->setTime(0, 0, 0);
        return $date;    	
    }
    
    /**
     * Sets a HydraDate object back to the start of the day
     *
     * @param HydraDate $date
     * @return HydraDate
     */
    public static function getStartOfDay(HydraDate $date)
    {
		$date->setTime(0, 0, 0);
        return $date;
    }

	/**
	 * Returns list of all Abbreviations of TimeZones
	 *
	 * @return array[]
	 */
    public static function getAllAbbreviatedTimeZones()
    {
        return timezone_abbreviations_list();
    }
    
	/**
	 * Returns list of all TimeZones
	 *
	 * @return array[]
	 */
    public static function getAllTimeZones()
    {
        return timezone_identifiers_list();
    }
    
	/**
	 * Returns list of all TimeZones for a country
	 *
	 * @param string $countryName
	 * @return array[] TimeZones
	 */
    public static function getAllTimeZonesForCountry($countryName)
    {
    	$timeZoneList = array();
        $timezones = timezone_identifiers_list();
        
        foreach($timezones as $timezone)
        	if(substr_count($timezone,$countryName) > 0)
        		array_push($timeZoneList,$timezone);
        		
        return $timeZoneList;
    }
}


?>