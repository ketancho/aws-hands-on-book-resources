import boto3
ec2_client = boto3.client('ec2', region_name='ap-northeast-1')

response = ec2_client.describe_instances(
    Filters=[
        {
            'Name': 'tag:Name',
            'Values': ['aws-hands-on-book-web-1a']
        }
    ]
)

instance_id = response['Reservations'][0]['Instances'][0]['InstanceId']

response = ec2_client.create_image(
    InstanceId=instance_id,
    Name='aws-hands-on-book-web-ami-by-boto3',
    NoReboot=True
)

print(response['ImageId'])