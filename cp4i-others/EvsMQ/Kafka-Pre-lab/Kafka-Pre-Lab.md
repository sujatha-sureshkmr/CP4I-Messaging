# Create a connection to the Kafka clusters

There are several labs that use Kafka and we will need to create a connection to access the Kafka cluster when using Smart connectors, Toolkit flows, and Event Endpoint apis. 
You will need to save the details from this section to be used in varies labs. 

**NOTE: You should do this from the VDI since you will need to run varies commands so best to have the cert files saved to the VDI**

[Return to Scenario main page](../index.md#lab-sections)

# 1. Create SCRAM credentials to connect to Event Streams

1\. Use the URL to the CP4I cluster that was provided to you from the instructor.   Select the **Enterprise LDAP**.

![alt text][pic0]

2\. When prompted use the username and password provided to you for this lab. In this example, we are using chopper1.

![alt text][pic1]

3\. You will now be on your home page and in the upper left it will show your login name.   Under **Event Streaming** click on the **es-demo** link to take you to the Event Streams Home page.

![alt text][pic2]

4\. Now we will select the **Connect to this Cluster** tile.

 ![alt text][pic3]

5\. Now we will see the Cluster connection screen. Make sure you select **External** and then click the **Generate SCRAM credentials**.

![alt text][pic4]

6\. You will need to enter the following details.

| Option        | Value           |
| ------------- |:-------------:|
| Credential name      | For the **credentials name** use your userid/username/unique identifier |
| What do you want your application to do?   | Produce messages, consume messages and create topics and schemas      |
| Which topics does the application need to access?  | All topics      |
| Which consumer group does the application need to access?       | All consumer group |
| Choose which transactional IDs the application can access      | All transactional IDs |

6b\. For the **credentials name** use your userid/username/unique identifier. Make sure the **Produce messages, consume messages and create topics and schemas** button is selected and then click **Next**.

7\. On the next screen select the **All Topics**.  Click **Next**.

8\. On the next screen select the **All consumer group**.  Click **Next**.

9\. Select the **All transactional IDs**.  Click **Generate credentials**.

10\. Now that we have the credentials generated use the icon to copy them and save them for use later in other labs. 
* a\. Save the bootstrap URL of the cluster
* b\. Save the SCRAM username 
* c\. Save the SCRAM password 

* Last is to download the PEM certificate. 

![alt text][pic9]

11\. Save the es-cert.pem, this will be used to connect to the Event Stream Cluster. 

![alt text][pic10]

12\. We will also download the PKCS12 certificate and save the **PKCS12 password**. This will be used to connect to the Event Stream Cluster when using the toolkit flows. 

![alt text][pic11]

13\. Due to the version of Java in ACE we will need to convert the PKCS12 to a JKS.  We will do this by running the following command.  

<code>
keytool -importkeystore -srckeystore es-cert.p12 -srcstoretype PKCS12 -destkeystore es-cert.jks -deststoretype JKS -srcstorepass XXXXXXX -deststorepass XXXXXX -noprompt
</code>

We will first open a terminal window.  Next cd to the Downloads directory.  If you do a ls es-cert* command you should see the es-demo.p12 cert you just download. 
The only thing you need to change in this example is replace the XXXXXX with the password you saved for the PKCS12 cert. 
Once done do a list again and you will now see the es-cert.jks file. 

# Summary
We should now have the following saved for use in the Kafka labs. 
* a\. The bootstrap URL of the cluster
* b\. The SCRAM username 
* c\. The SCRAM password 
* d\. The PEM certificate (used in the Designer flows).
* e\. The PKCS12 password (used in the Toolkit flows).
* f\. The PKCS12 certificate (used in the Toolkit flows).
* g\. The JKS Certificate (used in the Toolkit flows).

You should have a text file saved on the device with this info and the cert files will be in your Downloads directory. 

![alt text][pic12]

[Return to Scenario main page](../index.md#lab-sections)


[pic0]: images/0.png
[pic1]: images/1.png
[pic2]: images/2.png
[pic3]: images/3.png
[pic4]: images/4.png
[pic5]: images/5.png
[pic6]: images/6.png
[pic7]: images/7.png
[pic8]: images/8.png
[pic9]: images/9.png
[pic10]: images/10.png
[pic11]: images/11.png
[pic12]: images/12.png