# Create and Export MQ Policy in ACE

## Create MQ Policy

Open the ACE Workbench and choose a workspace where your MQ Flows exists.

In the Projects Area,  Right click and choose New -> Policy.

<img src="./media/mq-policy-1.jpeg" style="width:4in;height:6in"  />

If you already have a Policy Project, then you can chose it. Otherwise Click **New** to create a new Policy Project.

<img src="./media/mq-policy-2.jpeg" style="width:8in;height:4in"  />

In the New Policy Creation Wizard, Enter the Name of the Policy and Click Finish.

<img src="./media/mq-policy-3.jpeg" style="width:8in;height:4in"  />

Under the Policy Project, Enter the name of the Policy. For ex. It could be as per the environment type, eg. dev, uat etc. Click Finish.

<img src="./media/mq-policy-4.jpeg" style="width:8in;height:4in"  />

Select the Policy Type and Template as **MQ Endpoint**

<img src="./media/mq-policy-5.jpeg" style="width:8in;height:4in"  />

Enter the MQ Connection Details.

<img src="./media/mq-policy-6.jpeg" style="width:8in;height:4in"  />

Enter the details as below.

|  Parameter                                | Value 
|-|-
|connection|CLIENT
|destinationQueueManagerName|As per the Queue Manager Name, eg. QUICKSTART
|queueManagerHostname|Name of the MQ Service in OCP Console, eg. quickstart-cp4i-ibm-mq.cp4i.svc.cluster.local
|listenerPortNumber|Port as per the port configured in MQ Service in OCP Console, eg.1414
|channelName|You can enter the default channel, eg. SYSTEM.DEF.SVRCONN
|useSSL|false
|reconnectOption|default

<img src="./media/mq-policy-7.jpeg" style="width:8in;height:4in"  />

## Export MQ Policy

We need to export the MQ Policy Project as the zip file as below.

Right Click on the policy name, and select properties.

<img src="./media/mq-policy-export-1.jpeg" style="width:3in;height:6in"  />

Check the physical path of the policy file. You can open the path from here.

<img src="./media/mq-policy-export-2.jpeg" style="width:8in;height:4in"  />

You can see the policy xml. Go one level above to see the Policy Project.

<img src="./media/mq-policy-export-3.jpeg" style="width:8in;height:4in"  />

Compress the policy project as the zip file.

<img src="./media/mq-policy-export-4.jpeg" style="width:8in;height:4in"  />

Now we should have the policyproject.zip file to be used during deployment in Integration Server.

## Integration Server - MQ Policy Project Configuration

While we deploy the project BAR file in the integration server, after selecting the bar file, you can select an existing or create a new configuration for the policy project.

In the App Connect Dashboard, Configuration Tab, Click on **Create Configuration+** button to create a new configuration.

<img src="./media/mq-policy-config-1.jpeg" style="width:8in;height:4in"  />

Enter the Configuration Type as **Policy Project**, name of the policy project configuration, enter the policy project description. Browse or Drag & Drop the Policy Project File. 

<img src="./media/mq-policy-config-2.jpeg" style="width:8in;height:4in"  />

Click on the **Create Button** to create this new configuration.

<img src="./media/mq-policy-config-3.jpeg" style="width:8in;height:4in"  />

While deploying the project BAR file in the integration server, after selecting the bar file, you can select the configuration for the policy project. Click **Next**.

<img src="./media/mq-policy-config-4.jpeg" style="width:8in;height:4in"  />

[Go to Configuration Index](README.md#build-–-bar-file)