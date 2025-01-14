# iPay88 Omnipay Driver

**Important:** This implementation is based on the **iPay88 Online Payment Switching Gateway (OPSG) Technical Specification, Version 1.6.4.4**. Ensure compatibility with your integration requirements and verify if this version aligns with the gateway setup provided by iPay88.

An Omnipay driver for integrating with the iPay88 payment gateway, supporting features such as `purchase`, `completePurchase`, and `requery`.

## Available Methods

### `purchase`

   Redirects the user to the iPay88 payment page for completing a transaction.

   **Required Data**

   | Parameter       | Type      | Description                                  |
   |-----------------|-----------|----------------------------------------------|
   | `transactionId` | `string`  | Unique transaction/order ID                  |
   | `amount`        | `integer` | Payment amount in cents (e.g., 100 = RM1.00) |
   | `description`   | `string`  | Description of the product or service        |
   | `userName`      | `string`  | Payer's full name                            |
   | `userEmail`     | `string`  | Payer's email address                        |
   | `userContact`   | `string`  | Payer's contact number                       |
   | `returnUrl`     | `string`  | URL to redirect the user after payment       |
   | `notifyUrl`     | `string`  | URL for iPay88 to notify transaction status  |

   #### Example

   ```php
    $gateway = Omnipay::create('Ipay88');
    $gateway->setMerchantCode('your-merchant-code');
    $gateway->setMerchantKey('your-merchant-key');

    $response = $gateway->purchase([
       'transactionId' => 'ABC-12345',
       'amount'        => 100,
       'description'   => 'Test Product',
       'userName'      => 'John Doe',
       'userEmail'     => 'john@example.com',
       'userContact'   => '0123456789',
       'returnUrl'     => 'https://your-app.com/returnUrl',
       'notifyUrl'     => 'https://your-app.com/notifyUrl',
    ])->send();

    if ($response->isRedirect()) {
        $response->redirect(); // Redirect to iPay88 payment page
    }
   ```

   #### Response Methods
    - `isRedirect()`: Indicates if the response contains a redirection URL (iPay88 payment page).
    - `redirect()`: Redirect to iPay88 payment page.
    - `getRedirectResponse()`: Returns a POST form to redirect the user to iPay88.

### `completePurchase`

   Verifies the transaction status by handling the response from iPay88 after the user completes payment.

   #### Example

   ```php
    $gateway = Omnipay::create('Ipay88');
    $gateway->setMerchantCode('your-merchant-code');
    $gateway->setMerchantKey('your-merchant-key');
   
    $response = $gateway->completePurchase()->send();
    
    if ($response->isSuccessful()) {
        echo 'Transaction successful';
    } else {
        echo 'Transaction failed';
    }
   ```

   #### Response Methods
    - `isSuccessful()`: Indicates if the transaction was successfully verified.
    - `getTransactionId()`: Returns the merchant transaction/order ID
    - `getTransactionReference()`: Returns the iPay88 transaction reference number.

### `requery`

   Checks the status of a transaction and returns the transaction status.

   **Required Data**

   | Parameter       | Type      | Description                 |
   |-----------------|-----------|-----------------------------|
   | `transactionId` | `string`  | Unique transaction/order ID |
   | `amount`        | `integer` | Payment amount in cent      |

   #### Example

   ```php
    $gateway = Omnipay::create('Ipay88');
    $gateway->setMerchantCode('your-merchant-code');
    $gateway->setMerchantKey('your-merchant-key');
   
    $response = $gateway->requery([
        'transactionId' => 'ABC-12345',
        'amount'        => 100,
    ])->send();
   
    if ($response->isSuccessful()) {
        echo 'Transaction successful: ' . $response->getMessage();
    } else {
        echo 'Transaction failed: ' . $response->getMessage();
    }
   ```

   #### Response Methods
    - `isSuccessful()`: Indicates if the transaction was successful (`00`).
    - `getMessage()`: Returns a human-readable message about the transaction status.
    - `getCode()`: Returns the raw response code (e.g., `00`, `Record not found`, etc.).

## License

This package is open-source software licensed under the MIT License.