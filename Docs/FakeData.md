## Testing Data

### Variables
- Original Contributions Amount:
    - Owner.1: 100.000
    - Owner.2: 50.000
    - ConX.3: 20.0000
    - ConX.4: 35.0000
- Remaining Contributions Amount:
    - // Owner.1: (amount - expenses) + profits + costs
    - Owner.1: (100.000 - 100.000 - 0) + (155 + 20 + 10 + 16.25 + 100) + 100 + 100 = 501.25
    - Owner.2: (50.000 - 50.000) + (40 + 50) + (50 + 50) = 190
    - Owner Rem: 691.25
    - ConX.3: (20.000 - 20.000) + (15) + (20) = 35
    - ConX.4: (35.000 - 35.000) + (30 + 48.75) + (50 + 35) = 163.75
    - ConX Rem: 198.75

- Sales
  - Units
    - id:9,type:units,is_debt:false,product:pro-1,cost:0,
      net_price:20,profit:20,cont:owner.1,description:product details.
  - Invoice
    - id:10,type:invoice,is_debt:false,product:pro-1,cost:0,
      net_price:10,profit:10,cont:owner.1,description:product details.
  - Retail
    - id:11,type:retail,is_debt:false,product:pro-3,cost:50,
      net_price:100,profit:50,cont:owner.2,description:product details.
    - id:12,type:retail,is_debt:false,product:pro-5,cost:35,
      net_price:100,profit:65,cont:conx.4,description:product details.
    - id:13,type:retail,is_debt:false,product:pro-2,cost:100,
      net_price:200,profit:100,cont:owner.1,description:product details.
- Incomes
    - Sale 9
        - id:17,type:cost,amount:0,cont:owner->1,sale:9
        - id:18,type:profit,amount:20,cont:owner->1,sale:9 
    - Sale 10
        - id:19,type:cost,amount:0,cont:owner->1,sale:10
        - id:20,type:profit,amount:10,cont:owner->1,sale:10 
    - Sale 11
        - id:21,type:cost,amount:50,cont:owner->2,sale:11
        - id:22,type:profit,amount:50,cont:owner->2,sale:11 
    - Sale 12
        - id:23,type:cost,amount:35,cont:conx->4,sale:12
        - id:24,type:profit,amount:50,cont:conx->4,sale:12 
        - id:25,type:profit,amount:16.25,cont:owner->1,sale:12  
    - Sale 13
        - id:26,type:cost,amount:100,cont:owner->1,sale:13
        - id:27,type:profit,amount:100,cont:owner->1,sale:13

## Fake Data

### Variables
- Original Contributions Amount:
  - Owner.1: 100.000
  - Owner.2: 50.000
  - ConX.3: 20.0000
  - ConX.4: 35.0000
- Remaining Contributions Amount:
  - // Owner.1: (amount - expenses) + profits + costs 
  - Owner.1: (100.000 - 100.000 - 0) + (10 + 10 + 30 + 80 + 15 + 10) + 100 = 255
  - Owner.2: (50.000 - 50.000) + (40) + (50) = 90
  - Owner Rem: 345
  - ConX.3: (20.000 - 20.000) + (15) + (20) = 35
  - ConX.4: (35.000 - 35.000) + (30) + (50) = 80
  - ConX Rem: 115

- Contributors
    - id:1,name:Owner
    - id:2,name:ConX
- Contributions
    - Owner
        - id:1,amount:100k,percent:100%,
        - id:2,amount:50k, percent:100%,
    - Conx
        - id:3,amount:20k,percent:50%,
        - id:4,amount:35k,percent:75%,
- Bills + Containers
    - Default
        - id:1,type:default,amount:0,quantity:10k,serial:1001,seller_id:default,cont:owner
    - Stocktaking
        - id:2,type:stocktaking,amount:100k,quantity:1000,
          serial:1002,seller_id:default,cont:owner->1
    - Goods
        - id:3,type:goods,amount:50k,quantity:1000,
          serial:2432,seller_id:simex,cont:owner->2
        - 
        - id:4,type:goods,amount:20k,quantity:1000,
          serial:6534,seller_id:kensa,cont:conx->3
        - 
        - id:5,type:goods,amount:35k,quantity:1000,
          serial:3213,seller_id:syrox,cont:conx->4
        - 
- Expenses
    - Shopping
        - id:1,type:shopping,amount:0,bill:1,cont:owner.1
        - id:2,type:shopping,amount:100k,bill:2,cont:owner.1
        - id:3,type:shopping,amount:50k,bill:3,cont:owner.2
        - id:4,type:shopping,amount:20k,bill:4,cont:conx.3
        - id:5,type:shopping,amount:35k,bill:5,cont:conx.4
    - Loses
        - id:6,type:loses,amount:50,sale:5,cont:owner.2,description:The Product is not working.
    - Store
        - store
