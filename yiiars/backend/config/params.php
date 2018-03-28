<?php
return [
    'adminEmail' => 'admin@example.com',
    'breadcrumbs' => [],
    'uploads_dir' => dirname(__DIR__).'/web/uploads/',
    'image_domain' => 'http://www.ars.com/',
    'mainNavigation' => [
		[
			'name' => '操作面板',
			'icon' => 'fa fa-dashboard',		//https://fontawesome.com/v4.7.0/
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => '用户信息',
					'action' => '/user/index',
					'icon' => 'fa fa-circle-o'
				],
				[
					'name' => '设备管理',
					'action' => '/device/index',
					'icon' => 'fa fa-circle-o',
				],
			],
		],
		[
			'name' => '签到中心',
			'icon' => 'fa fa-pencil-square-o',
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => '签到数据',
					'action' => '/attendance/index',
					'icon' => 'fa fa-circle-o',
				],
				[
					'name' => '访客数据',
					'action' => '/guests/index',
					'icon' => 'fa fa-circle-o',
				],
			],
		],
		[
			'name' => 'IC 卡',
			'icon' => 'fa fa-address-card',
			'active' => false,
			'action' => '#',
			'items' => [
				[
					'name' => 'IC卡列表',
					'action' => '/ic-card/index',
					'icon' => 'fa fa-circle-o',
				],
				[
					'name' => 'IC卡数据',
					'action' => '/ic-log/index',
					'icon' => 'fa fa-circle-o'
				]
			]
		]
	],
];
