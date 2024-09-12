# PaymentController

## Overview

`PaymentController` is a Laravel controller responsible for handling payments via the Paystack payment gateway. It includes methods for initializing payments, handling payment callbacks, and verifying payment statuses.

## Methods

### `pay()`

- **Description:** Returns the view for initiating a payment.
- **URL:** `/pay`
- **Method:** GET
- **View:** `pay.blade.php`

### `make_payment()`

- **Description:** Initializes a payment transaction with Paystack using provided form data. Redirects the user to the Paystack authorization URL.
- **URL:** `/make-payment`
- **Method:** POST
- **Form Data:**
  - `user_id`: User ID
  - `aff_id`: Affiliate ID
  - `product_id`: Product ID
  - `amount`: Amount to be paid (in Naira, multiplied by 100)
  - `email`: Email address of the payer
  - `currency`: Currency code (e.g., "NGN")
  - `callback_url`: URL to redirect after payment

### `initialize_payment($formData)`

- **Description:** Sends a request to Paystack to initialize a payment transaction.
- **Parameters:**
  - `$formData`: An array containing the payment details.
- **Returns:** JSON response from Paystack.

### `payment_callback()`

- **Description:** Handles the callback from Paystack after a payment attempt. Verifies the payment status and returns appropriate responses based on the payment status.
- **URL:** `/payment-callback`
- **Method:** GET
- **Query Parameters:**
  - `reference`: Payment reference from Paystack
- **Response:** Redirects to a callback page or returns an error based on the payment status.

### `verify_payment($reference)`

- **Description:** Sends a request to Paystack to verify the status of a payment transaction using the provided reference.
- **Parameters:**
  - `$reference`: Payment reference from Paystack
- **Returns:** JSON response from Paystack.

## Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/your-repository-url.git
   cd your-repository-folder
   ```

2. **Install Dependencies:**

   ```bash
   composer install
   ```

3. **Setup Environment Variables:**

   Update your `.env` file with your Paystack secret key:

   ```dotenv
   PAYSTACK_SECRET_KEY=your-paystack-secret-key
   ```

4. **Migrate and Seed Database:**

   Run migrations and seed the database if required:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start the Laravel Development Server:**

   ```bash
   php artisan serve
   ```

## Usage

- **Initiate Payment:** Navigate to `/pay` and use the provided form to start a payment.
- **Handle Callback:** Ensure your Paystack callback URL is set to `/payment-callback` to handle payment status updates.

## Troubleshooting

- **Route Not Found:** Ensure your routes are correctly defined in `routes/web.php` or `routes/api.php`.
- **Payment Issues:** Verify your Paystack configuration and check the Paystack documentation for any specific requirements.

## Contributing

Feel free to submit issues or pull requests to improve this project.
