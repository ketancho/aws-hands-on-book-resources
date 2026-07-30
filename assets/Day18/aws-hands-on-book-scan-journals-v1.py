import json
import boto3
dynamodb_client = boto3.client('dynamodb')

def lambda_handler(event, context):
    # Journalsテーブルをscanし、
    # レスポンスのItem部分を変数journalsに格納する
    response = dynamodb_client.scan(
        TableName='Journals',
    )
    journals = response['Items']

    # 取得したJournalsのItemをJSON形式の文字列に変換し、
    # 日本語がそのまま表示される設定でレスポンスする
    return {
        "statusCode": 200,
        "body": json.dumps(journals, ensure_ascii=False)
    }