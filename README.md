Yii2 Contacts
===============

Yii2 Contacts to create, manage, and delete contacts in a Yii2 site.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require cinghie/yii2-contacts "*"
```

or add

```
"cinghie/yii2-contacts": "*"
```

## Configuration

### 1. Update yii2-contacts database schema

Make sure that you have properly configured `db` application component
and run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/cinghie/yii2-contacts/migrations
```

### 2. Set configuration file

Set on your configuration file

```	
'modules' => [ 

    // Yii2 Contacts
    'contacts' => [
        'class' => 'cinghie\contacts\Contacts',
        'roles' => ['admin']
     ],
	
]	
```

### URLS
<ul> 
  <li>Contacts: PathToApp/index.php?r=contacts/contacts/index</li>
  <li>Contacts with Pretty Urls: PathToApp/contacts/contacts/index</li>
</ul>
