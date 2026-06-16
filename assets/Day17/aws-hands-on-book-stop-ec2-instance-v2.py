import boto3
ec2_client = boto3.client('ec2')

def lambda_handler(event, context):
    # EC2 インスタンスを Name タグで検索し、
    # 該当するインスタンスの InstanceId を取得する
    response = ec2_client.describe_instances(
        Filters=[
            {
                'Name': 'tag:Name',
                'Values': ['aws-hands-on-book-batch']
            }
        ]
    )
    instance_id = response['Reservations'][0]['Instances'][0]['InstanceId']

    # InstanceId を指定し、stop_instances メソッドを呼び出す
    ec2_client.stop_instances(
        InstanceIds=[instance_id]
    )

    return {
        'statusCode': 200,
        'body': f'Stopped: {instance_id}'
    }