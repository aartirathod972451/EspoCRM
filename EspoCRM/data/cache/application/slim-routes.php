<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/EspoCRM-9.2.7/api/v1/Activities/upcoming' => 'route3',
      '/EspoCRM-9.2.7/api/v1/Activities' => 'route4',
      '/EspoCRM-9.2.7/api/v1/Timeline' => 'route5',
      '/EspoCRM-9.2.7/api/v1/Timeline/busyRanges' => 'route6',
      '/EspoCRM-9.2.7/api/v1/' => 'route15',
      '/EspoCRM-9.2.7/api/v1/App/user' => 'route16',
      '/EspoCRM-9.2.7/api/v1/App/about' => 'route18',
      '/EspoCRM-9.2.7/api/v1/Metadata' => 'route19',
      '/EspoCRM-9.2.7/api/v1/I18n' => 'route20',
      '/EspoCRM-9.2.7/api/v1/Settings' => 'route21',
      '/EspoCRM-9.2.7/api/v1/Stream' => 'route24',
      '/EspoCRM-9.2.7/api/v1/GlobalStream' => 'route25',
      '/EspoCRM-9.2.7/api/v1/GlobalSearch' => 'route26',
      '/EspoCRM-9.2.7/api/v1/Admin/jobs' => 'route38',
      '/EspoCRM-9.2.7/api/v1/CurrencyRate' => 'route44',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/notReadCounts' => 'route80',
      '/EspoCRM-9.2.7/api/v1/Email/insertFieldData' => 'route81',
      '/EspoCRM-9.2.7/api/v1/EmailAddress/search' => 'route83',
      '/EspoCRM-9.2.7/api/v1/Oidc/authorizationData' => 'route93',
    ),
    'POST' => 
    array (
      '/EspoCRM-9.2.7/api/v1/App/destroyAuthToken' => 'route17',
      '/EspoCRM-9.2.7/api/v1/Admin/rebuild' => 'route36',
      '/EspoCRM-9.2.7/api/v1/Admin/clearCache' => 'route37',
      '/EspoCRM-9.2.7/api/v1/Action' => 'route46',
      '/EspoCRM-9.2.7/api/v1/MassAction' => 'route47',
      '/EspoCRM-9.2.7/api/v1/Export' => 'route50',
      '/EspoCRM-9.2.7/api/v1/Import' => 'route53',
      '/EspoCRM-9.2.7/api/v1/Import/file' => 'route54',
      '/EspoCRM-9.2.7/api/v1/Attachment/fromImageUrl' => 'route63',
      '/EspoCRM-9.2.7/api/v1/Email/importEml' => 'route71',
      '/EspoCRM-9.2.7/api/v1/Email/sendTest' => 'route72',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/read' => 'route73',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/important' => 'route75',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/inTrash' => 'route77',
      '/EspoCRM-9.2.7/api/v1/UserSecurity/apiKey/generate' => 'route86',
      '/EspoCRM-9.2.7/api/v1/UserSecurity/password/recovery' => 'route88',
      '/EspoCRM-9.2.7/api/v1/UserSecurity/password/generate' => 'route89',
      '/EspoCRM-9.2.7/api/v1/User/passwordChangeRequest' => 'route90',
      '/EspoCRM-9.2.7/api/v1/User/changePasswordByRequest' => 'route91',
      '/EspoCRM-9.2.7/api/v1/Oidc/backchannelLogout' => 'route94',
    ),
    'PATCH' => 
    array (
      '/EspoCRM-9.2.7/api/v1/Settings' => 'route22',
    ),
    'PUT' => 
    array (
      '/EspoCRM-9.2.7/api/v1/Settings' => 'route23',
      '/EspoCRM-9.2.7/api/v1/CurrencyRate' => 'route45',
      '/EspoCRM-9.2.7/api/v1/Kanban/order' => 'route59',
      '/EspoCRM-9.2.7/api/v1/UserSecurity/password' => 'route87',
    ),
    'DELETE' => 
    array (
      '/EspoCRM-9.2.7/api/v1/Email/inbox/read' => 'route74',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/important' => 'route76',
      '/EspoCRM-9.2.7/api/v1/Email/inbox/inTrash' => 'route78',
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Activities/([^/]+)/([^/]+)/composeEmailAddressList|/EspoCRM\\-9\\.2\\.7/api/v1/Activities/([^/]+)/([^/]+)/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/Activities/([^/]+)/([^/]+)/([^/]+)/list/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/Meeting/([^/]+)/attendees()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Call/([^/]+)/attendees()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/TargetList/([^/]+)/optedOut()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/action/([^/]+)()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/layout/([^/]+)()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Admin/fieldManager/([^/]+)/([^/]+)()()()()()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route0',
            1 => 
            array (
              'parentType' => 'parentType',
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route1',
            1 => 
            array (
              'parentType' => 'parentType',
              'id' => 'id',
              'type' => 'type',
            ),
          ),
          5 => 
          array (
            0 => 'route2',
            1 => 
            array (
              'parentType' => 'parentType',
              'id' => 'id',
              'type' => 'type',
              'targetType' => 'targetType',
            ),
          ),
          6 => 
          array (
            0 => 'route7',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route8',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route10',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route32',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          10 => 
          array (
            0 => 'route33',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
            ),
          ),
          11 => 
          array (
            0 => 'route39',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/MassAction/([^/]+)/status|/EspoCRM\\-9\\.2\\.7/api/v1/Export/([^/]+)/status()|/EspoCRM\\-9\\.2\\.7/api/v1/Kanban/([^/]+)()()|/EspoCRM\\-9\\.2\\.7/api/v1/Attachment/file/([^/]+)()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Note/([^/]+)/reactors/([^/]+)()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Notification/([^/]+)/group()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/User/([^/]+)/stream/own()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/User/([^/]+)/acl()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route48',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route51',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route60',
            1 => 
            array (
              'entityType' => 'entityType',
            ),
          ),
          5 => 
          array (
            0 => 'route61',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route67',
            1 => 
            array (
              'id' => 'id',
              'type' => 'type',
            ),
          ),
          7 => 
          array (
            0 => 'route68',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route84',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route85',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route97',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/followers|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/stream()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/posts()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/updateStream()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/streamAttachments()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/usersAccess()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/([^/]+)()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route98',
            1 => 
            array (
              'controller' => 'controller',
            ),
          ),
          3 => 
          array (
            0 => 'route103',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route106',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route107',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route108',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route111',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route116',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route117',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
    'POST' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Campaign/([^/]+)/generateMailMerge|/EspoCRM\\-9\\.2\\.7/api/v1/Campaign/unsubscribe/([^/]+)()|/EspoCRM\\-9\\.2\\.7/api/v1/Campaign/unsubscribe/([^/]+)/([^/]+)()|/EspoCRM\\-9\\.2\\.7/api/v1/LeadCapture/form/([^/]+)()()()|/EspoCRM\\-9\\.2\\.7/api/v1/LeadCapture/([^/]+)()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/action/([^/]+)()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Admin/fieldManager/([^/]+)()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/MassAction/([^/]+)/subscribe()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Export/([^/]+)/subscribe()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route9',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route11',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route13',
            1 => 
            array (
              'emailAddress' => 'emailAddress',
              'hash' => 'hash',
            ),
          ),
          5 => 
          array (
            0 => 'route27',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route28',
            1 => 
            array (
              'apiKey' => 'apiKey',
            ),
          ),
          7 => 
          array (
            0 => 'route30',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          8 => 
          array (
            0 => 'route40',
            1 => 
            array (
              'scope' => 'scope',
            ),
          ),
          9 => 
          array (
            0 => 'route49',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route52',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Import/([^/]+)/revert|/EspoCRM\\-9\\.2\\.7/api/v1/Import/([^/]+)/removeDuplicates()|/EspoCRM\\-9\\.2\\.7/api/v1/Import/([^/]+)/unmarkDuplicates()()|/EspoCRM\\-9\\.2\\.7/api/v1/Import/([^/]+)/exportErrors()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Attachment/chunk/([^/]+)()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Attachment/copy/([^/]+)()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Note/([^/]+)/myReactions/([^/]+)()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/EmailTemplate/([^/]+)/prepare()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Email/([^/]+)/attachments/copy()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route55',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route56',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route57',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route58',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route62',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route64',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route65',
            1 => 
            array (
              'id' => 'id',
              'type' => 'type',
            ),
          ),
          9 => 
          array (
            0 => 'route69',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route70',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Email/inbox/folders/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/Email/([^/]+)/users()|/EspoCRM\\-9\\.2\\.7/api/v1/OAuth/([^/]+)/connection()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/followers()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/pin()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/([^/]+)()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route79',
            1 => 
            array (
              'folderId' => 'folderId',
            ),
          ),
          3 => 
          array (
            0 => 'route82',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route95',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route99',
            1 => 
            array (
              'controller' => 'controller',
            ),
          ),
          6 => 
          array (
            0 => 'route104',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route112',
            1 => 
            array (
              'Note' => 'Note',
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route118',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Campaign/unsubscribe/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/Campaign/unsubscribe/([^/]+)/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/Admin/fieldManager/([^/]+)/([^/]+)()|/EspoCRM\\-9\\.2\\.7/api/v1/Note/([^/]+)/myReactions/([^/]+)()()|/EspoCRM\\-9\\.2\\.7/api/v1/OAuth/([^/]+)/connection()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/followers()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/subscription()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/pin()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/starSubscription()()()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/([^/]+)()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route12',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route14',
            1 => 
            array (
              'emailAddress' => 'emailAddress',
              'hash' => 'hash',
            ),
          ),
          4 => 
          array (
            0 => 'route43',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          5 => 
          array (
            0 => 'route66',
            1 => 
            array (
              'id' => 'id',
              'type' => 'type',
            ),
          ),
          6 => 
          array (
            0 => 'route96',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route102',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route105',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route110',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route113',
            1 => 
            array (
              'Note' => 'Note',
              'id' => 'id',
            ),
          ),
          11 => 
          array (
            0 => 'route115',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
          12 => 
          array (
            0 => 'route119',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
    'OPTIONS' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/LeadCapture/([^/]+))$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route29',
            1 => 
            array (
              'apiKey' => 'apiKey',
            ),
          ),
        ),
      ),
    ),
    'PUT' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/action/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/layout/([^/]+)()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/layout/([^/]+)/([^/]+)()|/EspoCRM\\-9\\.2\\.7/api/v1/Admin/fieldManager/([^/]+)/([^/]+)()()()|/EspoCRM\\-9\\.2\\.7/api/v1/Team/([^/]+)/userPosition()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/subscription()()()()()()|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)/starSubscription()()()()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route31',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          4 => 
          array (
            0 => 'route34',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
            ),
          ),
          5 => 
          array (
            0 => 'route35',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
              'setId' => 'setId',
            ),
          ),
          6 => 
          array (
            0 => 'route41',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          7 => 
          array (
            0 => 'route92',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route100',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route109',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route114',
            1 => 
            array (
              'entityType' => 'entityType',
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
    'PATCH' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/EspoCRM\\-9\\.2\\.7/api/v1/Admin/fieldManager/([^/]+)/([^/]+)|/EspoCRM\\-9\\.2\\.7/api/v1/([^/]+)/([^/]+)())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route42',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          4 => 
          array (
            0 => 'route101',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
  ),
);