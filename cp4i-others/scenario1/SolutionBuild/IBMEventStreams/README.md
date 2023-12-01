# Solution Build -  IBM Event Stream
IBM Event Streams is an event-streaming platform based on the open-source Apache Kafka® project. So it will be good if you have some understanding of [kafka key concept](https://ibm.github.io/event-streams/2019.4/about/key-concepts/).

In this section we will go through on how to create IBM Event Streams topic that will be used in our solution. Please refer to [this link](https://ibm.github.io/event-streams/getting-started/creating-topics/) on how to create Kafka topic in IBM Event Streams.

For this scenario we will need to create some topics that will store data for each currency. Repeat the Create Topic steps to create below topics.
- EURUSD
- USDJPY
- AUDUSD
- SGDUSD
- GBPEUR
- PHPEUR

## Preparing Client Connection
You can refer to below instructions to **[Create Connection to shared Kafka cluster.](../Kafka-Pre-lab/Kafka-Pre-Lab.md)** Steps to create Kafka connection and save credentials and certs for all Kafka labs. 

## Create Topic
1. From IBM Integration Navigator page, find "Event streaming" and click on the created Event Streaming instance.

<img src="img/01-event%20streams%20menu.png" width=1000 height=400/>

2. In your IBM Event Streams main page, choose "Create a topic"

<img src="img/02-create%20topic%20menu.png" width=1000 height=400/>

3. In the first page of Create topic wizard, choose the topic name that you  will create. In this example we will create a topic to keep FX data for EUR to USD. Click next after you filled the topic name.

<img src="img/03-create%20topic.png" width=1000 height=400/>

4. Next step will be determine how much partition(s) you will create. It will depends on how much consumer that will consume the event from this topic.

<img src="img/04-create%20topic%20partition.png" width=1000 height=400/>

5. In message retention part, we will set on how long the message will be retained. In our case we will retain the message for 12 months. Feel free to create a topic with shorter retention time (eg 2 min) if you want to see kafka message retention feature.

<img src="img/05-create%20topic%20retention.png" width=1000 height=400/>

6. Select a replication factor in Replicas. This is how many copies of a topic will be made fo high availability. We can have 1 partition for this excercise. Click "Create topic" to finish topic creation.

<img src="img/06-create%20topic%20replication.png" width=1000 height=400/>

7. Check on the topic list and make sure that your topic already created.

<img src="img/07-topic%20created.png" width=1000 height=400/>

**Consideration for production environment**
1. Partition should be created depends on how many consumer / consumer group you have
2. For production environments, select **Replication factor: 3** as a minimum.

### [Go Back](/scenario1/README.md)