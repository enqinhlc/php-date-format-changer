<?php

/**
 * Copyright 2016 Engin Halaç <enginhalac@gmail.com>
 *
 * @author  Engin Halaç <enginhalac@gmail.com>
 * @url https://github.com/enqinhlc/php-date-format-changer
 * @version 1.0
 */

class DateFormatChanger {

	/**
	 * @var string
	 */
	private $date = 'd/m/y';
	/**
	 * @var string
	 */
	private $format = 'd/m/y';
	/**
	 * @var string
	 */
	private $seperator = '/';
	/**
	 * @var string
	 */
	private $returnFormat = 'ymd';
	/**
	 * @var string
	 */
	private $returnSeperator = '-';

	/**
	 * @var bool
	 */
	private $isUnix = false;

	/**
	 * @param string $date
	 */
	function setDate($date = 'd/m/y') {
		date_default_timezone_set('Europe/Istanbul');
		$this->date = $date;
	}

	/**
	 * @param string $format
	 */
	function setFormat($format = 'd/m/y') {
		$this->format = $format;
	}

	/**
	 * @param string $seperator
	 */
	function setSeperator($seperator = '/') {
		$this->seperator = $seperator;
	}

	/**
	 * @param string $returnFormat
	 */
	function setReturnFormat($returnFormat = 'ymd') {
		$this->returnFormat = $returnFormat;
	}

	/**
	 * @param string $returnSeperator
	 */
	function setReturnSeperator($returnSeperator = '-') {
		$this->returnSeperator = $returnSeperator;
	}

	/**
	 * @param bool $isUnix
	 */
	function isUnix($isUnix = false) {
		$this->isUnix = $isUnix;
	}

	/**
	 * @return int|string
	 */
	function getDate() {
		$parse = explode($this->seperator, strtolower($this->format));
		$regex = array();
		foreach ($parse as $key => $value) {
			$regex[] = '(?<' . $value . '>\d+)';
		}
		preg_match('#' . implode('/', $regex) . '#', $this->date, $m);
		$returnParse = array();
		for ($i = 0; $i < strlen($this->returnFormat); $i++) {
			$formatParam = $this->returnFormat{$i};
			if (isset($m[ strtolower($formatParam) ])) {
				$returnParse[] = $m[ strtolower($formatParam) ];
			} else {
				$returnParse[] = date($formatParam);
			}
		}
		$newDate = implode($this->returnSeperator, $returnParse);
		if ($this->isUnix === false) {
			return $newDate;
		} else {
			return mktime(0, 0, 0, $m['m'], $m['d'], $m['y']);
		}
	}
}


# $dfc = new DateFormatChanger();
# $dfc->setDate('11/08/2016');
# $dfc->setFormat('d/m/y'); // default
# $dfc->setSeperator('/'); // default
# $dfc->setReturnFormat('dmy');
# $dfc->setReturnSeperator('-'); // default
# echo $dfc->getDate() . "\n"; // 11-08-2016
# $dfc->setReturnSeperator('/');
# echo $dfc->getDate() . "\n"; // 11/08/2016

?>
