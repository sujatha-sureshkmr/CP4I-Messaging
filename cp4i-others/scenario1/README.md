## IBM CP4I Practicum Lab Book for Scenario 1: 

### Description:
This Practicum Lab Book explains and focuses on the solution preparation and implementation for Practicum Scenario 1 using Cloud Pak for Integration (CP4I). The book will cover the solution architecture and the details of how to best implement the solution for the given scenario. This will help accelerate adoption of Cloud Pak for Integration.

## Table of Contents:

### [Topic 1: Introduction and Scenario Details](#ibm-cp4i-scenaro-1-introduction)
### [Topic 2: Solution Architecture and List of Products Used](#solution-architecture)
### [Topic 3: Introduction to Cluster](#introduction-to-cluster)
### [Topic 4: Solution Build](#solution-build)
### [Topic 5: Conclusion](#conclusion)

###############################################################################################

# IBM CP4I Scenario Introduction

- ABC are a Medium sized bank that offers Investments to its high value customers. The bank receive FX (Foreign Exchange) data from a 3rd party via a feed.
- The data from this 3rd party feed is removed once it reaches an age of two weeks.
- As part of a new program at the bank they want to offer access to FX data up to 12 months old via a mobile app to their brokers. The raw data is not in the format required for the business users.
- The Bank historically use IIB and MQ and have bought CP4I. They have also setup a test system to investigate the use of OpenShift and CloudPaks.

<img src="../scenario1/img/01-scenario-diagram.png" width=600 height=480/>

### **Challanges**
Your team have (3) days to document your approach to a Solution to the customers business problem using CP4I capabilities and any external capabilities that you think are necessary or useful.
Day 3: Demonstrate your solution to whole class

# Solution Architecture
## High Level Architecture

<img src="../scenario1/img/high-level-architecture-diagram.png" width=600 height=480/>

- Assume we pull FX data from 3rd party application in XML Format and need to be transformed to the format required for the business users. We need an **Application Integration** capabilities for it
- **Event Streaming** will add resiliency to the system and to persist data for 12 month.
- **API Management** will manage and expose internal APIs to the broker apps

## Detailed Solution Flow

<img src="img/detailed-solution.png" width=600 height=480/>

1. Inside **IBM App Connect Enterprise** there will be an application that pull the data periodically, transform it to the format required by the business users and publish it in an **IBM Event Streams** topic with specific currency and event life time (12 months). 
2. Second application will be created to query FX data from Topic containing FX data..
3. Query FX flow will be published by **IBM API Connect**, to be consumed by the broker apps

## List of Software Products Used In Scenario

<img src="img/cloud-pak-stack.png" width=800 height=480/>

The Cloud Pak for Integration services that we will be use are:
- IBM App Connect Enterprise
- IBM Event Streams
- IBM API Connect

[Go to the TOP](#ibm-cp4i-practicum-lab-book-for-scenario-1)

## Introduction to Cluster

If you're completely new to the concept of clusters, do follow the quick and easy tutorial [here](https://cloud.ibm.com/docs/openshift?topic=openshift-openshift_tutorial) to learn more
> With Red Hat® OpenShift® on IBM Cloud®, you can create highly available clusters with virtual or bare metal worker nodes that come installed with the Red Hat OpenShift on IBM Cloud Container Platform orchestration software. You get all the advantages of a managed offering for your cluster infrastructure environment, while using the Red Hat OpenShift tooling and catalog that runs on Red Hat Enterprise Linux for your app deployments.

## Introduction to Openshift

OpenShift is a platform that allows you to run containerized applications and workloads and is powered by Kubernetes. It is an offering that comes with Red Hat support, regardless of where you choose to run your applications and workloads. 

One of the big advantages of OpenShift is being able to take advantage of public and private resources which includes bare metal or virtualized hardware whether it is on-premise or on a cloud provider. 

<img src="img/openshift-overview.png" width=900 height=300/>

This is the high level OpenShift Container Platform overview.

For developers, OpenShift has two different ways of enabling them to work with their platform. They can take advantage of either the CLI or a web console. 

[Go to the TOP](#ibm-cp4i-practicum-lab-book-for-scenario-1)


# Solution Build
You can refer to below instructions to **[Create Connection to shared Kafka cluster.](SolutionBuild/Kafka-Pre-lab/Kafka-Pre-Lab.md)** Steps to create Kafka connection and save credentials and certs for all Kafka labs. 

You may need to **[install client tools](SolutionBuild/Kafka-Pre-lab/Install-Client-Tools.md)** to work on this lab. 


|  Subject                            | Description                                            |                                                               
|-------------------------|------------------------------------------------------------------------------------------------------------|
| [Define FX Data Interface](Scenario/Interfaces.md)       |Sample for Users to design and construct their own user interface for the FX data Inbound interface.
| [Using IBM Event Streams](SolutionBuild/IBMEventStreams/README.md)       | The purpose of this lab is to provide an introduction to IBM Event Stream Feature on CP4I  | 
[Creating Kafka Policy and Message Flow ](SolutionBuild/IBMAppConnect/README.md)       | Before working on the message flow, you need to create a policy project using **App Connect Enterprise (ACE)**. Then you can build the message flow and deploy it on integration server.

## Conclusion
The above completes details for setup, installation and configuration of Cloud Pak for Integration for Scenario 1. As we conclude our work on the Practicum, you will now be well acquainted with the basic fundamentals and usage of Cloud Pak for Integration. This will assist you in your journey to Modernising Applications and keep up to speed with the technology and trends.

[Go to the TOP](#ibm-cp4i-practicum-lab-book-for-scenario-1)