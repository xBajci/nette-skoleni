<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();

		$router[] = new Route('test', function($a) {
			echo "param: $a";
		});

		$router[] = new Route('<neco>', [
			NULL => [
				Route::FILTER_IN => function($params) {
					if ($params['neco'] == '123') {
						return [
							'presenter' => 'Admin:Sign',
							'action' => 'in',
						];
					}
				},
				Route::FILTER_OUT => function($params) {
					if ($params['presenter'] == 'Admin:Sign'
					&& $params['action'] == 'in') {
						return ['neco' => '123'];
					}
				},
			],
		]);

		$router[] = new Route('rss[!.xml]', 'Front:Article:rss');
		$router[] = new Route('clanek/<slug>', 'Front:Article:detail', Route::ONE_WAY);
		$router[] = new Route('article/<slug .+>', 'Front:Article:detail');
		$router[] = new Route('[page/<page>]', 'Front:Article:list');

		$router[] = new Route('admin/[<page [0-9]+>]', 'Admin:Article:list');
		$router[] = new Route('admin/add', 'Admin:Article:add');
		$router[] = new Route('admin/sign-<action>', [
			'presenter' => 'Admin:Sign',
			'action' => [
				Route::FILTER_TABLE => [
					'prihlasit' => 'in',
					'odhlasit' => 'out',
				],
			],
		]);

		$router[] = new Route('<presenter>/<action>[/<id>]', 'Front:Article:list');
		return $router;
	}

}
