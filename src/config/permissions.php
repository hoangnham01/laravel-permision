<?php
 return array(
     /*
      'group-name'    => [
         'action' => [
             'router name',
         ]
      ],
      * */

     'members'    => [
         'create' => [
             'members.create',
             'members.store',
             'api.app.members-create'
         ],
         'edit'   => [
             'members.edit',
             'members.update',
             'api.app.members-edit'
         ]
     ],
 );