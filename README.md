# 学習メモ

## 環境構築

インフラ
* apache2のrewriteモジュールを有効化する
  * 有効化しないと404 Not Foundが発生する

アプリケーション
1. composer create-project --keep-vcs neos/flow-base-distribution .
2. ./flow core:setfilepermissions www-data www-data
   * パーミッションの初期設定、おそらく必要な箇所に書き込み権限を与えている
3. ./flow doctrine:migrate
   * データベースの初期化
4. /flow resource:publishでResources/Public/にファイルをコピーする
  * これをしないとCSSやJSが読み込まれない
  * 3のデータベースの初期化ステップを飛ばして4を実行すると以下のようにテーブルがないと言われる
  ```
    root@83607adbc530:/var/www/html# ./flow resource:publish
    Publishing resources of collection "static"
    Publishing resources of collection "persistent"
    An exception occurred while executing 'SELECT n0_.persistence_object_identifier AS persistence_object_identifier_0, n0_.collectionname AS collectionname_1, n0_.filename AS filename_2, n0_.filesize AS filesize_3, n0_.relativepublicationpath AS relativepublicationpath_4, n0_.mediatype AS mediatype_5, n0_.sha1 AS sha1_6 FROM neos_flow_resourcemanagement_persistentresource n0_ WHERE n0_.collectionname = ?' with params ["persistent"]:
    SQLSTATE[42S02]: Base table or view not found: 1146 Table
    'flow.neos_flow_resourcemanagement_persistentresource' doesn't exist
    
    Type: Doctrine\DBAL\Exception\TableNotFoundException
    File: Packages/Libraries/doctrine/dbal/lib/Doctrine/DBAL/Driver/AbstractMySQLDriv
    er.php
    Line: 61
    
    Nested exception:
    SQLSTATE[42S02]: Base table or view not found: 1146 Table 'flow.neos_flow_resourcemanagement_persistentresource' doesn't exist
    
    Type: Doctrine\DBAL\Driver\PDO\Exception
    Code: 42S02
    File: Packages/Libraries/doctrine/dbal/lib/Doctrine/DBAL/Driver/PDO/Exception.php
    Line: 18
    
    Nested exception:
    SQLSTATE[42S02]: Base table or view not found: 1146 Table 'flow.neos_flow_resourcemanagement_persistentresource' doesn't exist
    
    Type: PDOException
    Code: 42S02
    File: Packages/Libraries/doctrine/dbal/lib/Doctrine/DBAL/Driver/PDOStatement.php
    Line: 117
    ```
    
```
Unable to create a proxy for a final class "Neos\Welcome\Domain\Model\Account\Account".
Type: Doctrine\Common\Proxy\Exception\InvalidArgumentException
File:
Packages/Libraries/doctrine/common/src/Proxy/Exception/InvalidArgumentExcep
tion.php
Line: 91

Type: Neos\Flow\Core\Booting\Exception\SubProcessException
Code: 1355480641
File: Packages/Framework/Neos.Flow/Classes/Core/Booting/Scripts.php
Line: 727
```

```
Fatal error: Non-readonly class Neos\Welcome\Domain\Model\Account\Account
cannot extend readonly class
Neos\Welcome\Domain\Model\Account\Account_Original in
/var/www/html/Data/Temporary/Development/Cache/Code/Flow_Object_Classes/Neos_Welcome_Domain_Model_Account_Account.php
on line 39

Type: Neos\Flow\Core\Booting\Exception\SubProcessException
Code: 1355480641
File: Packages/Framework/Neos.Flow/Classes/Core/Booting/Scripts.php
Line: 727
```

```
root@551aaa1e5163:/var/www/html# ./flow flow:cache:flush
No composer manifest file found at "/var/www/html/Packages/Application/Kumagai.Demo/composer.json".

Type: Neos\Flow\Composer\Exception\MissingPackageManifestException
Code: 1349868540
File: Packages/Framework/Neos.Flow/Classes/Composer/ComposerUtility.php
Line: 98
```

```
root@551aaa1e5163:/var/www/html# ./flow package:create Vendor.Demo
No composer manifest file found at "/var/www/html/Packages/Application/Kumagai.Demo/composer.json".
Type: Neos\Flow\Composer\Exception\MissingPackageManifestException
Code: 1349868540
File: Packages/Framework/Neos.Flow/Classes/Composer/ComposerUtility.php
Line: 98
```

