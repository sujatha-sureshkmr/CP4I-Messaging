# IBM Cloud Pak for Integration - Configuration

[**4.1. High Level Architecture**](#_Toc105518919)

[**4.2. Prepare Client Tools**](#_Toc105518920)
  - [4.2.1 IBM App Connect Enterprise (ACE) Toolkit](#_Toc105518921)
  - [4.2.2 OC Client](#_Toc105518922)
  - [4.2.3 Mailtrap SMTP Setup](#_Toc105518923)

[**4.3. Messaging Queue (MQ)**](#_Toc105518924)

- [**4.3.1 Create Queue Manager**](#_Toc105518925)
- [**4.3.2 Create Queue**](#_Toc105518926)
- [**4.3.3 Configure Default Channel Security**](#_Toc105518927)

[**4.4. Integration - ACE to MQ**](#_Toc105518929)
- [**4.4.1 Prepare - Asset into IBM ACE Toolkit**](#_Toc105518930)
- [**4.4.2 Build - BAR File**](#_Toc105518931)

[**4.5. Integration Dashboard - Deploy a local integration server**](#_Toc105518928)

[**4.6. API Connect (APIC)**](#_Toc105518933)

- [**4.6.1 Cloud Manager (API Management Administration)**](#_Toc105518934)
  - [Create Organization](#create-organization)
  - [Configure SMTP for notifications](#configure-smtp-for-notifications)
  - [Configure admin email id](#configure-admin-email-id)
- [**4.6.2 API Manager (API Management)**](#_Toc105518938)
  - [Develop API](#develop-api)
  - [Configure API](#configure-api)
  - [Develop Product](#develop-product)
  - [Create Catalog](#create-catalog)
  - [Publish Product](#publish-product)
  - [API Connect Developer Portal](#api-connect-developer-portal)

### ------------------------------------------------------------------ ###

<span id="_Toc105518919" class="anchor"></span>

# High Level Architecture

Below is the high level architecture that we plan to implement as part
of this scenario.

<img src="./media/image1.png" />

<span id="_Toc105518920" class="anchor"></span>

# Prepare Client Tools

Make sure that you setup/prepare the below pre-req before proceeding.

<span id="_Toc105518921" class="anchor"></span>

### IBM App Connect Enterprise (ACE) Toolkit Setup
Refer to the instruction [here](../Configuration/Install-Client-Tools.md#ibm-app-connect-enterprise-ace-toolkit-setup)

<span id="_Toc105518922" class="anchor"></span>

### Openshift Command Line Interface (CLI) Setup
Refer to the instruction [here](../Configuration/Install-Client-Tools.md#openshift-command-line-interface-cli-setup)

<span id="_Toc105518923" class="anchor"></span>

### Mailtrap SMTP Setup
Refer to the instruction [here](../Configuration/Install-Client-Tools.md#mailtrap-smtp-setup)

<span id="_Toc105518924" class="anchor"></span>

# Messaging Queue (MQ)

<span id="_Toc105518925" class="anchor"></span>

## Check & Create Queue Manager

Go to IBM Cloud Pak home. Check the IBM Cloud PAK URL from Openshift Route cp4d or as per given by the instructor.

<img src="./media/image9.png" style="width:8in"  />

Login to IBM Cloud Pak using the IBM provided credentials (admin only).

<img src="./media/image10.png" style="width:8in" />

Use IBM provided Authentication (admin only) and log in with admin and its password.

<img src="./media/image11.png" style="width:8in"  />

Go to IBM Cloud Pak Home. You can verify the currently added/configure instances from Menu -> Integration Instances.

<img src="./media/image12.png" style="width:8in"/>

The below instances should already be pre-created for you.

<img src="./media/image12.1.png" style="width:8in" />

Click on **Messaging** as highlighted in the screen below. (Menu -> Run -> Messaging)

<img src="./media/image12.png" style="width:8in" />

This will redirect to a Messaging screen as below. If there MQ Console does not appear,Click on Create an instance to create a new queue manager instance. If MQ Queue Manager appear, then you can skip creating queue manager.

<img src="./media/image13.png" style="width:8in" />

Alternatively Queue Manager can be created from Menu -> Administration -> Integration Instances -> Create An Instance+. Select Messaging Option and proceed as below.

Select **Quick start** option from this screen, and click on Next.

<img src="./media/image14.png" style="width:8in" />

Modify the details for your queue manager as below:

-   **License acceptance** – Toggle the button from OFF to ON state 

<img src="./media/image15.png" style="width:8in" />

-   Select **Type of availability** from dropdown as SingleInstance

<img src="./media/image16.png" style="width:8in" />

-   Select **Type of Volume** from the drop down as persistent-claim 

<img src="./media/image17.png" style="width:8in"  />

Lastly click on **Create** from the top right corner and queue manager
will be created. You will be redirected to a new page, showing the
details of your newly created Queue manager. 

The Queue Manager Name is always QUICKSTART unless the name was changed from the advanced properties in the final Creation Screen. Need to toggle the Advanced option to see the advance details.

<img src="./media/image18.png" style="width:8in" />

Click on queue manager name --\> It should open up MQ Console

<img src="./media/image19.png" style="width:8in" />

Click on manage --\> quickstart to open queue manager

<img src="./media/image20.png" style="width:8in" />

<span id="_Toc105518926" class="anchor"></span>

## Create Queue

Click on Create icon to create the queue.

<img src="./media/image21.png" style="width:8in"  />

Select a Local Queue.

<img src="./media/image22.png" style="width:8in" />

Provide the details of the queue and click **create**.

<img src="./media/image23.png" style="width:8in" />

Queue will be created shortly.

<img src="./media/image24.png" style="width:8in"  />

<span id="_Toc105518927" class="anchor"></span>

## Configure Default Channel Security**

There are different layers of authorization and authentication configured on the Channel access. To simplify the exercise, we will proceed to disable to Channel security authentication and authorization using the script [mq_ace_lab.mqsc](../mq_ace_lab.mqsc) . Below steps will assist to disable. 

Copy Login Commands to login to oc client.

<img src="./media/image25.png" style="width:8in"  />

Login to Openshift cluster using oc client.

<img src="./media/image26.png" style="width:8in" />

<u> <i> oc login --token=sha256\~xxxxxx-xxxxxx-g --server=https://servername:30273 </i> </u>

run below command to see all your projects.

<u> <i> oc projects </i> </u>

Run below command to switch to your project.

<u> <i> oc project cp4i </i> </u>

Run below command to see the pod name of the mq queue manager.

<u> <i> oc get pods \| grep -i mq </i> </u>

Note the MQ Queue Manager POD Name. eg. ** quickstart-cp4i-ibm-mq-0 **

Change Directory to the location of your mqsc file. Use the following command to upload mqsc file to the MQ pod. QUICKSTART is queue manager name.

---
oc exec -it **quickstart-cp4i-queue-ibm-mq-0(this is your pod’s name)** runmqsc **QUICKSTART(QMGR-Name)** < mq_ace_lab.mqsc

---

This script performs:

-   Disable Chlauth security

-   Disable clientauth security

-   Disable user security on MQ objects level

The above command should succeed with below lines in the end.

<u> <i>
94 MQSC commands read.

No commands have a syntax error.

All valid MQSC commands were processed.
</i> </u>

Note the default channels details. Go to the Applications Tab for the Queue Manager that you created.

<img src="./media/image24.1.jpeg" style="width:8in"  />

Click on App Channels link in the left pane. Click on the Filter and Select Show System Channels.

<img src="./media/image25.1.jpeg" style="width:8in"  />

You should be able to see the System Channels. Note the default channel to be used for MQ Communication.

<img src="./media/image26.1.jpeg" style="width:8in"  />

<span id="_Toc105518929" class="anchor"></span>

# Integration - ACE to MQ

Integration has the following components:

-   [<u>Prepare</u>](#_Toc105518930)

-   [<u>Build</u>](#_Toc105518931)

-   [<u>Deploy</u>](#_Toc105518928)

<span id="_Toc105518930" class="anchor"></span>

## Prepare - Asset into IBM ACE Toolkit

Open IBM ACE Toolkit under a workspace and create a REST API project.

<img src="./media/image34.png" style="width:6.26806in" />

Give it a name and select the specification as Swagger 2.0 Click Finish.

<img src="./media/image35.png" style="width:6.26806in" />

Open the REST API Description. In the right Pane, Under Resources, Click on + icon to create a resource.

<img src="./media/image36.png" style="width:6.26806in" />

Enter the resource path and select the operation as post. Click Apply.

<img src="./media/image37.png" style="width:6.26806in" />

A New resource will be created.

<img src="./media/image38.png" style="width:6.26806in" />

Click on the subflow icon or this new resource.

<img src="./media/image39.png" style="width:6.26806in"  />

New subflow editor will open. Drag the IBM MQ -> MQ Output Connector from the
transformation section in the left toolbox.

<img src="./media/image40.png" style="width:6.26806in" />

Connect the Boxes together.

<img src="./media/image41.png" style="width:6.26806in"  />

Find the MQ Queue Manager Service IP address from the “openshift
console” or oc client (oc get svc \| grep -i mq).

<img src="./media/image42.png" style="width:6.26806in" />

<img src="./media/image43.png" style="width:6.26806in;height:3.50833in" />

Click on the MQ Output and configure the MQ Details. Enter the Queue Name.

<img src="./media/image45.png" style="width:6.26806in;height:2.93333in" />

Enter the MQ Queue Name in the **Basic Tab**. Then in the **MQ Connection tab**, Enter the MQ Connection Details like Queue Manager Name, Queue Manager
Host Name (Service IP), Listener Port no (1414 Default), Connection Channel Name (default – SYSTEM.DEF.SVRCONN).

<img src="./media/image46.png" style="width:6.26806in;height:4.87153in"  />

If you have a policy for MQ EndPoint,then you can configure the policy name in the **policy tab** here in the format {MQPolicyProjectName}:PolicyName, so that it can be used as a configuration for the integration server. In this case, above details on **MQ Connection tab** are not required. The Policy Project Creation Reference is **[here](Create-MQ-Policy.md)**.

<img src="./media/mq-policy-8.jpeg" style="width:8in;height:4in"  />

<span id="_Toc105518931" class="anchor"></span>

## Build – BAR File

Add a new BAR file in the project to package and export the
configuration.

<img src="./media/image47.png" style="width:4.14412in;height:4.90741in"  />

Enter the bar file details and click Finish.

<img src="./media/image48.png" style="width:4.40476in;height:3.77426in"  />

Include the newly created project. Add the Build options and Click Save.

<img src="./media/image49.png" style="width:6.26806in;height:2.37639in"  />

Rebuild BAR and save file one more time.

<img src="./media/image50.png" style="width:6.26806in;height:2.02083in"  />

<img src="./media/image51.png" style="width:4.02778in;height:1.30556in" />

<img src="./media/image52.png" style="width:3.875in;height:1.41667in" />

Check the properties of the generated bar file.

<img src="./media/image53.png" style="width:2.61111in;height:4.86111in"  />

Copy the bar file path or open it in finder window.

<img src="./media/image54.png" style="width:5.90278in;height:3.95833in"  />

<span id="_Toc105518928" class="anchor"></span>

# Integration Dashboard - Deploy an integration server

Proceed to create a Integration Server in CP4I Console. Click on Deploy Integrations.

<img src="./media/image55.jpeg" style="width:10.26806in"/>

Click Deploy a Server and Chose a Quick Start Plan. Click Next.

<img src="./media/image56.jpeg"  />

Drag and Drop the newly generated bar file here. Click Next.

<img src="./media/image57.jpeg"  />

Skip any Configuration to be applied this integration if you have not created a Policy Project. Just Click **Next**. 

If you have a MQ Policy Project, then you can create configuration for it, select it and Click **Next**. Click **[here](Create-MQ-Policy.md#integration-server---mq-policy-project-configuration)** for more details.

<img src="./media/image58.jpeg"  />

Enter the Integration Server Name starting with your Name to make it unique, Select License. Click Create.

<img src="./media/image59.jpeg" />

The Integration Server will be created and ready shortly. You may
refresh the page to check on the readiness status update.

<img src="./media/image60.jpeg" />

Click on the Server once its ready.

<img src="./media/image61.jpeg" />

Click on the API.

<img src="./media/image62.png" style="width:6.26806in" />

Click on the <u>post/AccountEnquiry.</u>

<img src="./media/image63.png" style="width:6.27545in;height:3.20238in" />

Click on Try It Tab to test the Rest Interface.

<img src="./media/image64.png" style="width:6.29107in;height:3.41667in" />

Click on Generate to generate a random test message. Click Send.

<img src="./media/image65.png" style="width:6.077in;height:3.40476in" />

The response should come successfully.

<img src="./media/image66.png" style="width:6.26806in;height:2.95in" />

This completes the creation and testing of local integration server.

<span id="_Toc105518933" class="anchor"></span>

# API Connect (APIC)

Navigate to Administration -\> Integration Instances.

<img src="./media/image67.png" style="width:6.26806in;height:1.44514in" />

If there is no existing instance of **API Management**, Create an instance of the API Connect (API Management) as per following procedure. 

If there is already an instance, then you should be able to see instances for API Management, API Management Administration, API-managed enterprise gateway. In this case, just click on the instance name for API Management Administration and continue to create organiation as per next section of **[Cloud Manager (API Management Administration)](#_Toc105518934)**.

<img src="./media/image68.png" style="width:6.26806in;height:4.07639in"  />

Chose the basic one node plan. Click Next.

<img src="./media/image69.jpg" />

Enter the API instance Name and accept the license. Enter the license ID.

<img src="./media/image70.jpg" />

The matching Storage Class will be automatically selected. Click Finish.

<img src="./media/image71.jpg" />

The following API Connect Instances will be created in about 45 minutes.

-   **API Managed Enterprise Gateway** is the data power gateway.

-   **API Management** is the instance where we can configure/Develop new APIs Products and catalog. (API Manager).

-   **API Management Administration** is where we can create organization, configure authentication settings, SMTP settings etc .

<img src="./media/image72.png" style="width:6.26806in;height:2.44097in"  />

<img src="./media/image72.1.jpg" style="width:6.26806in;height:3.42431in" />

<span id="_Toc105518934" class="anchor"></span>

## Cloud Manager (API Management Administration)

### Create Organization

Click on the API Management Administration Link to open Cloud Manager
Console.

Click Manage Organization.

<img src="./media/image73.png" style="width:6.26806in;height:3.9in"  />

Click on Add to create an API organization which is like a logical
separation of multiple API users.

<img src="./media/image74.png" style="width:6.26806in;height:2.09931in" />

Enter the Organization Name.

<img src="./media/image75.png" style="width:6.26806in;height:3.81736in"  />

Change the User Registry to Common Services User Registry. Enter the
existing user name as admin. Click Create.

<img src="./media/image76.png" style="width:6.26806in;height:3.47361in"  />
 
<img src="./media/image77.png" style="width:6.26806in;height:0.99074in"  />

### Configure SMTP for notifications
 
Click on Resource’s link in the left pane. Click on Notification Link in the left pane.

<img src="./media/image78.png" style="width:6.26806in;height:3.80417in" />

Click on Create button to create a new SMTP Server.

<img src="./media/image79.png" style="width:6.26806in;height:1.80208in" />

Add a new smtp server for email notifications. You can add any smtp
provider eg. Sendgrid or mailtrap or any other.

<img src="./media/image80.png" style="width:6.26806in;height:3.82569in" />

Click test email to test the connection. Enter the recipient email id
and click Send Test Email.

<img src="./media/image81.png" style="width:4.38889in;height:1.48611in" />

The email should be sent successfully. You can verify this only through the mailtrap inbox. It will not land in the actual reciever inbox.

<img src="./media/image82.png" style="width:4.36111in;height:1.45833in" />

Click Save to save the config.

<img src="./media/image83.png" style="width:6.26806in;height:1.42778in" />

Also update the same email smtp settings for the Dummy mail server as well.

<img src="./media/image84.png" style="width:6.26806in;height:1.34653in" />

### Configure admin email id

In the Cloud Manager, Under Manage Organization, Go to Logged in User (admin) Settings and click My Account.

<img src="./media/image85.png" style="width:6.26806in;height:1.66736in" />

Update the email id for the current account. Very Important. Otherwise
later you will not be able to create a portal service under a catalog.

<img src="./media/image86.png" style="width:6.26806in;height:2.83889in" />

<span id="_Toc105518938" class="anchor"></span>

## API Manager (API Management)

Click on the API Management Link to open API Management Console. If you
see below picture then your Organization is not set correctly.

<img src="./media/image87.png" style="width:width:6.26806in" />

After setting the organization correctly, the API Manager should look like this.

<img src="./media/image88.jpeg" style="width:width:6.26806in" />

### Develop API

Click on Develop APIs and products. Create a new API. This will
encapsulate the API created on the ACE.

<img src="./media/image89.png" style="width:6.26806in;height:1.47917in" />

Chose the default option "From Target Service". Click Next.

<img src="./media/image90.png" style="width:6.26806in;height:3.97292in" />

Provide the details for Target service.

<img src="./media/image91.png" style="width:6.26806in" />

Note the Target Service URL from Integration Dashboard that we created
earlier.

<img src="./media/image92.png" style="width:6.26806in;height:2.28194in"  />

example, <http://hostname/MyEquiry/v1/AccountEnquiry>

Enter the title of the API. This will also create an endpoint / base
path using which the API can be called and it will just redirect the
request to Target Service URL.

<img src="./media/image93.png" style="width:6.26806in" />

Click Next.

<img src="./media/image94.png" style="width:6.26806in;height:1.76042in" />

Click Edit API.

<img src="./media/image95.png" style="width:6.26806in;height:1.76319in" />

### Configure API

After Clicking Edit API, API Design Screen will open.

<img src="./media/image96.png" style="width:6.26806in;height:4.67431in"  />

As we are exposing only post service in the backend we can delete the
other operations from here.

<img src="./media/image97.png" style="width:6.26806in;height:3.94167in"  />

Click Save.

<img src="./media/image98.png" style="width:6.26806in"  />

Under Security Schema Click Add to add another security schema.

<img src="./media/image99.png" style="width:6.26806in"  />

Select apiKey as the security definition key.

<img src="./media/image100.png" style="width:6.26806in;height:3.12083in"  />

Enter the details as below.

<img src="./media/image101.png" style="width:6.26806in;height:4.79028in"  />

Client Secret is added as security schema. Click Save.

<img src="./media/image102.png" style="width:6.14652in;height:4.58367in"  />

Go to General -\> Security . Edit the security schema name.

<img src="./media/image103.png" style="width:6.17732in;height:4.60664in"  />

Select both parameter and Click Submit.

<img src="./media/image104.png" style="width:6.26806in;height:2.27083in"  />

Click Save.

<img src="./media/image105.png" style="width:6.26806in;height:2.58958in"  />

Now make this API online so that it will be published in a development
sandbox.

<img src="./media/image106.png" style="width:2.73611in;height:0.625in"  />

<img src="./media/image107.png" style="width:2.73611in;height:0.625in"  />

### Develop Product

Go to API Manager Home again and click on "Develop API and Products".

<img src="./media/image108.png" style="width:6.26806in"  />

Now we need to package this API into a product. One product can have
multiple APIs.

<img src="./media/image109.png" style="width:6.26806in;height:1.54722in" />

Click Add -\> Product.

<img src="./media/image110.png" style="width:6.26806in;height:1.54722in" />

Click Next.

<img src="./media/image111.png" style="width:6.26806in;height:1.96389in" />

Give a product Name. Click Next.

<img src="./media/image112.png" style="width:6.26806in;height:2.67778in" />

Select an API to be added into this product. Click Next.

<img src="./media/image113.png" style="width:6.26806in;height:2.17222in" />

Review the plan details. You can more plans by clicking on Add Button.
Can define the new plan name and rate limit (eg. API Calls Frequency). You can add arbitary plans and API Calls Frequency.

<img src="./media/image114.png" style="width:6.26806in;height:3.65in"  />

Click Next After adding the required plans.

<img src="./media/image115.png" style="width:6.26806in;height:4.46736in" />

Click Next with default options.

<img src="./media/image116.png" style="width:6.26806in;height:3.44861in" />

Click Done. We will publish it separately later after creating catalog.

<img src="./media/image117.png" style="width:6.26806in;height:2.05764in" />

New product is added with the new API.

<img src="./media/image118.png" style="width:6.26806in;height:1.68611in" />

Go to API Manager "Manage Settings" to update the email Notification
settings.

<img src="./media/image119.png" style="width:6.26806in;height:3.42431in" />

Go to "Notifications". Click Edit.

<img src="./media/image120.png" style="width:6.26806in;height:1.81042in" />

Configure the sender name and email address.

<img src="./media/image121.png" style="width:6.26806in;height:1.81042in" />

<img src="./media/image122.png" style="width:6.26806in;height:1.81042in" />

### Create Catalog

Now we can create a catalog. One catalog can contain one developer
portal where this product can be published. We can have a internal and
external catalog where internal catalog is for internal organization and
external is for external users.

Go to manage catalogs under API Manager.

<img src="./media/image123.png" style="width:6.26806in;height:3.69583in" />

Create new Catalog.

<img src="./media/image124.png" style="width:6.26806in;height:1.95278in" />

Enter a name and Click Create

<img src="./media/image125.png" style="width:6.26806in;height:2.72431in" />

Open the new Catalog and navigate to Catalog settings.

<img src="./media/image126.png" style="width:6.26806in;height:1.94306in" />

<img src="./media/image127.png" style="width:6.26806in;height:2.99097in" />

Create a developer portal here. Click Create. If the email if is not updated for the logged in user
account, then there will be an error mentioning so. Update the admin
user email id from Cloud Manager -\> My Account as explained earlier.
Also make sure smtp settings are correct under Cloud Manager
notification settings.

<img src="./media/image128.png" style="width:6.26806in;height:2.99097in" />

Select the portal service as "portal-service" and Click Create. 

<img src="./media/image129.png" style="width:6.26806in;height:2.39097in" />

It will take a few minutes for the portal service to be ready. You will
receive an email once its ready to set the password for the portal admin
account.

<img src="./media/image130.png" style="width:6.26806in;height:2.53403in" />

Note down the Portal API URL from **Catalog Settings -\> Portal** . eg.

<https://hostname/api-organization/practicum-catalog>

(optional) Once you receive the email to set the password click on that
link and set the password for the admin account for API Manager.

### Publish Product

In the original API Manager Window, Now lets publish the product to the new catalog from API Manager first. So it can be visible in this catalog.

Go to API Manager Home and click Develop APIs and Products. Go to Products Tab. Select the product settings and click Publish.

<img src="./media/image131.png" style="width:6.26806in;height:2.43472in" />

Select the new catalog.Click Next. 

<img src="./media/image131.jpeg" style="width:6.26806in;height:2.43472in" />

You can set the catalog visibility to Authenticated users. Click Publish. 

<img src="./media/image132.jpeg" style="width:6.26806in" />

<img src="./media/image133.jpeg" style="width:6.26806in" />

It will be published shortly.

### API Connect Developer Portal

Open the Portal API URL as noted above in the browser.

**Note:** Use **Mozilla Browser** only for this as there will be issues
with chrome browser with default self-signed certificate settings and
chrome will prevent the connection.

<img src="./media/image133.png" style="width:6.26806in;height:3.85972in" />

Click on **Create Account** to create a new account.

<img src="./media/image134.png" style="width:6.26806in;height:2.82292in" />

You will receive email with activation instructions.

<img src="./media/image135.png" style="width:5.45833in;height:4.51389in" />

The account will be activated and you will be able to login with the
newid. Sign in with the new id and password.

<img src="./media/image136.png" style="width:6.26806in;height:3.85972in" />

Click on Create a new App.

<img src="./media/image137.png" style="width:5.56071in;height:4.78014in" />

Enter an application Name and click Save.

<img src="./media/image138.png" style="width:5.76829in;height:3.47337in" />

Once application created successfully, note down the Key and Secret for
this application. You can not see the Key and Secret for this
application after this page. Each application will interact with API
Manager/ACE using this client secret. Click OK.

<img src="./media/image139.png" style="width:6.26806in" />

-   Key: 81b789b18XXXXXXXXXX069ec1757beb9

-   Secret: 0a38029dXXXXXXXXXXa16f47aa943eb

You can optionally click on verify link to verify your secret against
this application’s key.

Click on **Why not browse the available APIs** to subscribe to API
Product for this App.

<img src="./media/image140.png" style="6.26806in" />

Click on the published API product.

<img src="./media/image141.png" style="6.26806in" />

Just click on the **Select** button for one of the plan exposed by the
product.

<img src="./media/image142.png" style="6.26806in" />

Select the **application** to be subscribed.

<img src="./media/image143.png" style="6.26806in" />

To confirm subscription, click Next.

<img src="./media/image144.png" />

Click Done.

<img src="./media/image145.png" />

Click on **POST /** option under overview, in the left pane.

<img src="./media/image146.png" s />

Click on **Try It** tab to test this API product.

<img src="./media/image147.png" />

Enter the API Secret for authentication and click Send.

<img src="./media/image148.png" />

If you receive an error like below, then it could be because you are
using any other browser than Firefox. Or the Certificate is not trusted.

<img src="./media/image149.png"  />

Open this URL in the error below in the browser. eg.

https://hostname/api-organization/practicum-catalog/my-account-api/

Accept the certificate. Ignore the error. 

<img src="./media/image150.png" border=1 />

Now You can try to send the API call one more time, you should be able
to see the response successfully.

<img src="./media/image151.png"  />

Check in the IBM MQ if this message has been stored in Queue
Successfully.

 Go to Integration Instances -\> Messaging instance Name -\> Manage -\> Queue name

<img src="./media/image152.png" />

[Go to Configuration Index](#ibm-cloud-pak-for-integration---configuration)

[Go back to -> Table of Contents](../README.md)

[Go to next topic -> Conclusion](../Conclusion/README.md)