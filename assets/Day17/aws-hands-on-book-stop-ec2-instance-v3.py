import boto3
ec2_client = boto3.client('ec2')

def lambda_handler(event, context):
    # EC2インスタンスをNameタグで検索し、
    # 該当するインスタンスのInstanceIdを取得する
    response = ec2_client.describe_instances(
        Filters=[
            {
                'Name': 'tag:Name',
                'Values': [event['instance_name']] # event引数からinstance_nameを取得する
            }
        ]
    )
    instance_id = response['Reservations'][0]['Instances'][0]['InstanceId']

    # InstanceIdを指定し、stop_instancesメソッドを呼び出す
    ec2_client.stop_instances(
        InstanceIds=[instance_id]
    )

    return {
        'statusCode': 200,
        'body': f'Stopped: {instance_id}'
    }