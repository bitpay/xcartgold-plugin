bitpay/xcartgold-plugin
=======================

# Installation

1. Copy these files into your xcart/ directory (e.g. ~/www/xcart/ or ~/www/).  They will not overwrite any existing files.
2. Run modules/Bitpay/install.sql on your Xcart database (e.g. "mysql -u [user] -p [xcartdb] < install.sql OR copy the contents into phpMyAdmin).

# Configuration

1. Create an API key at bitpay.com by clicking My Account > API Access Keys > Add New API Key.
2. In your XCart admin panel, go to Settings > Payment Methods > Payment Gateways.
3. Change Your Country to All Countries, select Bitpay and click Add.
4. Click Payment Methods tab, check the box next to Bitpay and click Apply Changes.
5. In the same Bitpay section click Configure. 
6. Enter your API key from step 1.
7. Select a transaction speed. The high speed will send a confirmation as soon as a transaction is received in the bitcoin network (usually a few seconds). A medium speed setting will typically take 10 minutes. The low speed setting usually takes around 1 hour. See the bitpay.com merchant documentation for a full description of the transaction speed settings: https://bitpay.com/downloads/bitpayApi.pdf
8. Choose the currency that corresponds to your store's currency from the drop-down list.
9. Click Update.

# Usage

When a shopper chooses the Bitcoin payment method, they will be redirected to Bitpay.com where they will pay an invoice.  Bitpay will then notify your Xcart system that the order was paid for.  The customer will be presented with a button to return to your store.  

The order status in the admin panel will be "Processed" if payment has been confirmed. 

Note: This extension does not provide a means of automatically pulling a current BTC exchange rate for presenting BTC prices to shoppers.

# Support

## BitPay Support

* [GitHub Issues](https://github.com/bitpay/xcartgold-plugin/issues)
  * Open an issue if you are having issues with this plugin.
* [Support](https://support.bitpay.com)
  * BitPay merchant support documentation

## [Shopping Cart Name] Support

* [Homepage](http://www.x-cart.com/ecommerce-software.html)
* [Documentation](http://kb.x-cart.com/display/XDD/Definitive+guide)
* [Support Forums](http://forum.x-cart.com)

# Contribute

To contribute to this project, please fork and submit a pull request.

# License

The MIT License (MIT)

Copyright (c) 2011-2014 BitPay

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
