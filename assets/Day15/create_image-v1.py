import boto3
client = boto3.client('ec2', region_name='ap-northeast-1')

response = client.describe_instances(
    Filters=[
        {
            'Name': 'tag:Name',
            'Values': ['aws-hands-on-book-web-1a']
        }
    ]
)
instance_id = response['Reservations'][0]['Instances'][0]['InstanceId']
print(instance_id)