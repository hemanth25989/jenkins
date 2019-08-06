<?php
/**
 * Grid GridInterface.
 * @category  Webkul
 * @package   Webkul_Grid
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\Grid\Api;

interface TeamInterface
{
	/**
     * Returns greeting message to user
     *
     * @api
	 * @param string $team_id Users Team name.
     * @return string Greeting message with users data.
     */
	
    public function content($team_id);
	
	/**
     * Returns team full details
     *
     * @api
	 * @param string $team_id Team Id.
     * @return string team full details.
     */
	
    public function getTeamFullDetails();
}
