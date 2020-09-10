## Sips Paypage JSON PHP samples
The code samples in this repository help you to connect to Sips paypage JSON (using PHP). This repository contains several use cases.

### Contents
 **1. Folder Common**

This folder contains all the files that are common to all use cases.
- sealCalculationPaypageJson.php : This file contains functions to [calculate the seal](https://documentation.sips.worldline.com/en/WLSIPS.316-UG-Sips-Paypage-JSON.html#Calculating-the-seal-data-element) with the 2 algorithms HMAC-SHA-256 and SHA-256
- redirectionForm.php : This is the form to redirect to Sips Paypage if the payment initialization was successful
- requestError.php : This file displays errors when an error occurred during the initialization of the payment
- paymentResponse.php : This file displays the manual response to the payment request and calculates the seal to compare it with the seal received in the Sips response
- paymentRequest.php : This file contains the different functions used during the payment process

 **2. Other files**

Each file corresponds to a payment type and contains the code that generates the payment request and sends it to Sips server.

### Running the test
- Clone the repository and keep the folder structure as it is in GitHub
- Change the value of the normalReturnUrl field according to your architecture
- Check the uniqueness of the value in the transactionReference field when it is filled out
- In the case of payment by installments, change due dates and the transaction reference list if necessary
- Execute the payment request file on a local web server for the use case you want to test

### Version
This example has been validated on a WAMP server with PHP version 7.3.12 .

### Documentation
The code examples are based on our developer documentation, which provides comprehensive information on how Sips Paypage JSON works. For more information, refer to the [Sips Paypage JSON documentation](https://documentation.sips.worldline.com/en/WLSIPS.316-UG-Sips-Paypage-JSON.html).

### License
This repository is open source and available under the MIT license. For more information, see the [LICENSE](LICENSE) file.
