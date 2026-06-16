import json
import urllib.parse
import boto3

# 【修正箇所1】CSV ファイルを読み取るために追加
import csv
import io

print('Loading function')

s3 = boto3.client('s3')

# 【修正箇所2】DynamoDB を操作するクライアントを作成
dynamodb_client = boto3.client('dynamodb')

def lambda_handler(event, context):
    #print("Received event: " + json.dumps(event, indent=2))

    # Get the object from the event and show its content type
    bucket = event['Records'][0]['s3']['bucket']['name']
    key = urllib.parse.unquote_plus(event['Records'][0]['s3']['object']['key'], encoding='utf-8')
    try:
        response = s3.get_object(Bucket=bucket, Key=key)

        # 【修正箇所3】Content-Type を表示する処理は不要なためコメントアウト
        # print("CONTENT TYPE: " + response['ContentType'])
        # return response['ContentType']

        # 【修正箇所4（ここから）】
        # S3 から取得した CSV ファイルを文字列として読み込む
        csv_text = response['Body'].read().decode('utf-8')
        # CSV 文字列を解析できる形式に変換する
        reader = csv.reader(io.StringIO(csv_text))
        # ヘッダー行を読み飛ばす
        next(reader)

        # CSV ファイルの各行（2行目以降）を Item として DynamoDB テーブルに PUT する
        for row in reader:
            dynamodb_client.put_item(
                TableName='Journals',
                Item={
                    'Id': {
                        'N': row[0],
                    },
                    'Title': {
                        'S': row[1],
                    },
                    'Learning': {
                        'S': row[2],
                    },
                    'Image': {
                        'S': row[3],
                    },
                },
            )

        print('Successfully imported CSV data into DynamoDB.')

        return {
            'statusCode': 200,
        }
        # 【修正箇所4（ここまで）】

    except Exception as e:
        print(e)
        print('Error getting object {} from bucket {}. Make sure they exist and your bucket is in the same region as this function.'.format(key, bucket))
        raise e
