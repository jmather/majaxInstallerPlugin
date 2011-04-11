# majaxInstallerPlugin

This plugin aims to provide a configurable interactive (or automated) installer system for your symfony applications

## Sample asset:

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
