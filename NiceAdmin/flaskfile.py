from flask import Flask, render_template

app = Flask(__name__)

@app.route('/', methods= ['GET'])
def helo():
    return render_template('questionaire.html')

if __name__ == '__main__':
    app.run(port=3000, debug=True)

