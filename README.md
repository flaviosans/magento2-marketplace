Work in progress. Please do not install it atm.

# magento2-marketplace

#### Installation process
###### Install Extension
```
composer config repositories.magento2-marketplace git git@github.com:flaviosans/magento2-marketplace.git
composer require flaviosans/magento2-marketplace:dev-main
php bin/magento setup:upgrade
```
###### Save existing customers to assign new custom attributes
```
php bin/magento save:customers
```

#### Features
```
Allow customers to register as a vendor
Vendor account approval by Admin
```