- Products
    - id:1,serial:8681749637980,Other,code:KM-364,
      amount:10k,cost:0,price:0,bill:1,seller|brand:default,cont:owner.1
    - id:2,serial:8681749638307,Product 2,code:KM-375,
      amount:1k,cost:100,price:150,bill:2,seller|brand:default,cont:owner.1
    - id:3,serial:8681749637430,Product 3,code:KM-290,
      amount:1k,cost:50,price:100,bill:3,seller|brand:simex,cont:owner.2
    - id:4,serial:8581004,Product 4,code:pro-4,
      amount:1k,cost:20,price:50,bill:4,seller|brand:kensa,cont:conx.3
    - id:5,serial:8581005,Product 5,code:pro-5,
      amount:1k,cost:35,price:70,bill:5,seller|brand:syrox,cont:conx.4
- Sales
    - Units
        - id:1,type:units,is_debt:false,product:pro-1,
          cost:0,net_price:10,profit:10,cont:owner.1,description:product details.
    - Invoice
        - id:2,type:invoice,is_debt:false,product:pro-1,
          cost:0,net_price:10,profit:10,cont:owner.1,description:the pdf url.
    - Other
        - id:3,type:other,is_debt:false,product:pro-1,
          cost:0,net_price:30,profit:30,cont:owner.1,description:Phone reparing, Salling SIM Card
    - Retail
        - id:4,type:retail,is_debt:false,product:pro-2,
          cost:100,net_price:180,profit:80,cont:owner.1
        - id:5,type:retail,is_debt:false,product:pro-3,
          cost:50,net_price:90,profit:40,cont:owner.2
        - id:6,type:retail,is_debt:false,product:pro-4,
          cost:20,net_price:50,profit:30,cont:conx.3
        - id:7,type:retail,is_debt:false,product:pro-5,
          cost:50,net_price:90,profit:40,cont:conx.4
        - id:8,type:retail,is_debt:false,product:pro-5,
          cost:50,net_price:0,profit:-50,cont:conx.4,description:The Product
          is not working.
    - Wholesale
        - wholesale
- Incomes
    - Sale 1
        - id:1,type:cost,amount:0,cont:owner->1,sale:1
        - id:2,type:profit,amount:10,cont:owner->1,sale:1
    - Sale 2
        - id:3,type:cost,amount:0,cont:owner->1,sale:2
        - id:4,type:profit,amount:10,cont:owner->1,sale:2
    - Sale 3
        - id:5,type:cost,amount:0,cont:owner->1,sale:3
        - id:6,type:profit,amount:30,cont:owner->1,sale:3
    - Sale 4
        - id:7,type:cost,amount:100,cont:owner->1,sale:4
        - id:8,type:profit,amount:80,cont:owner->1,sale:4
    - Sale 5
        - id:9,type:cost,amount:50,cont:owner->2,sale:5
        - id:10,type:profit,amount:40,cont:owner->2,sale:5
    - Sale 6
        - id:11,type:cost,amount:20,cont:conx->3,sale:6
        - id:12,type:profit,amount:15,cont:conx->3,sale:6
        - id:13,type:profit,amount:15,cont:owner->1,sale:6
    - Sale 7
        - id:14,type:cost,amount:50,cont:conx->4,sale:7
        - id:15,type:profit,amount:30,cont:conx->4,sale:7
        - id:16,type:profit,amount:10,cont:owner->1,sale:7
          GNU nano 4.8                                  dev.test.conf                                  Modified  
          <VirtualHost 127.0.1.5:80>
      # The ServerName directive sets the request scheme, hostname and port that
      # the server uses to identify itself. This is used when creating
      # redirection URLs. In the context of virtual hosts, the ServerName
      # specifies what hostname must appear in the request's Host: header to
      # match this virtual host. For the default virtual host (this file) this
      # value is not decisive as it is used as a last resort host regardless.
      # However, you must set it for any further virtual host explicitly.
      #ServerName www.example.com

      ServerAdmin admin@dev.test    
      DocumentRoot /var/www/html/dev.test/public/
      ServerName dev.test    
      ServerAlias www.dev.test

      # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
      # error, crit, alert, emerg.
      # It is also possible to configure the loglevel for particular
      # modules, e.g.
      #LogLevel info ssl:warn

      ErrorLog ${APACHE_LOG_DIR}/error.log
      CustomLog ${APACHE_LOG_DIR}/access.log combined

      <Directory "/var/www/html/dev.test/public">
      DirectoryIndex index.php
      AllowOverride All
      Order allow,deny
      Allow from all

           # The missing one
           Require all granted
        </Directory>

      # For most configuration files from conf-available/, which are
      # enabled or disabled at a global level, it is possible to
      # include a line for only one particular virtual host. For example the
      # following line enables the CGI configuration for this host only
      # after it has been globally disabled with "a2disconf".
      #Include conf-available/serve-cgi-bin.conf
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet

