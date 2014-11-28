 <?php
/**
* @version		$Id:reserve.php  1 2014-11-28 05:41:54Z  $
* @package		Kargah
* @subpackage 	Tables
* @copyright	Copyright (C) 2014, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Jimtawl TableReserve class
*
* @package		Kargah
* @subpackage	Tables
*/
class TableReserve extends JTable
{

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	public function __construct(& $db) 
	{
		parent::__construct('#__kargah_reserve', 'id', $db);
	}

	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	* @since 1.5
	*/
	public function bind($array, $ignore = '')
	{ 
		
		return parent::bind($array, $ignore);		
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	public function check()
	{



		/** check for valid name */
		/**
		if (trim($this->fname) == '') {
			$this->setError(JText::_('Your Reserve must contain a fname.')); 
			return false;
		}
		**/		

		return true;
	}
}
 