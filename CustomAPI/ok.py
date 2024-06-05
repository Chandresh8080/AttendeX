from flask import Flask, request, render_template
from sheets_functions import *

app = Flask(__name__)


@app.route('/')
def index():
    return render_template('index.html')


@app.route('/ip')
def get_ip():
    user_ip = request.remote_addr
    enroll = request.args.get('enroll')
    sheet = request.args.get('sheet')
    update_google_sheet(enroll, sheet_name=sheet)
    return user_ip


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True, threaded=True, use_reloader=False)
