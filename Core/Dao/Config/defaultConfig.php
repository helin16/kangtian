<?php

return array(
				'Database' => array(
						'Driver' => 'mysql',
						'LoadBalancer' => 'localhost',
						'ImportNode' => 'localhost',
						'SecondaryNode' => 'localhost',
						'NASNode' => 'localhost',
						'CoreDatabase' => 'kangtia1_property',
						'Username' => 'root',
						'Password' => ''
					),
				'Profiler' => array(
								'SQL' => false,
								'Resources' => false
							),
				'theme'=> array(
					'name'=>'default'
					),
				'email'=> array(
					'contactUsReciever'=>'Administrator',
					'contactUsRecieverEmail'=>'admin@localhost.com'
					),
				'time'=>array(
						'defaultTimeZone'=>'Australia/Melbourne'
					)
			);

?>