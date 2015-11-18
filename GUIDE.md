# Using the BitPay plugin for X-Cart Gold

## Prerequisites

* Last Version Tested: X-Cart Gold 4.6.4

You must have a BitPay merchant account to use this plugin.  It's free to [sign-up for a BitPay merchant account](https://bitpay.com/start).


## Installation

1. Copy these files into your xcart/ directory (e.g. ~/www/xcart/ or ~/www/).  They will not overwrite any existing files.
2. Run modules/Bitpay/install.sql on your Xcart database (e.g. "mysql -u [user] -p [xcartdb] < install.sql **OR** copy the contents into a tool like phpMyAdmin).

## Configuration

1. Create an API key at bitpay.com by clicking My Account > API Access Keys > Add New API Key.
2. In your XCart admin panel, go to Settings > Payment Methods > Payment Gateways.
3. Change Your Country to All Countries, select Bitpay and click Add.
4. Click Payment Methods tab, check the box next to Bitpay and click Apply Changes.
5. In the same Bitpay section click Configure. 
6. Enter your API key from step 1.
7. Select a transaction speed. The high speed will send a confirmation as soon as a transaction is received in the bitcoin network (usually a few seconds). A medium speed setting will typically take 10 minutes. The low speed setting usually takes around 1 hour. See the bitpay.com merchant documentation for a full description of the transaction speed settings: https://bitpay.com/downloads/bitpayApi.pdf
8. Choose the currency that corresponds to your store's currency from the drop-down list.
9. Click Update.

**Using testnet:**

If you want to use the bitpay plugin with a testnet account, you will need to modify the file `/modules/Bitpay/bp_lib.php`, changing all instances of `https://bitpay.com` to `https://test.bitpay.com`. When configuring the plugin in step 1, get the API key from your `test.bitpay.com`.

## Usage

When a shopper chooses the Bitcoin payment method, they will be redirected to Bitpay.com where they will pay an invoice.  Bitpay will then notify your Xcart system that the order was paid for.  The customer will be presented with a button to return to your store.  

The order status in the admin panel will be "Processed" if payment has been confirmed. 

**Note:** This extension does not provide a means of automatically pulling a current BTC exchange rate for presenting BTC prices to shoppers.

