# majaxInstallerPlugin

This plugin aims to provide a configurable interactive (or automated) installer system for your symfony applications

## Sample assets:

### assets/databases.yml

    all:
      doctrine:
        class: sfDoctrineDatabase
        param:
    #      dsn: 'mysql:host=##HOST##;dbname=##DB_NAME##;'
    #      username: ##USERNAME##
    #      password: ##PASSWORD##
          dsn: 'sqlite:%SF_DATA_DIR%/demo.db'
    test:
      doctrine:
        class: sfDoctrineDatabase
        param:
          dsn: 'sqlite:%SF_DATA_DIR%/testing.db'

### assets/frontend/settings.yml

    # We're just cutting to the good stuff...

    all:
      .settings:
        # Form security secret (CSRF protection)
        csrf_secret:            ##CSRF_TOKEN##

### assets/admin/settings.yml

    # We're just cutting to the good stuff...

    all:
      .settings:
        # Form security secret (CSRF protection)
        csrf_secret:            ##CSRF_TOKEN##


## Sample configuration

### config/installer.yml

    files:
      1:
        source: assets/databases.yml
        destination: config/databases.yml
        tags:
          - { type: string, hash: '##HOST##', prompt: Database Host?, default: localhost, required: true }
          - { type: string, hash: '##DB_NAME##', prompt: Database Name?, default: db_name, required: true }
          - { type: string, hash: '##USERNAME##', prompt: Database Username?, default: db_user, required: true }
          - { type: string, hash: '##PASSWORD##', prompt: Database Password?, default: db_pass, required: true }
      2:
        source: assets/frontend/settings.yml
        destination: apps/frontend/config/settings.yml
        tags:
          - { type: expression, hash: '##CSRF_TOKEN##', default: "md5(time().rand())" }
      3:
        source: assets/admin/settings.yml
        destination: apps/admin/config/settings.yml
        tags:
          - { type: expression, hash: '##CSRF_TOKEN##', default: "md5(time().rand())" }


## Sample results

### Execution

    $ ./symfony majax:install


    /---------------------------------\
    | Processing config/databases.yml |
    \---------------------------------/


    Database Host? (default: localhost)
    Answer:
    Database Name? (default: db_name)
    Answer:
    Database Username? (default: db_user)
    Answer:
    Database Password? (default: db_pass)
    Answer:


    /-------------------------------------------\
    | Processing apps/admin/config/settings.yml |
    \-------------------------------------------/


    Setting ##CSRF_TOKEN## to "fa31eaca2a4d39fb9d4436dc38798d5b" automatically...


    /----------------------------------------------\
    | Processing apps/frontend/config/settings.yml |
    \----------------------------------------------/


    Setting ##CSRF_TOKEN## to "8df44ae049db9afc3ccde779c8f5d8d7" automatically...

### config/databases.yml

    all:
      doctrine:
        class: sfDoctrineDatabase
        param:
    #      dsn: 'mysql:host=localhost;dbname=db_name;'
    #      username: db_user
    #      password: db_pass
          dsn: 'sqlite:%SF_DATA_DIR%/demo.db'
    test:
      doctrine:
        class: sfDoctrineDatabase
        param:
          dsn: 'sqlite:%SF_DATA_DIR%/testing.db'

### apps/admin/config/settings.yml

    # Again only showing the important bits...
    all:
      .settings:
        # Form security secret (CSRF protection)
        csrf_secret:            fa31eaca2a4d39fb9d4436dc38798d5b

### apps/frontend/config/settings.yml

    # Again only showing the important bits...
    all:
      .settings:
        # Form security secret (CSRF protection)
        csrf_secret:            8df44ae049db9afc3ccde779c8f5d8d7
