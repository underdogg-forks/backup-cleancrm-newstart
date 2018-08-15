<?php

return [
    'role_structure' => [
        'owner' => [
            'users' => 'c,p,r,u,d',
            'acl' => 'c,p,r,u,d',
            'email' => 'c,p,r,u,d',
            'calendar' => 'c,p,r,u,d',
            'projects' => 'c,p,r,u,d',
            'hrm' => 'c,p,r,u,d',
            'crm' => 'c,p,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,p,r,u,d',
            'acl' => 'c,p,r,u,d',
            'email' => 'c,p,r,u,d',
            'calendar' => 'c,p,r,u,d',
            'projects' => 'c,p,r,u,d',
            'hrm' => 'c,p,r,u,d',
            'crm' => 'c,p,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'acl' => 'c,p,r,u',
            'email' => 'c,p,r,u',
            'calendar' => 'c,p,r,u',
            'projects' => 'c,p,r,u',
            'hrm' => 'c,p,r,u',
            'crm' => 'c,p,r,u',
            'profile' => 'r,u'
        ],
        'teamleader' => [
            'acl' => 'c,p,r,u',
            'email' => 'c,p,r,u',
            'calendar' => 'c,p,r,u',
            'projects' => 'c,p,r,u',
            'hrm' => 'c,p,r,u',
            'crm' => 'c,p,r,u',
            'profile' => 'r,u'
        ],
        'contributor' => [
            'acl' => 'r,u',
            'email' => 'c,p,r,u',
            'calendar' => 'c,p,r,u',
            'projects' => 'c,p,r,u',
            'hrm' => 'r',
            'crm' => 'c,p,r,u',
            'profile' => 'r,u'
        ],
        'staff' => [
            'acl' => 'r,u',
            'email' => 'c,p,r,u',
            'calendar' => 'c,p,r,u',
            'projects' => 'c,p,r,u',
            'hrm' => 'r',
            'crm' => 'r,u',
            'profile' => 'r,u'
        ],
        'subscriber' => [
            'acl' => 'r',
            'email' => 'r',
            'calendar' => 'r',
            'projects' => 'r',
            'hrm' => 'r',
            'crm' => 'r',
            'profile' => 'r'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'p' => 'copy',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
