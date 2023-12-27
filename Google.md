# Creating Google API Tokens for Integration

 Follow the steps below to create Google API tokens for integration.

## Prerequisites

Before you begin, make sure you have the following:

- A Google account
- Access to the [Google Cloud Console](https://console.cloud.google.com/)

## Steps

1. **Open the Google Cloud Console:**
   - Navigate to [https://console.cloud.google.com/](https://console.cloud.google.com/) and log in with your Google account.

2. **Create a new project:**
   - In the Cloud Console, click on the project drop-down menu.
   - Click on the "New Project" button.
   - Enter a name for your project and click "Create."

3. **Enable APIs for your project:**
   - In the Cloud Console, navigate to the "APIs & Services" > "Library" section.
   - Search for the API you want to use and click on it.
   - Click the "Enable" button to enable the API for your project.

4. **Create API credentials:**
   - In the Cloud Console, navigate to the "APIs & Services" > "Credentials" section.
   - Click on the "Create Credentials" button and select the appropriate credential type (API Key, OAuth client ID, etc.).
   - Create OAuth2.0 credential
   - Configure the screen if is nessecary
   - Configure the Service account this is nessecary for sharing Google Sheet file for getting the data


5. **Download or Copy your credentials:**
   - After creating credentials, download or copy the generated credentials, as they will be needed for authentication in your application.You can download them in JSON format

6. **Integrate API key or credentials into your application:**
   - Integrate the API key or credentials into your application. This might involve setting environment variables, configuration files, or making direct API calls using the credentials.


7. **Monitor and secure your credentials:**
   - Regularly monitor the usage of your API tokens in the Google Cloud Console. If compromised or misused, regenerate the credentials to maintain the security of your application.