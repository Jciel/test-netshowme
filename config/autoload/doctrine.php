<?php

return [
        'doctrine' => [
            'default' => 'odm_default',
            'connection' => [
                'odm_default' => [
                    'server' => 'localhost',
                    'port' => '27017',
                    'user' => '',
                    'password' => '',
                    'dbname' => 'test-netshowme',
                    'options' => []
                ],
            ],
            'driver' => [
                'odm_default' => [
                    \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::class => [
                        'documents_dir' => ['./src/App/src/Document']
                    ],
                    \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class => [
                        'Driver\Annotation' => \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::class,
                    ],
                ],
            ],
            'configuration' => [
                'odm_default' => [
//                    'metadata_cache' => \Doctrine\Common\Cache\ArrayCache::class, // optional
                    'driver' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                    'generate_proxies' => true,
                    'proxy_dir' => 'data/DoctrineMongoODMModule/Proxy',
                    'proxy_namespace' => 'DoctrineMongoODMModule\Proxy',
                    'generate_hydrators' => true,
                    'hydrator_dir' => 'data/DoctrineMongoODMModule/Hydrator',
                    'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',
                    'default_db' => 'test-netshowme',
//                    'filters' => [], // custom filters (optional)
//                    'types' => [], // custom types (optional)
//                    'retry_connect' => 0, // optional
//                    'retry_query' => 0, // optional
//                    'logger' => MyLogger::calss, // Logger implementation(optional)
//                    'classMetadataFactoryName' => 'stdClass' // optional
                ]
            ],
            'documentmanager' => [
                'odm_default' => [
                    'connection' => \Doctrine\MongoDB\Connection::class,
                    'configuration' => \Doctrine\MongoDB\Configuration::class,
//                    'configuration' => \Doctrine\ODM\MongoDB\Configuration::class,
                    'eventmanager' => \Doctrine\Common\EventManager::class,
                ]
            ],
            'eventmanager' => [
                'odm_default' => [
                    'subscribers' => [
//                        \MySubscriberImpl1::class,
                    ],
                ],
                'odm_secondary' => [
                    'subscribers' => [
//                        new \MySubscriberImpl2(),
                    ],
                ],
            ],
        ],
];
