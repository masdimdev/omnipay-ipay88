# iPay88 Omnipay Driver

**Important:** This implementation is based on the **iPay88 Online Payment Switching Gateway (OPSG) Technical Specification, Version 1.6.4.4**. Ensure compatibility with your integration requirements and verify if this version aligns with the gateway setup provided by iPay88.

An Omnipay driver for integrating with the iPay88 payment gateway, supporting features such as `purchase`, `completePurchase`, and `requeryPayment`.

## Getting Started

Install via Composer:

```bash
composer require masdimdev/omnipay-ipay88
```

Set up the gateway:

```php
$gateway = Omnipay::create('Ipay88');
$gateway->setMerchantCode('your-merchant-code');
$gateway->setMerchantKey('your-merchant-key');
```

## Available Methods

### `purchase`

Redirects the user to the iPay88 payment page for completing a transaction.

**Required Data**

| Parameter         | Type        | Description                                  |
| ----------------- | ----------- | -------------------------------------------- |
| `transactionId` | `string`  | Unique transaction/order ID                  |
| `amount`        | `integer` | Payment amount in cents (e.g., 100 = RM1.00) |
| `description`   | `string`  | Description of the product or service        |
| `userName`      | `string`  | Payer's full name                            |
| `userEmail`     | `string`  | Payer's email address                        |
| `userContact`   | `string`  | Payer's contact number                       |
| `returnUrl`     | `string`  | URL to redirect the user after payment       |
| `notifyUrl`     | `string`  | URL for iPay88 to notify transaction status  |

**Optional Data**

| Parameter     | Type        | Description                                                                        |
| ------------- | ----------- |------------------------------------------------------------------------------------|
| `paymentId` | `integer` | Payment ID. See [getPaymentIds()](#getPaymentIds) method for available payment IDs |
| `remark`    | `string`  | Remark                                                                             |

#### Example

```php
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
- `getRedirectUrl()`: Gets the redirect destination url.
- `getRedirectMethod()`: Get the required redirect method (either GET or POST).
- `getRedirectData()`: Gets the redirect form data array, if the redirect method is POST.
- `getRedirectResponse()`: Returns a POST form to redirect the user to iPay88.

### `completePurchase`

Verifies the transaction status by handling the response from iPay88 after the user completes payment.

#### Example

```php
$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
    echo 'Transaction successful';
} else {
    echo 'Transaction failed';
}
```

#### Response Methods

- `isSuccessful()`: Indicates if the transaction was successfully verified.
- `isSignatureValid()`: Indicates if the response signature was valid.
- `getTransactionId()`: Returns the merchant transaction/order ID.
- `getTransactionReference()`: Returns the iPay88 transaction reference number.
- `getData()`: Returns the iPay88 transaction response.
- `getFullData()`: Returns mapped iPay88 transaction response.

### `requery`

Checks the status of a transaction and returns the transaction status.

**Required Data**

| Parameter         | Type        | Description                 |
| ----------------- | ----------- |-----------------------------|
| `transactionId` | `string`  | Unique transaction/order ID |
| `amount`        | `integer` | Payment amount in cents     |

#### Example

```php
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

### `requeryPayment`

Retrieves detailed information about specific transactions.

**Required Data**

| Parameter         | Type        | Description                 |
| ----------------- | ----------- |-----------------------------|
| `transactionId` | `string`  | Unique transaction/order ID |
| `amount`        | `integer` | Payment amount in cents     |

#### Example

```php
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

- `isSuccessful()`: Indicates if the transaction was successfully verified.
- `getTransactionId()`: Returns the merchant transaction/order ID
- `getTransactionReference()`: Returns the iPay88 transaction reference number.
- `getData()`: Returns the iPay88 transaction response.
- `getFullData()`: Returns mapped iPay88 transaction response.

### `getPaymentIds`

Get list of available payment method/payment ID.

#### Example

```php
$gateway->getPaymentIds();
print_r($paymentMethods);
```

**Note:** Some payment methods may not be available for your merchant, please contact iPay88 for more information.

## License

This package is open-source software licensed under the MIT License.
