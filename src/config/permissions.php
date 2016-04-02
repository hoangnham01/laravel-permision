<?php
return array(
    'config' => array(
        'model' => App\IZee\Groups\Group::class,
        'users' => [
            'model' => Auth::class,
            'method' => 'user'
        ]
    ),
    'groups' => array(
        /*
    'group-name'    => [
       'action' => [
           'router name',
       ]
    ],
    * */
        'users' => [
            'view' => [
                'backend.users.index',
                'backend.users.show'
            ],
            'create' => [
                'backend.users.create',
                'backend.users.store',
            ],
            'edit'   => [
                'backend.users.edit',
                'backend.users.update',
            ],
        ],
        'groups' => [
            'view' => [
                'backend.groups.index',
                'backend.groups.show'
            ],
            'create' => [
                'backend.groups.create',
                'backend.groups.store',
            ],
            'edit'   => [
                'backend.groups.edit',
                'backend.groups.update',
            ],
            'delete'   => [
                'backend.groups.destroy',
            ],
        ],
    ),
);