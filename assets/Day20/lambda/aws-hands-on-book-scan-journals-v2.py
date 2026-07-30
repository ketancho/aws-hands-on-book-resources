import json
import boto3
dynamodb_client = boto3.client('dynamodb')

def lambda_handler(event, context):
    response = dynamodb_client.scan(
        TableName='Journals',
    )
    journals = response['Items']

    # 【修正箇所1】DynamoDB独自形式ではなく、
    # フロントエンドで扱いやすいJSON形式に変換
    journal_data = []
    for journal in journals:
        journal_item = {
            "id": int(journal['Id']['N']),
            "title": journal['Title']['S'],
            "learning": journal['Learning']['S'],
            "image": journal['Image']['S'],
        }
        journal_data.append(journal_item)

    # 【修正箇所2】Idの順に返すようにソート
    journal_data.sort(key=lambda x: x['id'])

    # 【修正箇所3】API Gateway経由で返すレスポンス形式に変更
    # JSONデータとレスポンスヘッダーを返却
    return {
        "isBase64Encoded": False,
        "statusCode": 200,
        "body": json.dumps(journal_data, ensure_ascii=False),
        "headers": {
            "content-type": "application/json"
        }
    }