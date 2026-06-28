import json
import boto3
dynamodb_client = boto3.client('dynamodb')

def lambda_handler(event, context):
    # Journals テーブルを対象にスキャンメソッドを実行し、
    # レスポンスの Item 部分を変数 journals に格納する
    response = dynamodb_client.scan(
        TableName='Journals',
    )
    journals = response['Items']

    # 取得した Journals の Item を JSON 形式の文字列に変換し、
    # 日本語がそのまま表示される設定でレスポンスする
    return {
        "statusCode": 200,
        "body": json.dumps(journals, ensure_ascii=False)
    }