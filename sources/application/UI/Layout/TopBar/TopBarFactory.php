<?php
/**
 * Copyright (C) 2013-2020 Combodo SARL
 *
 * This file is part of iTop.
 *
 * iTop is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iTop is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 */

namespace Combodo\iTop\Application\UI\Layout\TopBar;


use Combodo\iTop\Application\UI\Component\Breadcrumbs\Breadcrumbs;
use Combodo\iTop\Application\UI\Component\GlobalSearch\GlobalSearchFactory;
use Combodo\iTop\Application\UI\Component\QuickCreate\QuickCreateFactory;
use utils;

/**
 * Class TopBarFactory
 *
 * @author Guillaume Lajarige <guillaume.lajarige@combodo.com>
 * @package Combodo\iTop\Application\UI\Layout\TopBar
 * @internal
 * @since 2.8.0
 */
class TopBarFactory
{
	/**
	 * Make a standard TopBar layout for backoffice pages
	 *
	 * @param array|null $aBreadcrumbsEntry Current breadcrumbs entry to add
	 *
	 * @return \Combodo\iTop\Application\UI\Layout\TopBar\TopBar
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 */
	public static function MakeStandard($aBreadcrumbsEntry = null)
	{
		$oTopBar =  new TopBar(TopBar::BLOCK_CODE);

		if(utils::GetConfig()->Get('quick_create.enabled') === true)
		{
			$oTopBar->SetQuickCreate(QuickCreateFactory::MakeFromUserHistory());
		}

		if(utils::GetConfig()->Get('global_search.enabled') === true)
		{
			$oTopBar->SetGlobalSearch(GlobalSearchFactory::MakeFromUserHistory());
		}

		if(utils::GetConfig()->Get('breadcrumb.enabled') === true)
		{
			$oBreadcrumbs = new Breadcrumbs(Breadcrumbs::BLOCK_CODE, $aBreadcrumbsEntry);

			$oTopBar->SetBreadcrumbs($oBreadcrumbs);
		}

		return $oTopBar;
	}
}