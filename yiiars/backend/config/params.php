<?php
return [
    'adminEmail' => 'admin@example.com',
    'breadcrumbs' => [],
    'uploads_dir' => dirname(__DIR__).'/web/uploads/',
    'image_domain' => 'http://www.ars.com/',
    'mainNavigation' => [
		[
			'name' => 'Dashboard',
			'icon' => 'fa fa-dashboard',		//https://fontawesome.com/v4.7.0/
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => 'User',
					'action' => '/user/index',
					'icon' => 'fa fa-circle-o'
				],
				[
					'name' => 'Device',
					'action' => '/device/index',
					'icon' => 'fa fa-circle-o',
				],
			],
		],
		[
			'name' => 'Attendance',
			'icon' => 'fa fa-pencil-square-o',
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => 'Record',
					'action' => '/attendance/index',
					'icon' => 'fa fa-circle-o',
				],
				[
					'name' => 'Guests',
					'action' => '/guests/index',
					'icon' => 'fa fa-circle-o',
				],
			],
		],
		[
			'name' => 'IC Card',
			'icon' => 'fa fa-address-card',
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => 'IC Card List',
					'action' => '/ic-card/index',
					'icon' => 'fa fa-circle-o',
				],
				[
					'name' => 'IC Card Log',
					'action' => '/ic-log/index',
					'icon' => 'fa fa-circle-o'
				]
			]
		]
	],
];
