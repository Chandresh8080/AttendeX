from flask import Flask, request, jsonify
import sheets_functions
import time

app = Flask(__name__)

@app.route('/')
def index():
    enroll = request.args.get('enroll')
    param = request.args.get('sheet',"")
    param = param.split("~")
    status = "Faliure"
    if enroll is not None and param is not None:
        sheet = param[0]
        user_ts = param[1]
        current_timestamp = time.time()
        print(current_timestamp)
        if int(user_ts)>=int(current_timestamp):
          try:
            status = sheets_functions.update_google_sheet(enroll, sheet_name=sheet)
          except Exception as e:
            print("Try Again!!")

    return jsonify({'status': status})

@app.route('/ip')
def get_ip():
    enroll = request.args.get('enroll')
    sheet = request.args.get('sheet')
    status = sheets_functions.update_google_sheet(enroll, sheet_name=sheet)
    return jsonify({'status': status})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
